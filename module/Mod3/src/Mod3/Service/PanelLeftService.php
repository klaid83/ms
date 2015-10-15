<?php
namespace Mod3\Service;

use Zend\View\Model\ViewModel;

class PanelLeftService
{
	protected $sl;

	public function initPanelLeft($arrayLeft)
	{

		/** @var $view \Zend\View\Model\ViewModel */
		$view = $this->sl->get('view_manager')->getViewModel();

		/** @var  $view_children \Zend\View\Model\ViewModel */
		foreach($view->getChildren() as $view_children)
		{
			if ($view_children->captureTo() == 'panelLeft')
			{
				$view_children->setVariables($arrayLeft);
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

