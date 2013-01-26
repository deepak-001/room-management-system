<?php

namespace ResourceMS\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BookResource
 *
 * @ORM\Table(name="book_resource")
 * @ORM\Entity
 */
class BookResource
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
     * @var \ResourceMS\Entity\User
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\OneToOne(targetEntity="ResourceMS\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     * })
     */
    private $user;

    /**
     * @var \ResourceMS\Entity\Resource
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\OneToOne(targetEntity="ResourceMS\Entity\Resource")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="resource_id", referencedColumnName="id")
     * })
     */
    private $resource;



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
     * @return BookResource
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
     * @return BookResource
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
     * @param \ResourceMS\Entity\User $user
     * @return BookResource
     */
    public function setUser(\ResourceMS\Entity\User $user)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \ResourceMS\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set resource
     *
     * @param \ResourceMS\Entity\Resource $resource
     * @return BookResource
     */
    public function setResource(\ResourceMS\Entity\Resource $resource)
    {
        $this->resource = $resource;
    
        return $this;
    }

    /**
     * Get resource
     *
     * @return \ResourceMS\Entity\Resource 
     */
    public function getResource()
    {
        return $this->resource;
    }
}