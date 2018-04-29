<?php include "header.php"; ?>
<?php 
	if (!isset($_SESSION)) {
  	session_start();
	}
	if(!array_key_exists(session_id(), $_SESSION) || !array_key_exists('product_id',$_SESSION[session_id()])){
		print 'Page not found';
		return;	
	}

	// - Get selected boiler
	$product_id = $_SESSION[session_id()]['product_id'];
	$bedroom = $_SESSION[session_id()]['data']['HowManyRadiatorsAreInYourHome']['optionsSelected'];
	$bathroom = '0';
	$client = new SoapClient("https://api.247staywarm.co.uk/service1.asmx?WSDL", array('trace' => 1, 'cache_wsdl' => WSDL_CACHE_NONE));
	$params = array(
		'rooms' => (int)$bedroom,
		'brooms' => (int)$bathroom
	);
	$recommeded_boilers = $client->__soapCall("GetBoilersByRadiatorsAndRooms", [$params])->GetBoilersByRadiatorsAndRoomsResult;
	$recommeded_boilers = $recommeded_boilers->HandmadeNewProduct;
	foreach ($recommeded_boilers as $key => $boiler) {
		if ($boiler->ID == $product_id) {
			$selected_boiler = $boiler;
		}
	}
	// - Get booking date and time
	// $booking_date = strtotime($_SESSION[session_id()]['data']['slot']);
	// $booking_date_and_time = date('l jS F',$booking_date).' at '.date('ga', $booking_date);

	// - Quote data
	$quote_data = array();
	foreach ($_SESSION[session_id()]['data'] as $ques_num => $value) {
		if(isset($value['optionsSelected'])) {
			// print $ques_num.' '.$value['optionsSelected'].'<br>';
			$quote_data[$ques_num] = $value['optionsSelected'];
		}
	}
	$sale_info = [
		'twofoursevenref' => 1,
		'teamid' => 1,
		'fname' => $_POST['first-name'],
		'sname' => $_POST['surname'],
		'tel' => $_POST['phone-number'],
		'mob' => 'NA',
		'altnumber' => 'NA',
		'address' => $_POST['address-line-one'],
		'addressTwo' => $_POST['address-line-two'],
		'addressThree' => $_POST['address-line-three'],
		'postcode' => isset($quote_data['postcode']) ? $quote_data['postcode'] : 'NA',
		'email' => $_POST['email'],
		'whatheating' => isset($quote_data['one']) ? $quote_data['one'] : 'NA',
		'DoYouHaveAHotWaterCylinder' => isset($quote_data['two']) ? $quote_data['two'] : 'NA',
		'WouldYouLikeItRemoved' => isset($quote_data['two-sub']) ? $quote_data['two-sub'] : 'NA',
		'DoYouHaveSeperateColdWaterTank' => isset($quote_data['four']) ? $quote_data['four'] : 'NA',
		'HowQuicklyDoesColdWaterRunFromKitchen' => isset($quote_data['seven-sub-two']) ? $quote_data['seven-sub-two'] : 'NA',
		'WhatTimeOfHomeDoYouLive' => isset($quote_data['six']) ? $quote_data['six'] : 'NA',
		'IsYourFlatOn2ndFloor' => isset($quote_data['six-sub']) ? $quote_data['six-sub'] : 'NA',
		'WhereIsBoilerLocated' => isset($quote_data['seven']) ? $quote_data['seven'] : 'NA',
		'DoYouWantBoilerMoved' => isset($quote_data['DoYouWantBoilerMoved']) ? $quote_data['DoYouWantBoilerMoved'] : 'NA',
		'WhereWouldYouLikeYourNewBoiler' => isset($quote_data['seven-sub-two-extra']) ? $quote_data['seven-sub-two-extra'] : 'NA',
		'HowManyRadiatorsAreInYourHome' => isset($quote_data['HowManyRadiatorsAreInYourHome']) ? $quote_data['HowManyRadiatorsAreInYourHome'] : 'NA',
		'HowManyBathtubsAreInYourHome' => isset($quote_data['nine']) ? $quote_data['nine'] : 'NA',
		'HowManyStandaloneMixersShowers' => isset($quote_data['ten']) ? $quote_data['ten'] : 'NA',
		'DoYouHaveSeperateThermostatFromBoiler' => isset($quote_data['eleven']) ? $quote_data['eleven'] : 'NA',
		'DoYouHaveThermostatRadiator' => isset($quote_data['twelve']) ? $quote_data['twelve'] : 'NA',
		'WhereIsTheLocationOfFLue' => isset($quote_data['WhereIsTheLocationOfFLue']) ? $quote_data['WhereIsTheLocationOfFLue'] : 'NA',
		'RoofType' => isset($quote_data['thirteen-roof']) ? $quote_data['thirteen-roof'] : 'NA',
		'WallCovering' => isset($quote_data['twelve-wall-two']) ? $quote_data['twelve-wall-two'] : 'NA',
		'WhatShapeIsFlueOutside' => isset($quote_data['fourteen']) ? $quote_data['fourteen'] : 'NA',
		'IsFlueMoreThan2MetersFromFloor' => isset($quote_data['twelve-wall-three']) ? $quote_data['twelve-wall-three'] : 'NA',
		'IsFlueMoreThan2MetersFromNeighbour' => isset($quote_data['twelve-wall-four']) ? $quote_data['twelve-wall-four'] : 'NA',
		'IsFlueMoreThan30CmFromWindow' => isset($quote_data['thirteen-wall']) ? $quote_data['thirteen-wall'] : 'NA',
		'HowOldBoiler' => isset($quote_data['fifteen']) ? $quote_data['fifteen'] : 'NA',
		'Make' => isset($quote_data['seventeen']) ? $quote_data['seventeen'] : 'NA',
		'Model' => isset($quote_data['eighteen']) ? $quote_data['eighteen'] : 'NA',
		'SelectedBoiler' => $product_id,
		// 'BookingDate' => date('d/M/Y',$booking_date),
		// 'BookingSlot' => date('h A', $booking_date)
	];
?>
<?php 
	// print_r($_POST);
?>
<?php 
	$client = new SoapClient("https://api.247staywarm.co.uk/service1.asmx?WSDL", array('trace' => 1, 'cache_wsdl' => WSDL_CACHE_NONE));
	$create_sale = $client->__soapCall("CreateSalesFromService", [$sale_info]);
	// print_r($create_sale);
?>
<div class="main-container confirmation">
	<div class="section-one confirmation-main-banner">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 main-text">
					<h1>Thank you for booking with us!</h1>
					<p>Our engineer will visit you on your chosen day and you will soon have a brand new boiler covered and guaranteed for 7 years!</p>
					<h4><?php print $selected_boiler->ProductName; ?></h4>
					<p><b>We will contact you shorty to book a survey date.</p>
				</div>
			</div>
		</div>	
	</div>
<!-- 	<div class="section-two">
		<div class="container">
			<div class="row booking-info">
				<div class="col-lg-6 title-img">	
					<div class="corner">
					</div>
					<span class="corner-text"> &pound; <span class="price"><?php print $selected_boiler->GuidePrice; ?></span><br>
						<span class="sm-text">inc VAT</span><br>
						<span class="lg-text">Fully installed</span>
					</span>	
					<img src="img/rec-boiler.jpg" alt="">
				</div>
				<div class="col-lg-6 name-and-date">
					<h4><?php print $selected_boiler->ProductName; ?></h4>
					<h5>Your survey date</h5>
					<p><?php print $booking_date_and_time; ?></p>
				</div>
			</div>		
		</div>
	</div> -->
</div>
<!-- Google Code for Stay Warm Boiler Install Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 964144293;
var google_conversion_label = "m0WnCM-NiIEBEKXZ3ssD";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/964144293/?label=m0WnCM-NiIEBEKXZ3ssD&amp;guid=ON&amp;script=0"/>
</div>
</noscript>	
<?php include "footer.php"; ?>