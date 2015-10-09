<?php

namespace Mod1;


use Mod1\Exception\AccessDeniedException;
use Mod1\Exception\NoAccessException;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Log\Logger;
use Zend\Log\Writer\Stream;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Model\ViewModel;
use Zend\ModuleManager\Feature\FormElementProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ServiceManager\ServiceManager;

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




//	    $this->registerErrorHandling($e);
//	    $em = $e->getApplication()->getEventManager();
//	    $em->attach('dispatch', array($this, 'checkAuth'), 100);
//	    $em->attach(MvcEvent::EVENT_ROUTE, array($this, 'checkAuth'), 100);
//	    // OR
//	    $em->attach(MvcEvent::EVENT_DISPATCH_ERROR, function() {
//		    \Zend\Debug\Debug::dump('checkAuth');
//		    // Some logic.
//	    }, 100);
//
//	    /**
//	    MvcEvent::EVENT_BOOTSTRAP
//	    MvcEvent::EVENT_DISPATCH
//	    MvcEvent::EVENT_DISPATCH_ERROR
//	    MvcEvent::EVENT_FINISH
//	    MvcEvent::EVENT_RENDER
//	    MvcEvent::EVENT_ROUTE
//	     */
    }

	public function checkAuth()
	{
		\Zend\Debug\Debug::dump('function checkAuth');
		// Some logic.
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
				'ErrorHandling' => 'Mod1\Factories\ErrorHandlingFactory',
			),
			'abstract_factories' => array (
			),
		);
	}


	/**
	 * @param MvcEvent $e
	 */
	public function registerErrorHandling(MvcEvent $e)
	{

		$eventManager = $e->getApplication()->getEventManager();
		$eventManager->attach(
			MvcEvent::EVENT_DISPATCH_ERROR,
			function ($event) use ($e) {
				$sm = $e->getApplication()->getServiceManager();
				$service = $sm->get('ErrorHandling');

				$exception = $event->getResult()->exception;
				if ($exception) {
					$service->logException($exception);
				}
			}
		);
		set_error_handler(
			function ($c, $m, $f, $l) use ($e) {
				$sm = $e->getApplication()->getServiceManager();
				$service = $sm->get('ErrorHandling');
				$service->logException(func_get_args());
			}
		);
		register_shutdown_function(
			function () use ($e) {
				$error = error_get_last();
				$sm = $e->getApplication()->getServiceManager();
				if ($error &&
					($error['type'] == E_ERROR || $error['type'] == E_PARSE || $error['type'] == E_COMPILE_ERROR)
				) {
					$service = $sm->get('ErrorHandling');
					if (strpos($error['message'], 'Allowed memory size') == 0) {
						ini_set('memory_limit', (intval(ini_get('memory_limit')) + 64) . "M");
					}
					$service->logException($error);
				}
			}
		);
	}


	/**
	 *
	 * Регистрирует изменённую стратегию рендеринга PhpRenderStrategy
	 *
	 * @param MvcEvent $e
	 */
	public function attachCustomPhpRenderer(MvcEvent $e)
	{
		$matches = $e->getRouteMatch();
		$controller = $matches->getParam('controller');
		$action = $matches->getParam('action');
		$initialNamespace = $matches->getParam('initialNamespace');
		if (false === strpos($controller, __NAMESPACE__)) {
			// not a controller from this module
			return;
		}
		//Action create-closed используется из другого экшона
		if (false === strpos($initialNamespace, __NAMESPACE__) && $action == 'create-closed') {
			return;
		}
		$locator = $sm = $e->getApplication()->getServiceManager();
		$view = $locator->get('Zend\View\View');
		$metaRenderStrategy = $locator->get('PhpRendererStrategy');
		$view->getEventManager()->attach($metaRenderStrategy);
	}

}
