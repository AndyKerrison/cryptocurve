<?php include('head.php'); ?>

<body class="invest">
<?php
include('page-header.php'); 

include 'models/smartContract.php';
include 'models/database.php';

$file = "phplog.txt";
file_put_contents($file, "test", FILE_APPEND | LOCK_EX);

$db = new CCDatabase();

$contracts = $db->getAllSmartContracts();

?>
<div class="page-content">


<script runat="server" type"text/javascript">

alert("dev site");

var AjaxHelper = (function()
{
	function ajaxPost(methodName, data, success, error)
	{
		$.ajax({
			type: "POST",
				url: "https://cryptocurve.io/api.php?method="+methodName,
				data: JSON.stringify(data),
				contentType: "application/json; charset=utf-8",
				crossDomain: true,
				dataType: "json",
				success: success,
				error: error
			});
	}
	
	function defaultError(jqXHR, status) {
		// error handler
		console.log(jqXHR);
		alert('fail' + status.code);
	}
	
	return {
		setTransactionComplete : function(transactionID) {
			var data = {};
			data["transactionID"] = transactionID;
			
			function success(data, status, jqXHR) {
				console.log(data);
			}
				
			ajaxPost("setTransactionComplete", data, success, defaultError);
		},
		
		addTransaction : function(data) {
			
			function success(data, status, jqXHR) {
				console.log(data);
			}
				
			ajaxPost("addTransaction", data, success, defaultError);
		},
		
		getTransactions : function(owner, callback)
		{
			var data = {};
			data["owner"] = owner;
			
			function success(data, status, jqXHR) {
				//console.log("GET_TRANSACTIONS_RESULT");
				//console.log(data);
				callback(data);
			}
			
			ajaxPost("getTransactions", data, success, defaultError);
		}
	}
}
)();

	  

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
	$('#ethAddress').html('<a target="_blank" href="https://etherscan.io/address/'+web3Manager.getEthAddress()+'">'+web3Manager.getEthAddress()+'</a>');
	
	web3Manager.getBalance(function(ether) {
		$('#ethBalance').html(ether);
	});
	
	loadContracts();
	loadPendingTransactions();
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
		$name = $contract->getName();
		$address = $contract->getSmartContractAddress();
		$abi = $contract->getAbi();
		$allowDeposits = (bool)$contract->getAllowDeposits();
		echo "contracts.push(new SmartContract('".$id."', '".$name."', '".$address."', '".$abi."', '".$allowDeposits."'));";
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
		else
		{
			//for each contract, load the amount currently deposited by this user.	
			contracts[i].getDepositBalance(web3Manager.getEthAddress(), setDepositDisplayValue);
			contracts[i].getTokenBalance(web3Manager.getEthAddress(), setTokenDisplayValue);
		}		
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


//if the transaction is complete, it will have a blockhash, so don't show it
//and update the database.
function receiveTransactionStatus(transactionID, transaction) {
	return function(error, result) {			
		if(!error)
		{
			console.log(result);
		
			if (result == null || result.blockHash == null) //not included yet, or pending
			{
				drawPendingTransaction(transaction.transactionID, transaction.timestamp, transaction.ico, transaction.type, transaction.value);
			}
			else if (result.blockHash.length > 0)
			{
				//transaction successful, flag in db so it won't show up any more
				AjaxHelper.setTransactionComplete(transactionID);
				return;
			}
		}
		else
		{
			console.log(transactionID);
			console.log(error);
		}
	}
}


function loadPendingTransactions(){
	//load pending transactions via service. 
	AjaxHelper.getTransactions(web3Manager.getEthAddress(), function(data) {
		transactionData = data;
		console.log(data);
		for (var i=0; i<data.length;i++)
		{
			var transactionID = data[i].transactionID.trim();
			console.log("checking status for :" + transactionID);

			web3.eth.getTransaction(transactionID, receiveTransactionStatus(transactionID, data[i]));		
		}
	});
}

//todo - disable withdraw button if BOTH these are zero balance
function setDepositDisplayValue(result, contractID) {
	var tr = $("tr[data-contractID='" + contractID + "']");
	tr.find('.js-etherBalance').html(result);
}

function getDepositDisplayValue(contractID) {
	var tr = $("tr[data-contractID='" + contractID + "']");
	return tr.find('.js-etherBalance').html();
}

function setTokenDisplayValue(result, contractID) {
	var tr = $("tr[data-contractID='" + contractID + "']");
	tr.find('.js-tokenBalance').html(result);
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
			contractManager.deposit(contractID, value, web3Manager.getEthAddress(), depositSuccess);
		}
	});
	
	$('.js-btnWithdraw').click(function() {
		var contractID = $(this).closest("tr").data("contractid");
		contractManager.withdraw(contractID, web3Manager.getEthAddress(), withdrawSuccess);
	});
}

function withdrawSuccess(transactionID, contractID)
{
	var type = "Withdraw";
	var value = getDepositDisplayValue(contractID);
		
	//add it to the table
	drawPendingTransaction(transactionID, new Date(), contractManager.getName(contractID), type, value);	
	
	//add it to the database
	var data = {};
	data["transactionID"] = transactionID;
	data["owner"] = web3Manager.getEthAddress();
	data["timestamp"] = new Date();
	data["ico"] = contractManager.getName(contractID);
	data["type"] = type;
	data["value"] = value;
	
	AjaxHelper.addTransaction(data);
}

function depositSuccess(transactionID, contractID, value)
{
	var type = "Deposit";
	
	//add it to the table
	drawPendingTransaction(transactionID, new Date(), contractManager.getName(contractID), type, value);
	
	//add it to the database
	var data = {};
	data["transactionID"] = transactionID;
	data["owner"] = web3Manager.getEthAddress();
	data["timestamp"] = new Date();
	data["ico"] = contractManager.getName(contractID);
	data["type"] = type;
	data["value"] = value;
	
	AjaxHelper.addTransaction(data);
}

function drawPendingTransaction(transactionID, timestamp, contractName, type, value)
{
	if (timestamp.date != null) //object from db
	{
		timestamp = timestamp.date;
	}
	else //js date object
	{
		timestamp = timestamp.toISOString().replace('T', ' ').substring(0, 19);
	}
		
	var row = $('#pendingTransactions tr:first');
		row.after("<tr><td><a target='_blank' href='https://etherscan.io/tx/"+transactionID+"'>"+transactionID+"</a></td>"+
			"<td>"+timestamp+"</td>"+
			"<td>"+contractName+"</td>"+
			"<td>"+type+"</td>"+
			"<td>"+value+"</td>"+
			+"</tr>");
}

</script>

<div class="table1">
<h2>Metamask</h2>
<table class="meta">
<thead>
	<tr>
<th>Ethereum Address</th>
<th class="space">Balance</th>
    </tr>
	</thead>
	<tbody>
	<tr>
<td id="ethAddress">[someaddress]</td>
<td id="ethBalance">[somevalue]</td>
</tr>
</tbody>
</table>
</div>




<h2>Invest</h2>
<table class="meta">
<thead>
	<tr>
		<th>ICO</th>
		<th>Date</th>
		<th>Smart Contract Address</th>
		<th id="ether">Ether</th>
		<th>Tokens</th>
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
		<td><a target="_blank" href="https://etherscan.io/address/<?php echo $contract->getSmartContractAddress() ?>"><?php echo $contract->getSmartContractAddress() ?></a></td>
		<td class="js-etherBalance"></td>
		<td class="js-tokenBalance"></td>
		<td id="meta-deposit">
			<input type="text" class="js-txtDeposit" value="0.0">
			<button class="js-btnDeposit"><i class="fa fa-arrow-circle-down" aria-hidden="true"></i>Deposit</button>
		</td>
		<td>
			<button class="js-btnWithdraw"><i class="fa fa-arrow-circle-up" aria-hidden="true"></i>Withdraw all</button>
		</td>
	</tr>
<?php
}
?>  
</tbody>
</table>



<div class="table2">
<h2>Pending Transactions</h2>
<table class="meta" id="pendingTransactions">
<thead>
	<tr>
		<th>Transaction</th>
		<th>Time created</th>
		<th>ICO</th>
		<th>Type</th>
		<th class="space">Value</th>
	</tr>
</thead>
</table>
</div>
<!-- todo - put some proper spacing here, or let alex do it -->
<!--<p>&nbsp;</p>

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
</ul>-->
</div>
<!-- Footer -->
				<?php include('footer.php'); ?>
				
				<script src="js/menu.js"></script>
</body>
</html>