<?php include '../php/server_accounts.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../css/account-style.css">
	<title>Registration</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<div class="header">
		<h1>Register</h1>
	</div>
	<form id="regForm" name="registerForm" method="post" onsubmit="return validateRegisterForm()" action="register.php">
		<?php include '../php/server_errors.php'; ?>

		<div class="input-group">
			<label>Family Name</label>
			<input type="text" name="fam_name" value="<?php echo $fam_name; ?>" autocomplete="off" required>
		</div>
		<div class="input-group">
			<label>First Name</label>
			<input type="text" name="fst_name" value="<?php echo $fst_name; ?>" autocomplete="off" required>
		</div>
		<div class="input-group">
			<label>Email</label>
			<input type="text" name="email" value="<?php echo $email; ?>" autocomplete="off" required>
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password" required>
		</div>
		<div class="input-group">
			<label>Confirm Password</label>
			<input type="password" name="conf_password" required>
		</div>
		<div class="input-group">
			<button type="submit" name="register" class="btn">Register</button>
		</div>
		<p>
			Already a member? <a href="login.php">Sign in</a>
		</p>
		<p>
			Register Later. Go back <a href="../index.php">Home</a>
		</p>
	</form>
	<script src="../js/accounts-javascript.js"></script>
</body>
</html>