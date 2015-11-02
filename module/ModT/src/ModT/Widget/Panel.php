<?php

namespace ModT\Widget;

use ModT\Widget\Widget;

class Panel extends Widget
{
	public $title;
	public $icon;

	public function init()
	{
		echo '<div class="panel panel-primary">';
		echo '<div class="panel-heading"><span class="glyphicon glyphicon-' . $this->icon . '"></span>' . $this->title . '</div>';
		echo '<div class="panel-body">';
	}

	public function run()
	{
		echo '</div>';
		echo '</div>';
	}
}