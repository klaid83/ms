<?php

namespace ModT\View\Helper;

use Zend\Form\View\Helper\AbstractHelper;

class Menu extends AbstractHelper
{
	/**
	 * @var \Zend\ServiceManager\ServiceManager
	 */
	protected $serviceManager;


	/**
	 * @var string
	 */
	protected $currentPage;


	/**
	 * @var array
	 */
	protected $tabs;

	public function __invoke()
	{
		/**
		 * @var $router \Zend\Http\PhpEnvironment\Request
		 */
		$router = $this->getServiceManager()->get('request');

//		$requestSegments = explode("/", $router->getUri()->getPath());
//		\Zend\Debug\Debug::dump($requestSegments); die;
//		if($requestSegments[3] === 'index')
//		{
			$this->setCurrentPage('common');
//		}
//		else
//		{
//			$this->setCurrentPage($requestSegments[3]);
//		}

		$this->renderMenu();
	}



















	/**
	 * @return \Zend\ServiceManager\ServiceManager
	 */
	public function getServiceManager()
	{
		return $this->serviceManager;
	}

	/**
	 * @param \Zend\ServiceManager\ServiceManager $serviceManager
	 */
	public function setServiceManager($serviceManager)
	{
		$this->serviceManager = $serviceManager;
	}

	/**
	 * Renders top menu
	 */
	protected function renderTopMenu()
	{
		echo "<div class='simple-tabs-bar' style='margin-bottom: -2px;'>";
		$this->renderCommonTopMenuItem($this->getCurrentPage());
		$this->renderProposalTopMenuItem($this->getCurrentPage());
		$this->renderProtocolTopMenuItem($this->getCurrentPage());
		echo "</div>";
	}

	/**
	 * Renders bottom menu
	 */
	protected function renderBottomMenu()
	{
		$page = $this->getCurrentPage();
		echo "<div class='simple-tabs-bar' style='margin-bottom: -2px;'>";
		if($page === 'ranking')
		{
			$this->renderRankingMenu();
		}
		elseif($page !== 'proposalIndex' && $page !== 'proposalAddByPosition')
		{
			$this->renderCommonMenu();
		}
		elseif ($page !== 'protocolList')
		{
			$this->renderProposalMenu();
		}
		echo "</div>";
	}

	/**
	 * Renders menu item
	 */
	protected function renderProposalTopMenuItem()
	{
		$page = $this->getCurrentPage();
//		$user = $this->getCurrentUser();
		$isOwner = true;//$user->isOrganizer($this->getProcedure()->getId());
		$active = ($page == 'proposalIndex' || $page == 'proposalAddByPosition');

		if($isOwner)
		{
			$anchor = $this->barItemLink('/renderProposalTopMenuItem/1', 'Заявки');
			echo $this->menuDiv($anchor, $active);
		}
		else
		{
			$anchor = $this->barItemLink('/renderProposalTopMenuItem/2', 'Заявки');
			echo $this->menuDiv($anchor, $active);
		}
	}

	/**
	 * Renders menu item
	 */
	protected function renderCommonTopMenuItem()
	{
		$anchor = $this->barItemLink('/renderCommonTopMenuItem/1', 'Извещение');
		$isActive = $this->getCurrentPage() === 'common' || $this->getCurrentPage() === 'lots';
		echo $this->menuDiv($anchor, $isActive);
	}

	/**
	 * Renders menu item
	 */
	protected function renderProtocolTopMenuItem()
	{
		$anchor = $this->barItemLink('/renderProtocolTopMenuItem/', 'Протоколы');
		echo $this->menuDiv($anchor, $this->getCurrentPage() === 'protocolList');
	}

	/**
	 * Returns string which contains right <a> tag
	 * @param $link
	 * @param $name
	 * @return string
	 */
	protected function barItemLink($link, $name)
	{
		return "<a href='$link'>$name</a>";
	}


	/**
	 * Wraps content specified in param to menuDiv
	 * @param $content string
	 * @param bool $active
	 * @return string
	 */
	protected function menuDiv($content, $active = false)
	{
		if($active === true)
		{
			return "<div class='simple-tabs-bar-item current'>$content</div>";
		}
		else
		{
			return "<div class='simple-tabs-bar-item'>$content</div>";
		}
	}


	/**
	 * Renders submenu for proposal section
	 */
	protected function renderProposalMenu()
	{
		$byCustomerAnchor = $this->barItemLink('/renderProposalMenu/1', 'Подача предложений по заказчику');
		echo $this->barItemLink($byCustomerAnchor, $this->getCurrentPage() === 'proposalAddByCustomer');
		$byPositionAnchor = $this->barItemLink('/renderProposalMenu/2', 'Подача предложений по позиции');
		echo $this->barItemLink($byPositionAnchor, $this->getCurrentPage() === 'proposalAddByPosition');
	}

	/**
	 * Renders submenu
	 */
	protected function renderRankingMenu()
	{
		$anchor = $this->barItemLink('/renderRankingMenu/1', 'Оценка предложений');
		echo $this->menuDiv($anchor, $this->getCurrentPage() === 'ranking');
	}


	/**
	 * Renders submenu for common view tab
	 */
	protected function renderCommonMenu()
	{
		$visibility = 74;

		$tabs = $this->getTabsToShow($visibility);

		foreach($tabs as $tab)
		{
			switch($tab){
				case 'common':
					$anchor = $this->barItemLink('/view/common/', 'Общая информация');
					echo $this->menuDiv($anchor, $this->getCurrentPage() === $tab);
					break;
				case 'docs':
					$anchor = $this->barItemLink('/view/docs/', 'Документация по процедуре');
					echo $this->menuDiv($anchor, $this->getCurrentPage() === $tab);
					break;
				case 'firms':
					$anchor = $this->barItemLink('/view/firms/', 'Заказчики');
					echo $this->menuDiv($anchor, $this->getCurrentPage() === $tab);
					break;
				case 'lots':
					$anchor = $this->barItemLink('/view/lots/', 'Лоты');
					echo $this->menuDiv($anchor, $this->getCurrentPage() === $tab);
					break;
				case 'stages':
					$anchor = $this->barItemLink('/view/stages/', 'Порядок проведения');
					echo $this->menuDiv($anchor, $this->getCurrentPage() === $tab);
					break;
			}
		}
	}

	/**
	 * Renders full menu
	 */
	protected function renderMenu()
	{
		$this->renderTopMenu();
		$this->renderBottomMenu();
	}


	/**
	 * @param mixed $currentPage
	 */
	public function setCurrentPage($currentPage)
	{
		$this->currentPage = $currentPage;
	}

	/**
	 * @return mixed
	 */
	public function getCurrentPage()
	{
		return $this->currentPage;
	}



	/**
	 * Какие вкладки показывать при просмотре
	 * @param $visibility
	 * @return array
	 */
	public function getTabsToShow($visibility)
	{
		if($visibility === 74)
		{
			return $this->getAllTabs();
		}
		elseif($visibility === 73)
		{
			return array(
				'common',
				'lots',
			);
		}
		else
		{
			return $this->getAllTabs();
		}
	}

	public function getAllTabs()
	{
		return array(
			'common',
			'docs',
			'firms',
			'lots',
			'stages',
		);
	}
}