<!DOCTYPE html>
<html>
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
						<li><a class="" href="https://www.247homerescue.co.uk/new-contact/" target="_blank">Contact</a></li>
					</ul>
				</div>
			<!-- </div> -->
			<!-- <div class="row"> -->
				<!-- <div class="contact-info"><p>Need help with your new boiler? Call us on <span class="num">0345 3192 247</span></p></div> -->
			<!-- </div> -->
		</div>
	</header>