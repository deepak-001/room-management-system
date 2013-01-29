<?php

namespace Reservation\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class MainController extends AbstractActionController {

	public function indexAction() {
		if (!$this->getServiceLocator()->get('zfcuser_user_service')->getAuthService()->hasIdentity()) {
			return $this->redirect()->toRoute('zfcuser/login');
		}
		$session = new \Zend\Session\Container('time');

		$items = $this->getEntityManager()->getRepository('Reservation\Entity\Item')->findAll();

		return new ViewModel(
						array(
							'items' => $items,
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
