<?php


namespace Booking\Model;

class Rooms
{
    public $id;
    public $idBuilding;
	public $idQuality;
	public $number;
	public $description;

    public function exchangeArray($data)
    {
        $this->id     = (isset($data['id'])) ? $data['id'] : null;
        $this->idBuilding = (isset($data['idBuilding'])) ? $data['idBuilding'] : null;
		$this->idQuality  = (isset($data['idQuality'])) ? $data['idQuality'] : null;
		$this->number     = (isset($data['number'])) ? $data['number'] : null;
		$this->description     = (isset($data['description'])) ? $data['number'] : null;
    }
}
?>
