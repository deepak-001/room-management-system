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

class User extends EntityRepository {

	/**
	 * Finds all entities in the repository.
	 *
	 * @return array The entities.
	 */
	public function findAll() {
		return 'Hello world';
//		return $this->findBy(array());
	}

}

?>
