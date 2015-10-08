<?php

namespace Mod1\Factories;

use Mod1\Service\ErrorHandling;
use Zend\Log\Logger;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Log\Writer\Stream as LogWriterSteam;

class ErrorHandlingFactory implements FactoryInterface
{

	/**
	 * Create service
	 *
	 * @param ServiceLocatorInterface $serviceLocator
	 *
	 * @return mixed
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$filename = PROJECT_ROOT_PATH . '/data/log/error_' . date('d_m_Y') . '.log';

		$log = new Logger();


		$writer = new LogWriterSteam($filename);
		$log->addWriter($writer);
		$errorHandler = new ErrorHandling($log);
		return $errorHandler;
	}
}
