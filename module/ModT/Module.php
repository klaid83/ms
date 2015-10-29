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
		$serviceManager = $e->getApplication()->getServiceManager();
		$eventManager->attachAggregate($serviceLocator->get('Listener.ExceptionStrategy'));
		$eventManager->attach(MvcEvent::EVENT_DISPATCH_ERROR, function(MvcEvent $event) use ($serviceManager ){

			$exception = $event->getParam('exception');

			if ($exception)
			{

				do {
					$serviceManager->get('Logger')->crit(
						sprintf(
							"%s:%d %s (%d) [%s]\n",
							$exception->getFile(),
							$exception->getLine(),
							$exception->getMessage(),
							$exception->getCode(),
							get_class($exception)
						)
					);
				}
				while($ex = $exception->getPrevious());

				$response = $event->getResponse();
				$response->setHeaders(
					$response->getHeaders()->addHeaderLine('Location', "/error-page")
				);
				$response->setStatusCode(302);
				$response->sendHeaders();
				return $response;
			}
		});
	}


//	}

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



//	public function getServiceConfig()
//	{
//		return array(
//			'factories' => array(
//				'Logger' => function ($sm) {
//					$filename = 'log_' . date('F') . '.txt';
//					$log = new Logger();
//
//					if(!is_dir('./data/logs')){
//						mkdir('./data/logs');
//						chmod('./data/logs', 0777);
//					}
//
//					$writer = new Stream('./data/logs/' . $filename);
//					$log->addWriter($writer);
//					return $log;
//				}
//			),
//		);
//	}


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

	public function getControllerPluginConfig() {
		return array(
			'invokables' => array(
				'page_exception' => 'ModT\Controller\Plugin\ExceptionPlugin',
			)
		);
	}
}
