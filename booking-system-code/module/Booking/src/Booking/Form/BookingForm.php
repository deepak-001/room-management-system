<?php
namespace Booking\Form;

use Zend\Form\Form;

class BookingForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('booking');

        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'name',
            'attributes' => array(
               'type'  => 'text',
            ),
        ));
		        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));
    }
}

