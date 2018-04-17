<?php include "header.php"; ?>
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