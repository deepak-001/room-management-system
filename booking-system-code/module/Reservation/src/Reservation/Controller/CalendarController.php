<?php

namespace Reservation\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CalendarController extends AbstractActionController {

	public function datafeedlistAction() {

		$reservation = array('events' => array());
		$reservationEntities = $this->getEntityManager()->getRepository('Reservation\Entity\Reservation')->findAll();
		foreach ($reservationEntities as $entity) {
			$reservation['events'][] = array(
				$entity->getUid(),
				$entity->getItem()->getTitle() . ' ' . $entity->getUser()->getUsername(),
				date('m/d/Y H:i', $entity->getStartTime()),
				date('m/d/Y H:i', $entity->getEndTime()),
			);
		}

		$this->layout('layout/blank');
		return new ViewModel(
						array(
							'data' => json_encode($reservation),
						)
		);
	}

	private function js2PhpTime($jsdate) {
		if (preg_match('@(\d+)/(\d+)/(\d+)\s+(\d+):(\d+)@', $jsdate, $matches) == 1) {
			$ret = mktime($matches[4], $matches[5], 0, $matches[1], $matches[2], $matches[3]);
			//echo $matches[4] ."-". $matches[5] ."-". 0  ."-". $matches[1] ."-". $matches[2] ."-". $matches[3];
		} else if (preg_match('@(\d+)/(\d+)/(\d+)@', $jsdate, $matches) == 1) {
			$ret = mktime(0, 0, 0, $matches[1], $matches[2], $matches[3]);
			//echo 0 ."-". 0 ."-". 0 ."-". $matches[1] ."-". $matches[2] ."-". $matches[3];
		}
		return $ret;
	}

	private function php2JsTime($phpDate) {
		//echo $phpDate;
		//return "/Date(" . $phpDate*1000 . ")/";
		return date("m/d/Y H:i", $phpDate);
	}

	private function listCalendar($day, $type) {
		$phpTime = $this->js2PhpTime($day);
		//echo $phpTime . "+" . $type;
		switch ($type) {
			case "month":
				$st = mktime(0, 0, 0, date("m", $phpTime), 1, date("Y", $phpTime));
				$et = mktime(0, 0, -1, date("m", $phpTime) + 1, 1, date("Y", $phpTime));
				break;
			case "week":
				//suppose first day of a week is monday 
				$monday = date("d", $phpTime) - date('N', $phpTime) + 1;
				//echo date('N', $phpTime);
				$st = mktime(0, 0, 0, date("m", $phpTime), $monday, date("Y", $phpTime));
				$et = mktime(0, 0, -1, date("m", $phpTime), $monday + 7, date("Y", $phpTime));
				break;
			case "day":
				$st = mktime(0, 0, 0, date("m", $phpTime), date("d", $phpTime), date("Y", $phpTime));
				$et = mktime(0, 0, -1, date("m", $phpTime), date("d", $phpTime) + 1, date("Y", $phpTime));
				break;
		}
		//echo $st . "--" . $et;
		return listCalendarByRange($st, $et);
	}

	function listCalendarByRange($sd, $ed) {
		$ret = array();
		$ret['events'] = array();
		$ret["issort"] = true;
		$ret["start"] = $this->php2JsTime($sd);
		$ret["end"] = $this->php2JsTime($ed);
		$ret['error'] = null;
		try {
			$db = new DBConnection();
			$db->getConnection();
			$sql = "select * from `jqcalendar` where `starttime` between '"
					. php2MySqlTime($sd) . "' and '" . php2MySqlTime($ed) . "'";
			$handle = mysql_query($sql);
			//echo $sql;
			while ($row = mysql_fetch_object($handle)) {
				//$ret['events'][] = $row;
				//$attends = $row->AttendeeNames;
				//if($row->OtherAttendee){
				//  $attends .= $row->OtherAttendee;
				//}
				//echo $row->StartTime;
				$ret['events'][] = array(
					$row->Id,
					$row->Subject,
					php2JsTime(mySql2PhpTime($row->StartTime)),
					php2JsTime(mySql2PhpTime($row->EndTime)),
					$row->IsAllDayEvent,
					0, //more than one day event
					//$row->InstanceType,
					0, //Recurring event,
					$row->Color,
					1, //editable
					$row->Location,
					''//$attends
				);
			}
		} catch (Exception $e) {
			$ret['error'] = $e->getMessage();
		}
		return $ret;
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
