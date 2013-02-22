<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user
 *
 * @author John_Odom
 */

namespace Booking\Repository;
use Doctrine\ORM\EntityRepository;

class UserRoleRepository extends EntityRepository {

	/**
	 * Finds all entities in the repository.
	 *
	 * @return array The entities.
	 */
	public function getOptionsForSelect() {
		$roles= array();
		foreach ($this->findAll() as $role){
			$roles[$role->getRoleId()] = $role->getRoleId();
		}
		return $roles;
	}

}

?>
