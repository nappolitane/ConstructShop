<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="../css/index-style.css">
	<link rel="stylesheet" href="../css/about-style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>About</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

<div class="navbar">
	<a href="../index.php">Home</a>
	<a href="products.php">Products</a>
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

<div class="trademarks-row">
	<div class="summary-content">
		<h2>Who are we?</h2>
		<hr>
		<img src="../images/about-img.jpg" alt="IMAGE">
		<p><b>CONSTRUCT COMPANY - DEZELPMENT AND VALUES</b></p>
		<p>Construct SRL, founded in 1994 as a company with 100% Romanian capital, tackled the wholesale trade of finishing materials for construction as its main activity. The beginnings of the company were represented by a building and employees confident in the successful future of the activity carried out, which led to a significantly increasing evolution starting with the year 2000.</p>
		<p>Currently, the company has a covered storage space, its own logistics center, as well as a fleet consisting of goods transport vehicles and passenger cars belonging to the sales department, the company benefiting from its own resources for the development of the business.</p>
		<p>The Construct team is made up of dynamic and highly qualified personnel.</p>
	</div>
	<div class="trademarks-content">
		<h2>Registered trademarks</h2>
		<hr>
		<p>These are some of our products registered on the national market:</p>
		<ul>
			<li>StrongFIX - adhesive and reinforcing polystyrene mortar
			<li>StrongPLUS 3-15 - self-leveling cement screed
			<li>StrongFINE - indoor/outdoor tin with manual application
			<li>StronFINE WEISS - white interior/exterior tins
			<li>StrongFILL - plaster-based filler
			<li>StrongGYPS - finishing plaster based on plaster
			<li>BITUBAND - bituminous tape with aluminum foil
			<li>BITUGLAS - bituminous membrane based on fiberglass
			<li>POLIBIT - bituminous membrane based on polyester
			<li>BITUGLAS SHINGLES - bituminous shingles
			<li>IZOBASE - foundation membrane
			<li>POLSAND 500 - bituminous polyester fencing
			<li>IZOBIT 1800 - bituminous cardboard with sand
			<li>BITUZOL - bituminous mastic for waterproofing
			<li>HIDROSTAR - water-based bituminous primer
			<li>BITUSTAR - solvent-based bituminous primer
			<li>StyroSTRONG - expanded/extruded olistyrene for thermal insulation
			<li>PoliCOVER - cellular polycarbonate
			<li>STRONGFOAM - foam / polyurethane adhesive
			<li>STRONGSEALANT - sealants based on silicone or bitumen
		</ul>
	</div>
</div>

<div class="services-row">
	<div class="services-content">
		<h2>Logistic Services</h2>
		<hr>
		<p><b>Logistics</b> represent the management of the flow of goods between the point 
		<img align="right" src="../images/log_1.jfif" alt="IMAGE">
		<img align="right" src="../images/log_2.jfif" alt="IMAGE"> 
		of origin and point of destination, in order to satisfy the requirements of our customers or corporations. It deals throughout production and sales with the organization, regulation, presentation and optimization of the traffic processes of information, financial means, energy, goods and personnel. This process ensures within Construct a coherent and uninterrupted flow of products and services from suppliers to end customers. Our logistics department deals with operations and resources in the fields of: - supply; - purchases; - inventories; - warehouses; - Transport; - client service; And so on We invite you to access Construct logistics services.</p>
	</div>
</div>

<div class="partners-row">
	<div class="partners-content">
		<h2>Business partners</h2>
		<hr>
		<p><b>Goods suppliers:</b></p>
		<ul>
			<li>Construct, based on the field of activity, allocates its own and continuous resources for the development of the portfolio of goods suppliers, taking into account the needs of customers and the price requirements of the market
			<li>During the more than 15 years of activity, Construct has made available to applicants a wide range of goods, from stock products to special orders, from medium to premium products, from individual products to complete systems. At the same time, the main trend was the import of these categories of goods directly from renowned producers, from countries such as Poland, Italy, the Czech Republic, Slovakia, Turkey, Hungary, Russia, Greece, etc.
		</ul>
		<p><b>Services suppliers:</b></p>
		<ul>
			<li>The external support of the Construct activity is provided by service providers dedicated to the partnership we have.
		</ul>
		<p><b>Goods customers:</b></p>
		<ul>
			<li>The main promoters of the products distributed by Construct are represented by the customers and users of these goods. Through its category, retailer, hypermarket network, builder and even final consumer, each customer has a contribution to Construct's activity. This contribution is rewarded by favorable sales and delivery conditions, discussed and established individually.
		</ul>
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