<?php

namespace ResourceMS\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Room
 *
 * @ORM\Table(name="room")
 * @ORM\Entity
 */
class Room
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="number", type="integer", nullable=true)
     */
    private $number;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var \ResourceMS\Entity\Building
     *
     * @ORM\ManyToOne(targetEntity="ResourceMS\Entity\Building")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="building_id", referencedColumnName="id")
     * })
     */
    private $building;

    /**
     * @var \ResourceMS\Entity\Quality
     *
     * @ORM\ManyToOne(targetEntity="ResourceMS\Entity\Quality")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="quality_id", referencedColumnName="id")
     * })
     */
    private $quality;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set number
     *
     * @param integer $number
     * @return Room
     */
    public function setNumber($number)
    {
        $this->number = $number;
    
        return $this;
    }

    /**
     * Get number
     *
     * @return integer 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Room
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set building
     *
     * @param \ResourceMS\Entity\Building $building
     * @return Room
     */
    public function setBuilding(\ResourceMS\Entity\Building $building = null)
    {
        $this->building = $building;
    
        return $this;
    }

    /**
     * Get building
     *
     * @return \ResourceMS\Entity\Building 
     */
    public function getBuilding()
    {
        return $this->building;
    }

    /**
     * Set quality
     *
     * @param \ResourceMS\Entity\Quality $quality
     * @return Room
     */
    public function setQuality(\ResourceMS\Entity\Quality $quality = null)
    {
        $this->quality = $quality;
    
        return $this;
    }

    /**
     * Get quality
     *
     * @return \ResourceMS\Entity\Quality 
     */
    public function getQuality()
    {
        return $this->quality;
    }
}