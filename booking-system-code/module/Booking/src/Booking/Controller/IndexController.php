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
use Booking\Entity\Resource;
use Booking\Entity\Room;
use Booking\Form\BookingForm;
use Booking\Form\RoomForm;



class IndexController extends AbstractActionController {

	public function indexAction() {
//		$time = time();
//		echo time().'<br />';
//		echo date(DATE_ATOM,'1358143200').'<br />';
//		echo "Hello World";
//		echo DATE_ATOM;
	}

	public function readJsonAction() {
		
	}

	public function showUsersAction() {

		$user = new User;
		$user->setUsername('odom');
		$user->setPassword('pasword');
		$user = $this->getEntityManager()->persist($user);

		$this->getEntityManager()->flush();


		return new ViewModel(array(
					'users' => $this->getEntityManager()->getRepository('Booking\Entity\User')->findAll(),
				));
	}

	public function addRoomAction() {
		$form = new RoomForm();
		$request = $this->getRequest();
		$form->get('submit')->setAttribute('value', 'Add');

		$request = $this->getRequest();
		if ($request->isPost()) {
			$room = new Room;
			$post = $request->getPost();
			$room->setNumber($post->roomNum);
			$building = $this->getEntityManager()->getRepository('Booking\Entity\Building')->findById((int) $post->building);
			$room->setBuilding($building[0]);
			$room->setDescription($post->description);

			$room = $this->getEntityManager()->persist($room);

			$this->getEntityManager()->flush();

			return $this->redirect()->toRoute('home/default', array('controller' => 'index', 'action' => 'showRooms'));
		}

		return array('form' => $form);
	}

	public function showRoomsAction() {
		return new ViewModel(array(
					'rooms' => $this->getEntityManager()->getRepository('Booking\Entity\Room')->findAll()
				));
	}
	public function editAction(){
		$id = $this->getEvent()->getRouteMatch()->getParam('id');
		echo 'ID: '.$id;
		$form = new RoomForm();
		$request = $this->getRequest();
		$form->get('submit')->setAttribute('value', 'Add');

		$request = $this->getRequest();
		if ($request->isPost()) {
			$room = new Room;
			$post = $request->getPost();
			$room->setNumber($post->roomNum);
			$building = $this->getEntityManager()->getRepository('Booking\Entity\Building')->findById((int) $post->building);
			$room->setBuilding($building[0]);
			$room->setDescription($post->description);

			$room = $this->getEntityManager()->persist($room);

			$this->getEntityManager()->flush();

			return $this->redirect()->toRoute('home/default', array('controller' => 'index', 'action' => 'showRooms'));
		}

		return array('form' => $form);
	}

	public function addBuildingAction() {
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
	public function listResourceAction(){
		return new ViewModel(array(
					'resource' => $this->getEntityManager()->getRepository('Booking\Entity\Resource')->findAll()
				));
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
