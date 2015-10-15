<?php

namespace Mod3\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
		$panel_left_service = $this->getServiceLocator()->get('panel_left_service');


	    $arrayLeft = array(
		    'var_1' => 'some_1',
		    'var_2' => 'some_2',
		    'var_3' => 'some_3',
		    'var_4' => 'some_4',
	    );
	    $panel_left_service->initPanelLeft($arrayLeft);

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
