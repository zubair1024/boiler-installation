<?php include "header.php"; ?>
<?php 
	if (session_status() == PHP_SESSION_NONE) {
    session_start();
	}
	if(!array_key_exists(session_id(), $_SESSION) || !array_key_exists('product_id',$_SESSION[session_id()])){
		print 'Page not found';
		return;	
	}
	$id = $_SESSION[session_id()]['product_id'];
	$bedroom = $_SESSION[session_id()]['data']['eight']['optionsSelected'];
	$bathroom = $_SESSION[session_id()]['data']['nine']['optionsSelected'];
	$client = new SoapClient("http://crm.247labs.co.uk/service1.asmx?WSDL", array('trace' => 1, 'cache_wsdl' => WSDL_CACHE_NONE));
	$params = array(
		'rooms' => (int)$bedroom,
		'brooms' => (int)$bathroom
	);
	$recommeded_boilers = $client->__soapCall("GetBoilersByRadiatorsAndRooms", [$params])->GetBoilersByRadiatorsAndRoomsResult;
	$recommeded_boilers = $recommeded_boilers->HandmadeNewProduct;
?>
<div class="main-container selected-boiler">
	<div class="section-one container">
		<?php foreach ($recommeded_boilers as $key => $boiler): ?>
			<?php if ($boiler->ID == $id): ?>
				<div class="row inner-div-one">
					<div class="col-md-8">
						<div class="info-buy">
							<h1><?php print $boiler->ProductName; ?></h1>
							<p class="price-info">Fully installed price &pound;<span class="price"><?php print $boiler->GuidePrice; ?></span> | Service Plan from <span class="ff-price">&pound;40pm</span></p>
						</div>
					</div>
					<div class="col-md-4 cta-top-wrapper">
						<div class="cta-top">
							<a href="javascript:history.back(1)" class="back btn">Back</a>
							<a href="/book-appointment" class="btn">Book now</a>
						</div>	
					</div>	
				</div>		
				<div class="row inner-div-two">
					<div class="col-md-6 boiler-img">
						<img src="img/rec-boiler.png" alt="">
					</div>
					<div class="col-md-6">
						<?php // print $boiler->Information; ?>
						<ul>
							<li>An energy Efficient boiler</li>
							<li>Precision heating to reduce your fuel bills</li>
							<li>Available in a selection of styles and sizes and are designed to meet your energy efficiency needs</li>
							<li>Quiet and compact in size</li>
							<li>Full range of smart thermostat controls</li>
							<li>Registration &amp; Activation of your warranty</li>
							<li>Registration of your new boiler with Gas Safe</li>
							<li>Removal and disposal of your old boiler</li>
						</ul>
					</div>
				</div>
				<?php 
					$tech_spec['output'] = isset($boiler->DHWInput) ? $boiler->DHWInput: "";
					$tech_spec['dimension'] = isset($boiler->Dimension) ? $boiler->Dimension: "";
					$tech_spec['weight'] = isset($boiler->Weight) ? $boiler->Weight: "";
				?>
			<?php endif ?>
		<?php endforeach ?>
	</div>
	<div class="included">
		<div class="container">
			<div class="row">
				<h2>What's included?</h2>
				<div class="col-md-6">
					<img src="img/included.png" alt="">
				</div>
				<div class="col-md-6 info-list">
					<ul>
						<li>Discounted Installation Price</li>
						<li>Fixed low monthly payments</li>
						<li>7 Years Heating and Hot Water Promise</li>
						<li>Leading boiler brands to choose from</li>
						<li>Installed by a Gas Safe Registered engineer</li>
					</ul>
				</div>
			</div>
		</div>	
	</div>
	<div class="tech-spec">
		<div class="container">
			<h2>Technical specifications</h2>
			<div class="info">
				<p>Output kW <span><?php print $tech_spec['output'] ?></span></p>
				<p>Dimension <span><?php print $tech_spec['dimension'] ?></span></p>
				<p>Weight <span><?php print $tech_spec['weight'] ?></span></p>
			</div>
			<div class="cta-bottom">
				<a href="javascript:history.back(1)" class="back btn">Back</a>
				<a href="/book-appointment" class="btn">Buy now</a>
			</div>
		</div>
	</div>
</div>	
<?php include "footer.php"; ?>