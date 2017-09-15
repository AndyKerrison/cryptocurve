<?php  

class SmartContract {
	
	private $ID;
	private $name;
	private $abi;
	private $startDate;
	private $smartContractAddress;
	private $allowDeposits;
		
	function __construct ($dataRow)
	{
		$this->ID = $dataRow[0];
		$this->name = $dataRow[1];
		$this->abi = trim($dataRow[2]);
		
		$dateTimeObj = $dataRow[3]->format('Y-m-d');
		
		$this->startDate = $dateTimeObj;
		$this->smartContractAddress = trim($dataRow[4]);
		$this->allowDeposits = $dataRow[5];
	}
	
	public function getID() {
        return $this->ID;
    }
	
	public function getName() {
        return $this->name;
    }
	
	public function getAbi() {
        return $this->abi;
    }
	
	public function getStartDate() {
        return $this->startDate;
    }
	
	public function getSmartContractAddress() {
        return $this->smartContractAddress;
    }
	
	public function getAllowDeposits() {
        return $this->allowDeposits;
    }
}

?>  