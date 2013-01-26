<?php

namespace Reservation\Repository;

use Doctrine\ORM\EntityRepository;

class TypeRepository extends EntityRepository {

	public function findAllTitleInArray() {
		$qb = $this->_em->createQueryBuilder();
		$qb->select('t.title')
				->from('Reservation\Entity\Type', 't');

		$result = array();
		foreach ($qb->getQuery()->getResult() as $value) {
			$result[] = $value['title'];
		}
		return $result;
	}

}

?>
