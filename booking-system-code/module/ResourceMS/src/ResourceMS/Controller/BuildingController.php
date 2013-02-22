<?php

namespace ResourceMS\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class BuildingController extends AbstractActionController {

	public function indexAction() {
		$session = new \Zend\Session\Container('url');
		$session->redirect = (string) $this->getRequest()->getRequestUri();
		
		$nbItemPerPage = 2;
		$buildings = $this->getEntityManager()->getRepository('ResourceMS\Entity\Building')->findAll();

		$rooms = array();
		if (is_array($buildings)) {
			$paginator = new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\ArrayAdapter($buildings));
			foreach ($buildings as $building) {
				$rooms[$building->getId()] = $this->getEntityManager()->getRepository('ResourceMS\Entity\Room')->findBy(array('building' => $building));
			}
		} else {
			$paginator = $buildings;
		}

		$paginator->setItemCountPerPage($nbItemPerPage);
		$paginator->setCurrentPageNumber($this->getEvent()->getRouteMatch()->getParam('p'));

		return new ViewModel(
						array(
							'buildings' => $paginator,
							'rooms' => $rooms,
							'nbItemPerPage' => $nbItemPerPage,
							'messages' => $this->flashMessenger()->getMessages(),
						)
		);
	}

	public function createAction() {
		$buildingForm = new \ResourceMS\Form\BuildingForm();

		$request = $this->getRequest();
		if ($request->isPost()) {
			$buildingFilter = new \ResourceMS\Form\Filter\BuildingFilter($this->getServiceLocator()->get('db'));

			$buildingForm->setInputFilter($buildingFilter->getInputFilter());
			$buildingForm->setData($request->getPost());

			if ($buildingForm->isValid()) {
				$data = $request->getPost();

				$building = new \ResourceMS\Entity\Building();
				$building->setName($data->name);
				$building->setDescription($data->description);

				$this->getEntityManager()->persist($building);
				$this->getEntityManager()->flush();

				$this->flashMessenger()->addMessage('<div class="alert alert-success">Buiding ' . $data->name . ' was created</div>');

				return $this->redirect()->toRoute('manage/resource', array('controller' => 'building')); //id, blabla
			}
		}

		return new ViewModel(
						array(
							'form' => $buildingForm,
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
