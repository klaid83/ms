<?php
namespace ModT\Service;

use Zend\View\Model\ViewModel;

class MenuService
{
	/** @var $sl \Zend\ServiceManager\ServiceManager */
	protected $sl;

	public function initPanelLeft($arrayLeft)
	{
		/** @var $view \Zend\View\Model\ViewModel */
		$view = $this->getSl()->get('view_manager')->getViewModel();

		/** @var  $view_children \Zend\View\Model\ViewModel */
		foreach($view->getChildren() as $view_children)
		{
			if ($view_children->captureTo() == 'panelLeft')
			{
				$view_children->setVariables($arrayLeft);
				break;
			}
		}
	}

	public function setSl($sl)
	{
		$this->sl = $sl;
	}

	public function getSl()
	{
		return $this->sl;
	}
}

