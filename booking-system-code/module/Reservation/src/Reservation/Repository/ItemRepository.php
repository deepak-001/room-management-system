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

	public function findBusyItemByTime($start, $end) {
		$query = $this->getEntityManager()->createQueryBuilder();
		$sub = $this->getEntityManager()->createQueryBuilder();

		$sub->select('i.uid')
				->from('Reservation\Entity\Item', 'i')
				->where('i.isBookable = 1')->getDQL();

		$items = array();
		foreach ($sub->getQuery()->getResult() as $item) {
			$items[$item['uid']] = $item['uid'];
		}

		$q = $this->getEntityManager()->createQuery(
				'SELECT r FROM Reservation\Entity\Reservation r'
				);

		var_dump($q->getResult());
	}

}

?>
