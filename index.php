<?php include('head.php'); ?>

<script>
$(window).load(function(){
     $('.loading-icon').fadeOut();
});
</script>

<body class="page">

<div class="loading-icon"></div>					
        
<div class="page-top">
<?php include('header-page.php'); ?>
<canvas id="reactive"></canvas>


<div class="title-container">
<h1>Next Gen Wallet</h1>
</div>
<div class="phone-container">
</div>

</div>
			<div class="page-content">
			
			
			
			
			
			  
			  <!-- Phone Reveal -->
			  <section id="phone-reveal" class="index-section">
						<div class="index-section-wrap">
							
								<h2 class="one-header">All In One Wallet Solution</h2>
								<div class="phone-reveal-container">
								<div class="phone-shells">
								<div class="phone-layer1"><img class="first" src="/img/shell-layer.png"/></div>
								<div class="phone-layer2"><img class="first" src="/img/phone-shell.png"/></div>
								</div>
								<div class="phone-description">
								<div class="phone-icons">
								<img class="crypto-icons" src="/img/purchase.png"/>
								<p>Buy Cryptocurrency</p>
								</div>
								<div class="phone-icons">
								<img class="crypto-icons" src="/img/portfolio.png"/>
								<p>Manage Your Portfolio</p>
								</div>
								<div class="phone-icons">
								<img class="crypto-icons" src="/img/icos.png"/>
								<p>Invest In ICOs</p>
								</div>
								<div class="phone-icons">
								<img class="crypto-icons" src="/img/sync.png"/>
								<p>Sync Wallet Contacts</p>
								</div>
								<div class="phone-icons">
								<img class="crypto-icons" src="/img/swap.png"/>
								<p>Swap Currencies</p>
								</div>
								<div class="phone-icons">
								<img class="crypto-icons" src="/img/mushroom.png"/>
								<p>Liquidate Entire Portfolio To ETH "Nuke"</p>
								</div>
								</div>
								
								</div>
									
									
							
						</div>
					</section>
					
					
					<!-- Nuke Button -->
			  <section id="nuke-button" class="index-section">
						<div class="index-section-wrap">
							
								<h2>Nuke Button</h2>
								
						</div>		
					</section>
					
					
					<!-- Fiat Gateway -->
			  <section id="fiat-gateway" class="index-section">
						<div class="index-section-wrap">
							
								<h2>Fiat Gateway</h2>
								<div class="fiat-container">
									<div class="fiat-info">
								     <p class="fiat-header">Mobile Gateway</p>
									 <p>Buy cryptocurrencies with your credit card or bank account from the curve wallet</p>
									</div>
									
									<div class="fiat-image-container">
									<img src="/img/fiat-gateway.jpg" class="fiat-image"/>
									</div>
								
								
								
								</div>
								
								
								
								
						</div>		
					</section>
					
					
					
					<!-- Telegram -->
			  <section id="telegram" class="index-section">
						<div class="index-section-wrap">
							
								
								<div class="telegram-container">
								<img class="telegram-img" src="/img/telegram.png"/ width="100px">
								<div class="telegram-child-container">
								<p class="telegram-text">Join our official telegram group!</p>
								<a href="https://t.me/cryptocurve" class="telegram-button">Join Us</a>
								</div>
									
									</div>
								
								
								
								</div>
								
								
								
								
						</div>		
					</section>
					
					
					
					
					
					<!-- Token Statistics -->
			  <section id="token-stats" class="index-section">
						<div class="index-section-wrap">
							
								<h2>Token Distribution</h2>
								
								<div id="doughnutChart" class="chart"></div>
								
								
								
						</div>		
					</section>
					
					<!-- Roadmap -->
			  <section id="roadmap" class="index-section">
						<div class="index-section-wrap">
							
							<img class="roadmap-img" src="/img/roadmap.jpg"/>	
								
						</div>		
					</section>
					
					
					
					<!-- Team -->
			  <section id="team" class="index-section">
						<div class="index-section-wrap">
					
								<h2>Our Team</h2>
								<div class="team-container">
								<ul class="team-list">
								<li>
								<div id="pic1" class="team-pic">
								<div class="pic-info">
								<h2>Joshua Halferty</h2>
								<p class="team-title">Chief Executive Officer</p>
								</div>
								</div>
								</li>
								<li>
								<div id="pic2" class="team-pic">
								<div class="pic-info">
								<h2>Xander Yi</h2>
								<p class="team-title">Chief Financial Officer</p>
								</div>
								</div>
								</li>
								<li>
								<div id="pic3" class="team-pic">
								<div class="pic-info">
								<h2>Andrew Kerrison</h2>
								<p class="team-title">Chief Blockchain Engineer</p>
								</div>
								</div>
								</li>
								<li>
								<div id="pic4" class="team-pic">
								<div class="pic-info">
								<h2>Alex Lenart</h2>
								<p class="team-title">Chief Marketing Officer</p>
								</div>
								</div>
								</li>
								<li>
								<div id="pic5" class="team-pic">
								<div class="pic-info">
								<h2>Paul Landingin</h2>
								<p class="team-title">Sales Director</p>
								</div>
								</div>
								</li>
								</ul>
								</div>
									
									
							
						</div>
					</section>
					

							
  
	</div> 		
<?php include('footer-page.php'); ?>

						<!-- Scroll Button -->
						<div class="up-button">
								<a href="#" class="scrollup" display="inline"><i class="fa fa-chevron-up"></i></a>
						</div>
<script src="/js/dougnut.js"></script>
<script src="/js/tween.min.js"></script>
<script src="/js/ease.min.js"></script>						
<script src="/js/node-effect.js"></script>	
<script src="/js/reveal.js"></script>
<script src="/js/scrollup.js"></script>					
<script src="/js/appear.js"></script>
<script src="/js/menu.js"></script>

</body>
</html>