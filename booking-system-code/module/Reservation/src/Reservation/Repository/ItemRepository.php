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

	public function findArrayForSelectOption($typeUid) {
		$query = $this->getEntityManager()->createQueryBuilder();

		$query->select('i.uid, i.title')
				->from('Reservation\Entity\Item', 'i')
				->where('i.type = :type')
				->setParameter('type', $typeUid);

		$result = array();
		foreach ($query->getQuery()->getResult() as $each) {
			$result[$each['uid']] = $each['title'];
		}
		return $result;
	}

}

?>
