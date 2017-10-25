var ContractManager = function(contracts)
{
	this.contracts = contracts;
	
	function findContract(contractID)
	{
		for(var i=0; i<contracts.length; i++)
		{
			if (contracts[i].getID() == contractID)
			{
				return contracts[i];				
			}			
		}
		return null;
	}
	
	this.getName = function(contractID)
	{
		var contract = findContract(contractID);
		return contract.getName();
	}
	
	this.withdraw = function(contractID, ethAddress, callback)
	{
		var contract = findContract(contractID);
		contract.withdraw(ethAddress, callback);		
	}
	
	this.deposit = function(contractID, value, ethAddress, callback)
	{
		var contract = findContract(contractID);
		contract.sendTransactionFrom(ethAddress, value, callback);
	}
	
	this.buyTokens = function(contractID, ethAddress, callback)
	{
		var contract = findContract(contractID);
		contract.buyTokens(ethAddress, callback);
	}
}