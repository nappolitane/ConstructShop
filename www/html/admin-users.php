<?php include '../php/server_admin_users.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="../css/admin-users-style.css">
	<title>Users</title>
</head>

<body>
<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>

<div class="wrapper">
    <div class="sidebar">
        <h2>Menu</h2>
        <ul>
            <li><a href="admin-home.php"><i class="fas fa-home"></i>Home</a></li>
            <li><a href="admin-users.php"><i class="fas fa-user"></i>Users</a></li>
            <li><a href="#"><i class="fas fa-project-diagram"></i>Products</a></li>
            <li><a href="#"><i class="fas fa-address-book"></i>Contact</a></li>
            <li><a href="login.php" id="logged_out_link"><i class="fas fa-sign-out-alt"></i>Log out</a></li>
			<script>
				const logout_link = document.getElementById('logged_out_link');
				logout_link.addEventListener("click", () => {
					<?php $_SESSION['logged_out'] = True; ?>
				});
			</script>
        </ul> 
    </div>
    <div class="main_content">		
    	<?php include '../php/adminPrintUsers.php'; ?>

		<div class="administration-edit-content">
			<form method="post" action="admin-users.php">
				<div class="administration-input-group">
					<label>Family name</label>
					<input type="text" name="fam_name" id="fam_name" autocomplete="off" required>
				</div>
				<div class="administration-input-group">
					<label>First name</label>
					<input type="text" name="fst_name" id="fst_name" autocomplete="off" required>
				</div>
				<div class="administration-input-group">
					<label>Email</label>
					<input type="text" name="email" id="email" autocomplete="off" required>
				</div>
				<div class="administration-input-group">
					<label>New password</label>
					<input type="password" name="new_password" id="new_password" autocomplete="off">
				</div>
				<input type="text" name="old_email" id="old_email">
					
				<button type="submit" name="administration-add-content" class="administration-send-content-btn">Add</button>
				<button type="submit" name="administration-update-content" class="administration-send-content-btn">Update</button>
				<button type="submit" name="administration-remove-content" class="administration-send-content-btn">Remove</button>

			</form>
		</div>

		<script>
			var table = document.getElementById("table");
			document.getElementById("old_email").style.display = 'none';
			for(var i = 1; i < table.rows.length; i++){
				table.rows[i].onclick = function(){
					document.getElementById("fam_name").value = this.cells[0].innerHTML;
					document.getElementById("fst_name").value = this.cells[1].innerHTML;
					document.getElementById("email").value = this.cells[2].innerHTML;
					document.getElementById("old_email").value = this.cells[2].innerHTML;
				};
			}
		</script>
    </div>
</div>
</body>
</html>
