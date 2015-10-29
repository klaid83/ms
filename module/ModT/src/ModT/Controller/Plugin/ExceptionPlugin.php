<?php
namespace ModT\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use RuntimeException;

class ExceptionPlugin extends AbstractPlugin
{
	public function accessDeniedAction()
	{
		throw new \ModT\Exception\AccessDeniedException();
	}

	public function noAccessAction()
	{
		throw new \ModT\Exception\NoAccessException();
	}

	public function page404()
	{
		throw new \ModT\Exception\Page404Exception();
	}

}