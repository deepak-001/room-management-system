<?php

namespace Reservation\Form;

use Zend\Form\Form;

class ReservationTimeForm extends Form {

	public function __construct() {
		parent::__construct();

		$this->setName('reservation-time');
		$this->setAttribute('method', 'post');

		$timeRange = array();
		
		for($h = 0; $h < 24 ; $h++){
			for($mn = 0; $mn < 60; $mn+=15){
				$timeRange[sprintf('%02d',$h) . ':' . sprintf('%02d',$mn)] = sprintf('%02d',$h) . ':' . sprintf('%02d',$mn);
			}
		}
		
		$this->add(array(
			'name' => 'start_date',
			'type' => '\Zend\Form\Element\Text',
			'options' => array(
				'label' => 'Start date',
			),
			'attributes' => array(
				'class' => 'date',
			),
		));

		$this->add(array(
			'name' => 'start_time',
			'type' => '\Zend\Form\Element\Select',
			'options' => array(
				'label' => 'Start time',
				'value_options' => $timeRange,
			),
			'attributes' => array(
				'class' => 'time',
			),
		));

		$this->add(array(
			'name' => 'end_date',
			'type' => '\Zend\Form\Element\Text',
			'options' => array(
				'label' => 'End date',
			),
			'attributes' => array(
				'class' => 'date',
			),
		));

		$this->add(array(
			'name' => 'end_time',
			'type' => '\Zend\Form\Element\Select',
			'options' => array(
				'label' => 'End time',
				'value_options' => $timeRange,
			),
			'attributes' => array(
				'class' => 'time',
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
				'value' => 'Start',
			),
		));
	}

}