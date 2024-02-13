<?php include '../php/server_accounts.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../css/account-style.css">
	<title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<div class="header">
		<h1>Login</h1>
	</div>
	<form method="post" action="login.php">
		<?php include '../php/server_errors.php'; ?>

		<div class="input-group">
			<label>Email</label>
			<input type="text" name="email" autocomplete="off" required>
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password" required>
		</div>
		<div class="input-group">
			<button type="submit" name="login" class="btn">Login</button>
		</div>
		<p>
			Not a member? <a href="register.php">Sign up</a>
		</p>
		<p>
			Register Later. Go back <a href="../index.php">Home</a>
		</p>
	</form>
</body>
</html>