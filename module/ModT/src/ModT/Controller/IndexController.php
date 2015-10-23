<?php

namespace ModT\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
	    $country = $this->params()->fromRoute('country', 0);
	    $city    = $this->params()->fromRoute('city', 0);


//	    if (!$id)
	    {
		    $this->flashMessenger()->addErrorMessage('City id doesn\'t set');
//			return $this->redirect()->toRoute('blog');
	    }




	    \Zend\Debug\Debug::dump($country);
	    \Zend\Debug\Debug::dump($city);







	    /** @var $menu_service \ModT\Service\MenuService */
	    $menu_service = $this->getServiceLocator()->get('menu_service');

	    $menu = array(
		    'vars' => array(
			    'menu_country' => array(
				    'russia' => 'Россия',
				    'strana_1' => 'Страна 1',
				    'strana_2' => 'Страна 2',
				    'strana_3' => 'Страна 3',
				    'strana_4' => 'Страна 4',
				    'strana_5' => 'Страна 5',
			    ),
			    'menu_city' => array(
				    'gorod_1' => 'Город 1',
				    'gorod_2' => 'Город 2',
				    'gorod_3' => 'Город 3',
				    'gorod_4' => 'Город 4',
				    'gorod_5' => 'Город 5',
				    'gorod_6' => 'Город 6',
			    ),
		    )
	    );
	    $menu_service->initPanelLeft($menu);
        return new ViewModel();
    }

}
