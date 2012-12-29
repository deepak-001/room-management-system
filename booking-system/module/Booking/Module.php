<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Booking;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Booking\Model\UsersTable;
use Zend\Db\ResultSet\ResultSet;
use Booking\Model\Users;
use Zend\Db\TableGateway\TableGateway;


class Module
{

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
	 public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Booking\Model\UsersTable' =>  function($sm) {
                    $tableGateway = $sm->get('AlbumTableGateway');
                    $table = new UsersTable($tableGateway);
                    return $table;
                },
                'AlbumTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Users());
                    return new TableGateway('users', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }
}
