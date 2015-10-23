<?php
namespace ModT\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class MenuServiceFactory implements FactoryInterface
{

	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$service = new MenuService;
		$service->setSl($serviceLocator);
		return $service;
	}
}