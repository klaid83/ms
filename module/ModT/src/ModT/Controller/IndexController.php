<?php

namespace ModT\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
	/** @var $cityInfo \Mod1\Entity\City */
	protected $_city = null;

	/** @var $cityInfo \Mod1\Entity\Country */
	protected $_country = null;


    public function indexAction()
    {
	    $view_model = new ViewModel();
	    $view_model->setTemplate('modt/countries');

//	    /** @var $menu_service \ModT\Service\MenuService */
//	    $menu_service = $this->getServiceLocator()->get('menu_service');
//
//	    $menu = array(
//		    'vars' => array(
//			    'menu_country' => array(
//				    'russia' => 'Россия',
//				    'strana_1' => 'Страна 1',
//				    'strana_2' => 'Страна 2',
//				    'strana_3' => 'Страна 3',
//				    'strana_4' => 'Страна 4',
//				    'strana_5' => 'Страна 5',
//			    ),
//			    'menu_city' => array(
//				    'gorod_1' => 'Город 1',
//				    'gorod_2' => 'Город 2',
//				    'gorod_3' => 'Город 3',
//				    'gorod_4' => 'Город 4',
//				    'gorod_5' => 'Город 5',
//				    'gorod_6' => 'Город 6',
//			    ),
//		    )
//	    );
//	    $menu_service->initPanelLeft($menu);
        return $view_model->setVariables(
	        array(
		        'country' => $this->_country
	        )
        );
    }


	protected function _initCountry($allias)
	{
		$this->_country = $this->getServiceLocator()
			->get('Doctrine\ORM\EntityManager')
			->getRepository('Mod1\Entity\Country')
			->findOneByAllias($allias);

		if (!$this->_country)
		{
			$this->exception()->page404();
		}
	}

	protected function _initCity($allias)
	{
		$citiesByCountry = $this->_country->getCities();

		foreach($citiesByCountry as $cityByCountry)
		{
			if ($cityByCountry->getAllias() == $allias)
			{
				$this->_city = $cityByCountry;
				break;
			}
		}

		if (!$this->_city)
		{
			$this->exception()->page404();
		}
	}


	public function countryAction()
	{
		$alliasCountry = $this->params()->fromRoute('country', 0);

		if (!$alliasCountry)
		{
			$this->exception()->page404();
		}

		$this->_initCountry($alliasCountry);

		$view_model = new ViewModel();
		$view_model->setTemplate('modt/country');

		return $view_model->setVariables(
			array(
				'country' => $this->_country,
			)
		);
	}

	public function cityAction()
	{
		$alliasCountry = $this->params()->fromRoute('country', 0);

		$alliasCity = $this->params()->fromRoute('city', 0);

		if (!$alliasCountry || !$alliasCountry)
		{
			$this->exception()->page404();
		}

		$this->_initCountry($alliasCountry);
		$this->_initCity($alliasCity);

		$view_model = new ViewModel();
		$view_model->setTemplate('modt/city');

		return $view_model->setVariables(
			array(
				'country' => $this->_country,
				'city'    => $this->_city,
			)
		);
	}

}
