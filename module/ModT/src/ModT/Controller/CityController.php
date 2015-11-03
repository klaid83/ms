<?php

namespace ModT\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CityController extends AbstractActionController
{
    public function indexAction()
    {
	    $view_model = new ViewModel();

        return $view_model->setVariables(
	        array()
        );
    }
}
