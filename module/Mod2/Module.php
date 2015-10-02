<?php

namespace Mod2;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
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

	public function getFormElementConfig()
	{
		return array(
			'factories' => array(
				'commentForm' => function($sm)
				{
					$form = new \Mod2\Form\CommentForm();
					$form->setInputFilter(new \Mod2\Form\CommentFilter());
					$form->setHydrator(new \Zend\Stdlib\Hydrator\ObjectProperty());
					return $form;
				},
			),
		);
	}
}
