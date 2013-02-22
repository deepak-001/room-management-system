<?php

namespace ResourceMS\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class RoomController extends AbstractActionController {

	public function indexAction() {
		$nbItemPerPage = 4;
		$buildings = $this->getEntityManager()->getRepository('ResourceMS\Entity\Building')->findAll();

		if (is_array($buildings)) {
			$paginator = new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\ArrayAdapter($buildings));
		} else {
			$paginator = $buildings;
		}


		$paginator->setItemCountPerPage($nbItemPerPage);
		$paginator->setCurrentPageNumber($this->getEvent()->getRouteMatch()->getParam('p'));

		return new ViewModel(
						array(
							'buildings' => $paginator,
							'nbItemPerPage' => $nbItemPerPage,
							'messages' => $this->flashMessenger()->getMessages(),
						)
		);
	}

	public function createAction() {

		$roomForm = new \ResourceMS\Form\RoomForm();
		$buildingName = $this->params('building');

		$building = $this->getEntityManager()->getRepository('ResourceMS\Entity\Building')->findOneBy(array('name' => $buildingName));
		
		if(NULL === $building){
			return $this->redirect()->toRoute('manage/resource',array('controller'=>'building'));
		}
		
		$request = $this->getRequest();
		if ($request->isPost()) {
			$roomFilter = new \ResourceMS\Form\Filter\RoomFilter();

			$roomForm->setInputFilter($roomFilter->getInputFilter());
			$roomForm->setData($request->getPost());

			if ($roomForm->isValid()) {
				$data = $request->getPost();

				$room = new \ResourceMS\Entity\Room();

				if (NULL !== $building) {

					$room->setBuilding($building);
					$room->setNumber($data->number);
					$room->setDescription($data->description);

					$this->getEntityManager()->persist($room);
					$this->getEntityManager()->flush();

					$this->flashMessenger()->addMessage('<div class="alert alert-success">Room ' . $data->number . ' was created</div>');

					$session = new \Zend\Session\Container('url');
					if (isset($session->redirect)) {
						return $this->redirect()->toUrl($session->redirect);
					}
				}
			}
		}

		return new ViewModel(
						array(
							'form' => $roomForm,
							'buildingName' => $buildingName
						)
		);
	}

	public function deleteAction() {
		$roomId = $this->params('room');

		if (NULL === $roomId) {
			return $this->redirect()->toRoute('home');
		}

		$roomEntity = $this->getEntityManager()->find('ResourceMS\Entity\Room', $roomId);
		if (NULL === $roomEntity) {
			return $this->redirect()->toRoute('home');
		}

		$this->getEntityManager()->remove($roomEntity);
		$this->getEntityManager()->flush();

		$session = new \Zend\Session\Container('url');
		if (isset($session->redirect)) {
			return $this->redirect()->toUrl($session->redirect);
		}
		return $this->redirect()->toRoute('manage/resource', array('controller' => 'building'));
	}

	public function editAction() {
		$roomForm = new \ResourceMS\Form\RoomForm();
		$buildingName = $this->params('building');
		$roomId = $this->params('room');


		if (NULL === $roomId) {
			return $this->redirect()->toRoute('home');
		}

		$roomEntity = $this->getEntityManager()->find('ResourceMS\Entity\Room', $roomId);
		if (NULL === $roomEntity) {
			return $this->redirect()->toRoute('home');
		}

		$roomData = array(
			'number' => $roomEntity->getNumber(),
			'description' => $roomEntity->getDescription(),
		);
		$roomForm->setData($roomData);
		$roomForm->get('submit')->setValue('Done');

		$request = $this->getRequest();
		if ($request->isPost()) {
			$roomFilter = new \ResourceMS\Form\Filter\RoomFilter();

			$roomForm->setInputFilter($roomFilter->getInputFilter());
			$roomForm->setData($request->getPost());

			if ($roomForm->isValid()) {
				$data = $request->getPost();

				$building = $this->getEntityManager()->getRepository('ResourceMS\Entity\Building')->findOneBy(array('name' => $buildingName));

				var_dump($building);

				if (NULL !== $building) {

					$roomEntity->setBuilding($building);
					$roomEntity->setNumber($data->number);
					$roomEntity->setDescription($data->description);

					$this->getEntityManager()->persist($roomEntity);
					$this->getEntityManager()->flush();

					$session = new \Zend\Session\Container('url');
					if (isset($session->redirect)) {
						return $this->redirect()->toUrl($session->redirect);
					}
					return $this->redirect()->toRoute('manage/resource', array('controller' => 'building'));
				}
			}
		}

		return new ViewModel(
						array(
							'form' => $roomForm,
							'roomId' => $roomId,
							'buildingName' => $buildingName
						)
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
