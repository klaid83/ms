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

//retrieving
//		$plumber = $em->find('SoleTrader', $plumber->getId());
//		$plumber->getAddress();
		die;
	}



}
