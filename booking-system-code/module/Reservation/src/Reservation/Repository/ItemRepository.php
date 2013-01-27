<?php

namespace Reservation\Repository;

use Doctrine\ORM\EntityRepository;

class ItemRepository extends EntityRepository {

	public function findAllTitleInArray() {
		$qb = $this->_em->createQueryBuilder();
		$qb->select('i.title')
				->from('Reservation\Entity\Item', 'i');

		$result = array();
		foreach ($qb->getQuery()->getResult() as $value) {
			$result[] = $value['title'];
		}
		return $result;
	}

	public function findByUids($uids) {
		$em = $this->getEntityManager();
		$query = $em->createQueryBuilder();

		$in = $query->expr()->in('i.uid', $uids);
		$query->select('i')
				->from('Reservation\Entity\Item', 'i')
				->where($in);

		return $query->getQuery()->getResult();
	}

}

?>
