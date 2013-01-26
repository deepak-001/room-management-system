<?php

namespace ResourceMS\Form;

use Zend\Form\Form;

class BuildingForm extends Form {

	public function __construct() {
		parent::__construct();

		$this->setName('building');
		$this->setAttribute('method', 'post');

		$this->add(array(
			'name' => 'name',
			'type' => '\Zend\Form\Element\Text',
			'options' => array(
				'label' => 'Name',
			),
			'attributes' => array(
				'placeholder' => 'Name',
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