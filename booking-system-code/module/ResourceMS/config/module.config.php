<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace ResourceMS;

return array(
	'router' => array(
		'routes' => array(
			// Home Register //
			'home' => array(
				'type' => 'Zend\Mvc\Router\Http\Literal',
				'options' => array(
					'route' => '/',
					'defaults' => array(
						'controller' => 'index',
						'action' => 'index',
					),
				),
			),
			'manage' => array(
				'type' => 'Zend\Mvc\Router\Http\Segment',
				'options' => array(
					'route' => '/manage[/]',
					'defaults' => array(
						'controller' => 'management',
						'action' => 'index',
					),
				),
				'may_terminate' => true,
				'child_routes' => array(
					'resource' => array(
						'type' => 'Segment',
						'options' => array(
							'route' => '[:controller[/][:p][:action]]',
							'constraints' => array(
								'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
								'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
								'p' => '[\ \-0-9]+',
							),
						),
					),
					'room' => array(
						'type' => 'Segment',
						'options' => array(
							'route' => 'room/in/building/[:building[/:action[/:room]]]',
							'constraints' => array(
								'building' => '[a-zA-Z][a-zA-Z0-9_-]*',
								'room' => '[0-9]+',
							),
							'defaults' => array(
								'controller' => 'room',
								'action' => 'index',
							),
						),
					),
				),
			),
		),
	),
	'session' => array(
		'save_path' => realpath(__DIR__ . '/../../../data/session'),
	),
	'controllers' => array(
		'invokables' => array(
			'index' => 'ResourceMS\Controller\IndexController',
			'management' => 'ResourceMS\Controller\ManagementController',
			'building' => 'ResourceMS\Controller\BuildingController',
			'room' => 'ResourceMS\Controller\RoomController',
		),
	),
	'service_manager' => array(
		'factories' => array(
			'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
		),
	),
	'translator' => array(
		'locale' => 'en_US',
		'translation_file_patterns' => array(
			array(
				'type' => 'gettext',
				'base_dir' => __DIR__ . '/../language',
				'pattern' => '%s.mo',
			),
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
			'zfcuser/login' => __DIR__ . '/../view/zfcuser/login.phtml',
		),
		'template_path_stack' => array(
			'resourcems' => __DIR__ . '/../view',
			'zfcuser' => __DIR__ . '/../view',
		),
	),
	// Doctrine config
	'doctrine' => array(
		'driver' => array(
			__NAMESPACE__ . '_driver' => array(
				'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
				'cache' => 'array',
				'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
			),
			'orm_default' => array(
				'drivers' => array(
					__NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
				),
			),
		),
	),
);
