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


}
