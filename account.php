<?php
	session_start();
	require_once 'connect.php';

	if (!isset($_SESSION['username'])) {
		header("Location: signup.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Account - Retro Diner</title>
	<meta charset="utf-8">
	<link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div id='main'>
		<div id="header">
			<div>
				<a href="index.html"><img class="logo" src="images/logo.png" width="513" height="84" alt=""
						title=""></a>
				<a href="index.html"><img src="images/waitress.png" width="332" height="205" alt="" title=""></a>
				<ul class="navigation">
					<li>
						<a href="index.html">Home</a>
					</li>
					<li>
						<a href="about.html">About</a>
					</li>
					<li>
						<a href="burger.php">Menu</a>
					</li>
					<li>
						<a href="contact.html">Contact</a>
					</li>
					<li>
						<a href="blog.html">Blog</a>
					</li>
					<li>
						<a class="active" href="account.php">Account</a>
					</li>
				</ul>
			</div>
		</div>

		<div id="content">
            <h2>Добро пожаловать, <?php echo $_SESSION['username']; ?>!</h2>
            
            <!-- Кнопка выхода -->
            <form action="logout.php" method="post">
        		<!-- <button type="submit" id="logoutBtn">Log out</button> -->
				<button type="submit" id="logoutBtn" value="Logout" class="logout_button" name="submit" >
    		</form>
        </div>

		<div id="footer">
			<div>
				<ul>
					<li class="first">
						<h2>Delivery Hotline</h2>
						<h3>Call 0-123-456-789</h3>
						<ul>
							<li>
								<a href="http://www.facebook.com" class="facebook"></a>
							</li>
							<li>
								<a href="http://www.twitter.com" class="twitter"></a>
							</li>
						</ul>
					</li>
					<li>
						<a href="index.html"><img class="logo" src="images/logo-footer.png" alt=""></a>
						<ul class="navigation">
							<li>
								<a href="index.html">Home</a>
							</li>
							<li>
								<a href="about.html">About Us</a>
							</li>
							<li>
								<a href="burger.php">Menu</a>
							</li>
							<li>
								<a href="contact.html">Contact Us</a>
							</li>
						</ul>
						<span>&copy; 2023 RetroDiner.com. All Rights Reserved</span>
					</li>
					<li class="last">
						<h2>Follow Us By Email</h2>
						<form action="index.html">
							<input type="text" name="subscribe" placeholder="Enter Your Email Here...">
							<input type="submit" value="">
						</form>
					</li>
				</ul>
			</div>
		</div>
	</div>
</body>

</html>