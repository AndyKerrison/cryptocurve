<?php  

class Transaction {
	
	public $ID;
	public $transactionID;
	public $owner;
	public $timestamp;
	public $ico;
	public $type;
	public $value;
			
	function __construct ($dataRow)
	{
		$this->ID = $dataRow[0];
		$this->transactionID = $dataRow[1];
		$this->owner = $dataRow[2];
		$this->timestamp = $dataRow[3];
		$this->ico = $dataRow[4];
		$this->type = $dataRow[5];
		$this->value = $dataRow[6];
	}
	
	public function getID() {
        return $this->ID;
    }
}

?>  

