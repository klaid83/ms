<?php

namespace Mod3;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;

class Module
{
	public function onBootstrap(MvcEvent $e)
	{
		$eventManager        = $e->getApplication()->getEventManager();
		$moduleRouteListener = new ModuleRouteListener();
		$moduleRouteListener->attach($eventManager);

		// отлавливаем exception
		$eventManager->attach(MvcEvent::EVENT_DISPATCH_ERROR, array($this, 'exceptionHandler'));

	}

	public function getConfig()
	{
		return include __DIR__ . '/config/module.config.php';
	}

	public function getAutoloaderConfig()
	{
		return array(
			'Zend\Loader\StandardAutoloader' => array(
				'namespaces' => array(
					__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
				),
			),
		);
	}

	public function exceptionHandler(MvcEvent $e)
	{
		$exception = $e->getParam('exception');

		if($exception instanceof \Mod3\Exception\AccessDeniedException || $exception instanceof \Mod3\Exception\NoAccessException) {
			$model = new ViewModel();
			$model->setTerminal(false);

			if($exception instanceof \Mod3\Exception\AccessDeniedException) {
				$model->setTemplate('mod3/access_denied');
			} elseif ($exception instanceof \Mod3\Exception\NoAccessException) {
				$model->setTemplate('mod3/no_access');
			}

			$response = $e->getResponse();
			$response->setStatusCode(403);

			$e->setResponse($response);
			$e->setResult($model);
			return;
		}
	}
}
