<?php
namespace ModT\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Mvc\Controller\Plugin\FlashMessenger as FlashMessenger;

class FlashMessages extends AbstractHelper
{
	/**
	 * @var FlashMessenger
	 */
	protected $flashMessenger;

	public function setFlashMessenger(FlashMessenger $flashMessenger)
	{
		$this->flashMessenger = $flashMessenger;
	}

	public function __invoke()
	{
		$messages = array();

		if ($this->flashMessenger->hasMessages())
		{
			$messages['common'] = $this->flashMessenger->getMessages();
		}
		if ($this->flashMessenger->hasSuccessMessages())
		{
			$messages['success'] = $this->flashMessenger->getSuccessMessages();
		}
		if ($this->flashMessenger->hasInfoMessages())
		{
			$messages['info'] = $this->flashMessenger->getInfoMessages();
		}
		if ($this->flashMessenger->hasErrorMessages())
		{
			$messages['danger'] = $this->flashMessenger->getErrorMessages();
		}
		if ($this->flashMessenger->hasWarningMessages())
		{
			$messages['warning'] = $this->flashMessenger->getWarningMessages();
		}

		return $messages;
	}
}