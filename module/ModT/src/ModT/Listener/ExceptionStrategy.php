<?php

namespace ModT\Listener;

use Zend\View\Model\ViewModel,
	Zend\EventManager\AbstractListenerAggregate,
	Zend\EventManager\EventManagerInterface,
	Zend\Mvc\MvcEvent;

class ExceptionStrategy extends AbstractListenerAggregate
{
	/** @var \Zend\Mvc\MvcEvent $_event */
	protected $_event;

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
		$this->_event = $event;
		$exception = $event->getParam('exception');

		if ($exception instanceof \ModT\Exception\AccessDeniedException)
		{
			$this->displayError('mod3/access_denied');
		}
		else if ($exception instanceof \ModT\Exception\NoAccessException)
		{
			$this->displayError('mod3/no_access');
		}
		else if ($exception instanceof \ModT\Exception\Page404Exception)
		{
			$this->displayError('error/404', 404);
		}
	}

	protected function displayError($template, $status = 403)
	{
		$model = new ViewModel();
		$model->setTerminal(false);

		$model->setTemplate($template);

		/** @var $response  \Zend\Http\PhpEnvironment\Response */
		$response = $this->_event->getResponse();
		$response->setStatusCode($status);

		$this->_event->setResponse($response);
		$this->_event->setResult($model);

		return;
	}
}
