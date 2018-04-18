<!DOCTYPE html>
<html>

<head>
	<title>Get Pay Monthly New Boiler Installation Quote in just 90 Seconds</title>
	<meta name="description" content="New boiler replacement quote just in 90 seconds, click here now and claim 7 years hot water and heating warranty plus FREE annual boiler service with plumbing & drainage, home security and pest control. Fixed monthly cost, No hidden fees and small print!">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-117756222-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'UA-117756222-1');
    </script>

</head>

<body>
    <?php  $current_uri = $_SERVER['REQUEST_URI'];?>
    <header id="nav-header">
        <div class="container">
            <!-- <div class="row"> -->
            <div class="logo">
                <a id="logo" href="/">
                    <img src="img/logo.png">
                </a>
            </div>
            <div class="menu-icon">
                <i class="fas fa-bars"></i>
            </div>
            <div class="main-nav">
                <ul>
                    <li>
                        <a class="<?php if(strpos($current_uri, '/')) echo " active "; ?>" href="/">Home</a>
                    </li>
                    <li>
                        <a class="<?php if(strpos($current_uri, 'boiler-installation-quote')) echo " active "; ?>" href="/boiler-installation-quote">Get a quote</a>
                    </li>
                    <li>
                        <a class="<?php if(strpos($current_uri, 'faqs')) echo " active "; ?>" href="/faqs">FAQs</a>
                    </li>
                    <li>
                        <a class="" href="https://www.247homerescue.co.uk/new-contact/">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- </div> -->
            <!-- <div class="row"> -->
            <!-- <div class="contact-info"><p>Need help with your new boiler? Call us on <span class="num">0345 3192 247</span></p></div> -->
            <!-- </div> -->
        </div>
    </header>
<?php 
	// - Check and initialise session
if (!isset($_SESSION)) {
  session_start();
}
// $_SESSION[session_id()] = array();
// if(!array_key_exists('data', $_SESSION[session_id()])) {
// 	$_SESSION[session_id()]['data'] = array();
// }
?>
<div class="main-container quote-page container">
	<div id="data-one" class="row">
		<div id="ques-one">
			<h3>What type of heating system do you have?</h3>
			<p class="info">Selet the type of boiler you have from the list below.</p>
			<div class="ans-wrapper">
				<a onclick="optSelect('one','gas','two',this);"><img src="img/gas.png"></a>
				<a onclick="serviceNotProvided('Electric');"><img src="img/electric.png"></a>
				<a onclick="serviceNotProvided('LPG');"><img src="img/lpg.png"></a>
				<a onclick="serviceNotProvided('Oil');"><img src="img/oil.png"></a>
			</div>
		</div>	
	</div>
	<?php 
		// if(isset($_SESSION[session_id()]['data'])) {
		// 	foreach ($_SESSION[session_id()]['data'] as $ques_num => $data) {
		// 		// print $data['optionsSelected'];
		// 		print $data['html'];

		// 	}
		// }
	?>
</div>
<?php include "footer.php"; ?>