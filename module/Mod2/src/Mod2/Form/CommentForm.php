<?php
namespace Mod2\Form;

use Zend\Form\Element;
use Zend\Form\Form;

class CommentForm extends Form
{

	public function __construct()
	{
		parent::__construct();

		$this->setName('Comment');
		$this->setAttribute('method', 'post');

		$this->add(array(
			'name' => 'parentId',
			'attributes' => array(
				'type' => 'hidden',
			),
		));

		$this->add(array(
			'name' => 'type',
			'type' => 'select',
			'options' => array(
				'label' => 'Type',
				'empty_option' => 'Select',
				'value_options' => array(
					'1' => 'type1',
					'2' => 'type2',
					'3' => 'type3',
				),
			)
		));

		$this->add(array(
			'name' => 'comment',
			'attributes' => array(
				'type' => 'textarea',
			),
			'options' => array(
				'label' => 'Comment',
			)
		));

//		$this->add(new Element\Csrf('security')); // ошибка падает
		$this->add(array(
			'name' => 'submit',
			'attributes' => array(
				'type' => 'submit',
				'value' => 'Submit',
			),
		));
	}
}