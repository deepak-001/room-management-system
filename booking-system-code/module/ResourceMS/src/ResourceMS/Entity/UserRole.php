<?php

namespace ResourceMS\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserRole
 *
 * @ORM\Table(name="user_role")
 * @ORM\Entity(repositoryClass="ResourceMS\Repository\UserRoleRepository")
 */
class UserRole
{
    /**
     * @var string
     *
     * @ORM\Column(name="role_id", type="string", length=255, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $roleId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="default", type="boolean", nullable=true)
     */
    private $default;

    /**
     * @var string
     *
     * @ORM\Column(name="parent", type="string", length=255, nullable=true)
     */
    private $parent;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ResourceMS\Entity\User", mappedBy="role")
     */
    private $user;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

    /**
     * Get roleId
     *
     * @return string 
     */
    public function getRoleId()
    {
        return $this->roleId;
    }

    /**
     * Set default
     *
     * @param boolean $default
     * @return UserRole
     */
    public function setDefault($default)
    {
        $this->default = $default;
    
        return $this;
    }

    /**
     * Get default
     *
     * @return boolean 
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * Set parent
     *
     * @param string $parent
     * @return UserRole
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    
        return $this;
    }

    /**
     * Get parent
     *
     * @return string 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add user
     *
     * @param \ResourceMS\Entity\User $user
     * @return UserRole
     */
    public function addUser(\ResourceMS\Entity\User $user)
    {
        $this->user[] = $user;
    
        return $this;
    }

    /**
     * Remove user
     *
     * @param \ResourceMS\Entity\User $user
     */
    public function removeUser(\ResourceMS\Entity\User $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUser()
    {
        return $this->user;
    }
}