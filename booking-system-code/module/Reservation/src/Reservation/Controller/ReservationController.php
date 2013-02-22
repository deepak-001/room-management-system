<?php

namespace Reservation\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ReservationController extends AbstractActionController {

	public function startAction() {
		$form = new \Reservation\Form\ReservationTimeForm();

		$request = $this->getRequest();

		$message = '';
		if ($request->isPost()) {
			$data = $request->getPost();

			$form->setValue($data);

			$startTime = $data->start_date . ' ' . $data->start_time;
			$endTime = $data->end_date . ' ' . $data->end_time;

			$startTimeInt = strtotime($startTime);
			$endTimeInt = strtotime($endTime);

			if ($endTimeInt > $startTimeInt) {
				$session = new \Zend\Session\Container('time');
				$session->start = $startTimeInt;
				$session->end = $endTimeInt;

				$this->redirect()->toRoute('home');
			} else {
				$message = '<div class="alert alert-error">Set time properly!</div>';
			}
		}

		return new ViewModel(
						array(
							'form' => $form,
							'message' => $message,
						)
		);
	}

	public function bookAction() {
		$session = new \Zend\Session\Container('items');
		$currentItems = array();
		if (isset($session->items)) {
			$currentItems = $session->items;
		}

		$data = $this->getRequest()->getPost();

		$itemUidToBook = $data->itemUid;

		if (NULL !== $itemUidToBook) {
			$currentItems[$itemUidToBook] = $itemUidToBook;
			$session->items = $currentItems;
		}

		$currentItemsEntity = $this->orderItem($this->getEntityManager()->getRepository('Reservation\Entity\Item')->findByUids($currentItems));

		if ($this->getRequest()->isXmlHttpRequest()) {
			$this->layout('layout/blank');
		}

		return new ViewModel(
						array(
							'items' => $currentItemsEntity,
						)
		);
	}

	public function showAction() {
		if (!$this->getServiceLocator()->get('zfcuser_user_service')->getAuthService()->hasIdentity()) {
			return $this->redirect()->toRoute('zfcuser/login');
		}
		$reservation = $this->getEntityManager()->getRepository('Reservation\Entity\Reservation')->findBy(array('user' => $this->getServiceLocator()->get('zfcuser_user_service')->getAuthService()->getIdentity()), array('lastModifiedTime' => 'DESC'));
//		$this->layout('layout/calendar');
		return new ViewModel(
						array(
							'reservation' => $reservation,
						)
		);
	}

	public function viewAction() {
		if (!$this->getServiceLocator()->get('zfcuser_user_service')->getAuthService()->hasIdentity()) {
			return $this->redirect()->toRoute('zfcuser/login');
		}
		$reservation = $this->getEntityManager()->getRepository('Reservation\Entity\Reservation')->findBy(array('user' => $this->getServiceLocator()->get('zfcuser_user_service')->getAuthService()->getIdentity()), array('lastModifiedTime' => 'DESC'));

		return new ViewModel(
						array(
							'reservation' => $reservation,
						)
		);
	}

	public function doneAction() {
		if (!$this->getServiceLocator()->get('zfcuser_user_service')->getAuthService()->hasIdentity()) {
			return $this->redirect()->toRoute('zfcuser/login');
		}

		$session = new \Zend\Session\Container('items');

		//No Items was reservation
		if (count($session->items) == 0) {
			return $this->redirect()->toRoute('home');
		}

		$items = $this->getEntityManager()->getRepository('Reservation\Entity\Item')->findByUids($session->items);
		$currentItemsEntity = $this->orderItem($items);


		$reservation = NULL;
		$currentUser = $this->getServiceLocator()->get('zfcuser_user_service')->getAuthService()->getIdentity();

		if ($this->getRequest()->isPost()) {
			$postData = $this->getRequest()->getPost();
			$sessionTime = new \Zend\Session\Container('time');

			if (NULL !== $sessionTime->start && NULL !== $sessionTime->end) {
				foreach ($items as $item) {
					$reservation = new \Reservation\Entity\Reservation();
					$reservation->setDisabled(0);
					$reservation->setDeleted(0);
					$reservation->setReturned(0);
					$reservation->setCreatedTime(time());
					$reservation->setLastModifiedTime(time());
					$reservation->setCreatedUser($currentUser);
					$reservation->setLastModifiedUser($currentUser);

					$reservation->setUser($currentUser);
					$reservation->setStartTime($sessionTime->start);
					$reservation->setEndTime($sessionTime->end);
					$reservation->setItem($item);

					$this->getEntityManager()->persist($reservation);
				}
				$this->getEntityManager()->flush();

				$sessionTime->start = NULL;
				$sessionTime->end = NULL;
				$session->items = array();

				return $this->redirect()->toRoute('home/default', array('controller' => 'reservation', 'action' => 'show'));
			} else {
				return $this->redirect()->toRoute('home/default', array('controller' => 'reservation', 'action' => 'start'));
			}
		}

		return new ViewModel(
						array(
							'items' => $currentItemsEntity,
						)
		);
	}

	public function orderItem($items) {
		$orderedItems = array();

		foreach ($items as $item) {
			if (NULL !== $item->getType()) {
				$orderedItems[$item->getType()->getTitle()][$item->getUid()] = $item;
			}
		}
		ksort($orderedItems);
		return $orderedItems;
	}

	public function clearAction() {
		$session = new \Zend\Session\Container('items');
		$session->items = array();

		if ($this->getRequest()->isXmlHttpRequest()) {
			$this->layout('layout/blank');
		}
		$viewModel = new ViewModel();
		$viewModel->setTemplate('reservation/reservation/book');
		$viewModel->setVariable('items', array());

		return $viewModel;
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
