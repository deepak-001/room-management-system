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


class BookingController extends AbstractActionController {
	
	public function indexAction(){
		return array(
			'key' => "Hello World this is booking page"
		);
	}

	public function addUserAction(){
		return array(
			'key' => "add user"
			
		);
	}
	   public function addRoomAction(){
		   
		   return array(
			   'key' => $_POST["fname"]
		   );
	   }
}
