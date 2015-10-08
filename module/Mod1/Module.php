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
			'initializers' => array(
				function ($instance, $sm) {
					if ($instance instanceof \Zend\Db\Adapter\AdapterAwareInterface) {
						$instance->setDbAdapter($sm->get('Zend\Db\Adapter\Adapter'));
					}
				}
			),
			'invokables' => array(
				'menu' => 'Mod1\Model\MenuTable'
			),
			'factories' => array (
				'TestService' => 'Mod1\Factories\TestServiceFactory',
				'Navigation' => 'Mod1\Navigation\MyNavigationFactory',
			),
			'abstract_factories' => array (
			),
		);
	}
}
