<?php

namespace ResourceMS\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class BuildingController extends AbstractActionController {

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

				$this->flashMessenger()->addMessage('Thank you for your comment!');

				return $this->redirect()->toRoute('blog-details'); //id, blabla
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
