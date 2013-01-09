<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Booking\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Booking\Model\UsersModel;
use Booking\Model\RoomsTable;


class IndexController extends AbstractActionController {

    public function indexAction() {
        
        return array(
            'key' => 'Hello world'
            
        );
//        return new ViewModel(
//                );
    }
    public function readJsonAction(){
        $id =3 ;
        $name = 'speeder';
		$array = array('id'=> $id, 'name' => $name);
        $path ='Booking\Model\UsersTable';
		$this->getServiceLocator()->get($path)->saveUsers($array);
		
        
//       return array(
//           'key' => 'readJsonAction'
//       );
       
       }
	   
	   public function showUsersAction(){
		   $path ='Booking\Model\UsersTable';
//		   $users = $this->getServiceLocator()->get($path)->fetchAll();
//		   echo count($users);
//		   var_dump($users);
		   return new ViewModel(array(
            'users' => $this->getServiceLocator()->get($path)->fetchAll(),
			));
//		    return array(
//			   'key' => 'This view action'
//		   );
	   }
	   public function showRoomsAction(){
		   $path ='Booking\Model\RoomsTable';
		   return new ViewModel(array(
            'rooms' => $this->getServiceLocator()->get($path)->fetchAll(),
			));
	   }
	   public function viewAction(){
		   return array(
			   'key' => 'This view action'
		   );
	   }
    

}
