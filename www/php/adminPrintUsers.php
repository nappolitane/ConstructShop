<?php

	$db = mysqli_connect("db","root","root","ConstructShop");

	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		exit();
	}

	if(!(isset($_SESSION['user_email']) and $_SESSION['user_email'] == "admin")){
		header('location: ../html/login.php');
		exit();
	}

	$myQuery = "SELECT * FROM Customers";

	if($result = mysqli_query($db, $myQuery)){ ?>
		<div class="administration-table-content">
			<table id="table" border="1">
				<tr>
					<th>Family name</th>
					<th>First name</th>
					<th>Email</th>
					<th>New password</th>
				</tr>
				<?php
				while($row = mysqli_fetch_array($result))
				{
					?>
					<tr>
						<td><?php echo $row['Family_name']; ?></td>
						<td><?php echo $row['First_name']; ?></td>
						<td><?php echo $row['Email']; ?></td>
						<td><?php echo $row['Cust_password']; ?></td>
					</tr>
					<?php
				}
				mysqli_free_result($result);
				?>
			</table>
		</div>
		<?php
	}
	else echo "ERROR: " . mysqli_error($db);

	mysqli_close($db);

?>