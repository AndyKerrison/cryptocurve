<html>
<head>
<?php  

include 'models/smartContract.php';
include 'models/database.php';

$db = new CCDatabase();

$contracts = $db->getAllSmartContracts();

?>

<link rel="stylesheet" href="css/main.css" type="text/css">
<link rel="stylesheet" href="css/font-awesome.css" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">
</head>
<body class="page">
<?php include('page-header.php'); ?>
<div class="page-content">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="web3.min.js"></script>
<script runat="server" type"text/javascript">

var SmartContract = function(contractID, contractAddress, contractAbi, allowDeposits) {
	var id = contractID;
	var address = contractAddress;
	var abi = contractAbi;	
	var allowDeposits = allowDeposits;
	
	this.canTakeDeposits = function() {
		if (!allowDeposits) return false;
		if (address == null || address.length == 0) return false;
		if (abi == null || abi.length == 0) return false;
		return true;
	}
		
	this.getID = function() {
		return id;
	}
	
	this.getDepositValue = function(ethAddress, callback) {
		if (address == null || address.length == 0)
		{
			callback(0, id);
			return;
		}
		
		console.log("ABI "+this.abi);
		console.log("address "+ address);
		console.log("ethaddress " + ethAddress);
		var contractInstance = web3.eth.contract(JSON.parse(abi)).at(address);
		contractInstance._etherDeposits(ethAddress, function(error, result)
		{
			if (!error) {
				console.log(result);
				//alert("got some value " + result);
				result = +(result/1000000000000000000).toFixed(4)
				callback(result, id);
			} else {
				console.error(error);
			}
		});
	}
	
	this.withdraw = function(ethAddress) {
		web3.eth.sendTransaction({
			from: ethAddress,
			to: address,
			value: 0
		}, function(error, result){
			if (!error) {
				console.log(result);
				alert("Transaction hash: " + result);			
			} else {
				console.error(error);
			}
		});	
	}
	
	this.sendTransactionFrom = function(ethAddress, value) 	{
		alert("(debug) from: " + ethAddress);
		alert("(debug) to: " + address);
		alert("(debug) value: " + value);
		
		web3.eth.sendTransaction({
			from: ethAddress,
			to: address,
			value: value*1000000000000000000 //must be a unit for this somewhere
		}, function(error, result){
			if (!error) {
				console.log(result);
				alert("Transaction hash: " + result);			
			} else {
				console.error(error);
			}		
		});
	}

}



var contracts= [];
var ethBalance = 0;
var metaMaskAddress;
var contractAddress;

window.addEventListener('load', function() {
	checkWeb3();
});

function checkWeb3()
{
	// Checking if Web3 has been injected by the browser (Mist/MetaMask)
	if (typeof web3 !== 'undefined') {
		// Use Mist/MetaMask's provider
		window.web3 = new Web3(web3.currentProvider);
		checkNetworkVersion();
		//window.web3 = new Web3(new Web3.providers.HttpProvider("http://localhost:8545"));
		//alert("found metamask");
	} else {
		alert("This page requires MetaMask");
		//alert("loading default");    
		// fallback - use your fallback strategy (local node / hosted node + in-dapp id mgmt / fail)
		//window.web3 = new Web3(new Web3.providers.HttpProvider("http://localhost:8545"));
	}
}

function checkNetworkVersion()
{
	web3.version.getNetwork((err, netId) => {
		switch (netId) {
			case "1":
				console.log('This is mainnet')
				loadStuff();
				break
			case "2":
				console.log('This is the deprecated Morden test network.')
				break
			case "3":
				console.log('This is the ropsten test network.')
				break
			default:
				console.log('This is an unknown network.')
		}
	});
}

function loadStuff()
{
	if (web3.eth.accounts.length == 0)
	{
		alert("Please unlock metamask and refresh page to continue");
		return;
	}
	metaMaskAddress = web3.eth.accounts[0];
	$('#ethAddress').html(metaMaskAddress);
		
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
	
	for(var i=0; i<contracts.length; i++)
	{
		//if we don't have a contract address or abi, disable the deposit button and textbox
		if (!contracts[i].canTakeDeposits())
		{
			var tr = $("tr[data-contractID='" + contracts[i].getID() + "']");
			tr.find('.js-txtDeposit').prop("disabled", true);			
			tr.find('.js-btnDeposit').prop("disabled", true);			
			tr.find('.js-btnWithdraw').prop("disabled", true);			
		}
		
		//for each contract, load the amount currently deposited by this user.	
		contracts[i].getDepositValue(metaMaskAddress, function(result, id) { 		
			//if the deposit value was 0, disable the withdraw button
			var tr = $("tr[data-contractID='" + id + "']");
			tr.find('.js-etherDeposited').html(result);
			
			if (result ==0)
			{				
				tr.find('.js-btnWithdraw').prop("disabled", true);			
			}
		});
	}
	
	/*alert(contractAbi);
	alert(contractAddress);
	alert(metaMaskAddress);
	var contractInstance = web3.eth.contract(contractAbi).at(contractAddress);
		contractInstance._etherDeposits(metaMaskAddress, function(error, result)
		{
			if (!error) {
				console.log(result);
				//alert("got some value " + result);
				result = +(result/1000000000000000000).toFixed(4)
				alert("GOT Deposit value " + result);
			} else {
				console.error(error);
			}
		});
	*/
			
	/*
	alert("now setting value");
	
	contractInstance = web3.eth.contract(abi).at(address);
	contractInstance.setSomeValue(100, {value: 0, gas: 30000}, function(error, result){ 
		if (!error) {
			console.log(result);
		} else {
			console.error(error);
		}
	});
	*/
 
	// Now you can start your app & access web3 freely:
	web3.eth.getBalance(metaMaskAddress, function (error, result) {
		if (!error) {
			console.log(result);
			var ether = web3.fromWei(result, 'ether');
			console.log(ether);
			ether = +ether.toFixed(4);
			ethBalance = ether;
			$('#ethBalance').html(ether);			
		} else {
			console.error(error);
		}
	});
}

$( document ).ready(function() {
	bindButtons();    
});

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
			submitDeposit(contractID, value);
		}
	});
	
	$('.js-btnWithdraw').click(function() {
		var contractID = $(this).closest("tr").data("contractid");
		withdraw(contractID);		
	});
}

//DISABLE WHEN CONTRACT ACTIVE!
//Disable when no deposits!
function withdraw(contractID)
{
	for(var i=0; i<contracts.length; i++)
	{
		if (contracts[i].getID() == contractID)
		{
			contracts[i].withdraw(metaMaskAddress);
		}
	}		
}

function submitDeposit(contractID, value)
{
	for(var i=0; i<contracts.length; i++)
	{
		if (contracts[i].getID() == contractID)
		{
			contracts[i].sendTransactionFrom(metaMaskAddress, value);
		}
	}
}

</script>

<div>Ethereum address:</div>
<div id="ethAddress">[someaddress]</div>
<div>Ether balance:</div>
<div id="ethBalance">[somevalue]</div>

<h1>Metamask Blockchain interaction demo</h1>
<p>ICO list (database drivenn)</p>
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
</ul>

<p>Still todo:</p>
<ul>
	<li>clean up javascript code, split into useful modules</li>
	<li>Add user's pending transactions to database and display on this page</li>
	<li>Auto-update at intervals (30s? 1m?)</li>
	<li>Admin page for adding/updatingdeleting ICO's in the database</li>
</ul>
</div>
</body>
</html>