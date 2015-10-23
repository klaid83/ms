<?php

namespace Mod3\View\Helper;
use Zend\View\Helper\AbstractHelper;

class List1Helper extends AbstractHelper
{
	public function __invoke($arr)
	{
		if (is_array($arr))
		{
			\Zend\Debug\Debug::dump($this->getServiceLocator()->getServiceLocator());
			echo '<ul>';
			foreach($arr as $v)
			{
				echo '<li>' . $v . '</li>';
			}
			echo '</ul>';
		}
	}
}