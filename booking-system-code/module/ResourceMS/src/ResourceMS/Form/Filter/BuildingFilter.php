<?php

namespace ResourceMS\Form\Filter;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Db\Adapter\Adapter;

class BuildingFilter implements InputFilterAwareInterface {

	protected $inputFilter;
	protected $adapter;

	public function __construct($adapter = NULL) {
		$this->adapter = $adapter;
	}

	public function setInputFilter(InputFilterInterface $inputFilter) {
		throw new \Exception("Not used");
	}

	public function getInputFilter() {
		if (!$this->inputFilter) {
			$inputFilter = new InputFilter();
			$factory = new InputFactory();

			$inputFilter->add($factory->createInput(
							array(
								'name' => 'name',
								'required' => true,
								'filters' => array(
									array('name' => 'StripTags'),
									array('name' => 'StringTrim'),
								),
								'validators' => array(
									array(
										'name' => 'Db\NoRecordExists',
										'options' => array(
											'table' => 'building',
											'field' => 'name',
											'adapter' => $this->adapter,
										)
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
