<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Booking\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Booking\Entity\User;
use Booking\Entity\Building;
use Booking\Entity\Room;
use Booking\Form\BookingForm;

class IndexController extends AbstractActionController {

	public function indexAction() {

	}

	public function readJsonAction() {
		$id = 3;
		$name = 'speeder';
		$array = array('id' => $id, 'name' => $name);
		$path = 'Booking\Model\UsersTable';
		$this->getServiceLocator()->get($path)->saveUsers($array);
	}

	public function showUsersAction() {

		$user = new User;
		$user->setUsername('odom');
		$user->setPassword('pasword');
		$user=$this->getEntityManager()->persist($user);
		
		$this->getEntityManager()->flush();
		
		
		return new ViewModel(array(
					'users' => $this->getEntityManager()->getRepository('Booking\Entity\User')->findAll(),
				));
	}


	public function showRoomsAction() {
//	$room = new Room;
	
//	$user=$this->getEntityManager()->persist($room)->;
	return new ViewModel(array(
		'rooms' => $this->getEntityManager()->getRepository('Booking\Entity\Room')->findAll()
	));
	}
	public function addBuilding(){
		$building = new Building;
	}
	public function viewAction() {
		return array(
			'key' => 'This view action'
		);
	}
		public function addAction() {
			$form = new BookingForm();
			$form->get('name')->setValue('Hello');
		return array(
			'form' => $form
		);
	}

	/**
	 * Entity manager instance
	 * 
	 * @var Doctrine\ORM\EntityManager
	 */
	protected $em;

	/**
	 * Returns an instance of the Doctrine entity manager loaded from the service 
	 * locator
	 * 
	 * @return Doctrine\ORM\EntityManager
	 */
	public function getEntityManager() {
		if (null === $this->em) {
			$this->em = $this->getServiceLocator()
					->get('doctrine.entitymanager.orm_default');
		}
		return $this->em;
	}

}
