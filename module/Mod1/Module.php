<?php

namespace Mod1;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);


	    $app = $e->getApplication();
	    // get the shared events manager
	    $sem = $app->getEventManager()->getSharedManager();
	    // listen to 'MyEvent' when triggered by the IndexController
	    // регистрируем слушателя на событие MyEvent
	    $sem->attach('Mod1\Controller\IndexController', 'MyEvent', function($e) {
		    \Zend\Debug\Debug::dump('MyEvent');
	    });
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

	public function getServiceConfig()
	{
		return array (
			'factories' => array (
				'TestService' => 'Mod1\Factories\TestServiceFactory',
			),
			'abstract_factories' => array (
			),
		);
	}
}
