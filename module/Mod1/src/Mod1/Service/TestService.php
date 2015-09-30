<?php

namespace Mod1\Service;

class TestService
{
	protected $_var1;
	protected $_var2;

	public function setVar1($var1)
	{
		$this->_var1 = $var1;
	}

	public function setVar2($var2)
	{
		$this->_var2 = $var2;
	}

	public function getVars()
	{
		return array($this->_var1, $this->_var2);
	}

	public function getVar1()
	{
		return $this->_var1;
	}

	public function getVar2()
	{
		return $this->_var2;
	}
}