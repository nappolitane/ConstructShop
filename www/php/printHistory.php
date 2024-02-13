<?php

	$db = mysqli_connect("db","root","root","ConstructShop");

	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		exit();
	}

	if(isset($_SESSION['user_email'])){
		$email = $_SESSION['user_email'];
	}
	else{
		header('location: ../html/login.php');
		exit();
	}

	$getIdQuery="SELECT ID_customer FROM Customers WHERE Email = '$email'";
			if($result = mysqli_query($db, $getIdQuery)){
				$row = mysqli_fetch_array($result);
				$user_id = $row['ID_customer'];
				mysqli_free_result($result);
			}
	else echo "ERROR: " . mysqli_error($db);

	$myQuery = "SELECT * FROM Orders as O INNER JOIN Cart as C on O.ID_cart=C.ID_cart inner join Products as P on P.ID_product=C.ID_product where C.ID_customer=$user_id";

	if($result = mysqli_query($db, $myQuery)){ ?>
		<div class="administration-table-content">
			<table id="table" border="1">
				<tr>
					<th>Order ID</th>
					<th>Product name</th>
					<th>Order date</th>
					<th>Total due</th>
				</tr>
				<?php
				while($row = mysqli_fetch_array($result))
				{
					?>
					<tr>
						<td><?php echo $row['ID_internal_order']; ?></td>
						<td><?php echo $row['Product_name']; ?></td>
						<td><?php echo $row['Order_date']; ?></td>
						<td><?php echo $row['Total_due']; ?></td>
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