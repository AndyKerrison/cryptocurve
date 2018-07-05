<?php include('head.php'); ?>

<script>
$(window).on('load', function() { 
     $('.loading-icon').fadeOut();
});
</script>



<body class="page">
<div class="alert">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  Whitepaper is now available! Join our whitelist!
</div>

<div id="popup">
<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
<p class="popup-text">We have updated our <a href="https://cryptocurve.network/#cookiePolicy">cookie</a> and <a href="https://cryptocurve.network/#privacyPolicy">privacy policies. </a>We recommend that you review them carefully.</p>
</div>

<div class="loading-icon"></div>					
     

<div class="page-top">
<?php include('header-page.php'); ?>
<canvas id="reactive"></canvas>


<div class="title-container">
<p class="top-wallet">The <span class="curve-word">Curve</span> Wallet</p>
<h1>Next Gen Wallet</h1>
<h1>Next Gen Features</h1>
<br/>
<br/>
<p class="bottom-wallet">The Browser To Blockchain</p>
<p class="bottom-wallet2"></p>
</div>
<div class="phone-container">
<img class="header-mockup" src="/img/header-image-mockup.png"/>
</div>

</div>
			<div class="page-content">
			
			
			
			<!-- Video -->
			  <section id="video" class="index-section">
						<div class="index-section-wrap">
							
								
								<div class="video-container">
								<iframe src="https://player.vimeo.com/video/264779015" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe
								</div>
								
						</div>		
					</section>
			
			  
			  <!-- Phone Reveal -->
			  <section id="phone-reveal" class="index-section">
						<div class="index-section-wrap">
							
								<h2 class="one-header">All-In-One Wallet Solution</h2>
								<div class="phone-reveal-container">
								<div class="phone-login-container"><img class="login-screen" src="/img/new-login.png"/></div>
								<div class="phone-description">
								<div class="phone-icons">
								<img class="crypto-icons" src="/img/exchange.png"/>
								<p>Decentralised Exchange</p>
								</div>
								<div class="phone-icons">
								<img class="crypto-icons" src="/img/nuke-image.png"/>
								<p>Nuke</p>
								</div>
								<div class="phone-icons">
								<img class="crypto-icons" src="/img/investing.png"/>
								<p>ICO Investing</p>
								</div>
								<div class="phone-icons">
								<img class="crypto-icons" src="/img/ico-pooling.png"/>
								<p>ICO Pooling</p>
								</div>
								<div class="phone-icons">
								<img class="crypto-icons" src="/img/ico-airdrops.png"/>
								<p>ICO Staking</p>
								</div>
								<div class="phone-icons">
								<img class="crypto-icons" src="/img/portfolio.png"/>
								<p>Portfolio Tracking</p>
								</div>
								<div class="phone-icons">
								<img class="crypto-icons" src="/img/fiat-image.png"/>
								<p>Fiat Gateway</p>
								</div>
								<div class="phone-icons">
								<img class="crypto-icons" src="/img/wanchain.png"/>
								<p>Fully Interoperable Wallet</p>
								</div>
								</div>
								
								</div>
									
									
							
						</div>
					</section>
					
					
					
					
					
					<!-- Nuke Button -->
			  <section id="nuke-button" class="index-section">
						<div class="index-section-wrap">
							
								<h2>Nuke Button</h2>
								
								<div class="nuke-container">
									<div class="nuke-info">
								     <p class="nuke-header">Nuke Your Portfolio</p>
									 <p>Effortlessly convert all coins into ETH, BTC, or a stable coin</p>
									 <p>Convert back and keep your profits</p>
									 <p>Never miss another BTC bullrun</p>
									 <p>Pick a percentage to convert</p>
									</div>
									
									<div class="nuke-image-container">
									<img src="/img/nuke-section-mockup.png" class="nuke-image"/>
									</div>
								
						</div>
					  </div>	
					</section>
					
					
					<!-- CURV Token -->
			  <section id="curv-token" class="index-section">
			                         <h2>CURV Token</h2>
						<div id="main-token-container" class="index-section-wrap">
							
								
								<div class="token-container">
								<div class="token-box" id="voting-box"><div class="token-box-content"><img src="/img/voting.png"/><h2 class="token">Voting</h2><p>All CURV holders have voting rights for which ICOs Curve should pursue to have listed on our platform.</p></div></div>
								<div class="token-box"><div class="token-box-content"><img src="/img/discounts.png"/><h2 class="token">Fee Discounts</h2><p>Trading fee discounts if paid with CURV.</p></div></div>
								<div class="token-box"><div class="token-box-content"><img src="/img/pooling-tokens.png"/><h2 class="token">Pooling</h2><p>Create and run your own pooling smart contract when you hold enough CURV tokens.</p></div></div>
								<div class="token-box"><div class="token-box-content"><img src="/img/token-burn.png"/><h2 class="token">Burning</h2><p>CryptoCurve buys back a percentage of tokens every quarter and burns them.</p></div></div>
								<div class="token-box"><div class="token-box-content"><img src="/img/staking.png"/><h2 class="token">Staking</h2><p>Lock up your CURV tokens and receive free airdrops from ICOs.</p></div></div>
								</div>
								
                       </div>						
					</section>
					
					
					
					<!-- Roadmap -->
			  <section id="roadmap" class="index-section">
						<div class="index-section-wrap">
							
								<h2>Roadmap</h2>
							
							<ul class="timeline">
									
									<!-- Item 1 -->
										<li>
											<div class="direction-r" id="roadmap1">
											  <div class="flag-wrapper">
												<span class="hexa"></span>
												<span class="flag">Company Founded</span>
												<span class="time-wrapper"><span class="time">Q3 2017</span></span>
											  </div>
											  <div class="desc">CryptoCurve was conceptualized</div>
											</div>
										  </li>
									
									<!-- Item 2 -->
										<li>
											<div class="direction-l" id="roadmap2">
											  <div class="flag-wrapper">
												<span class="hexa"></span>
												<span class="flag">First Product</span>
												<span class="time-wrapper"><span class="time">Q3 2017</span></span>
											  </div>
											  <div class="desc">Uncapped ETH ICO pooling</div>
											</div>
										  </li>

										  <!-- Item 3 -->
										  <li>
											<div class="direction-r" id="roadmap3">
											  <div class="flag-wrapper">
												<span class="hexa"></span>
												<span class="flag">Curve Token Sale</span>
												<span class="time-wrapper"><span class="time">Q2 2018</span></span>
											  </div>
											  <div class="desc">CURV public token sale.</div>
											</div>
										  </li>
										  
										  
										  <!-- Item 4 -->
										  <li>
											<div class="direction-l" id="roadmap4">
											  <div class="flag-wrapper">
												<span class="hexa"></span>
												<span class="flag">Wanchain Wallet Functionality</span>
												<span class="time-wrapper"><span class="time">Q2 2018</span></span>
											  </div>
											  <div class="desc">Basic wallet functionality on Curve main site.</div>
											</div>
										  </li>
										  
										  <!-- Item 5  -->
										  <li>
											<div class="direction-r" id="roadmap5">
											  <div class="flag-wrapper">
												<span class="hexa"></span>
												<span class="flag">Wanchain ICO Pooling</span>
												<span class="time-wrapper"><span class="time">Q3 2018</span></span>
											  </div>
											  <div class="desc">Allow custom pooling for Wanchain ICOs</div>
											</div>
										  </li>
										  
										  <!-- Item 6 -->
										  <li>
											<div class="direction-l" id="roadmap6">
											  <div class="flag-wrapper">
												<span class="hexa"></span>
												<span class="flag">Buy Into ICOs From Curve Wallet</span>
												<span class="time-wrapper"><span class="time">Q3 2018</span></span>
											  </div>
											  <div class="desc">Allow users to participate in ICOs directly from wallet.</div>
											</div>
										  </li>
										  
										  <!-- Item 7 -->
										  <li>
											<div class="direction-r" id="roadmap7">
											  <div class="flag-wrapper">
												<span class="hexa"></span>
												<span class="flag">Wanchain Interoperability</span>
												<span class="time-wrapper"><span class="time">Q4 2018</span></span>
											  </div>
											  <div class="desc">Cross-chain functionality. </div>
											</div>
										  </li>
										  
										  <!-- Item 8 -->
										  <li>
											<div class="direction-l" id="roadmap8">
											  <div class="flag-wrapper">
												<span class="hexa"></span>
												<span class="flag">Ethereum ICO Pooling</span>
												<span class="time-wrapper"><span class="time">Q4 2018</span></span>
											  </div>
											  <div class="desc">Ethereum ICO pooling on Curve</div>
											</div>
										  </li>
										  
										  
										  <!-- Item 9 -->
										  <li>
											<div class="direction-r" id="roadmap9">
											  <div class="flag-wrapper">
												<span class="hexa"></span>
												<span class="flag">Portfolio Tracking</span>
												<span class="time-wrapper"><span class="time">Q4 2018</span></span>
											  </div>
											  <div class="desc">Allow users to track their assets on the Curve platform.</div>
											</div>
										  </li>
										  
										  <!-- Item 10 -->
										  <li>
											<div class="direction-l" id="roadmap10">
											  <div class="flag-wrapper">
												<span class="hexa"></span>
												<span class="flag">Wanchain Decentralised Exchange</span>
												<span class="time-wrapper"><span class="time">Q1 2019</span></span>
											  </div>
											  <div class="desc">Cross-chain trading on the Curve platform</div>
											</div>
										  </li>
										 
										  
										  <!-- Item 11 -->
										  <li>
											<div class="direction-r" id="roadmap11">
											  <div class="flag-wrapper">
												<span class="hexa"></span>
												<span class="flag">Nuke Function</span>
												<span class="time-wrapper"><span class="time">Q1 2019</span></span>
											  </div>
											  <div class="desc">Allow users to liquidate percentages of their portfolio automatically into BTC ETH or a stable coin.</div>
											</div>
										  </li>
										  
										  <!-- Item 12 -->
										  <li>
											<div class="direction-l" id="roadmap12">
											  <div class="flag-wrapper">
												<span class="hexa"></span>
												<span class="flag">Fiat Gateway</span>
												<span class="time-wrapper"><span class="time">Q2 2019</span></span>
											  </div>
											  <div class="desc">Allow users to purchase cryptocurrency directly through mobile application with bank account or credit card.</div>
											</div>
										  </li>
										  
				
										</ul>	
								
						</div>		
					</section>
					
					
					<section id="newsletter">
					
					<h2 id="news">Newsletter</h2>
					
					<div class="newsletter-container">
					<!-- AWeber Web Form Generator 3.0.1 -->

<form method="post" class="af-form-wrapper" accept-charset="UTF-8" action="https://www.aweber.com/scripts/addlead.pl"  >
<div style="display: none;">
<input type="hidden" name="meta_web_form_id" value="1088901446" />
<input type="hidden" name="meta_split_id" value="" />
<input type="hidden" name="listname" value="awlist5055888" />
<input type="hidden" name="redirect" value="https://www.aweber.com/thankyou-coi.htm?m=text" id="redirect_7972981117518af98b82f810c46bd7b8" />

<input type="hidden" name="meta_adtracking" value="My_Web_Form" />
<input type="hidden" name="meta_message" value="1" />
<input type="hidden" name="meta_required" value="email" />

<input type="hidden" name="meta_tooltip" value="" />
</div>
<div id="af-form-1088901446" class="af-form"><div id="af-body-1088901446" class="af-body af-standards">
<div class="af-element">
<div class="af-textWrap"><input class="text" id="awf_field-97615442" placeholder="email" type="text" name="email" value="" tabindex="500" onfocus=" if (this.value == '') { this.value = ''; }" onblur="if (this.value == '') { this.value='';} " />
</div><div class="af-clear"></div>
</div>
<div class="af-element buttonContainer">
<input name="submit" class="submit" type="submit" value="Subscribe" tabindex="501" />
<div class="af-clear"></div>
</div>
</div>
</div>
<div style="display: none;"><img src="https://forms.aweber.com/form/displays.htm?id=jAwcHJwMjCwsbA==" alt="" /></div>
</form>
<script type="text/javascript">
// Special handling for facebook iOS since it cannot open new windows
(function() {
    if (navigator.userAgent.indexOf('FBIOS') !== -1 || navigator.userAgent.indexOf('Twitter for iPhone') !== -1) {
        document.getElementById('af-form-1088901446').parentElement.removeAttribute('target');
    }
})();
</script><script type="text/javascript">
    <!--
    (function() {
        var IE = /*@cc_on!@*/false;
        if (!IE) { return; }
        if (document.compatMode && document.compatMode == 'BackCompat') {
            if (document.getElementById("af-form-1088901446")) {
                document.getElementById("af-form-1088901446").className = 'af-form af-quirksMode';
            }
            if (document.getElementById("af-body-1088901446")) {
                document.getElementById("af-body-1088901446").className = "af-body inline af-quirksMode";
            }
            if (document.getElementById("af-header-1088901446")) {
                document.getElementById("af-header-1088901446").className = "af-header af-quirksMode";
            }
            if (document.getElementById("af-footer-1088901446")) {
                document.getElementById("af-footer-1088901446").className = "af-footer af-quirksMode";
            }
        }
    })();
    -->
</script>

<!-- /AWeber Web Form Generator 3.0.1 -->
			</div>		
					</section>
					
					

							
  
	</div> 		
<?php include('footer-page.php'); ?>

						<!-- Scroll Button -->
						<div class="up-button">
								<a href="#" class="scrollup" display="inline"><i class="fa fa-chevron-up"></i></a>
						</div>						

</body>
<script src="/js/node-effect.js"></script>	
<script src="/js/reveal.js"></script>
</html>