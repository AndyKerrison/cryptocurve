<html>
<head>
<link rel="stylesheet" href="css/main.css" type="text/css">
<link rel="stylesheet" href="css/font-awesome.css" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">
</head>
<body class="page">
<?php
include('page-header.php'); 

include 'models/smartContract.php';
include 'models/database.php';

$db = new CCDatabase();

$contracts = $db->getAllSmartContracts();

?>
<div class="page-content">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!--<script src="web3.min.js"></script>-->
<script src="js/SmartContract.js"></script>
<script src="js/Web3Manager.js"></script>
<script src="js/ContractManager.js"></script>
<script runat="server" type"text/javascript">

var web3Manager;
var contractManager;

$( document ).ready(function() {
	bindButtons();    
});

//must run after window load, won't be ready when document.ready fires.
$(window).on('load', function() {
	web3Manager = new Web3Manager(web3fail, web3success);	
	web3Manager.init();
});

//got web3, set the user's address and balance
function web3success()
{
	$('#ethAddress').html(web3Manager.getEthAddress());
	
	web3Manager.getBalance(function(ether) {
		$('#ethBalance').html(ether);
	});
	
	loadContracts();
}

function web3fail(error)
{
	alert(error);
	loadContracts(); //just to disable them really
}

//load the contracts, update page state accordingly
//note - most disabled/enabled stuff could be done server side, except for that which requires loading existing deposits
function loadContracts()
{
	var contracts = [];
	
	//here we dynamically create javascript objects for each of the contracts retrieved from the database.	
	<?php  
	foreach ($contracts as $contract)
	{
		$id = $contract->getID();
		$address = $contract->getSmartContractAddress();
		$abi = $contract->getAbi();
		$allowDeposits = $contract->getAllowDeposits();
		echo "contracts.push(new SmartContract('".$id."', '".$address."', '".$abi."', '".$allowDeposits."'));";
		echo "\r\n";
	}
	?>
	
	contractManager = new ContractManager(contracts);
	
	for(var i=0; i<contracts.length; i++)
	{
		//if we don't have a contract address or abi, disable the deposit button and textbox
		//same if metamask/web3 wasn't loaded
		if (!contracts[i].canTakeDeposits() || !web3Manager.web3Valid())
		{
			setContractDisabled(contracts[i].getID());		
		}
		
		//for each contract, load the amount currently deposited by this user.	
		contracts[i].getDepositValue(web3Manager.getEthAddress(), setDepositDisplayValue);
	}
}


//display-related functions. Designer may tweak these as needed
function setContractDisabled(contractID)
{
	var tr = $("tr[data-contractID='" + contractID + "']");
	tr.find('.js-txtDeposit').prop("disabled", true);			
	tr.find('.js-btnDeposit').prop("disabled", true);			
	tr.find('.js-btnWithdraw').prop("disabled", true);	
}

function setDepositDisplayValue(result, contractID) {
	//if the deposit value was 0, disable the withdraw button
	var tr = $("tr[data-contractID='" + contractID + "']");
	tr.find('.js-etherDeposited').html(result);
			
	if (result ==0)
	{				
		tr.find('.js-btnWithdraw').prop("disabled", true);			
	}
}

function bindButtons() {
	$('.js-btnDeposit').click(function() {
		var value = $(this).parent().find('.js-txtDeposit').val();
		if (isNaN(value)) 
		{
			alert("Numbers only, bitch");
		}
		else if (value > ethBalance)
		{
			alert("insufficient funds");
		}
		else if (value < 0.01)
		{
			alert("Minimum deposit is 0.01");
		}
		else
		{
			var contractID = $(this).closest("tr").data("contractid");
			contractManager.submit(contractID, value, web3Manager.getEthAddress(), depositSuccess);
		}
	});
	
	$('.js-btnWithdraw').click(function() {
		var contractID = $(this).closest("tr").data("contractid");
		contractManager.withdraw(contractID, web3Manager.getEthAddress(), withdrawSuccess);
	});
}

function withdrawSuccess(transactionID, contractID)
{
	alert("Transaction hash: " + transactionID);	
}

function depositSuccess(transactionID, contractID)
{
	alert("Transaction hash: " + transactionID);	
}

</script>

<div>Ethereum address:</div>
<div id="ethAddress">[someaddress]</div>
<div>Ether balance:</div>
<div id="ethBalance">[somevalue]</div>

<h1>Metamask Blockchain interaction demo</h1>
<table class="meta">
<thead>
	<tr>
		<th>ICO</th>
		<th>Date</th>
		<th>Smart Contract Address</th>
		<th>Deposited</th>
		<th>Deposit</th>
		<th>Withdraw</th>
	</tr>
</thead>
<tbody>

<?php  
foreach ($contracts as $contract)
{
	$contractID = $contract->getID();
?>
	<tr data-contractID="<?php echo $contractID ?>">
		<td><?php echo $contract->getName() ?></td>
		<td><?php echo $contract->getStartDate() ?></td>
		<td><?php echo $contract->getSmartContractAddress() ?></td>
		<td class="js-etherDeposited"></td>
		<td>
			<input type="text" class="js-txtDeposit" value="0.0">
			<button class="js-btnDeposit">Deposit</button>
		</td>
		<td>
			<button class="js-btnWithdraw">Withdraw all</button>
		</td>
	</tr>
<?php
}
?>  
</tbody>
</table>
<p>&nbsp;</p>
<p>Stuff done</p>
<ul>
	<li>Read address and balance from Metamask</li>
	<li>Safe errors if metamask not installed, or not unlocked</li>
	<li>Deposit to smart contract plus basic validation (numeric, min/max limits)</li>
	<li>Allow withdraw from smart contract</li>
	<li>get ICO list from database</li>
	<li>Restrict the withdraw/deposit functions based on if ICO is enabled, active, etc</li>
	<li>clean up javascript code, split into useful modules</li>
</ul>

<p>Still todo:</p>
<ul>	
	<li>Update ICOs in database, retest withdraw/deposit functions</li>
	<li>Add user's pending transactions to database and display on this page</li>
	<li>Auto-update at intervals (30s? 1m?)</li>
	<li>Admin page for adding/updatingdeleting ICO's in the database</li>
</ul>
</div>
</body>
</html>