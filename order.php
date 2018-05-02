<?php include "header.php"; ?>
<!-- Include postcode lookup library -->
<script src="https://getaddress.io/js/jquery.getAddress-2.0.5.min.js"></script>
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

?>
<div class="main-container order">
	<div class="container">
		<h1>Enter your details to book your <b>FREE</b> survey</h1>
		<p class="divider">This is a completely free of charge service.</p>
		<form id="confirmation" action="confirmation" name="order-from" method="post" class="needs-validation" novalidate>
			<div class="row booking-info">
				<div class="col-lg-6 title-img">	
					<div class="corner">
					</div>
					<span class="corner-text"> &pound; <span class="price"><?php print $selected_boiler->GuidePrice; ?></span><br>
						<span class="sm-text">inc VAT</span><br>
						<span class="lg-text">Fully installed*</span>
					</span>	
					<img src="img/rec-boiler.png" alt="">
				</div>
				<div class="col-lg-6 name-and-date">
					<h4><?php print $selected_boiler->ProductName; ?></h4>
					<!-- <div class="col-md-6"> -->
						<ul>
							<li>An energy Efficient boiler</li>
							<li>Precision heating to reduce your fuel bills</li>
							<li>Available in a selection of styles and sizes</li>
							<li>Designed to meet your energy efficiency needs</li>
							<li>Quiet and compact in size</li>
							<li>Full range of smart thermostat controls</li>
							<li>Registration &amp; Activation of your warranty</li>
							<li>Registration of your new boiler with Gas Safe</li>
							<li>Removal and disposal of your old boiler</li>
						</ul>
					<!-- </div> -->
				</div>
			</div>
			<div class="form-wrapper">
			<h2>Please provide your contact details:</h2>
				<!-- <div class="form-group">
					<label for="title">Title</label>
					<select class="form-control" name="title" id="title" required>
						<option value="">Select</option>
						<option value="Mr">Mr</option>
						<option value="Mrs">Mrs</option>
						<option value="Miss">Miss</option>
						<option value="Ms">Ms</option>
					</select>
				</div> -->
				<div class="form-group">
					<label for="full-name">Name</label>
					<input type="text" name="first-name" placeholder="First name" class="form-control combined" required>
					<input type="text" name="surname" placeholder="Surname" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="phone-number">Phone number</label>
					<input type="number" name="phone-number" placeholder="e.g 01254 355535" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="email">Email address</label>
					<input type="email" name="email" placeholder="e.g james@example.com" class="form-control" required>
				</div>
				<!-- <div class="form-group">
					<label for="">Enter your postcode to find your address:</label>
					<div id="postcode_lookup"></div>
				</div>
				<div class="form-group">
					<label for="addressLineOne">Address</label>
					<input type="text" id="addressLineOne" placeholder="Address line one" class="form-control combined" name="address-line-one" required>
					<input type="text" id="addressLineTwo" placeholder="Address line two" class="form-control combined" name="address-line-two">
					<input type="text" id="addressLineThree" placeholder="Address line two" class="form-control" name="address-line-three">
				</div> -->
				<!-- <div class="form-group">
					<label for="town">Town</label>
					<input type="text" id="town" placeholder="Town" name="town" class="form-control" required>
				</div> -->
				<!-- <div class="form-group">
					<label for="country">County</label>
					<input type="text" id="county" placeholder="County" name="county" class="form-control" required>
				</div> -->
				<!-- <div class="form-group">
					<label for="postcode">Postcode</label>
					<input type="text" id="postCode" placeholder="Postcode" name="postcode" class="form-control" required="">
				</div> -->
			</div>					
			<div class="button-wrapper">
				<button type="submit" class="btn btn-primary">Confirm and Book</button>
			</div>
		</form>
	</div>
</div>

<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>
<!-- Postcode lookup script -->
<script>
jQuery('#postcode_lookup').getAddress({
  api_key: 'pLA-sMphaU2BdDQkLY8e6g4612',
  output_fields:{
      line_1: '#addressLineOne',
      line_2: '#addressLineTwo',
      line_3: '#addressLineThree',
      post_town: '#town',
      county: '#county',
      postcode: '#postCode'
  },
  onLookupSuccess: function(data){/* Your custom code */},
  onLookupError: function(){/* Your custom code */},
  onAddressSelected: function(elem,index){/* Your custom code */}
});
</script>
<?php include "footer.php"; ?>
