<?php

namespace ModT\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;

class PostController extends AbstractActionController
{
	/**
	 * @var EntityManager
	 */
	protected $entityManager;

	/**
	 * Sets the EntityManager
	 *
	 * @param EntityManager $em
	 * @access protected
	 * @return PostController
	 */
	protected function setEntityManager(EntityManager $em)
	{
		$this->entityManager = $em;
		return $this;
	}

	/**
	 * Returns the EntityManager
	 *
	 * Fetches the EntityManager from ServiceLocator if it has not been initiated
	 * and then returns it
	 *
	 * @access protected
	 * @return EntityManager
	 */
	protected function getEntityManager()
	{
		if (null === $this->entityManager)
		{
			$this->setEntityManager($this->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
		}
		return $this->entityManager;
	}

	public function indexAction()
	{
		$repository = $this->getEntityManager()->getRepository('Mod1\Entity\Post');
		$posts      = $repository->findAll();

		return array(
			'posts' => $posts
		);
	}

	public function addAction()
	{

	}

	public function editAction()
	{

	}

	public function deleteAction()
	{

	}
}
