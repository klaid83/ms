<?php

namespace Mod2\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class AbstractController extends  AbstractActionController
{

	public function page404()
	{
		$response = $this->getResponse();
		$response->setStatusCode(404);

		$this->getEvent()->getViewModel()->setTemplate('mod2/404');
		$this->getEvent()->setResponse($response);
		return $this->getEvent()->getViewModel();
	}

	public function page403()
	{
		$response = $this->getResponse();
		$response->setStatusCode(403);

		$this->getEvent()->getViewModel()->setTemplate('mod2/403');
		$this->getEvent()->setResponse($response);
		return $this->getEvent()->getViewModel();
	}
}
