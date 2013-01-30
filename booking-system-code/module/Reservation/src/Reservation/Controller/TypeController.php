<?php

namespace Reservation\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class TypeController extends AbstractActionController {

	private $classMap = array(
		'formClass' => '\Reservation\Form\TypeForm',
		'filterClass' => '\Reservation\Filter\TypeFilter',
		'entityClass' => '\Reservation\Entity\Type',
	);
	private $settersPostData = array(
		'setTitle' => 'title',
		'setDescription' => 'description',
	);
	private $entityDataMatchFormName = array(
		'title' => 'getTitle',
		'parent' => 'getParent',
		'description' => 'getDescription',
		'submit' => 'Done',
	);
	private $redirect = array(
		'create' => array(
			'method' => 'toRoute',
			'to' => 'home',
		),
		'edit' => array(
			'method' => 'toRoute',
			'to' => 'home',
		),
		'delete' => array(
			'method' => 'toRoute',
			'to' => 'home',
		),
	);

	public function indexAction() {
		$types = $this->getEntityManager()->getRepository('Reservation\Entity\Type')->findAll();
		return new ViewModel(
						array(
							'types' => $types
						)
		);
	}

	public function createAction() {
		$user = $this->getServiceLocator()->get('zfcuser_user_service')->getAuthService()->getIdentity();
		$settersData = array(
			'setDisabled' => 0,
			'setDeleted' => 0,
			'setCreatedTime' => time(),
			'setCreatedUser' => $user,
			'setLastModifiedTime' => time(),
			'setLastModifiedUser' => $user,
		);


		$form = new $this->classMap['formClass']();

		$form->get('parent')->setValueOptions(
				$this->getEntityManager()->getRepository('Reservation\Entity\Type')->findArrayForSelectOption()
		);

		$request = $this->getRequest();
		if ($request->isPost()) {
			$filter = new $this->classMap['filterClass']($this->getServiceLocator()->get('db'));

			$form->setInputFilter($filter->getInputFilter());
			$form->setData($request->getPost());

			if ($form->isValid()) {
				$data = $request->getPost();

				$entity = new $this->classMap['entityClass']();

				foreach ($this->settersPostData as $method => $postName) {
					$entity->{$method}($data->{$postName});
				}

				$settersData['setParent'] = $this->getEntityManager()->find($this->classMap['entityClass'], $data->parent);
				foreach ($settersData as $method => $value) {
					$entity->{$method}($value);
				}

				$this->getEntityManager()->persist($entity);
				$this->getEntityManager()->flush();

				$this->flashMessenger()->addMessage('<div class="alert alert-success">Success</div>');

				return $this->redirect()->toRoute('admin/default', array('controller' => 'type'));
			}
		}

		$viewModel = new ViewModel(array(
					'form' => $form,
					'routeOptions' => array(
						'controller' => 'type',
						'action' => 'create'
					)
				));
		$viewModel->setTemplate('reservation/type/type-form');

		return $viewModel;
	}

	public function editAction() {
		$form = new $this->classMap['formClass']();
		$entityUid = $this->params('uid');

		$entity = $this->getEntityManager()->getRepository($this->classMap['entityClass'])->findOneBy(array('uid' => $entityUid));

		$user = $this->getServiceLocator()->get('zfcuser_user_service')->getAuthService()->getIdentity();
		$settersData = array(
			'setLastModifiedTime' => time(),
			'setLastModifiedUser' => $user,
		);

		$form->get('parent')->setValueOptions(
				$this->getEntityManager()->getRepository('Reservation\Entity\Type')->findArrayForSelectOption()
		);

		if ($entity instanceof $this->classMap['entityClass'] && NULL !== $entity) {
			$formData = array();
			foreach ($this->entityDataMatchFormName as $formName => $value) {
				if ('submit' != $formName) {
					if ('parent' === $formName) {
						if (NULL != $entity->{$value}()) {
							$formData[$formName] = $entity->{$value}()->getTitle();
						}
					} else {
						$formData[$formName] = $entity->{$value}();
					}
				}
			}
			$form->setData($formData);
			$form->get('submit')->setValue('Done');
			if (NULL !== $entity->getParent()) {
				$form->get('parent')->setValue($entity->getParent()->getUid());
			}
		}

		$request = $this->getRequest();
		if ($request->isPost()) {
			$filter = new $this->classMap['filterClass']($this->getServiceLocator()->get('db'));

			$form->setInputFilter($filter->getInputFilter());
			$form->setData($request->getPost());

			if ($form->isValid()) {
				$data = $request->getPost();

				if (NULL !== $entity) {

					foreach ($this->settersPostData as $method => $postName) {
						$entity->{$method}($data->{$postName});
					}

					$settersData['setParent'] = $this->getEntityManager()->find($this->classMap['entityClass'], $data->parent);
					foreach ($settersData as $method => $value) {
						$entity->{$method}($value);
					}

					$this->getEntityManager()->persist($entity);
					$this->getEntityManager()->flush();

					$this->flashMessenger()->addMessage('<div class="alert alert-success">Success</div>');

//					$session = new \Zend\Session\Container('url');
//					if (isset($session->redirect)) {
//						return $this->redirect()->toUrl($session->redirect);
//					}
					return $this->redirect()->toRoute('home');
				}
			}
		}

		$viewModel = new ViewModel(array(
					'form' => $form,
					'routeOptions' => array(
						'controller' => 'type',
						'action' => 'edit',
						'uid' => $entityUid,
					),
				));
		$viewModel->setTemplate('reservation/type/type-form');

		return $viewModel;
	}

	public function deleteAction() {
		$uid = $this->params('uid');

		$entity = $this->getEntityManager()->find($this->classMap['entityClass'], $uid);

		$this->getEntityManager()->remove($entity);
		$this->getEntityManager()->flush();

//		$session = new \Zend\Session\Container('url');
//		if (isset($session->redirect)) {
//			return $this->redirect()->toUrl($session->redirect);
//		}
		return $this->redirect()->toRoute('home');
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
