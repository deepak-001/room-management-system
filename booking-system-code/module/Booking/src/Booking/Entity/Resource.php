<?php

namespace Booking\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Resource
 *
 * @ORM\Table(name="resource")
 * @ORM\Entity
 */
class Resource
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
     * @ORM\Column(name="numbers", type="integer", nullable=true)
     */
    private $numbers;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var \Booking\Entity\Category
     *
     * @ORM\ManyToOne(targetEntity="Booking\Entity\Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * })
     */
    private $category;

    /**
     * @var \Booking\Entity\Quality
     *
     * @ORM\ManyToOne(targetEntity="Booking\Entity\Quality")
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
     * Set numbers
     *
     * @param integer $numbers
     * @return Resource
     */
    public function setNumbers($numbers)
    {
        $this->numbers = $numbers;
    
        return $this;
    }

    /**
     * Get numbers
     *
     * @return integer 
     */
    public function getNumbers()
    {
        return $this->numbers;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Resource
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
     * Set category
     *
     * @param \Booking\Entity\Category $category
     * @return Resource
     */
    public function setCategory(\Booking\Entity\Category $category = null)
    {
        $this->category = $category;
    
        return $this;
    }

    /**
     * Get category
     *
     * @return \Booking\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set quality
     *
     * @param \Booking\Entity\Quality $quality
     * @return Resource
     */
    public function setQuality(\Booking\Entity\Quality $quality = null)
    {
        $this->quality = $quality;
    
        return $this;
    }

    /**
     * Get quality
     *
     * @return \Booking\Entity\Quality 
     */
    public function getQuality()
    {
        return $this->quality;
    }
}