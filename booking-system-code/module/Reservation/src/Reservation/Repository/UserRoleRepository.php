<?php

namespace Reservation\Repository;

use Doctrine\ORM\EntityRepository;

class UserRoleRepository extends EntityRepository {

	/**
	 * Finds all entities in the repository.
	 *
	 * @return array The entities.
	 */
	public function getOptionsForSelect() {
		$roles = array('');
		foreach ($this->findAll() as $role) {
			$roles[$role->getRoleId()] = $role->getRoleId();
		}
		return $roles;
	}

}

?>
