<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/index-style.css">
	<title>Home</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<!-- Note -->
<div class="head-note">
	<h4>This website has 5 known vulnerabilities. Exploit them if you can!</h4>
</div>

<!-- Header -->
<div class="header">
	<h1>construct.ro</h1>
	<p>Managing <b>constructions</b> with ease.</p>
</div>

<!-- Navigation Bar -->
<div class="navbar">
	<a href="html/products.php">Products</a>
	<a href="html/about.php">About</a>
	<a href="html/contact.php">Contact</a>
	<a href="html/cart.php" style="padding:12px 20px; font-size:30px;"><i class="fa fa-shopping-cart"></i></a>
	<div class="dropdown">
		<button class="dropbtn"><i class="fa fa-user"></i></button>
		<div class="dropdown-content">
			<?php if(isset($_SESSION['user_email'])) { ?>
				<form action="html/settings.php" method="post" id="settings_page_form">
					<input type="hidden" name="settings_id_customer" value="<?php echo $_SESSION['customer_id']; ?>">
				</form>
				<a href="#" id="to_settings_link"><?php echo "Account settings"; ?></a>
				<a href="html/login.php" id="logged_out_link"><?php echo "Log out"; ?></a>
				<script>
					const logout_link = document.getElementById('logged_out_link');
					logout_link.addEventListener("click", () => {
						<?php $_SESSION['logged_out'] = True; ?>
					});
					const settings_link = document.getElementById('to_settings_link');
					settings_link.addEventListener("click", () => {
						document.getElementById('settings_page_form').submit();
					});
				</script>
			<?php } 
			else { ?>
				<a href="html/login.php"><?php echo "Log in"; ?></a>
				<a href="html/register.php"><?php echo "Register"; ?></a>
			<?php } ?>
		</div>
	</div>
</div>

<div class="prem-prod">
	<div class="about">
		<h1>Welcome!</h1>
		<h4><b>Construct Company</b></h4>
		<p>Construct - importer and distributor of construction materials - is ready to offer you consultancy in the choice of materials and solutions for your construction, with a complete range of products for thermal and phono insulation, waterproofing, facades, roofs and accessories.</p>
		<a href="html/about.php"><button class="btnAbout">More...</button></a>
	</div>
	<div class="premium">
		<h1>Premium Products</h1>
		<?php include 'php/printPremiumProducts.php'; ?>
	</div>
</div>

<div class="novelties">
	<h1>What we provide</h1>
		<div class="carousel-container">
			<button id="prevBtn"><i class="fa fa-angle-double-left"></i></button>
			<button id="nextBtn"><i class="fa fa-angle-double-right"></i></button>
			<div class="carousel-slide">
				<div class="gallery">
					<a target="_blank" href="images/electrician.jfif">
					<img src="images/electrician.jfif" alt="Expert electricians" width="675" height="375">
					<div class="desc">Expert electricians</div>
					</a>
				</div>
				<div class="gallery">
					<a target="_blank" href="images/helmet.jpg">
					<img src="images/helmet.jpg" alt="Safety helmet" width="675" height="375">
					<div class="desc">Construction safety</div>
					</a>
				</div>
				<div class="gallery">
					<a target="_blank" href="images/equipment.jfif">
					<img src="images/equipment.jfif" alt="Equipment" width="675" height="375">
					<div class="desc">Professional equipments</div>
					</a>
				</div>
				<div class="gallery">
					<a target="_blank" href="images/minimization.jpg">
					<img src="images/minimization.jpg" alt="Loss minimization" width="675" height="375">
					<div class="desc">Loss minimization</div>
					</a>
				</div>
				<div class="gallery">
					<a target="_blank" href="images/solarhouse.jpg">
					<img src="images/solarhouse.jpg" alt="Solarhouse" width="675" height="375">
					<div class="desc">Solar solutions</div>
					</a>
				</div>
				<div class="gallery">
					<a target="_blank" href="images/wood.jfif">
					<img src="images/wood.jfif" alt="Wood" width="675" height="375">
					<div class="desc">Wooden constructions</div>
					</a>
				</div>
			</div>
		</div>
	<script src="js/index-javascript.js"></script>
</div>

<div class="advertisement">
	<h1>Construction materials and finishes</h1>
	<h3>The Construct company offers you a wide range of construction materials, waterproofing, sound insulation, thermal insulation as well as materials for finishes and facades.</h3>
</div>

<div class="careers-row">
	<div class="contact">
		<img align="left" src="images/mail.png" alt="Mail">
		<h2>Contact</h2>
		<p>
			Str. Constructiilor nr.456<br>
			Ploiesti, Romania<br>
			+4 0777 123 456
		</p>
		<a href="#">contact@construct.ro</a>
	</div>
	<div class="careers">
		<img src="images/careers.jpg" alt="Careers">
		<h2>Careers</h2>
		<p>Vacant jobs at Construct Company</p>
		<a href="html/careers.php">Details...</a>
	</div>
</div>

<!-- Footer -->
<div class="footer">
	<p>Social networks</p>
	<div class="btnNetworking">
		<button id="facebook"><i class="fa fa-facebook"></i></button>
		<button id="google"><i class="fa fa-google-plus"></i></button>
		<button id="twitter"><i class="fa fa-twitter"></i></button>
		<button id="linkedin"><i class="fa fa-linkedin"></i></button>
	</div>
	<p>Construct S.R.L. Ploiesti ©2024 | <a href="#">Maps Location</a></p>
</div>

</body>
</html>
