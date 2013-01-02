<?php

namespace Booking\Model;

use Zend\Db\TableGateway\TableGateway;

class UsersTable {

	protected $tableGateway;

	public function __construct(TableGateway $tableGateway) {
		$this->tableGateway = $tableGateway;
	}

	public function fetchAll() {
		$resultSet = $this->tableGateway->select();
		return $resultSet;
	}

	public function saveUsers($data) {
		$this->tableGateway->insert($data);
	}
	public function getUser(){
		
	}

}
?>
