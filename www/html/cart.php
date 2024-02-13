<?php include '../php/server_cart.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../css/index-style.css">
	<link rel="stylesheet" type="text/css" href="../css/cart-style.css">
	<title>Cart</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

<div class="navbar">
	<a href="../index.php">Home</a>
	<a href="products.php">Products</a>
	<a href="about.php">About</a>
	<a href="contact.php">Contact</a>
	<a href="cart.php" style="padding:12px 20px; font-size:30px;"><i class="fa fa-shopping-cart"></i></a>
	<div class="dropdown">
		<button class="dropbtn"><i class="fa fa-user"></i></button>
		<div class="dropdown-content">
			<?php if(isset($_SESSION['user_email'])) { ?>
				<form action="settings.php" method="post" id="settings_page_form">
					<input type="hidden" name="settings_id_customer" value="<?php echo $_SESSION['customer_id']; ?>">
				</form>
				<a href="#" id="to_settings_link"><?php echo "Accounts settings"; ?></a>
				<a href="login.php" id="logged_out_link"><?php echo "Log out"; ?></a>
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
				<a href="login.php"><?php echo "Log in"; ?></a>
				<a href="register.php"><?php echo "Register"; ?></a>
			<?php } ?>
		</div>
	</div>
</div>

<div class="cart-content-row">
	<?php include '../php/printProductsCart.php'; ?>
</div>

<div class="careers-row">
	<div class="contact">
		<img align="left" src="../images/mail.png" alt="Mail">
		<h2>Contact</h2>
		<p>
			Str. Constructiilor nr.456<br>
			Ploiesti, Romania<br>
			+4 0777 123 456
		</p>
		<a href="#">contact@construct.ro</a>
	</div>
	<div class="careers">
		<img src="../images/careers.jpg" alt="Careers">
		<h2>Careers</h2>
		<p>Vacant jobs at Construct Company</p>
		<a href="careers.php">Details...</a>
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