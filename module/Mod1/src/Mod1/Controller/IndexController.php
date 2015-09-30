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
//		return $view;
	}
}
