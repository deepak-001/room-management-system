<?php

namespace Reservation\Filter;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Db\Adapter\Adapter;

class TypeFilter implements InputFilterAwareInterface {

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
								'name' => 'title',
								'required' => true,
								'filters' => array(
									array('name' => 'StripTags'),
									array('name' => 'StringTrim'),
								),
								'validators' => array(
									array(
										'name' => 'Db\NoRecordExists',
										'options' => array(
											'table' => 'type',
											'field' => 'title',
											'adapter' => $this->adapter,
										)
									)
								),
							)
					)
			);

			$inputFilter->add($factory->createInput(
							array(
								'name' => 'parent',
								'required' => false,
								'filters' => array(
									array('name' => 'StripTags'),
									array('name' => 'StringTrim'),
								),
								'validators' => array(
									array(
										'name' => 'Db\RecordExists',
										'options' => array(
											'table' => 'type',
											'field' => 'title',
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
