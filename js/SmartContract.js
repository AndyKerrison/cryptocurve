var SmartContract = function(contractID, contractName, contractAddress, contractAbi, allowDeposits) {
	var id = contractID;
	var name = contractName;
	var address = contractAddress;
	var abi = contractAbi;	
	var allowDeposits = allowDeposits;
		
	var tokenAbi = `[
  {
    "constant": true,
    "inputs": [],
    "name": "decimals",
    "outputs": [
      {
        "name": "",
        "type": "uint8"
      }
    ],
    "payable": false,
    "type": "function"
  }
]`;

	var decimals= -1;
	var tokenBalance = -1;
	
	function balanceReturn(callback)
	{
		if (decimals > -1 && tokenBalance > -1)
		{	
			tokenBalance = +(tokenBalance/Math.pow(10, decimals)).toFixed(4);
			callback(tokenBalance, id);
		}
	}
	
	this.canTakeDeposits = function() {
		if (!allowDeposits) return false;
		if (address == null || address.length == 0) return false;
		if (abi == null || abi.length == 0) return false;
		return true;
	}
		
	this.getID = function() {
		return id;
	}
	
	this.getName = function() {
		return name;
	}
	
	this.getDepositBalance = function(ethAddress, callback) {
		if (address == null || address.length == 0 || typeof web3 == 'undefined')
		{
			callback(0, id);
			return;
		}
		
		var contractInstance = web3.eth.contract(JSON.parse(abi)).at(address);
		contractInstance._etherDeposits(ethAddress, function(error, result)
		{
			if (!error) {
				//wei to ether conversion
				result = +(result/1000000000000000000).toFixed(4);
				callback(result, id);
			} else {
				console.error(error);
			}
		});
	}
	
	
	this.getTokenBalance = function(ethAddress, callback) {
		if (address == null || address.length == 0 || typeof web3 == 'undefined')
		{
			callback(0, id);
			return;
		}
		
		//set the token balance
		var contractInstance = web3.eth.contract(JSON.parse(abi)).at(address);
		contractInstance.getUserTokenBalance(ethAddress, function(error, result)
		{
			if (!error) {
				tokenBalance = result;
				balanceReturn(callback);				
			} else {
				console.error(error);
			}
		});

		//get the token address from the smart contract, then get the number of decimals that erc20 uses
		var contractInstance = web3.eth.contract(JSON.parse(abi)).at(address);
		contractInstance._token(function(error, result)
		{
			if (!error) {	
				
				var tokenInstance = web3.eth.contract(JSON.parse(tokenAbi)).at(result);
				tokenInstance.decimals(function(error, result)
				{
					if (!error) {
						decimals = result;
						balanceReturn(callback);
					}
					else{
						console.error(error);
					}
				});
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
				callback(result, id);			
			} else {
				console.error(error);
			}
		});	
	}
	
	this.sendTransactionFrom = function(ethAddress, value, callback) 	{
		//alert("(debug) returning fake transaction ID for testing");
		//callback("0x123456789", id, value);
		//return;
		
		//alert("(debug) from: " + ethAddress);
		//alert("(debug) to: " + address);
		//alert("(debug) value: " + value);
		
		web3.eth.sendTransaction({
			from: ethAddress,
			to: address,
			value: value*1000000000000000000 //must be a unit for this somewhere
		}, function(error, result){
			if (!error) {
				callback(result, id, value);				
			} else {
				console.error(error);
			}		
		});
	}
	
	this.buyTokens = function(ethAddress, callback) {
	
		var contractInstance = web3.eth.contract(JSON.parse(abi)).at(address);
		
		contractInstance.buyTokens({value: 0, gas: 250000}, function(error, result){ 
			if (!error) {
				callback(result, id);				
			} else {
				console.error(error);
			}
		});
	}
}
