<?php

namespace Mod2\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

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
}
