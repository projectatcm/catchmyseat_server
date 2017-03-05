<?php include 'template/header.php' ?>
<body class="sign-in-up">
    <section>
			<div id="page-wrapper" class="sign-in-wrapper">
				<div class="graphs">
					<div class="sign-in-form">
						<div class="sign-in-form-top">
							<img src="assets/images/logo.png" height="80" style="margin-left: -30px;">
						</div>
						<div class="signin">
							
							<form action="actions.php" method="post">
							<input type="hidden" name="action" value="login_check">
							<div class="log-input">
								<div class="log-input-left">
								   <input type="text" name="username" class="user" placeholder="Username" required />
								</div>
								
							</div>
							<div class="log-input">
								<div class="log-input-left">
								   <input type="password" name="password" class="lock" placeholder="password" required />
								</div>
							</div>
							<div class="log-input">
								<input type="submit" value="Login" class="pull-right">
							</div>
							<div class="clearfix"></div>
						</form>	 
						</div>
						
					</div>
				</div>
			</div>
		<!--footer section start-->
			<footer>
			   <p>&copy 2015 Easy Admin Panel. All Rights Reserved | Design by <a href="https://w3layouts.com/" target="_blank">w3layouts.</a></p>
			</footer>
        <!--footer section end-->
	</section>
	
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.min.js"></script>
</body>
</html>