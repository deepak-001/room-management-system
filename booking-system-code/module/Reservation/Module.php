<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Reservation;

use Zend\Mvc\MvcEvent;
use Zend\Session\Config\SessionConfig;

class Module {

	public function onBootstrap(MvcEvent $e) {
		$events = $e->getApplication()->getEventManager()->getSharedManager();
		
		$config = $e->getApplication()->getServiceManager()->get('config');
		// configure session 
		$sessionConfig = new SessionConfig();
		$sessionConfig->setOptions($config['session']);
		
		$events->attach('ZfcUser\Service\User', 'register.post', function($e) {
					$user = $e->getParam('user');  // User account object
					$form = $e->getParam('form');  // Form object
					// Perform your custom action here

					/* @var $sm ServiceLocatorInterface */
					$sm = $e->getTarget()->getServiceManager();

					/* @var $em \Doctrine\ORM\EntityManager */
					$em = $sm->get('doctrine.entitymanager.orm_default');

					$defaultRoleId = 'student';

					$userRole = $em->find('ResourceMS\Entity\UserRole', $defaultRoleId);
					if (NULL !== $userRole) {
						$user->addRole($userRole);
						$em->persist($user);
						$em->flush();
					}
				}
		);
	}

	public function getConfig() {
		return include __DIR__ . '/config/module.config.php';
	}

	public function getAutoloaderConfig() {
		return array(
			'Zend\Loader\StandardAutoloader' => array(
				'namespaces' => array(
					__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
				),
			),
		);
	}

	public function getServiceConfig() {
		return array(
			'factories' => array(
			),
		);
	}

}
