<?php

namespace Reservation\Form;

use Zend\Form\Form;

class ItemForm extends Form {

	public function __construct() {
		parent::__construct();

		$this->setName('item');
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
			'type' => '\Zend\Form\Element\Text',
			'options' => array(
				'label' => 'Parent',
				'label_attributes' => array(
					'class' => 'auto'
				),
			),
			'attributes' => array(
				'placeholder' => 'Parent',
				'id' => 'parent'
			),
		));

		$this->add(array(
			'name' => 'type',
			'type' => '\Zend\Form\Element\Text',
			'options' => array(
				'label' => 'Type',
				'label_attributes' => array(
					'class' => 'auto'
				),
			),
			'attributes' => array(
				'placeholder' => 'Type',
				'id' => 'type',
			),
		));

		$this->add(array(
			'name' => 'bookable',
			'type' => '\Zend\Form\Element\Checkbox',
			'options' => array(
				'label' => 'Bookalbe',
			),
			'attributes' => array(
			),
		));


		$this->add(array(
			'name' => 'quality',
			'type' => '\Zend\Form\Element\Text',
			'options' => array(
				'label' => 'Quality',
			),
			'attributes' => array(
				'placeholder' => 'Quality',
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