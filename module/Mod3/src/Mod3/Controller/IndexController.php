<?php

namespace Mod3\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
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
