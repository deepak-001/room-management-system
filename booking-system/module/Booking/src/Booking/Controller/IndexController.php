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


class IndexController extends AbstractActionController {

    public function indexAction() {
        
        return array(
            'key' => 'Hello world'
            
        );
//        return new ViewModel(
//                );
    }
    public function readJsonAction(){
        $id =1 ;
        $name = 'speeder';
		$array = array('id'=> $id, 'name' => $name);
        $path ='Booking\Model\UsersTable';
		$this->getServiceLocator()->get($path)->saveUsers($array);
		
        
//       return array(
//           'key' => 'readJsonAction'
//       );
       
       }
    

}
