<?php

namespace Mod2;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\ModuleManager\ModuleManager;

class Module
{
	//module.php
	public function init(ModuleManager $moduleManager){
		$sharedEvents = $moduleManager->getEventManager()->getSharedManager();
		$sharedEvents->attach(__NAMESPACE__, 'dispatch', function($e) {
			$controller = $e->getTarget();
			$controller->layout('layout/new_layout');

			// или делать проверку на контроллер или еще чё-нить
//			if ($controller instanceof Controller\FrontEndController) {
//				$controller->layout('layout/new_layout');
//			}
		}, 100);
	}

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

	public function getViewHelperConfig()
	{
		return array(
			'factories' => array(
				'test_helper' => function($sm) {
					$helper = new View\Helper\Testhelper ;
					return $helper;
				}
			)
		);
	}
}
