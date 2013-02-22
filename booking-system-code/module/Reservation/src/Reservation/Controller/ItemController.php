<?php

namespace Reservation\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ItemController extends AbstractActionController {

	private $classMap = array(
		'formClass' => '\Reservation\Form\ItemForm',
		'filterClass' => '\Reservation\Filter\ItemFilter',
		'entityClass' => '\Reservation\Entity\Item',
		'entityRelationClass' => '\Reservation\Entity\Type',
	);
	private $settersPostData = array(
		'setTitle' => 'title',
		'setQuality' => 'quality',
		'setIsBookable' => 'bookable',
		'setDescription' => 'description',
	);
	private $entityDataMatchFormName = array(
		'title' => 'getTitle',
		'quality' => 'getQuality',
		'parent' => 'getParent',
		'bookable' => 'getIsBookable',
		'type' => 'getType',
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

		return new ViewModel(
						array(
							'types' => $this->getEntityManager()->getRepository('Reservation\Entity\Type')->findArrayForSelectOption(),
							'messages' => $this->flashMessenger()->getMessages(),
						)
		);
	}

	public function newAction() {
		if ($this->getRequest()->isPost()) {
			$postData = $this->getRequest()->getPost();
			$type = $this->getEntityManager()->find('Reservation\Entity\Type', $postData->type);
			if (NULL != $type) {
				$routeOptions = array(
					'controller' => 'Item',
					'action' => 'create',
					'uid' => $postData->type,
				);
				return $this->redirect()->toRoute('admin/default', $routeOptions);
			}
		}
		return new ViewModel();
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
		$typeUid = $this->params('uid');
		$typeEntity = NULL;
		$parentType = NULL;
		$typeUidToView = 0;
		$item = NULL;

		if (NULL !== $typeUid) {
			$typeUidToView = $typeUid;
			$form->get('type')->setValue($typeUid);

			$typeEntity = $this->getEntityManager()->find('Reservation\Entity\Type', $typeUid);

			if (NULL !== $typeEntity) {
				$parentType = $typeEntity->getParent();
				if (NULL !== $parentType) {
					$optionValues = array(
						0 => '',
						array(
							'label' => $parentType->getTitle(),
							'options' => $this->getEntityManager()->getRepository('Reservation\Entity\Item')->findArrayForSelectOption($typeEntity->getParent()->getUid())
						)
					);

					$form->get('parent')->setValueOptions(
							$optionValues
					);
				}
			}
		} else if (NULL === $typeEntity && !$this->getRequest()->isPost()) {
			$this->flashMessenger()->addMessage('<div class="alert alert-error">Select type first</div>');
			return $this->redirect()->toRoute('admin/default', array('controller' => 'item'));
		}

		$request = $this->getRequest();
		if ($request->isPost()) {
			$data = $request->getPost();



			$filter = new $this->classMap['filterClass']($this->getServiceLocator()->get('db'));

//			$form->setInputFilter($filter->getInputFilter());

			$form->setData($data);

			if (!$data->type) {
				$this->flashMessenger()->addMessage('<div class="alert alert-error">Select type first</div>');
				return $this->redirect()->toRoute('admin/default', array('controller' => 'item'));
			} else {
				$typeUidToView = $data->type;
			}

//			if ($form->isValid()) {

			$entity = new $this->classMap['entityClass']();

			foreach ($this->settersPostData as $method => $postName) {
				$entity->{$method}($data->{$postName});
			}

			if ($data->parent) {
				$settersData['setParent'] = $this->getEntityManager()->find($this->classMap['entityClass'], $data->parent);
			}
			if ($data->type) {
				$settersData['setType'] = $this->getEntityManager()->find($this->classMap['entityRelationClass'], $data->type);
			}

			$item = $this->getEntityManager()->getRepository('Reservation\Entity\Item')->findOneBy(array(
				'title' => $data->title,
				'type' => $data->type,
					));

			if (NULL === $item) {
				foreach ($settersData as $method => $value) {
					$entity->{$method}($value);
				}

				$this->getEntityManager()->persist($entity);
				$this->getEntityManager()->flush();
				$this->flashMessenger()->addMessage('<div class="alert alert-success">Success</div>');

				return $this->redirect()->toRoute('admin/default', array('controller' => 'item'));
			} else {
				$this->flashMessenger()->addMessage('<div class="alert alert-error">Already exist</div>');
				return $this->redirect()->toRoute('admin/default', array('controller' => 'item', 'action' => 'create', 'uid' => $typeUidToView));
			}
		}
//		}

		return new ViewModel(
						array(
							'form' => $form,
							'type' => $typeEntity,
							'item' => $item,
							'routeOptions' => array('controller' => 'item', 'action' => 'create'),
							'typeUid' => $typeUidToView,
							'messages' => $this->flashMessenger()->getMessages(),
						)
		);
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

		if ($entity instanceof $this->classMap['entityClass'] && NULL !== $entity) {
			$formData = array();
			foreach ($this->entityDataMatchFormName as $formName => $value) {
				if ('submit' != $formName) {
					if ('parent' === $formName || 'type' === $formName) {
						if (NULL !== $entity->{$value}()) {
							$formData[$formName] = $entity->{$value}()->getTitle();
						}
					} else {
						$formData[$formName] = $entity->{$value}();
					}
				}
			}
			$form->setData($formData);
		}

		$form->get('submit')->setValue('Done');
		if (NULL !== $entity->getType()) {
			$form->get('type')->setValue($entity->getType()->getUid());
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

					$settersData['setParent'] = $this->getEntityManager()->getRepository($this->classMap['entityClass'])->findOneBy(array('title' => $data->parent));
					$settersData['setType'] = $this->getEntityManager()->getRepository($this->classMap['entityRelationClass'])->findOneBy(array('title' => $data->type));
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
					'item' => $entity,
					'type' => $entity->getType(),
					'routeOptions' => array('controller' => 'item', 'action' => 'edit', 'uid' => $entityUid),
					'messages' => $this->flashMessenger()->getMessages(),
					'types' => $this->getEntityManager()->getRepository($this->classMap['entityRelationClass'])->findAllTitleInArray(),
					'items' => $this->getEntityManager()->getRepository($this->classMap['entityClass'])->findAllTitleInArray(),
						)
		);
		$viewModel->setTemplate('reservation/item/create');

		return $viewModel;
	}

	public function listAction() {
		$typeUid = $this->params('uid');
		$items = NULL;
		if (NULL === $typeUid) {
			$items = $this->getEntityManager()->getRepository('Reservation\Entity\Item')->findAll();
		} else {
			$items = $this->getEntityManager()->getRepository('Reservation\Entity\Item')->findBy(array(
				'type' => $typeUid
					));
		}

		return new ViewModel(
						array(
							'items' => $items,
							'types' => $this->getEntityManager()->getRepository('Reservation\Entity\Type')->findArrayForSelectOption(),
							'messages' => $this->flashMessenger()->getMessages(),
						)
		);
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
