<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
return array(
	'router' => array(
		'routes' => array(
			// Home Register //
			'home' => array(
				'type' => 'Zend\Mvc\Router\Http\Literal',
				'options' => array(
					'route' => '/home',
					'defaults' => array(
						'controller' => 'Booking\Controller\Index',
						'action' => 'index',
					),
				),
				'may_terminate' => true,
				'child_routes' => array(
					'user-list' => array(
						'type' => 'Zend\Mvc\Router\Http\Literal',
						'options' => array(
							'route' => '/users',
							'defaults' => array(
								'controller' => 'Booking\Controller\Index',
								'action' => 'showUsers',
							),
						),
					),
					'rooms-list' => array(
						'type' => 'Zend\Mvc\Router\Http\Literal',
						'options' => array(
							'route' => '/view',
							'defaults' => array(
								'controller' => 'Booking\Controller\Index',
								'action' => 'showRooms',
							),
						),
					),
				),
			),
			// Booking Action //
			'booking' => array(
				'type' => 'Zend\Mvc\Router\Http\Literal',
				'options' => array(
					'route' => '/booking',
					'defaults' => array(
						'controller' => 'Booking\Controller\booking',
						'action' => 'index',
					),
				),
				'may_terminate' => true,
				'child_routes' => array(
					'add_room' => array(
						'type' => 'Zend\Mvc\Router\Http\Literal',
						'options' => array(
							'route' => '/add_room',
							'defaults' => array(
								'controller' => 'Booking\Controller\booking',
								'action' => 'addRoom',
							),
						),
					),
					'add_user' => array(
						'type' => 'Zend\Mvc\Router\Http\Literal',
						'options' => array(
							'route' => '/add_user',
							'defaults' => array(
								'controller' => 'Booking\Controller\booking',
								'action' => 'addUser',
							),
						),
					),
				),
			),
			
			// User Management //
			'users-list' => array(
				'type' => 'Literal',
				'options' => array(
					'route' => '/user',
					'defaults' => array(
						'__NAMESPACE__' => 'Booking\Controller',
						'controller' => 'Index',
						'action' => 'showUsers',
					),
				),
				'may_terminate' => true,
				'child_routes' => array(
					'default' => array(
						'type' => 'Segment',
						'options' => array(
							'route' => '/[:controller[/:action]]',
							'constraints' => array(
								'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
								'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							),
							'defaults' => array(
							),
						),
					),
				),
			),
		),
	),
	'controllers' => array(
		'invokables' => array(
			'Booking\Controller\Index' => 'Booking\Controller\IndexController',
			'Booking\Controller\Booking' => 'Booking\Controller\BookingController'
		),
	),
	'service_manager' => array(
		'factories' => array(
			'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
		),
	),
	'view_manager' => array(
		'display_not_found_reason' => true,
		'display_exceptions' => true,
		'doctype' => 'HTML5',
		'not_found_template' => 'error/404',
		'exception_template' => 'error/index',
		'template_map' => array(
			'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
			'error/404' => __DIR__ . '/../view/error/404.phtml',
			'error/index' => __DIR__ . '/../view/error/index.phtml',
		),
		'template_path_stack' => array(
			__DIR__ . '/../view',
		),
	),
);
