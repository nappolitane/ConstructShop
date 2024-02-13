<?php
	$db = mysqli_connect("db","root","root","ConstructShop");

	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		exit();
	}

	if($result = mysqli_query($db, "SELECT ID_product,Product_name,Image FROM Products WHERE Availability = 'Premium'")){
		for($i=0;$i<4;$i++){ 
			$row = mysqli_fetch_array($result);
			$id = $row['ID_product'];
			$product = $row['Product_name'];
			$imag = $row['Image'];
			$imag = substr($imag, 3);
			?>
			<div class="gallery">
				<a href="html/product.php?id_product=<?php echo $id; ?>">
					<img src="<?php echo $imag; ?>" alt="<?php echo $product; ?>" width="400" height="400">
					<div class="desc"><?php echo $product; ?></div>
				</a>
			</div>
		<?php }
		mysqli_free_result($result); 
	}
	else echo "ERROR: " . mysqli_error($db);

	mysqli_close($db);
?>
