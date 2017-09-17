var ContractManager = function(contracts)
{
	this.contracts = contracts;
	
	this.withdraw = function(contractID, ethAddress, callback)
	{
		for(var i=0; i<contracts.length; i++)
		{
			if (contracts[i].getID() == contractID)
			{
				contracts[i].withdraw(ethAddress, callback);
			}
		}		
	}
	
	this.deposit = function(contractID, value, ethAddress, callback)
	{
		for(var i=0; i<contracts.length; i++)
		{
			if (contracts[i].getID() == contractID)
			{
				contracts[i].sendTransactionFrom(ethAddress, value, callback);
			}
		}
	}
}