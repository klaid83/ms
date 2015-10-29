<?php

namespace Mod3;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Console\Request as ConsoleRequest;

class Module
{
	public function onBootstrap(MvcEvent $e)
	{
		//--- do not install MxcLayoutScheme for console requests
		if ($e->getRequest() instanceof ConsoleRequest) return;

		$app                 = $e->getApplication();
		$eventManager        = $app->getEventManager();
		$serviceLocator      = $app->getServiceManager();
		$moduleRouteListener = new ModuleRouteListener();
		$moduleRouteListener->attach($eventManager);

		$eventManager->attachAggregate($serviceLocator->get('Listener.GuardExceptionStrategy'));
		$eventManager->attach($serviceLocator->get('mxc_layoutscheme_service'));
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

	public function getControllerPluginConfig() {
		return array(
			'invokables' => array(
				'layoutScheme' => 'Mod3\Controller\Plugin\LayoutSchemePlugin',
			)
		);
	}

	public function getViewHelperConfig()
	{
		return array(
			'factories' => array(
				'list_helper' => function($sm) {
					$helper = new View\Helper\ListHelper ;
					return $helper;
				},
				'list1_helper' => function($sm) {
					$helper = new View\Helper\List1Helper ;
					return $helper;
				},
				'service_menu_helper' => function($sm) {
					$helper = new View\Helper\ServiceMenuHelper ;
					return $helper;
				},
			)
		);
	}
}
