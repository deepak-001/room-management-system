<?php


namespace Booking\Model;

class Users
{
    public $id;
    public $name;
	public $dateOfBirth;
	public $email;
    public function exchangeArray($data)
    {
        $this->id     = (isset($data['id'])) ? $data['id'] : null;
        $this->name = (isset($data['name'])) ? $data['name'] : null;
		$this->dateOfBirth     = (isset($data['dateOfBirth'])) ? $data['dateOfBirth'] : null;
		$this->email     = (isset($data['email'])) ? $data['email'] : null;
    }
}
?>
