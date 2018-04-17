<head>
	<title>247 Boiler installation</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
</head>
<body>
	<?php  $current_uri = $_SERVER['REQUEST_URI'];?>
	<header id="nav-header">
		<div class="container">
			<!-- <div class="row"> -->
				<div class="logo">
					<a id="logo" href="/"><img src="img/logo.png"></a>
				</div>
				<div class="menu-icon">
					<i class="fas fa-bars"></i>
				</div>
				<div class="main-nav">
					<ul>
						<li><a class="<?php if(strpos($current_uri, '/')) echo "active"; ?>" href="/">Home</a></li>
						<li><a class="<?php if(strpos($current_uri, 'boiler-installation-quote')) echo "active"; ?>" href="/boiler-installation-quote">Get a quote</a></li>
						<li><a class="<?php if(strpos($current_uri, 'faqs')) echo "active"; ?>" href="/faqs">FAQs</a></li>
						<li><a class="" href="https://www.247homerescue.co.uk/new-contact/"  target="_blank">Contact</a></li>
					</ul>
				</div>
			<!-- </div> -->
			<!-- <div class="row"> -->
				<div class="contact-info"><p>Need help with your new boiler? Call us on <span class="num">0345 3192 247</span></p></div>
			<!-- </div> -->
		</div>
	</header>
<?php 
	// - Check and initialise session
	if (session_status() == PHP_SESSION_NONE) {
    session_start();
	}
	session_id();
?>
<div class="main-container">
	<div class="section-one main-banner">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 main-text">
					<h1>Need a new boiler?</h1>
					<div class="boiler-image">
						<img src="img/main-boiler-image.png" alt="">
					</div>
					<p>Buy a new boiler on-line today by 3pm and get it installed the next day</p>
					<a href="/boiler-installation-quote" class="btn">Get a price in 90 seconds</a>
				</div>
				<!-- <div class="col-md-4 boiler-image">
					<img src="img/main-boiler-image.png" alt="">
				</div> -->
			</div>
		</div>	
	</div>
	<div class="section-two">
		<div class="container">
			<div class="row">
				<h2>Buy your boiler today, installed tomorrow</h2>
				<p class="section-intro-text">We guarantee your hot water and heating for 7 years, with an annual service every year!<br> 
				As an added bonus we will provide our Home Emergency Deluxe Plan for FREE this will include:</p>
				<div class="col-md-6 circle-feature">
						<p><span class="bigger-text">7 Year<br></span> Promise</p>
				</div>
				<div class="col-md-6 features-list">
					<ul>
						<li>External Plumbing &amp; Drainage</li>
						<li>Internal Plumbing &amp; Drainage</li>
						<li>Electrical Emergency &amp; Breakdown</li>
						<li>Home Security</li>
						<li>Pest Control</li>
					</ul>
				</div>	
			</div>	
		</div>
	</div>
	<div class="section-three">
		<div class="container">
			<div class="row">
				<div class="col-md-6 feature-image">
						<img src="img/trusted-provider.png" alt="">
				</div>
				<div class="col-md-6 features">
					<h2>Experienced engineers</h2>
					<p>Our engineers are fully qualified with years of experience to get the job done quickly and efficiently.</p>
					<h2>We’re rated as great</h2>
					<p>Our dedication to customer service means that our customers have rated us as ‘Great’ on trustpilot. Getting your home back up to scratch is our No.1 priority.</p>
				</div>	
			</div>	
		</div>
	</div>
	<div class="section-four">
		<div class="container">
			<h2>Why choose us?</h2>
			<p class="section-intro-text">With over 3000+ gas safe registered engineers nationwide and a great selection of leading boiler brands to choose from, you won’t need to look anywhere else for your new boiler.</p>					
			<ul>
				<li>Discounted Installation Price</li>
				<li>Fixed low monthly payments</li>
				<li>7 Years Heating and Hot Water Promise</li>
				<li>Leading boiler brands to choose from</li>
			</ul>
		</div>
	</div>
	<div class="section-five">
		<div class="container">
			<div class="row">
				<h2>Don’t let your old boiler leave you in the cold</h2>
				<div class="col-md-4">
					<img src="img/trusted-icon.png" alt="">
					<h4>Trusted engineers</h4>
					<p>Choose from leading boiler brands and have the installation carried out by trusted engineers</p>
				</div>	
				<div class="col-md-4">
					<img src="img/one-monthly-fee-icon.png" alt="">
					<h4>One monthly fee</h4>
					<p>7 Years Heating and Hot Water Promise Covers all your needs in 1 plan with no gap in cover</p>
				</div>	
				<div class="col-md-4">
					<img src="img/7-years-warranty-icon.png" alt="">
					<h4>7 Years Heating and Hot Water Promise</h4>
					<p>New boiler installations are guaranteed for 7 years</p>
				</div>
				<a href="/boiler-installation-quote" class="btn">Get a price in 90 seconds</a>	
			</div>	
		</div>
	</div>
</div>
<?php include "footer.php"; ?>