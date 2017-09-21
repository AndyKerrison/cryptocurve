<?php

class CCDatabase
{
	private $serverName;
	private $uid;
	private $pwd;
	private $databaseName;
	private $connectionInfo;
	
	function __construct()
	{
		$myfile = fopen("..\..\Secure\dbAccess.txt", "r") or die("Unable to open file!");
		$this->serverName = trim(fgets($myfile));
		$this->uid = trim(fgets($myfile));
		$this->pwd = trim(fgets($myfile));
		$this->databaseName = trim(fgets($myfile));
		$this->connectionInfo = array( "UID"=>$this->uid, "PWD"=>$this->pwd, "Database"=>$this->databaseName);
		
		fclose($myfile);
	}
	
	function getTransactions($owner)
	{	
		$file = "phplog.txt";
		file_put_contents($file, "getTransactions(".$owner.")", FILE_APPEND | LOCK_EX);
		
		// Connect using SQL Server Authentication.
		$conn = sqlsrv_connect( $this->serverName, $this->connectionInfo);  
		$sql = "SELECT [id], [transactionID], [owner], [timestamp], [ico], [type], [value]
			FROM [Transactions] where owner = ? and isComplete = 0";
			
		file_put_contents($file, "declared", FILE_APPEND | LOCK_EX);
		
		//$stmt = sqlsrv_query( $conn, $sql, array());
		$stmt = sqlsrv_query( $conn, $sql, array(&$owner));
		
		file_put_contents($file, "EX", FILE_APPEND | LOCK_EX);
		
		if( ($errors = sqlsrv_errors() ) != null) {
				foreach( $errors as $error ) {
					echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
					file_put_contents($file, $error[ 'SQLSTATE'], FILE_APPEND | LOCK_EX);
					echo "code: ".$error[ 'code']."<br />";
					file_put_contents($file, $error[ 'code'], FILE_APPEND | LOCK_EX);
					echo "message: ".$error[ 'message']."<br />";
					file_put_contents($file, $error[ 'message'], FILE_APPEND | LOCK_EX);
				}
			}
				
		// Iterate through the result set printing a row of data upon each iteration.
		$transactions = array();
	
		while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC))  
		{ 
			file_put_contents($file, "adding", FILE_APPEND | LOCK_EX);
			$test = new Transaction($row);	
			$transactions[] = $test;//array("one", "two");//$test;
			//file_put_contents($file, $test->jsonSerialize(), FILE_APPEND | LOCK_EX);
			//$transactions[] = $test;//transaction->jsonSerialize();
		} 
		
		file_put_contents($file, "prepared", FILE_APPEND | LOCK_EX);
				
		/*if( sqlsrv_execute( $stmt ) === false ) {
			file_put_contents($file, "ERROR", FILE_APPEND | LOCK_EX);
			if( ($errors = sqlsrv_errors() ) != null) {
				foreach( $errors as $error ) {
					echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
					file_put_contents($file, $error[ 'SQLSTATE'], FILE_APPEND | LOCK_EX);
					echo "code: ".$error[ 'code']."<br />";
					file_put_contents($file, $error[ 'code'], FILE_APPEND | LOCK_EX);
					echo "message: ".$error[ 'message']."<br />";
					file_put_contents($file, $error[ 'message'], FILE_APPEND | LOCK_EX);
				}
			}		
			die( print_r( sqlsrv_errors(), true));
		}
		else
		{
			file_put_contents($file, "getTransactions OK", FILE_APPEND | LOCK_EX);
		}*/
				
		if( ($errors = sqlsrv_errors() ) != null) {
				foreach( $errors as $error ) {
					echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
					file_put_contents($file, $error[ 'SQLSTATE'], FILE_APPEND | LOCK_EX);
					echo "code: ".$error[ 'code']."<br />";
					file_put_contents($file, $error[ 'code'], FILE_APPEND | LOCK_EX);
					echo "message: ".$error[ 'message']."<br />";
					file_put_contents($file, $error[ 'message'], FILE_APPEND | LOCK_EX);
				}
			}
		
		// Free statement and connection resources. 
		sqlsrv_free_stmt( $stmt);  
		sqlsrv_close( $conn);  
		
		file_put_contents($file, "getTransactions END", FILE_APPEND | LOCK_EX);

		return $transactions;
	}
	
	function setTransactionComplete($transactionID)
	{
		$file = "phplog.txt";
		file_put_contents($file, "setTransactionComplete", FILE_APPEND | LOCK_EX);
		
		$connectionInfo = array( "UID"=>$this->uid,                            
			"PWD"=>$this->pwd,
			"Database"=>$this->databaseName);
		
		$conn = sqlsrv_connect( $this->serverName, $connectionInfo);		
		
		$sql = "update Transactions set isComplete = 1 where transactionID = ?";
		
		// Initialize parameters and prepare the statement. 
		$stmt = sqlsrv_prepare( $conn, $sql, array( &$transactionID));
		
		if( sqlsrv_execute( $stmt ) === false ) {
			file_put_contents($file, "ERROR", FILE_APPEND | LOCK_EX);
			if( ($errors = sqlsrv_errors() ) != null) {
				foreach( $errors as $error ) {
					echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
					file_put_contents($file, $error[ 'SQLSTATE'], FILE_APPEND | LOCK_EX);
					echo "code: ".$error[ 'code']."<br />";
					file_put_contents($file, $error[ 'code'], FILE_APPEND | LOCK_EX);
					echo "message: ".$error[ 'message']."<br />";
					file_put_contents($file, $error[ 'message'], FILE_APPEND | LOCK_EX);
				}
			}
			
			
			die( print_r( sqlsrv_errors(), true));
		}
		
		sqlsrv_free_stmt( $stmt);  
		sqlsrv_close( $conn);  
	}
	
	function addTransaction($transactionID, $owner, $timestamp, $ico, $type, $value)
	{
		$file = "phplog.txt";
		file_put_contents($file, "addTransaction", FILE_APPEND | LOCK_EX);
		
		$connectionInfo = array( "UID"=>$this->uid,                            
			"PWD"=>$this->pwd,
			"Database"=>$this->databaseName);
		
		$conn = sqlsrv_connect( $this->serverName, $connectionInfo);		
		
		$sql = "insert into Transactions(TransactionID, Owner, Timestamp, Ico, Type, Value) values(?, ?, ?, ?, ?, ?)";
		
		// Initialize parameters and prepare the statement. 
		$stmt = sqlsrv_prepare( $conn, $sql, array( &$transactionID, &$owner, &$timestamp, &$ico, &$type, &$value));
		
		if( sqlsrv_execute( $stmt ) === false ) {
			file_put_contents($file, "ERROR", FILE_APPEND | LOCK_EX);
			if( ($errors = sqlsrv_errors() ) != null) {
				foreach( $errors as $error ) {
					echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
					file_put_contents($file, $error[ 'SQLSTATE'], FILE_APPEND | LOCK_EX);
					echo "code: ".$error[ 'code']."<br />";
					file_put_contents($file, $error[ 'code'], FILE_APPEND | LOCK_EX);
					echo "message: ".$error[ 'message']."<br />";
					file_put_contents($file, $error[ 'message'], FILE_APPEND | LOCK_EX);
				}
			}
			
			
			die( print_r( sqlsrv_errors(), true));
		}
		
		sqlsrv_free_stmt( $stmt);  
		sqlsrv_close( $conn);  
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