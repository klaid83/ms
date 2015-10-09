<?php

namespace Mod3;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;

class Module
{
	public function onBootstrap(MvcEvent $e)
	{
		$app                 = $e->getApplication();
		$eventManager        = $app->getEventManager();
		$serviceLocator      = $app->getServiceManager();
		$moduleRouteListener = new ModuleRouteListener();
		$moduleRouteListener->attach($eventManager);

		$eventManager->attachAggregate($serviceLocator->get('Listener.GuardExceptionStrategy'));
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

	/**
	 * @return array
	 */
	public function getServiceConfig()
	{
		return include __DIR__ . '/config/services.config.php';
	}
}
