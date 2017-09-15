<?php

class CCDatabase
{
	private $serverName;
	private $uid;
	private $pwd;
	private $databaseName;
	
	function __construct()
	{
		$myfile = fopen("..\..\Secure\dbAccess.txt", "r") or die("Unable to open file!");
		$this->serverName = trim(fgets($myfile));
		$this->uid = trim(fgets($myfile));
		$this->pwd = trim(fgets($myfile));
		$this->databaseName = trim(fgets($myfile));
		
		fclose($myfile);
	}
	
	function getAllSmartContracts()
	{
		$connectionInfo = array( "UID"=>$this->uid,                            
                         "PWD"=>$this->pwd,                            
                         "Database"=>$this->databaseName); 
						 
		// Connect using SQL Server Authentication.
		$conn = sqlsrv_connect( $this->serverName, $connectionInfo);  
		$tsql = "SELECT [id], [name], [abi], [startDate], [smartContractAddress], [allowDeposits] from ICOs";  
		
		// Execute the query.
		$stmt = sqlsrv_query( $conn, $tsql);  
		
		// Iterate through the result set printing a row of data upon each iteration.
		$contracts = array();

		while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC))  
		{ 
			$contracts[] = new SmartContract($row);			
		}  
		
		// Free statement and connection resources. 
		sqlsrv_free_stmt( $stmt);  
		sqlsrv_close( $conn);  

		return $contracts;
	}
}

?>