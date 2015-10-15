<?php
namespace Mod3\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PanelLeftServiceFactory implements FactoryInterface
{

	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$service = new PanelLeftService;
		$service->setSl($serviceLocator);
		return $service;
	}
}