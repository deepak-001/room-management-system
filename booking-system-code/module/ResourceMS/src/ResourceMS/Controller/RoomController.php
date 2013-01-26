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
		
		$request = $this->getRequest();
		if ($request->isPost()) {
			$roomFilter = new \ResourceMS\Form\Filter\RoomFilter();

			$roomForm->setInputFilter($roomFilter->getInputFilter());
			$roomForm->setData($request->getPost());

			if ($roomForm->isValid()) {
				$data = $request->getPost();

				$room = new \ResourceMS\Entity\Room();
				$building = $this->getEntityManager()->getRepository('ResourceMS\Entity\Building')->findOneBy(array('name' => $buildingName));

				var_dump($building);
				
				if (NULL !== $building) {

					$room->setBuilding($building);
					$room->setNumber($data->number);
					$room->setDescription($data->description);

					$this->getEntityManager()->persist($room);
					$this->getEntityManager()->flush();

					$this->flashMessenger()->addMessage('<div class="alert alert-success">Room ' . $data->number . ' was created</div>');

					return $this->redirect()->toRoute('manage/resource', array('controller' => 'building')); //id, blabla
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
