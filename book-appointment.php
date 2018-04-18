<?php include "header.php"; ?>
<link rel='stylesheet' href='fullcalendar/fullcalendar.css' />
<script src='fullcalendar/lib/moment.min.js'></script>
<script src='fullcalendar/fullcalendar.js'></script>
<?php 
	if (!isset($_SESSION)) {
  	session_start();
	}
	if(!array_key_exists(session_id(), $_SESSION) || !array_key_exists('product_id',$_SESSION[session_id()])){
		print 'Page not found';
		return;	
	}
	$id = $_SESSION[session_id()]['product_id'];
	$bedroom = $_SESSION[session_id()]['data']['HowManyRadiatorsAreInYourHome']['optionsSelected'];
	$bathroom = $_SESSION[session_id()]['data']['nine']['optionsSelected'];
	$client = new SoapClient("https://api.247staywarm.co.uk/service1.asmx?WSDL", array('trace' => 1, 'cache_wsdl' => WSDL_CACHE_NONE));
	$params = array(
		'rooms' => (int)$bedroom,
		'brooms' => (int)$bathroom
	);
	$recommeded_boilers = $client->__soapCall("GetBoilersByRadiatorsAndRooms", [$params])->GetBoilersByRadiatorsAndRoomsResult;
	$recommeded_boilers = $recommeded_boilers->HandmadeNewProduct;
?>
<div class="main-container book-appointment">
	<div class="container section-one">
			<div class="heading">
				<h1>Your quote</h1>
				<p>Your Quote is based on what you told us about your boiler.<br><br>The price shown is the Initial Payment with a service contract of £40 per month over 84 months / 7 years (Subject To Site Survey).<br><br><b>Book your free no-obligation survey below.</b></p>
			</div>
			<div class="boiler-info">
				<?php foreach ($recommeded_boilers as $key => $boiler): ?>
					<?php if ($boiler->ID == $id): ?>
						<p>Cost to install <b><?php print $boiler->ProductName; ?></b></p>
						<p class="price">&pound;<?php print $boiler->GuidePrice; ?><span>inc.VAT</span></p>
					<?php endif ?>
				<?php endforeach ?>
			</div>
			<!-- <p>Your quote is based on what you told us about your boiler and some assumptions that we’ve made.</p> -->
	</div>
	<div class="contact-info">
		<div class="container">
			<h4>Need your boiler installed tomorrow?*</h4>
			<p>Call us before 3pm and we’ll arrange an engineer to visit you the next day!</p>
			<p class="num">0345 3192 247</p>
			<p class="terms-text">*Subject to survey and availability</p>
		</div>
	</div>
	<div class="container booking-section">
		<h2>Book your survey appointment</h2>
		<div id='calendar'></div>
		<a href="/order" class="btn book-appointment-btn disabled">Book Survey</a>
	</div>
</div>
<?php include "footer.php"; ?>