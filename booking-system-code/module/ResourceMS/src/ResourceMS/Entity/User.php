<?php

namespace ResourceMS\Entity;

use ZfcUser\Entity\UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class User implements UserInterface {

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="user_id", type="integer", nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $userId;

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
	 * @var string
	 *
	 * @ORM\Column(name="username", type="string", length=64, nullable=true)
	 */
	private $username;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="password", type="string", length=255, nullable=true)
	 */
	private $password;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="email", type="string", length=64, nullable=true)
	 */
	private $email;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="gender", type="string", length=11, nullable=false)
	 */
	private $gender;

	/**
	 * Get id.
	 *
	 * @return int
	 */
	public function getId() {
		return $this->userId;
	}

	/**
	 * Set id.
	 *
	 * @param int $id
	 * @return UserInterface
	 */
	public function setId($id) {
		$this->userId = $id;
	}

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="last_login_time", type="integer", nullable=true)
	 */
	private $lastLoginTime;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="display_name", type="string", length=50, nullable=true)
	 */
	private $displayName;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="state", type="smallint", nullable=true)
	 */
	private $state;

	/**
	 * @var \Doctrine\Common\Collections\Collection
	 *
	 * @ORM\ManyToMany(targetEntity="ResourceMS\Entity\UserRole", inversedBy="user")
	 * @ORM\JoinTable(name="user_role_linker",
	 *   joinColumns={
	 *     @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
	 *   },
	 *   inverseJoinColumns={
	 *     @ORM\JoinColumn(name="role_id", referencedColumnName="role_id")
	 *   }
	 * )
	 */
	private $role;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->role = new \Doctrine\Common\Collections\ArrayCollection();
	}

	/**
	 * Get userId
	 *
	 * @return integer 
	 */
	public function getUserId() {
		return $this->userId;
	}

	/**
	 * Set disabled
	 *
	 * @param boolean $disabled
	 * @return User
	 */
	public function setDisabled($disabled) {
		$this->disabled = $disabled;

		return $this;
	}

	/**
	 * Get disabled
	 *
	 * @return boolean 
	 */
	public function getDisabled() {
		return $this->disabled;
	}

	/**
	 * Set deleted
	 *
	 * @param boolean $deleted
	 * @return User
	 */
	public function setDeleted($deleted) {
		$this->deleted = $deleted;

		return $this;
	}

	/**
	 * Get deleted
	 *
	 * @return boolean 
	 */
	public function getDeleted() {
		return $this->deleted;
	}

	/**
	 * Set username
	 *
	 * @param string $username
	 * @return User
	 */
	public function setUsername($username) {
		$this->username = $username;

		return $this;
	}

	/**
	 * Get username
	 *
	 * @return string 
	 */
	public function getUsername() {
		return $this->username;
	}

	/**
	 * Set password
	 *
	 * @param string $password
	 * @return User
	 */
	public function setPassword($password) {
		$this->password = $password;

		return $this;
	}

	/**
	 * Get password
	 *
	 * @return string 
	 */
	public function getPassword() {
		return $this->password;
	}

	/**
	 * Set email
	 *
	 * @param string $email
	 * @return User
	 */
	public function setEmail($email) {
		$this->email = $email;

		return $this;
	}

	/**
	 * Get email
	 *
	 * @return string 
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * Set gender
	 *
	 * @param string $gender
	 * @return User
	 */
	public function setGender($gender) {
		$this->gender = $gender;

		return $this;
	}

	/**
	 * Get gender
	 *
	 * @return string 
	 */
	public function getGender() {
		return $this->gender;
	}

	/**
	 * Set lastLoginTime
	 *
	 * @param integer $lastLoginTime
	 * @return User
	 */
	public function setLastLoginTime($lastLoginTime) {
		$this->lastLoginTime = $lastLoginTime;

		return $this;
	}

	/**
	 * Get lastLoginTime
	 *
	 * @return integer 
	 */
	public function getLastLoginTime() {
		return $this->lastLoginTime;
	}

	/**
	 * Set displayName
	 *
	 * @param string $displayName
	 * @return User
	 */
	public function setDisplayName($displayName) {
		$this->displayName = $displayName;

		return $this;
	}

	/**
	 * Get displayName
	 *
	 * @return string 
	 */
	public function getDisplayName() {
		return $this->displayName;
	}

	/**
	 * Set state
	 *
	 * @param integer $state
	 * @return User
	 */
	public function setState($state) {
		$this->state = $state;

		return $this;
	}

	/**
	 * Get state
	 *
	 * @return integer 
	 */
	public function getState() {
		return $this->state;
	}

	/**
	 * Add role
	 *
	 * @param \ResourceMS\Entity\UserRole $role
	 * @return User
	 */
	public function addRole(\ResourceMS\Entity\UserRole $role) {
		$this->role[] = $role;

		return $this;
	}

	/**
	 * Remove role
	 *
	 * @param \ResourceMS\Entity\UserRole $role
	 */
	public function removeRole(\ResourceMS\Entity\UserRole $role) {
		$this->role->removeElement($role);
	}

	/**
	 * Get role
	 *
	 * @return \Doctrine\Common\Collections\Collection 
	 */
	public function getRole() {
		return $this->role;
	}

}