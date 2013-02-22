<?php

namespace Booking\Form;

use Zend\Form\Element\Select;
use Zend\Form\Form;

class RoomForm extends Form {

	public function __construct($name = null) {
		// we want to ignore the name passed
		parent::__construct('booking');

		$this->setAttribute('method', 'post');
		$this->add(array(
			'name' => 'roomNum',
			'options' => array(
				'label' => 'Room'
			),
			'attributes' => array(
				'type' => 'text',
			),
		));
		$this->add(array(
			'name' => 'description',
			'options' => array(
				'label' => 'Description'
			),
			'attributes' => array(
				'type' => 'textarea',
			),
		));
		
		$this->add(array(
			'name' => 'building',
			'type' => 'Zend\Form\Element\Select',
			'options' => array(
				'label' => 'Building'
			),
			'attributes' => array(
			),
		));
		
		
		$this->add(array(
			'name' => 'submit',
			'attributes' => array(
				'type' => 'submit',
				'value' => 'add',
				'id' => 'submitbutton',
			),
		));
	}

	public function getBuilding() {
		return $this->building;
	}

}

