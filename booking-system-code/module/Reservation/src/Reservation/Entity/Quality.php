<?php

namespace Reservation\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Quality
 *
 * @ORM\Table(name="quality")
 * @ORM\Entity
 */
class Quality
{
    /**
     * @var integer
     *
     * @ORM\Column(name="uid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $uid;

    /**
     * @var boolean
     *
     * @ORM\Column(name="disabled", type="boolean", nullable=true)
     */
    private $disabled;

    /**
     * @var boolean
     *
     * @ORM\Column(name="deleted", type="boolean", nullable=true)
     */
    private $deleted;

    /**
     * @var integer
     *
     * @ORM\Column(name="created_time", type="integer", nullable=true)
     */
    private $createdTime;

    /**
     * @var integer
     *
     * @ORM\Column(name="last_modified_time", type="integer", nullable=true)
     */
    private $lastModifiedTime;

    /**
     * @var integer
     *
     * @ORM\Column(name="valid_time_start", type="integer", nullable=true)
     */
    private $validTimeStart;

    /**
     * @var integer
     *
     * @ORM\Column(name="valid_time_end", type="integer", nullable=true)
     */
    private $validTimeEnd;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var boolean
     *
     * @ORM\Column(name="value", type="boolean", nullable=true)
     */
    private $value;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var \Reservation\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Reservation\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="created_user", referencedColumnName="user_id")
     * })
     */
    private $createdUser;

    /**
     * @var \Reservation\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Reservation\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="last_modified_user", referencedColumnName="user_id")
     * })
     */
    private $lastModifiedUser;



    /**
     * Get uid
     *
     * @return integer 
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * Set disabled
     *
     * @param boolean $disabled
     * @return Quality
     */
    public function setDisabled($disabled)
    {
        $this->disabled = $disabled;
    
        return $this;
    }

    /**
     * Get disabled
     *
     * @return boolean 
     */
    public function getDisabled()
    {
        return $this->disabled;
    }

    /**
     * Set deleted
     *
     * @param boolean $deleted
     * @return Quality
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
    
        return $this;
    }

    /**
     * Get deleted
     *
     * @return boolean 
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Set createdTime
     *
     * @param integer $createdTime
     * @return Quality
     */
    public function setCreatedTime($createdTime)
    {
        $this->createdTime = $createdTime;
    
        return $this;
    }

    /**
     * Get createdTime
     *
     * @return integer 
     */
    public function getCreatedTime()
    {
        return $this->createdTime;
    }

    /**
     * Set lastModifiedTime
     *
     * @param integer $lastModifiedTime
     * @return Quality
     */
    public function setLastModifiedTime($lastModifiedTime)
    {
        $this->lastModifiedTime = $lastModifiedTime;
    
        return $this;
    }

    /**
     * Get lastModifiedTime
     *
     * @return integer 
     */
    public function getLastModifiedTime()
    {
        return $this->lastModifiedTime;
    }

    /**
     * Set validTimeStart
     *
     * @param integer $validTimeStart
     * @return Quality
     */
    public function setValidTimeStart($validTimeStart)
    {
        $this->validTimeStart = $validTimeStart;
    
        return $this;
    }

    /**
     * Get validTimeStart
     *
     * @return integer 
     */
    public function getValidTimeStart()
    {
        return $this->validTimeStart;
    }

    /**
     * Set validTimeEnd
     *
     * @param integer $validTimeEnd
     * @return Quality
     */
    public function setValidTimeEnd($validTimeEnd)
    {
        $this->validTimeEnd = $validTimeEnd;
    
        return $this;
    }

    /**
     * Get validTimeEnd
     *
     * @return integer 
     */
    public function getValidTimeEnd()
    {
        return $this->validTimeEnd;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Quality
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set value
     *
     * @param boolean $value
     * @return Quality
     */
    public function setValue($value)
    {
        $this->value = $value;
    
        return $this;
    }

    /**
     * Get value
     *
     * @return boolean 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Quality
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
     * Set createdUser
     *
     * @param \Reservation\Entity\User $createdUser
     * @return Quality
     */
    public function setCreatedUser(\Reservation\Entity\User $createdUser = null)
    {
        $this->createdUser = $createdUser;
    
        return $this;
    }

    /**
     * Get createdUser
     *
     * @return \Reservation\Entity\User 
     */
    public function getCreatedUser()
    {
        return $this->createdUser;
    }

    /**
     * Set lastModifiedUser
     *
     * @param \Reservation\Entity\User $lastModifiedUser
     * @return Quality
     */
    public function setLastModifiedUser(\Reservation\Entity\User $lastModifiedUser = null)
    {
        $this->lastModifiedUser = $lastModifiedUser;
    
        return $this;
    }

    /**
     * Get lastModifiedUser
     *
     * @return \Reservation\Entity\User 
     */
    public function getLastModifiedUser()
    {
        return $this->lastModifiedUser;
    }
}