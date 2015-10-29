<?php

namespace ModT\Listener;

use Zend\View\Model\ViewModel,
	Zend\EventManager\AbstractListenerAggregate,
	Zend\EventManager\EventManagerInterface,
	Zend\Mvc\MvcEvent;

class ExceptionStrategy extends AbstractListenerAggregate
{
	/**
	 * @param  \Zend\EventManager\EventManagerInterface $events
	 * @return void
	 */
	public function attach(EventManagerInterface $events)
	{
		$this->listeners[] = $events->attach(
			MvcEvent::EVENT_DISPATCH_ERROR,
			array($this, 'onDispatchError'),
			0
		);
	}

	/**
	 * @param  \Zend\Mvc\MvcEvent $event
	 * @return void
	 */
	public function onDispatchError(MvcEvent $event)
	{
		$exception = $event->getParam('exception');

		if ($exception instanceof \ModT\Exception\AccessDeniedException)
		{
			$this->displayError($event, 403, 'mod3/access_denied');
		}
		else if ($exception instanceof \ModT\Exception\NoAccessException)
		{
			$this->displayError($event, 403, 'mod3/no_access');
		}
		else if ($exception instanceof \ModT\Exception\Page404Exception)
		{
			$this->displayError($event, 404, 'error/404');
		}
	}

	protected function displayError($event, $status, $template)
	{
		$model = new ViewModel();
		$model->setTerminal(false);

		$model->setTemplate($template);

		/** @var $response  \Zend\Http\PhpEnvironment\Response */
		$response = $event->getResponse();
		$response->setStatusCode($status);

		$event->setResponse($response);
		$event->setResult($model);

		return;
	}
}
