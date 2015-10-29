<?php
namespace ModT\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use RuntimeException;

class ExceptionPlugin extends AbstractPlugin
{
	public function page404()
	{
		throw new \Mod3\Exception\AccessDeniedException();
	}

	public function page403()
	{
		throw new \Mod3\Exception\NoAccessException();
	}

	public function testPlugin()
	{
		\Zend\Debug\Debug::dump('testPlugin');
	}

	public function accessDeniedAction()
	{
		throw new \Mod3\Exception\AccessDeniedException();
	}

	public function noAccessAction()
	{
		throw new \Mod3\Exception\NoAccessException();
	}
}