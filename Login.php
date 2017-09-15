<?php include('head.php'); ?>


<body class="page">
<?php include('header.php'); ?>
			<div class="page-content">
			<div class="form-container">
			<div class="Login">
			<h2>Login</h2>
			<form class="login" action="/login_page.php">
				<input type="text" class="user" placeholder="Username" name="username" required>
					<input type="password" class="pass" placeholder="Password" name="password" required>
						<button class="sign" type="submit">Login</button>
						  <a class="forgot" href="http://www.google.com">forgot your password?</a>
							</form>
			</div>
			
			
			<div class="signup">
			<h2>Sign Up</h2>
			<button class="join" type="submit">Click Here To Signup</button>
			</div>
			</div>		
					
  
      
  
  
	</div> 		
<?php include('footer.php'); ?>
</body>
</html>