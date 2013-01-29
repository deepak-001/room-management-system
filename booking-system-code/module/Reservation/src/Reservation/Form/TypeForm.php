<?php

namespace Reservation\Form;

use Zend\Form\Form;

class TypeForm extends Form {

	public function __construct() {
		parent::__construct();

		$this->setName('type');
		$this->setAttribute('method', 'post');

		$this->add(array(
			'name' => 'title',
			'type' => '\Zend\Form\Element\Text',
			'options' => array(
				'label' => 'Title',
			),
			'attributes' => array(
				'placeholder' => 'Title',
			),
		));

		$this->add(array(
			'name' => 'parent',
			'type' => '\Zend\Form\Element\Select',
			'options' => array(
				'label' => 'Parent',
				'label_attributes' => array(
					'class' => 'auto'
				),
			),
			'attributes' => array(
				'placeholder' => 'Parent',
				'id' => 'parent',
				'class' => 'select'
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
				'label' => ' ',
			),
			'attributes' => array(
				'type' => 'submit',
				'class' => 'btn',
				'value' => 'Create',
			),
		));
	}

}