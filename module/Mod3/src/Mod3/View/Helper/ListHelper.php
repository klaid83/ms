<?php

namespace Mod3\View\Helper;
use Zend\View\Helper\AbstractHelper;

class ListHelper extends AbstractHelper
{
	public function __invoke($arr)
	{
		if (is_array($arr))
		{
			echo '<ul>';
			foreach($arr as $v)
			{
				echo '<li>' . $v . '</li>';
			}
			echo '</ul>';
		}
	}
}