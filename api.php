<?php
include 'models/database.php';
include 'models/Transaction.php';
/**
 * Simple example of web service
 * @author R. Bartolome
 * @version v1.0
 * @return JSON messages with the format:
 * {
 * 	"code": mandatory, string '0' for correct, '1' for error
 * 	"message": empty or string message
 * 	"data": empty or JSON data
 * }
 *
 * This file can be tested from the browser:
 * http://localhost/webservice-php-json/service_test.php
 *
 * Based on
 * http://www.raywenderlich.com/2941/how-to-write-a-simple-phpmysql-web-service-for-an-ios-app
 */
// the API file
// creates a new instance of the api class
//$api = new api();
// message to return
$message = array();
$decoded = json_decode(file_get_contents('php://input'));

$method = $_GET["method"];

switch($method)
{	
	case 'getTransactions':
		$db = new CCDatabase();
		$message = $db->GetTransactions($decoded->owner);
		break;
	case 'setTransactionComplete':
		$transactionID = $decoded->transactionID;
		
		$db = new CCDatabase();
		$db->SetTransactionComplete($transactionID);
		
		$message[] = $transactionID;
		
		break;
	case 'addTransaction':
		$transactionID = $decoded->transactionID;
		$timestamp = $decoded->timestamp;
		$owner = $decoded->owner;
		$ico = $decoded->ico;
		$type = $decoded->type;
		$value = $decoded->value;
		
		$file = "phplog.txt";
		file_put_contents($file, "test2", FILE_APPEND | LOCK_EX);
		
		$db = new CCDatabase();
		$db->AddTransaction($transactionID, $owner, $timestamp, $ico, $type, $value);
		
		$message[] = $transactionID;
		$message[] = $owner;
		$message[] = $timestamp;
		$message[] = $ico;
		$message[] = $type;
		$message[] = $value;
		
		break;
		/*$params = array();
		$params['id'] = isset($_POST["id"]) ? $_POST["id"] : '';
		if (is_array($data = $api->get($params))) {
			$message["code"] = "0";
			$message["data"] = $data;
		} else {
			$message["code"] = "1";
			$message["message"] = "Error on get method";
		}
		break;*/
		//$message[] = "get";
	default:
		$message[] = "unrecognised";
		break;
}
//the JSON message
//header('Content-type: application/json; charset=utf-8');
//echo json_encode('test', JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHED);
echo json_encode($message);
?>