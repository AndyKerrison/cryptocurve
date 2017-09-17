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
		if (address == null || address.length == 0 || typeof web3 == 'undefined')
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
	
	this.withdraw = function(ethAddress, callback) {
		web3.eth.sendTransaction({
			from: ethAddress,
			to: address,
			value: 0
		}, function(error, result){
			if (!error) {
				console.log(result);				
				callback(result, id);			
			} else {
				console.error(error);
			}
		});	
	}
	
	this.sendTransactionFrom = function(ethAddress, value, callback) 	{
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
				callback(result, id);				
			} else {
				console.error(error);
			}		
		});
	}
	
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
}
