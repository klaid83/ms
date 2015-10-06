<?php

namespace Mod1\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
	    /** @var \Mod1\Service\TestService $testService */
	    $testService = $this->getServiceLocator()->get('TestService');


//	    return $this->page404();


//	    \Zend\Debug\Debug::dump($testService->getVar1());
//	    \Zend\Debug\Debug::dump($testService->getVar2());

	    // создаем событие MyEvent
	    $this->getEventManager()->trigger('MyEvent', $this);

        return new ViewModel(array('vars' => $testService->getVars()));
    }

	public function page404()
	{
		$view = new ViewModel();
		$view->setTerminal(true);
		$view->setTemplate('mod1/test_template');
//		$this->getResponse()->setStatusCode(404);
		return $view;
	}

	public function OneToOneInsertAction()
	{
		$em = $this->getServiceLocator()
			->get('doctrine.entitymanager.orm_default');
		// Insert
		$user = new \Mod1\Entity\User();
		$user->setName('name');

		$comment = new \Mod1\Entity\Comment();
		$comment->setMessage('street23');

		$comment->setUser($user);
		$user->setComment($comment);

		$em->persist($user);
		$em->flush();
		die;
	}

	public function OneToOneSelectAction()
	{
		// Select
		$user = $this->getServiceLocator()
			->get('Doctrine\ORM\EntityManager')
			->getRepository('Mod1\Entity\User')
			->findOneById(2);
		\Zend\Debug\Debug::dump($user->getName());
		\Zend\Debug\Debug::dump($user->getComment()->getMessage());
		die;
	}

	public function OneToManyInsertAction()
	{
		$em = $this->getServiceLocator()
			->get('doctrine.entitymanager.orm_default');

		// Insert
		$user = new \Mod1\Entity\User1();
		$user->setName('name1');

		$comment1 = new \Mod1\Entity\Comment1();
		$comment1->setMessage('comment3');
		$comment1->setUser($user);
		$comment2 = new \Mod1\Entity\Comment1();
		$comment2->setMessage('comment4');
		$comment2->setUser($user);

		$user->getComments()->add($comment2);
		$user->getComments()->add($comment1);

		$em->persist($user);
		$em->flush();
		die;
	}


	public function OneToManySelectAction()
	{
		// Select
//		$em = $this->getServiceLocator()
//			->get('doctrine.entitymanager.orm_default');
//		$user = $em->find('Mod1\Entity\User1', 2);
//		$user->getComments()->toArray();

		$user = $this->getServiceLocator()
			->get('Doctrine\ORM\EntityManager')
			->getRepository('Mod1\Entity\User1')
			->findOneById(2);

		\Zend\Debug\Debug::dump($user->getName());
		foreach($user->getComments()->toArray() as $comment)
		{
			\Zend\Debug\Debug::dump($comment->getMessage());
		}
		die;
	}

	public function OneToManySelfRefInsertAction()
	{
		$em = $this->getServiceLocator()
			->get('doctrine.entitymanager.orm_default');

		// Insert
		$comment2 = new \Mod1\Entity\Comment2();
		$comment2->setMessage('parent');

		$comment1 = new \Mod1\Entity\Comment2();
		$comment1->setMessage('children1');
		$comment1->setParent($comment2);
		$comment3 = new \Mod1\Entity\Comment2();
		$comment3->setMessage('children2');
		$comment3->setParent($comment2);

		$comment2->getChildren()->add($comment1);
		$comment2->getChildren()->add($comment3);

		$em->persist($comment2);
		$em->flush();

		die;
	}


	public function OneToManySelfRefSelectAction()
	{
		// Select
		$em = $this->getServiceLocator()
			->get('doctrine.entitymanager.orm_default');

		//retrieving
		$comment = $em->find('Mod1\Entity\Comment2', 1);
		foreach($comment->getChildren()->toArray() as $children)
		{
			\Zend\Debug\Debug::dump($children->getMessage());
		}

		die;
	}


	public function ManyToManyInsertAction()
	{
		// Select
		$em = $this->getServiceLocator()
			->get('doctrine.entitymanager.orm_default');

		// persisting
		$plumber = new \Mod1\Entity\User3();
		$plumber->setName('Plumber Builder');

		$plaster = new \Mod1\Entity\User3();
		$plaster->setName('Plaster Builder');

		$categoryPlumber = new \Mod1\Entity\Category3();
		$categoryPlumber->setName('Plumber Category');
		$categoryBeer_Drinkers = new \Mod1\Entity\Category3();
		$categoryBeer_Drinkers->setName('Beer_Drinkers Category');

		$categoryPlumber->getUsers()->add($plumber);
		$categoryBeer_Drinkers->getUsers()->add($plaster);
		$categoryBeer_Drinkers->getUsers()->add($plumber);

		$plumber->getCategories()->add($categoryPlumber);
		$plumber->getCategories()->add($categoryBeer_Drinkers);
		$plaster->getCategories()->add($categoryBeer_Drinkers);

		$em->persist($plumber);
		$em->persist($plaster);
		$em->flush();

		die;
	}

	public function ManyToManySelectAction()
	{
		// Select
		$em = $this->getServiceLocator()
			->get('doctrine.entitymanager.orm_default');

		//retrieving
		$plumber = $em->find('Mod1\Entity\User3', 1);
		//get last categories for plumber
		$plumber->getCategories()->toArray();
		//get last category(Beer_Drinkers Category) and all users for this category
		$somes = $plumber->getCategories()->last()->getUsers()->toArray();


		foreach($somes as $some)
		{
			\Zend\Debug\Debug::dump($some->getName());
		}

		die;
	}

	public function InheritanceInsertAction()
	{
		$em = $this->getServiceLocator()
			->get('doctrine.entitymanager.orm_default');

		// persisting
		$stage_selection = new \Mod1\Entity\StageSelection();
		$stage_selection->setSpecialNumber('8888');
		$stage_selection->setType('type');

		$stage_selection1 = new \Mod1\Entity\StageSelection1();
		$stage_selection1->setSpecialNumber('7777');
		$stage_selection1->setType('type1');

		$em->persist($stage_selection);
		$em->persist($stage_selection1);
		$em->flush();

		die;
	}

	public function InheritanceSelectAction()
	{
		$em = $this->getServiceLocator()
			->get('doctrine.entitymanager.orm_default');

		//retrieving
		$stage_selection = $em->find('Mod1\Entity\StageSelection', 6);
		$stage_selection1 = $em->find('Mod1\Entity\StageSelection1', 5);
		\Zend\Debug\Debug::dump($stage_selection->getType());
		\Zend\Debug\Debug::dump($stage_selection1);
		die;
	}


	public function ContryCityInsertAction()
	{
		die;

		$em = $this->getServiceLocator()
			->get('doctrine.entitymanager.orm_default');

		// Insert
		$country = new \Mod1\Entity\Country();
		$country->setName('Россия');
		$country->setDescription('Описание России');


		$city = new \Mod1\Entity\City();
		$city->setName('Нижний Новгород');
		$city->setDescription('Описание Нижнего Новгорода');
		$city->setCountry($country);

		$city1 = new \Mod1\Entity\City();
		$city1->setName('Москва');
		$city1->setDescription('Описание Москвы');
		$city1->setCountry($country);


		$country->getCities()->add($city);
		$country->getCities()->add($city1);

		$em->persist($country);
		$em->flush();
		die;
	}

	public function ContryCitySelectAction()
	{
		// Select
		$em = $this->getServiceLocator()
			->get('doctrine.entitymanager.orm_default');

		// all cities for country
		$country = $em->find('Mod1\Entity\Country', 1);
		\Zend\Debug\Debug::dump($country->getName());
//		\Zend\Debug\Debug::dump($country->getCities()->toArray());
		/** @var $city \Mod1\Entity\City */
		foreach($country->getCities() as $city)
		{
			\Zend\Debug\Debug::dump($city->getDescription());
		}

		// get city
		$city = $em->find('Mod1\Entity\City', 1);

		\Zend\Debug\Debug::dump($city->getName());
		\Zend\Debug\Debug::dump($city->getCountry()->getName());
		\Zend\Debug\Debug::dump($city->getCountry()->getDescription());

		die;
	}

	public function ResortInsertAction()
	{
		$em = $this->getServiceLocator()
			->get('doctrine.entitymanager.orm_default');

		// Insert
		$country = $em->find('Mod1\Entity\Country', 3);;

		$city = $em->find('Mod1\Entity\City', 5);
		$city->setCountry($country);

		$resort = new \Mod1\Entity\Resort();
		$resort->setName('Курорт');
		$resort->setDescription('Описание Курорта');
		$resort->setCity($city);

		$city->getResorts()->add($resort);

		$country->getCities()->add($city);

		$em->persist($country);
		$em->flush();

		die;
	}

	public function ResortSelectAction()
	{
		// Select
		$em = $this->getServiceLocator()
			->get('doctrine.entitymanager.orm_default');

		$resort = $em->find('Mod1\Entity\Resort', 1);
		\Zend\Debug\Debug::dump($resort->getName());
		\Zend\Debug\Debug::dump($resort->getCity()->getName());
		\Zend\Debug\Debug::dump($resort->getCity()->getCountry()->getName());
		die;
	}

	public function ResortInsert1Action()
	{
		$em = $this->getServiceLocator()
			->get('doctrine.entitymanager.orm_default');

		// Insert
		$resort = new \Mod1\Entity\Resort();
		$resort->setName('Курорт1');
		$resort->setDescription('Описание Курорта1');
		$resort->setCity($em->find('Mod1\Entity\City', 5));

		$em->persist($resort);
		$em->flush();

		die;
	}


	public function countriesAction()
	{
		$countries = $this->getServiceLocator()
			->get('Doctrine\ORM\EntityManager')
			->getRepository('Mod1\Entity\Country')
			->findAll();

		return new ViewModel(array(
			'countries' => $countries
		));
	}

	public function countryAction()
	{
		$id = (int) $this->params()->fromRoute('id', 0);

		if (!$id)
		{
			$this->flashMessenger()->addErrorMessage('Country id doesn\'t set');
//			return $this->redirect()->toRoute('blog');
		}

		$em = $this->getServiceLocator()
			->get('doctrine.entitymanager.orm_default');

		$country = $em->find('Mod1\Entity\Country', $id);

		if (!$country instanceof \Mod1\Entity\Country)
		{
			return $this->page404();
//			die('FAIL');
		}

		return new ViewModel(array(
			'country' => $country
		));
	}

	public function citiesAction()
	{
		$id = (int) $this->params()->fromQuery('id');

		$country = $this->getServiceLocator()
			->get('Doctrine\ORM\EntityManager')
			->getRepository('Mod1\Entity\Country')
			->find($id);

		if (!$country instanceof \Mod1\Entity\Country)
		{
			die("FAIL COUNTRY");
		}

		return new ViewModel(array(
			'country' => $country
		));
	}

	public function cityAction()
	{
		$id = (int) $this->params()->fromQuery('id');

		$em = $this->getServiceLocator()
			->get('doctrine.entitymanager.orm_default');

		$city = $em->find('Mod1\Entity\City', $id);

		if (!$city instanceof \Mod1\Entity\City)
		{
			die('FAIL');
		}

		return new ViewModel(array(
			'city' => $city
		));
	}

}
