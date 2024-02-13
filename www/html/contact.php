<?php include '../php/server_contact.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/index-style.css">
	<link rel="stylesheet" href="../css/contact-style.css">
	<title>Contact</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

<div class="navbar">
	<a href="../index.php">Home</a>
	<a href="products.php">Products</a>
	<a href="about.php">About</a>
	<a href="cart.php" style="padding:12px 20px; font-size:30px;"><i class="fa fa-shopping-cart"></i></a>
	<div class="dropdown">
		<button class="dropbtn"><i class="fa fa-user"></i></button>
		<div class="dropdown-content">
			<?php if(isset($_SESSION['user_email'])) { ?>
				<form action="settings.php" method="post" id="settings_page_form">
					<input type="hidden" name="settings_id_customer" value="<?php echo $_SESSION['customer_id']; ?>">
				</form>
				<a href="#" id="to_settings_link"><?php echo "Account settings"; ?></a>
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

<div class="contact-content-row">
	<div class="contact-content">
		<h2>Contact</h2>
		<hr>
		<h3>Ploiesti, Prahova</h3>
		<h4>Adress</h4>
		<p>
			Construct S.R.L.<br>
			Str. Constructiilor nr.456<br>
			vis-a-vis Hotel Cartof
		</p>
		<h4>Contact</h4>
		<p>
			<b>Phone:</b> 0777 123 456<br>
			<b>Email:</b> contact@construct.ro
		</p>
		<hr>
		<h3>Craiova, Dolj</h3>
		<h4>Adress</h4>
		<p>
			Construct S.R.L.<br>
			Str. Oltenilor nr.22<br>
			corner with Str. Cutitarilor
		</p>
		<h4>Contact</h4>
		<p>
			<b>Phone:</b> 03 7788 9900<br>
			<b>Email:</b> contact@construct.ro
		</p>
	</div>
	<div class="send-content">
		<h2>Send us a message!</h2>
		<h5>Now you can send us messages automatically using XML! Try the new update!</h5>
		<hr>
		<br>
		<form id="conForm" name="contactForm" method="post" onsubmit="return validateContactForm()" action="contact.php">
			<div class="contact-input-group">
				<label>Family name</label>
				<input type="text" name="fam_name" autocomplete="off">
			</div>
			<div class="contact-input-group">
				<label>First name</label>
				<input type="text" name="fst_name" autocomplete="off">
			</div>
			<div class="contact-input-group">
				<label>Email</label>
				<input type="text" name="email" autocomplete="off" required>
			</div>
			<div class="contact-input-group">
				<label>Subject (max. 100 characters)</label>
				<input type="text" name="subject" autocomplete="off" required>
			</div>
			<div class="contact-input-group">
				<label>Message (max. 1000 characters)</label>
				<textarea type="text" name="message" placeholder="Write here..." autocomplete="off" required></textarea>
			</div>
			<div class="contact-input-group">
				<button type="submit" name="contact-send-content" class="send-content-btn">Submit</button>
			</div>
		</form>
		<script src="../js/contact-javascript.js"></script>
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