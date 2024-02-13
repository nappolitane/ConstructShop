<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="../css/index-style.css">
	<link rel="stylesheet" href="../css/products-style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>Products</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

<div class="navbar">
	<a href="../index.php">Home</a>
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
			<?php  } 
			else { ?>
				<a href="login.php"><?php echo "Log in"; ?></a>
				<a href="register.php"><?php echo "Register"; ?></a>
			<?php } ?>
		</div>
	</div>
</div>

<div class="products-search-row">
	<div class="products-search">
		<h2>Our products</h2>
		<hr>
		<h4>Search for products:</h4>
		<div class="product-searchbar">
			<form method="post" action="products.php">
				<input type="text" placeholder="Search..." value="<?php if(isset($_POST['searchItem']))echo $_POST['searchItem']; ?>" name="searchItem">
				<button type="submit" name="search"><i class="fa fa-search"></i></button>
			</form>
		</div>
		<hr><br>
		<h4>Sort:</h4> 
		<select id="sort-select" onchange="changeFunc();">
			<option value="alphabetic">Alphabetic</option>
			<option value="revAlphabetically">Reverse alphabetically</option>
			<option value="incPrice">Increasing price</option>
			<option value="decPrice">Descreasing price</option>
		</select>
	</div>
</div>

<div class="products-content-row">
	<div class="products-filter">
		<form id="prod-filter" method="post" action="products.php">
			<div class="products-filter-content">
				<h4>Category</h4>
				<input type="checkbox" id="waterproofing" name="waterproofing" <?=(isset($_POST['waterproofing'])?' checked':'')?>>
				<label for="waterproofing"> Waterproofing</label><br>
				<input type="checkbox" id="thermal_insulation" name="thermal_insulation" <?=(isset($_POST['thermal_insulation'])?' checked':'')?>>
				<label for="thermal_insulation"> Thermal and phono insulation</label><br>
				<input type="checkbox" id="facades_finishes" name="facades_finishes" <?=(isset($_POST['facades_finishes'])?' checked':'')?>>
				<label for="facades_finishes"> Facades and finishes</label><br>
				<input type="checkbox" id="roofs" name="roofs" <?=(isset($_POST['roofs'])?' checked':'')?>>
				<label for="roofs"> Roofs</label><br>
			</div>
			<div class="products-filter-content">
				<h4>Availability</h4>
				<input type="checkbox" id="ordinary" name="ordinary" <?=(isset($_POST['ordinary'])?' checked':'')?>>
				<label for="ordinary"> Ordinary</label><br>
				<input type="checkbox" id="premium" name="premium" <?=(isset($_POST['premium'])?' checked':'')?>>
				<label for="premium"> Premium</label><br>
				<input type="checkbox" id="new" name="new" <?=(isset($_POST['new'])?' checked':'')?>>
				<label for="new"> New</label><br>
			</div>
			<div class="products-filter-content">
				<h4>Price</h4>
				<p>Price range</p>
				<input type="number" id="min_price" value="<?php if(isset($_POST['min_price']))echo $_POST['min_price']; ?>" name="min_price">
				 - 
				<input type="number" id="max_price" value="<?php if(isset($_POST['max_price']))echo $_POST['max_price']; ?>" name="max_price">
				<input type="submit" id="price-submit" name="price-submit" value=">">
			</div>
		</form>
	</div>
	<div class="products-content">
		<?php include '../php/printProductsPage.php'; ?>
	</div>
</div>

<script src="../js/products-javascript.js"></script>

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