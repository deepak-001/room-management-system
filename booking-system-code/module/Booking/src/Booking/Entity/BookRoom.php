<?php

namespace Booking\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BookRoom
 *
 * @ORM\Table(name="book_room")
 * @ORM\Entity
 */
class BookRoom
{
    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $userId;

    /**
     * @var integer
     *
     * @ORM\Column(name="room_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $roomId;

    /**
     * @var integer
     *
     * @ORM\Column(name="start_time", type="integer", nullable=true)
     */
    private $startTime;

    /**
     * @var integer
     *
     * @ORM\Column(name="end_time", type="integer", nullable=true)
     */
    private $endTime;

    /**
     * @var string
     *
     * @ORM\Column(name="report", type="string", length=255, nullable=true)
     */
    private $report;



    /**
     * Set userId
     *
     * @param integer $userId
     * @return BookRoom
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    
        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set roomId
     *
     * @param integer $roomId
     * @return BookRoom
     */
    public function setRoomId($roomId)
    {
        $this->roomId = $roomId;
    
        return $this;
    }

    /**
     * Get roomId
     *
     * @return integer 
     */
    public function getRoomId()
    {
        return $this->roomId;
    }

    /**
     * Set startTime
     *
     * @param integer $startTime
     * @return BookRoom
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
    
        return $this;
    }

    /**
     * Get startTime
     *
     * @return integer 
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Set endTime
     *
     * @param integer $endTime
     * @return BookRoom
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;
    
        return $this;
    }

    /**
     * Get endTime
     *
     * @return integer 
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * Set report
     *
     * @param string $report
     * @return BookRoom
     */
    public function setReport($report)
    {
        $this->report = $report;
    
        return $this;
    }

    /**
     * Get report
     *
     * @return string 
     */
    public function getReport()
    {
        return $this->report;
    }
}