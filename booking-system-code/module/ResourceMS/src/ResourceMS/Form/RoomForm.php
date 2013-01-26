<?php

namespace ResourceMS\Form;

use Zend\Form\Form;

class RoomForm extends Form {

	public function __construct() {
		parent::__construct();

		$this->setName('building');
		$this->setAttribute('method', 'post');

		$this->add(array(
			'name' => 'number',
			'type' => '\Zend\Form\Element\Text',
			'options' => array(
				'label' => 'Number',
			),
			'attributes' => array(
				'placeholder' => 'Number',
			),
		));

		$this->add(array(
			'name' => 'description',
			'type' => '\Zend\Form\Element\Textarea',
			'options' => array(
				'label' => 'Description',
			),
			'attributes' => array(
				'placeholder' => 'Description',
			),
		));

		$this->add(array(
			'name' => 'submit',
			'options' => array(
				'label' => '   ',
			),
			'attributes' => array(
				'type' => 'submit',
				'class' => 'btn',
				'value' => 'Create',
			),
		));
	}

}