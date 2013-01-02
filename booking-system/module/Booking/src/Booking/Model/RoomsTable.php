<?php

namespace Booking\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Where;

class RoomsTable  {

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

	public function getRooms() {

		$sql = new Sql($this->tableGateway->getAdapter());
		$select = $sql->select();
		$select->from($this->table)->join('buildings', 'romms.idBuilding = buildings.id');

		$statement = $sql->prepareStatementForSqlObject($select);

		$result = $statement->execute();



		return $result;
	}

}

?>
