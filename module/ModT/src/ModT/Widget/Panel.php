<?php

namespace ModT\Widget;

use ModT\Widget\Widget;

class Panel extends Widget
{
	public $title;
	public $icon;

	public function init()
	{
		echo Html::beginTag('div',array('class'=>'panel panel-primary'));
		echo Html::beginTag('div',array('class'=>"panel-heading"));
		echo Html::tag('span','',array('class'=>'glyphicon glyphicon-' . $this->icon)) . $this->title;
		echo Html::endTag('div');

		echo Html::beginTag('div',array('class'=>'panel-body'));
	}

	public function run()
	{
		echo Html::endTag('div');
		echo Html::endTag('div');
	}
}