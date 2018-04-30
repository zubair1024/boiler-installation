<?php include "header.php"; ?>
<?php 
	if (session_status() == PHP_SESSION_NONE) {
    session_start();
	}
	if(!array_key_exists(session_id(), $_SESSION)){
		return;	
	}
	// print_r($_SESSION[session_id()]);
	$bedroom = $_SESSION[session_id()]['data']['HowManyRadiatorsAreInYourHome']['optionsSelected'];
	$bathroom = '0';
	$client = new SoapClient("https://api.247staywarm.co.uk/service1.asmx?WSDL", array('trace' => 1, 'cache_wsdl' => WSDL_CACHE_NONE));
	$params = array(
		'rooms' => (int)$bedroom,
		'brooms' => (int)$bathroom
	);
	$recommeded_boilers = $client->__soapCall("GetBoilersByRadiatorsAndRooms", [$params])->GetBoilersByRadiatorsAndRoomsResult;
	$recommeded_boilers = $recommeded_boilers->HandmadeNewProduct;
?>
<div class="main-container recommended-boiler">
	<div class="section-one container">
		<h1>Your recommended boilers</h1>
		<?php foreach ($recommeded_boilers as $key => $boiler): ?>
				<div class="row">
					<div class="col-md-6 title-img">	
						<div class="corner">
						</div>
						<span class="corner-text"> &pound; <span class="price"><?php print $boiler->GuidePrice; ?></span><br>
							<span class="sm-text">inc VAT</span><br>
							<span class="lg-text">Fully installed*</span>
						</span>	
						<img src="img/rec-boiler.png" alt="">
						<h4><?php print $boiler->ProductName; ?></h4>
					</div>
					<div class="col-md-6 info">	
						<div class="info-wrapper">
							<p>Output kW <span><?php print isset($boiler->DHWInput) ? $boiler->DHWInput: ""; ?></span></p>
							<p>Flow Rate <span><?php print isset($boiler->Dimension) ? $boiler->Dimension: ""; ?></span></p>
							<p>Efficiency Rating <span><?php print isset($boiler->Weight) ? $boiler->Weight: ""; ?></span></p>
							<p>Service Plan from <span class="finance-from">&pound;40pm</span></p>
						</div>
					</div>
					<div class="btns-wrapper">
						<a onclick="boilerSelected('<?php print $boiler->ID; ?>')" class="btn">Select Boiler</a>
						<?php if(strpos((string)$boiler->ProductName, 'Ideal') !== false): ?>
							<a href="/pdf/Ideal.pdf" class="btn" target="_blank">More info</a>
						<?php endif; ?>
						<?php if(strpos((string)$boiler->ProductName, 'Warmhaus') !== false): ?>
							<a href="/pdf/Warmhaus.pdf" class="btn" target="_blank">More info</a>
						<?php endif; ?>
						<?php if(strpos((string)$boiler->ProductName, 'Worcester') !== false): ?>
							<a href="/pdf/Worcestor.pdf" class="btn" target="_blank">More info</a>
						<?php endif; ?>
					</div>	
					<br>
					<p class="terms-and-conditions">&nbsp;&nbsp;&nbsp;*Subject to terms and conditions</p>
				</div>	
		<?php endforeach; ?>	
	</div>
	<div class="section-two">
		<div class="container">
			<div class="row">
				<h2>Buy your boiler today, installed tomorrow</h2>
				<p class="section-intro-text">We PROMISE to provide you with your hot water and heating for 7 years, with an Annual Boiler Service every year!<br> 
				As an added bonus we will provide our Home Emergency Deluxe Plan, this will include:</p>
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
	<div class="sec-cta-info">
		<div class="container">
			<p>If you need help call now and speak with our Boiler Specialist: </p>
			<p class="num">0345 3192 247</p>
		</div>
	</div>	
</div>

<?php include "footer.php"; ?>