<?php

namespace ModT;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
	public function onBootstrap(MvcEvent $e)
	{

		$app                 = $e->getApplication();
		$eventManager        = $app->getEventManager();
		$serviceLocator      = $app->getServiceManager();
		$moduleRouteListener = new ModuleRouteListener();
		$moduleRouteListener->attach($eventManager);
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

	public function getViewHelperConfig()
	{
		return array(
			'factories' => array(
				'menu_country_helper' => function($sm) {
					$helper = new View\Helper\MenuCountryHelper ;
					return $helper;
				},
				'menu_city_helper' => function($sm) {
					$helper = new View\Helper\MenuCityHelper ;
					return $helper;
				},
			)
		);
	}
}
