<?php
namespace Mod2\Form;

use Zend\InputFilter\InputFilter;

class CommentFilter extends InputFilter
{
	public function __construct()
	{
		$this->add(array(
			'name' => 'parentId',
			'required' => true,
			'filters' => array(
				array('name' => 'Int'),
			),
		));
		$this->add(array(
			'name' => 'type',
			'required' => true,
		));

		$this->add(array(
			'name' => 'comment',
			'required' => true,
			'filters' => array(
				array('name' => 'StripTags'),
				array('name' => 'StringTrim'),
			),
			'validators' => array(
				array(
					'name' => 'StringLength',
					'options' => array(
						'encoding' => 'UTF-8',
						'min' => 2,
						'max' => 100,
					),
				),
			),
		));
	}
}