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
     * @ORM\Column(name="start_time", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
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
     * @var \Booking\Entity\User
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\OneToOne(targetEntity="Booking\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     * })
     */
    private $user;

    /**
     * @var \Booking\Entity\Room
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\OneToOne(targetEntity="Booking\Entity\Room")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="room_id", referencedColumnName="id")
     * })
     */
    private $room;



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

    /**
     * Set user
     *
     * @param \Booking\Entity\User $user
     * @return BookRoom
     */
    public function setUser(\Booking\Entity\User $user)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Booking\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set room
     *
     * @param \Booking\Entity\Room $room
     * @return BookRoom
     */
    public function setRoom(\Booking\Entity\Room $room)
    {
        $this->room = $room;
    
        return $this;
    }

    /**
     * Get room
     *
     * @return \Booking\Entity\Room 
     */
    public function getRoom()
    {
        return $this->room;
    }
}