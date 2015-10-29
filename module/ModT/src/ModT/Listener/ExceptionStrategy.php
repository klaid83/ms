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
		if($exception instanceof \ModT\Exception\AccessDeniedException
			|| $exception instanceof \ModT\Exception\NoAccessException
		)
		{

			$model = new ViewModel();
			$model->setTerminal(false);

			if($exception instanceof \ModT\Exception\AccessDeniedException)
			{
				$model->setTemplate('mod3/access_denied');
			}
			elseif ($exception instanceof \ModT\Exception\NoAccessException)
			{
				$model->setTemplate('mod3/no_access');
			}

			/** @var $response  \Zend\Http\PhpEnvironment\Response */
			$response = $event->getResponse();
			$response->setStatusCode(403);

			$event->setResponse($response);
			$event->setResult($model);
			return;
		}
	}
}
