<?php

namespace Reservation\Repository;

use Doctrine\ORM\EntityRepository;

class TypeRepository extends EntityRepository {

	public function findAllTitleInArray() {
		$qb = $this->getEntityManager()->createQueryBuilder();
		$qb->select('t.title')
				->from('Reservation\Entity\Type', 't');

		$result = array();
		foreach ($qb->getQuery()->getResult() as $value) {
			$result[] = $value['title'];
		}
		return $result;
	}

	public function findArrayForSelectOption() {
		$q = $this->getEntityManager()->createQueryBuilder();
		$q->select('t.uid, t.title')
				->from('Reservation\Entity\Type', 't')
		;
		$result = array(0 => '');
		foreach ($q->getQuery()->getResult() as $each) {
			$result[$each['uid']] = $each['title'];
		}
		return $result;
	}

}

?>
