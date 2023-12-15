<?php
require_once 'connect.php';
?>
<!DOCTYPE html>

<head>
	<title>Breakfast Menu - Retro Diner</title>
	<meta charset="utf-8">
	<link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div id="main">
		<div id="header">
		<div>
			<a href="index.html"><img class="logo" src="images/logo.png" width="513" height="84" alt="" title=""></a>
			<a href="index.html"><img src="images/waitress.png" width="332" height="205" alt="" title=""></a>
			<ul class="navigation">
				<li>
					<a href="index.html">Home</a>
				</li>
				<li>
					<a href="about.html">About</a>
				</li>
				<li>
					<a class="active" href="breakfast.php">Menu</a>
				</li>
				<li>
					<a href="contact.html">Contact</a>
				</li>
				<li>
					<a href="blog.html">Blog</a>
				</li>
				<li>
					<a href="account.php">Account</a>
				</li>
			</ul>
		</div>
	</div>
	<div id="body">
		<div class="content">
			<div>
				<div>
					<h1>Breakfast</h1>
					<div> <a href="breakfast.php"><img src="images/breakfast2.jpg" width="484" height="271" alt=""></a>
					</div>
					<ul>
					<?php
						$breakfasts = mysqli_query($connect_menu, "SELECT * FROM `breakfasts`");
						$breakfasts = mysqli_fetch_all($breakfasts, MYSQLI_ASSOC);
						$last_index = count($breakfasts) - 1;

						foreach ($breakfasts as $index => $breakfast) {
							$class = $index === $last_index ? 'last' : '';
							?>
							<li class="<?php echo $class; ?>">
								<h2><a href="breakfast.php">
										<?php echo $breakfast['name']; ?>
									</a></h2>
								<p>
									<?php echo $breakfast['description']; ?>
								</p>
								<span class="price">
									<?php echo '₴' . $breakfast['price']; ?>
								</span>
							</li>
							<?php
						}
						?>
					</ul>
				</div>
			</div>
		</div>
		<div class="sidebar">
			<h1>Menu</h1>
			<ul class="navigation">
				<li class="first">
					<a href="burger.php">BURGERS</a>
				</li>
				<li>
					<a href="hotdog.php">HOTDOGS</a>
				</li>
				<li>
					<a href="shake.php">SHAKES</a>
				</li>
				<li>
					<a class="active" href="breakfast.php">BREAKFAST</a>
				</li>
			</ul>
			<a href="breakfast.php" class="download">&nbsp;</a>
		</div>
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