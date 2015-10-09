<?php

namespace Mod3\Listener;

use Zend\View\Model\ViewModel,
	Zend\EventManager\AbstractListenerAggregate,
	Zend\EventManager\EventManagerInterface,
	Zend\Mvc\MvcEvent;

class GuardExceptionStrategy extends AbstractListenerAggregate
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

		if($exception instanceof \Mod3\Exception\AccessDeniedException
			|| $exception instanceof \Mod3\Exception\NoAccessException
		)
		{
			$model = new ViewModel();
			$model->setTerminal(false);

			if($exception instanceof \Mod3\Exception\AccessDeniedException)
			{
				$model->setTemplate('mod3/access_denied');
			}
			elseif ($exception instanceof \Mod3\Exception\NoAccessException)
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
