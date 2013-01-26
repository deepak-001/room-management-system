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
			var_dump($data);

			$form->setValue($data);

			$startTime = $data->start_date . ' ' . $data->start_time;
			var_dump(date("d/m/Y H:i", strtotime($startTime)));
			$endTime = $data->end_date . ' ' . $data->end_time;
			var_dump(date("d/m/Y H:i", strtotime($endTime)));

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
