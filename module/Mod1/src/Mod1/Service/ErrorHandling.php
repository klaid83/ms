<?php
namespace Mod1\Service;

use Zend\Di\ServiceLocatorInterface;
use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;

/**
 * ���������� ������
 *
 * Class ErrorHandling
 *
 * @package Mod1\Service
 */
class ErrorHandling implements ServiceManagerAwareInterface
{
	/** @var \Zend\Log\Logger */
	protected $logger;

	protected $errorTpl;

	protected $exceptionTpl;

	protected $serviceManager;

	public function __construct($logger)
	{
		$this->logger = $logger;
		$this->errorTpl = "\n������: %s\n���������: %s\n����: %s (������: %s)\n";
		$this->exceptionTpl = "\n����������: %s\n���������: %s\n����: %s (������: %s)\n���� �������:\n%s\n";
	}

	public function logException()
	{
		try {
//			$user = $this->getServiceManager()->get('CurrentUser');

			foreach (func_get_args() as $info) {
				if (is_object($info)) {
					/** @var \Exception $info */
					$message = sprintf(
						$this->exceptionTpl,
						get_class($info),
						$info->getMessage(),
						$info->getFile(),
						$info->getLine(),
						$info->getTraceAsString()
					);
				} else {
					$message = sprintf(
						$this->errorTpl,
						array_shift($info),
						array_shift($info),
						array_shift($info),
						array_shift($info)
					);
				}
//
//				if ($user && $user->isAuth()) {
//					$message .= "������������(user_id): {$user->getId()}\n";
//					$message .= "�����������(firm_id): {$user->getFirmId()}\n";
//				}

				if (isset($_SERVER['REQUEST_URI'])) {
					$message .= "Url: {$_SERVER['REQUEST_URI']}\n";
				}

				$message .= "\n";

				$this->logger->err($message);
			}
		} catch (\Exception $e) {
			// nothing ...
		}
	}

	/**
	 * Set service manager
	 *
	 * @param ServiceManager $serviceManager
	 */
	public function setServiceManager(ServiceManager $serviceManager)
	{
		$this->serviceManager = $serviceManager;
	}

	/**
	 * @return mixed
	 */
	public function getServiceManager()
	{
		return $this->serviceManager;
	}
}
