<?php include '../php/server_settings.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/index-style.css">
	<link rel="stylesheet" href="../css/settings-style.css">
	<title>Account Settings</title>
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

<div class="account-settings-row">
	<div class="account-settings-content">
	
		<div class="account-settings-tab">
			<button class="account-settings-tablinks" onclick="openSettings(event,'Personal')" id="defaultOpen"><i class="fa fa-user"></i></button>
			<button class="account-settings-tablinks" onclick="openSettings(event,'Payment')"><i class="fa fa-credit-card"></i></button>
			<button class="account-settings-tablinks" onclick="openSettings(event,'History')"><i class="fa fa-history"></i></button>
		</div>

		<div id="Personal" class="account-settings-tabcontent">
			<div class="tabcontent-personal">
				<h2>Personal data</h2>
				<form id="detForm" name="detailsForm" method="post" onsubmit="return validateDetailsForm()" action="settings.php">
					<?php include '../php/server_errors.php'; ?>

					<div class="personal-input-group">
						<label>Family name</label>
						<input type="text" name="fam_name" value="<?php echo $fam_name; ?>" autocomplete="off" required>
					</div>
					<div class="personal-input-group">
						<label>First name</label>
						<input type="text" name="fst_name" value="<?php echo $fst_name; ?>" autocomplete="off" required>
					</div>
					<div class="personal-input-group">
						<label>Date of birth</label>
						<input type="text" name="date_birth" value="<?php echo $date_birth; ?>" autocomplete="off">
					</div>
					<div class="personal-input-group">
						<label>Email</label>
						<input type="text" name="email" value="<?php echo $email; ?>" readonly>
					</div>
					<div class="personal-input-group">
						<label>New password</label>
						<input type="password" name="new_password" autocomplete="off">
					</div>
					<div class="personal-input-group">
						<label>Current password</label>
						<input type="password" name="curr_password" autocomplete="off" required>
					</div>
					<div class="personal-input-group">
						<input type="hidden" name="settings_id_customer" value="<?php echo $_SESSION['customer_id']; ?>">
						<button type="submit" name="personal-btn" class="update-personal-btn">Update</button>
					</div>
				</form>
			</div>
		</div>

		<div id="Payment" class="account-settings-tabcontent">
			<div class="tabcontent-personal">
				<h2>Payment details</h2>
				<form id="payForm" name="paymentForm" method="post" onsubmit="return validatePaymentForm()" action="settings.php">
					<?php include '../php/server_errors.php'; ?>

					<div class="personal-input-group">
						<label>Card number</label>
						<input type="text" name="card_number" value="<?php echo $card_number; ?>" autocomplete="off">
					</div>
					<div class="personal-input-group">
						<label>Expiring date</label>
						<input type="text" name="exp_date" value="<?php echo $exp_date; ?>" autocomplete="off">
					</div>
					<div class="personal-input-group">
						<label>Country</label>
						<input type="text" name="country" value="<?php echo $country; ?>" autocomplete="off">
					</div>
					<div class="personal-input-group">
						<label>Address</label>
						<input type="text" name="address" value="<?php echo $address; ?>" autocomplete="off">
					</div>
					<div class="personal-input-group">
						<label>Postal code</label>
						<input type="text" name="postal_code" value="<?php echo $postal_code; ?>" autocomplete="off">
					</div>
					<div class="personal-input-group">
						<label>Current password</label>
						<input type="password" name="curr_password" autocomplete="off" required>
					</div>
					<div class="personal-input-group">
						<input type="hidden" name="settings_id_customer" value="<?php echo $_SESSION['customer_id']; ?>">
						<button type="submit" name="payment-btn" class="update-personal-btn">Update</button>
					</div>
				</form>
			</div>
		</div>

		<div id="History" class="account-settings-tabcontent">
			<div class="tabcontent-personal">
				<h2>Order history</h2>
				<?php include '../php/printHistory.php'; ?>
			</div>
		</div>
		
		<script src="../js/settings-javascript.js"></script>
	</div>
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