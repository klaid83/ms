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

	protected $_left_menu = array();


    public function indexAction()
    {
	    $view_model = new ViewModel();
	    $view_model->setTemplate('modt/countries');

	    $this->_leftMenu();

	    $countries = $this->getServiceLocator()
		    ->get('Doctrine\ORM\EntityManager')
		    ->getRepository('Mod1\Entity\Country')
		    ->findAll();

        return $view_model->setVariables(
	        array(
		        'countries' => $countries
	        )
        );
    }

	protected function _leftMenu()
	{
		if ($this->_city)
		{
			$this->_initMenuCity();
		}
		else if ($this->_country)
		{
			$this->_initMenuCountry();
		}
	    /** @var $menu_service \ModT\Service\MenuService */
	    $menu_service = $this->getServiceLocator()->get('menu_service');
		$menu_service->initPanelLeft($this->_left_menu);
	}

	protected function _initMenuCountry()
	{
		$this->_left_menu = array(
				'menu' => array(
					'menu_title' => 'Country',
					'menu_country' => 'country',
					'menu_data' => array(
					    'russia' => 'Россия',
					    'strana_1' => 'Страна 1',
					    'strana_2' => 'Страна 2',
					    'strana_3' => 'Страна 3',
					    'strana_4' => 'Страна 4',
					    'strana_5' => 'Страна 5',
				    )
			    ),
				'type' => 1,
	        );
	}

	protected function _initMenuCity()
	{
		$this->_left_menu = array(
			'menu' => array(
			    'menu_title' => 'Country:City',
				'menu_country' => 'country_city',
			    'menu_data' => array(
				    'gorod_1' => 'Город 1',
				    'gorod_2' => 'Город 2',
				    'gorod_3' => 'Город 3',
				    'gorod_4' => 'Город 4',
				    'gorod_5' => 'Город 5',
				    'gorod_6' => 'Город 6',
			    ),
		    ),
			'type' => 2,
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
		$this->_leftMenu();
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
		$this->_leftMenu();
		return $view_model->setVariables(
			array(
				'country' => $this->_country,
				'city'    => $this->_city,
			)
		);
	}

}
