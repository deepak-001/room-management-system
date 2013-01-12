<?php


namespace Booking\Form;
use Zend\Form\Element\Select;
use Zend\Form\Form;
class RoomForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('booking');

        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'roomNum',
            'options' => array(
				'label' => 'Room'
			),
			'attributes' => array(
             'type'  => 'text',
			
            ),
        ));
		$this->add(array(
            'name' => 'description',
			'options' => array(
				'label' => 'Description'
			),
            'attributes' => array(
               'type'  => 'textarea',
            ),
        ));
		$this->add(array(
			'type' => 'Zend\Form\Element\Select',
			'name' => 'building',
			'options' => array(
				'label' => 'Building',
				'value_options' => array(
					'0' => 'Select your building',
					'1' => 'A',
					'2' => 'B',
					'3' => 'C',
					'4' => 'F'
					
				),
			),
						'attributes' => array(
				'value' => '0'
			)
		));
		
		        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'add',
                'id' => 'submitbutton',
            ),
        ));
    }
}

