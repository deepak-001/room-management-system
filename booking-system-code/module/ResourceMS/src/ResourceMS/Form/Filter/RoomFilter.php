<?php

namespace ResourceMS\Form\Filter;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class RoomFilter implements InputFilterAwareInterface {

	protected $inputFilter;

	public function setInputFilter(InputFilterInterface $inputFilter) {
		throw new \Exception("Not used");
	}

	public function getInputFilter() {
		if (!$this->inputFilter) {
			$inputFilter = new InputFilter();
			$factory = new InputFactory();

			$inputFilter->add($factory->createInput(
							array(
								'name' => 'number',
								'required' => true,
								'filters' => array(
									array('name' => 'StripTags'),
									array('name' => 'StringTrim'),
								),
								'validators' => array(
									array(
										'name' => 'Digits',
									)
								),
							)
					)
			);

			$this->inputFilter = $inputFilter;
		}

		return $this->inputFilter;
	}

}