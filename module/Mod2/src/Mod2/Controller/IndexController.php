<?php

namespace Mod2\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Form\Annotation\AnnotationBuilder;
use Zend\View\Model\JsonModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {

        return new ViewModel();
    }

	public function simpleAction()
	{
		$formManager = $this->serviceLocator->get('FormElementManager');
		$form = $formManager->get('commentForm');

		// prepare data
		$comment = new \Mod2\Form\CommentForm();
		$comment->type = 3;
		$comment->comment = 'Test';

		$form->bind($comment);
		$request = $this->getRequest();

		if ($request->isPost())
		{
			$form->setData($request->getPost());
			if ($form->isValid())
			{
				var_dump($comment->type);    // value
				var_dump($comment->comment); // value
				var_dump($comment->get('type'));    // element form`s
				var_dump($comment->get('comment')); // element form`s
			}
		}

		return array('form' => $form);
	}


	public function annotationSimpleAction()
	{
		// prepare data
		$comment = new \Mod2\Entity\Comment1();
		$comment->type = 2;
		$comment->comment = 'Test annotation';

		$builder = new AnnotationBuilder();
		$form = $builder->createForm($comment);
		$form->add(array(
			'name' => 'submit',
			'attributes' => array(
				'type' => 'submit',
				'value' => 'Go',
				'id' => 'submitbutton',
			),
		));

		$form->bind($comment);

		$request = $this->getRequest();
		if ($request->isPost()) {
			$form->setData($request->getPost());
			if ($form->isValid()) {
				var_dump($comment);
			}
		}
		return array('form' => $form);
	}

	public function viewAction()
	{
		$this->layout()->setTemplate('layout/new_layout');

		$view = new ViewModel();
		$view->setTemplate('mod2/test_template2');
		$view->setVariables(array('var1' => 12, 'var2' => 34, 'var3' => 56));

		$sideblockView = new ViewModel();
		$sideblockView->setTemplate('mod2/test_template1');
		$sideblockView->setVariables(array('banner1' => 'foto_1', 'banner2' => 'foto_2', 'banner3' => 'foto_3'));
		$view->addChild($sideblockView, 'sideblock');

		return $view;
	}

	public function setCodeAction()
	{
		$response = $this->getResponse();
		$response->setStatusCode(404);
//		$response->setStatusCode(200);
//		$response->setStatusCode(303);
//		$response->setStatusCode(500);
//		$response->setStatusCode(502);
		return $response;
	}

	public function jsonAction()
	{
		$view = new JsonModel(
			array('success' => '1','data'=>'foo'));
		return $view;
	}


}
