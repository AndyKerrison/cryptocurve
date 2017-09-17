var Web3Manager = function(failureCallback, successCallback)
{
	var web3Valid = false;
	var ethAddress = "";
	this.failureCallback = failureCallback;
	this.successCallback = successCallback;
	
	this.web3Valid = function()
	{
		return web3Valid;
	}
	
	this.getEthAddress = function()
	{
		return ethAddress;		
	}
	
	this.getBalance = function(callback){	
		web3.eth.getBalance(ethAddress, function (error, result) {
			if (!error) {
				console.log(result);
				var ether = web3.fromWei(result, 'ether');
				console.log(ether);
				ether = +ether.toFixed(4);
				ethBalance = ether;
				callback(ether);			
			} else {
				console.error(error);
			}
		});
	}
	
	this.init = function()
	{
		// Checking if Web3 has been injected by the browser (Mist/MetaMask)
		if (typeof web3 !== 'undefined') {
			// Use Mist/MetaMask's provider
			window.web3 = new Web3(web3.currentProvider);
			checkAccountAndNetworkVersion();
			//window.web3 = new Web3(new Web3.providers.HttpProvider("http://localhost:8545"));
			//alert("found metamask");
		} else {
			failureCallback("This page requires MetaMask");
			//alert("loading default");    
			// fallback - use your fallback strategy (local node / hosted node + in-dapp id mgmt / fail)
			//window.web3 = new Web3(new Web3.providers.HttpProvider("http://localhost:8545"));
		}
	}
	
	function checkAccountAndNetworkVersion()
	{	
		web3.version.getNetwork((err, netId) => {
			switch (netId) {
				case "1":
					if (web3.eth.accounts.length == 0)
					{
						failureCallback("Please unlock metamask and refresh page to continue");
						return;					
					}
					
					web3Valid = true;
					ethAddress = web3.eth.accounts[0];		
					successCallback();
					//console.log('This is mainnet');
					//loadStuff();
					break
				case "2":
					console.log('This is the deprecated Morden test network.');
					failureCallback('please switch to mainnet');
					break
				case "3":
					console.log('This is the ropsten test network.');
					failureCallback('please switch to mainnet');
					break
				default:
					console.log('This is an unknown network.');
					failureCallback('please switch to mainnet');
			}
		});
	}
}