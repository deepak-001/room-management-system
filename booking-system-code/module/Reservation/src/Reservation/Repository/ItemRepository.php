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

}

?>
