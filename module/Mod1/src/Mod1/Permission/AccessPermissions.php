<?php

namespace Mod1\Permission;


class AccessPermissions
{
	const CREATE = 'create';
	const EDIT = 'edit';
	const SEND = 'send';


	protected $_access_names = array(
		self::CREATE  => 'Возможность создать',
		self::EDIT    => 'Возможность редактирования',
		self::SEND    => 'Возможность отправки',
	);


	protected $test_access = array(
		'1' => 'create',
		'2' => 'create',
		'1' => 'edit',
		'1' => 'send',
		'2' => 'edit',
		'3' => 'edit',
		'4' => 'edit',
		'5' => 'create',
	);

	protected $_users = array();

	protected function _can($user_id, $access)
	{
		if(!$user_id || empty($access) || !array_key_exists($access, $this->_access_names))
		{
			return false;
		}

		if(!array_key_exists($user_id, $this->_users))
		{
			$this->_users[$user_id] = array();

			foreach($this->test_access as $k=>$v)
			{
				if ($user_id == $k)
				{
					$this->_users[$user_id][] = $v;
				}
			}

		}
		return in_array($access, $this->_users[$user_id]);
	}


	protected function _checkCorrectAccessName($access)
	{
		if (empty($access))
		{
			throw new \Exception('Передано право с пустым именем!');
		}
		is_array($access) || $access = array($access);

		foreach ($access as $right)
		{
			if(!array_key_exists($right, $this->_access_names))
			{
				throw new \Exception('Право '.$right.' не определено');
			}
		}
	}

	protected function _allow($items, $access)
	{
		$this->_checkCorrectAccessName($access);

		return $this->_allowUser($items, $access);
	}

	protected function _allowUser($user, $access)
	{
//		$retrading_id = (int) $this->getRetrading()->getRetradingId();
//		$lot_id = (int) $this->getRetrading()->getLotId();
//		$query = '';
//
//		is_array($access) || $access = array($access);
//
//		$user_id = (int) $user->getId();
//		$firm_id = (int) $user->getFirmId();
//
//		foreach ($access as $right)
//		{
//			if ($query)
//			{
//				$query .= ',';
//			}
//			$query .= '(' . $retrading_id . ', '.$lot_id.', ' . $user_id . ', ' . $firm_id . ', "' . $right . '")';
//		}
//		if ($query)
//		{
//			$this->createMapper()->getTable()->getAdapter()->query(
//				'INSERT IGNORE INTO '.$this->createMapper()->getTable()->getName()
//					. '(retrading_id, lot_id, user_id, firm_id, access) VALUES ' . $query
//			);
//		}
//		return $this;
		return '';
	}

	public function clear($items = null, $access = null)
	{
//		$mapper = $this->createMapper();
//		$mapper->getFilters()->filterByRetradingId($this->getRetrading()->getRetradingId());
//		if(!is_null($items))
//		{
//			if($items instanceof FirmIterator)
//			{
//				$mapper->getFilters()->filterByFirmId($items->getIds());
//			}
//			elseif($items instanceof FirmObject)
//			{
//				$mapper->getFilters()->filterByFirmId($items->getId());
//			}
//			elseif($items instanceof UserIterator)
//			{
//				$mapper->getFilters()->filterByUserId($items->getIds());
//			}
//			elseif($items instanceof UserObject)
//			{
//				$mapper->getFilters()->filterByUserId($items->getId());
//			}
//			else
//			{
//				throw new \Exception('Неккоректный тип объекта, ожидается UserIterator|UserObject|FirmIterator|FirmObject');
//			}
//		}
//		if(!is_null($access))
//		{
//			$this->_checkCorrectAccessName($access);
//			$mapper->getFilters()->filterByAccess($access);
//		}
//		$mapper->deleteByFilters();
//		return $this;

		return '';
	}


	public function canEdit($user)
	{
		return $this->_can($user, self::EDIT);
	}

	public function allowEdit($items)
	{
		return $this->_allow($items, self::EDIT);
	}

	public function clearEdit($items = null)
	{
		return $this->clear($items, self::EDIT);
	}

}