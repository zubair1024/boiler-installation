<?php 
header('Content-Type: application/json');

if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
	return false;
}
// - Check and initialise session
if (!isset($_SESSION)) {
  session_start();
}
// $_SESSION[session_id()] = array();
// if(!array_key_exists('data', $_SESSION[session_id()])) {
// 	$_SESSION[session_id()]['data'] = array();
// }
$type = $_POST['type'];

if($type == 'getModel') {
	$make = $_POST['make'];
	$return = get_model($make);
}

if($type == 'questions') {
	$ques_num = $_POST['quesNum'];
	$opt_selected = $_POST['optSelected'];
	$next = $_POST['nxt'];
	$return = question_and_options($ques_num, $opt_selected,$next);
}

if($type ==	 'saveMakeModel') {
	$_SESSION[session_id()]['data']['seventeen']['optionsSelected'] = $_POST['make'];
	$_SESSION[session_id()]['data']['eighteen']['optionsSelected'] = $_POST['model'];
	$return = ['saved' => TRUE ];
}

if($type == 'boilerSelected') {
	$id = $_POST['pid'];
	$_SESSION[session_id()]['product_id'] = $id;
	$return = [ 'msg' => 'success'];
}

function question_and_options($ques_num, $opt_selected,$next) {
	switch ($ques_num) {
		case 'one':
			$html = "
			<div id='data-two' class='row'>
				<div id='ques-two'>
					<h3>Do you have a hot water cylinder?</h3>
					<p class='info'>A hot water cylinder is used to store your home's hot water and can typically be found in an airing cupboard or the loft. Water cylinders look like large round tanks and are found in homes that have existing 'conventional' or 'system' boilers.</p>
					<div class='ans-wrapper'>
						<a onclick=\"optSelect('two','yes','three',this);\"><img src='img/water-cylinder-yes.png'></a>
						<a onclick=\"optSelect('two-sub','no','five',this);\"><img src='img/water-cylinder-no.png'></a>
					</div>
				</div>	
			</div>
			";
			$div_info = ['quesNumber' => $ques_num, 'next' => 'data-'.$next, 'sub' => false];
			manage_session_data($html,$ques_num,$opt_selected);
			break;

		case 'two':	
			$html = "
			<div id='data-three' class='row'>
				<div id='ques-three'>
					<h3>Would you like it removed?</h3>
					<p class='info'>Not recommended if you would like to run more than 2 baths and/or mixer showers at the same time.</p>
					<div class='ans-wrapper'>
						<a onclick=\"optSelect('three','yes','four',this);\"><img src='img/yes.png'></a>
						<a onclick=\"optSelect('three','no','four',this);\"><img src='img/no.png'></a>
					</div>
				</div>	
			</div>
			";
			$div_info = ['quesNumber' => $ques_num, 'next' => 'data-'.$next, 'sub' => false];
			manage_session_data($html,$ques_num,$opt_selected);
			break;

			case 'two-sub':	
				$html = "
				<div id='data-five' class='row'>
					<div id='ques-five'>
						<h3>How quickly does cold water run from your kitchen tap?</h3>
						<p class='info'>How long does it take to fill a pint glass? 5 Seconds is fast, 10 seconds is slow, anything in between is average.</p>
						<div class='ans-wrapper'>
							<a onclick=\"optSelect('five','slow','six',this);\"><img src='img/tap-slow.png'></a>
							<a onclick=\"optSelect('five','average','six',this);\"><img src='img/tap-average.png'></a>
							<a onclick=\"optSelect('five','fast','six',this);\"><img src='img/tap-fast.png'></a>	
						</div>
					</div>	
				</div>
				";
				$div_info = ['quesNumber' => 'two', 'next' => 'data-'.$next, 'sub' => false];
				manage_session_data($html,'four',$opt_selected);
				break;

			case 'three':	
				$html = "
				<div id='data-four' class='row'>
					<div id='ques-four'>
						<h3>Do you have a separate cold water tank in your loft?</h3>
						<div class='ans-wrapper'>
							<a onclick=\"optSelect('four','yes','five',this);\"><img src='img/cold-water-tank.png'></a>
							<a onclick=\"optSelect('four','no','five',this);\"><img src='img/cold-water-tank-no.png'></a>
						</div>
					</div>	
				</div>
				";
				$div_info = ['quesNumber' => $ques_num, 'next' => 'data-'.$next, 'sub' => false];
				manage_session_data($html,$ques_num,$opt_selected);
				break;

			case 'four':
				$html = "
				<div id='data-five' class='row'>
					<div id='ques-five'>
						<h3>How quickly does cold water run from your kitchen tap?</h3>
						<p class='info'>How long does it take to fill a pint glass? 5 Seconds is fast, 10 seconds is slow, anything in between is average.</p>
						<div class='ans-wrapper'>
							<a onclick=\"optSelect('five','slow','six',this);\"><img src='img/tap-slow.png'></a>
							<a onclick=\"optSelect('five','average','six',this);\"><img src='img/tap-average.png'></a>
							<a onclick=\"optSelect('five','fast','six',this);\"><img src='img/tap-fast.png'></a>	
						</div>
					</div>	
				</div>
				";
				$div_info = ['quesNumber' => $ques_num, 'next' => 'data-'.$next, 'sub' => false];
				manage_session_data($html,$ques_num,$opt_selected);
				break;

			case 'five':
				$html = "
				<div id='data-six' class='row'>
					<div id='ques-six'>
						<h3>What type of home do you live in?</h3>
						<div class='ans-wrapper'>
							<a onclick=\"optSelect('five-sub','flat','six-sub',this);\"><img src='img/flat.png'></a>
							<a onclick=\"optSelect('six','bungalow','seven',this);\"><img src='img/bungalow.png'></a>
							<a onclick=\"optSelect('six','detached','seven',this);\"><img src='img/detached.png'></a>	
							<a onclick=\"optSelect('six','semi-detached','seven',this);\"><img src='img/semi-detached.png'></a>	
							<a onclick=\"optSelect('six','terraced','seven',this);\"><img src='img/terraced.png'></a>	
						</div>
					</div>	
				</div>
				";
				$div_info = ['quesNumber' => $ques_num, 'next' => 'data-'.$next, 'sub' => false];
				manage_session_data($html,$ques_num,$opt_selected);
				break;

			case 'five-sub':
				$html = "
				<div id='data-six-sub' class='row'>
					<div id='ques-six-sub'>
						<h3>Is your flat on or above the second floor?</h3>
						<p>We need to know whether your flat or apartment is on or above the second floor.</p>
						<div class='ans-wrapper'>
							<a onclick=\"optSelect('six-sub','flat upto 1st floor','seven',this);\"><img src='img/flat-up-to-1st-floor.png'></a>
							<a onclick=\"optSelect('six-sub','flat second and above','seven',this);\"><img src='img/flat-2nd-floor-above.png'></a>
						</div>
					</div>	
				</div>
				";
				$div_info = ['quesNumber' => 'six', 'next' => 'data-'.$next, 'sub' => true];
				manage_session_data($html,'six',$opt_selected);
				break;

			case 'six':
				$html = "
				<div id='data-seven' class='row'>
					<div id='ques-seven'>
						<h3>Where is your boiler located?</h3>
						<p>We need to know where in your home your boiler is located.</p>
						<div class='ans-wrapper'>
							<a onclick=\"optSelect('seven','kitchen','eight',this);\"><img src='img/kitchen.png'></a>
							<a onclick=\"optSelect('seven','living room','eight',this);\"><img src='img/living-room.png'></a>
							<a onclick=\"optSelect('seven','utility room','eight',this);\"><img src='img/utility-room.png'></a>
							<a onclick=\"optSelect('seven','attic','eight',this);\"><img src='img/attic.png'></a>
							<a onclick=\"optSelect('seven','bathroom','eight',this);\"><img src='img/bathroom.png'></a>
							<a onclick=\"optSelect('seven','bedroom','eight',this);\"><img src='img/bedroom.png'></a>
							<a onclick=\"optSelect('seven','garage','eight',this);\"><img src='img/garage.png'></a>
						</div>
					</div>	
				</div>
				";
				$div_info = ['quesNumber' => $ques_num, 'next' => 'data-'.$next, 'sub' => false];
				manage_session_data($html,$ques_num,$opt_selected);	
				break;

			case 'six-sub':
				$html = "
				<div id='data-seven' class='row'>
					<div id='ques-seven'>
						<h3>Where is your boiler located?</h3>
						<p>We need to know where in your home your boiler is located.</p>
						<div class='ans-wrapper'>
							<a onclick=\"optSelect('seven','kitchen','eight',this);\"><img src='img/kitchen.png'></a>
							<a onclick=\"optSelect('seven','living room','eight',this);\"><img src='img/living-room.png'></a>
							<a onclick=\"optSelect('seven','utility room','eight',this);\"><img src='img/utility-room.png'></a>
							<a onclick=\"optSelect('seven','attic','eight',this);\"><img src='img/attic.png'></a>
							<a onclick=\"optSelect('seven','bathroom','eight',this);\"><img src='img/bathroom.png'></a>
							<a onclick=\"optSelect('seven','bedroom','eight',this);\"><img src='img/bedroom.png'></a>
							<a onclick=\"optSelect('seven','garage','eight',this);\"><img src='img/garage.png'></a>
						</div>
					</div>	
				</div>
				";	
				$div_info = ['quesNumber' => 'six-sub', 'next' => 'data-'.$next, 'sub' => true];
				manage_session_data($html,'six-sub',$opt_selected);
				break;	

			case 'seven':
				$html = "
				<div id='data-eight' class='row'>
					<div id='ques-eight'>
						<h3>Do you want the boiler moved to another location?</h3>
						<div class='ans-wrapper'>
							<a onclick=\"optSelect('seven-sub-one','Yes','seven-sub-one',this);\"><img src='img/yes.png'></a>
							<a onclick=\"optSelect('seven-sub-two','No','seven-sub-two',this);\"><img src='img/no.png'></a>
						</div>
					</div>	
				</div>
				";	
				$div_info = ['quesNumber' => $ques_num, 'next' => 'data-'.$next, 'sub' => true];
				manage_session_data($html,$ques_num,$opt_selected);
				break;

			case 'seven-sub-one':
				$html = "
				<div id='data-seven-sub-one' class='row'>
					<div id='ques-seven-sub-one'>
						<h3>Where would you like your new boiler?</h3>
						<div class='ans-wrapper'>
							<a onclick=\"optSelect('seven-sub-two-extra','kitchen','seven-sub-two-extra',this);\"><img src='img/kitchen.png'></a>
							<a onclick=\"optSelect('seven-sub-two-extra','living room','seven-sub-two-extra',this);\"><img src='img/living-room.png'></a>
							<a onclick=\"optSelect('seven-sub-two-extra','utility room','seven-sub-two-extra',this);\"><img src='img/utility-room.png'></a>
							<a onclick=\"optSelect('seven-sub-two-extra','attic','seven-sub-two-extra',this);\"><img src='img/attic.png'></a>
							<a onclick=\"optSelect('seven-sub-two-extra','bathroom','seven-sub-two-extra',this);\"><img src='img/bathroom.png'></a>
							<a onclick=\"optSelect('seven-sub-two-extra','bedroom','seven-sub-two-extra',this);\"><img src='img/bedroom.png'></a>
							<a onclick=\"optSelect('seven-sub-two-extra','garage','seven-sub-two-extra',this);\"><img src='img/garage.png'></a>
						</div>
					</div>	
				</div>
				";	
				$div_info = ['quesNumber' => 'eight', 'next' => 'data-'.$next, 'sub' => true];
				manage_session_data($html,'DoYouWantBoilerMoved',$opt_selected);
				break;		

			case 'seven-sub-two':
				$html = "
				<div id='data-seven-sub-two' class='row'>
					<div id='ques-seven-sub-two'>
						<h3>How many bedrooms do you have?</h3>
						<div class='ans-wrapper'>
							<a onclick=\"optSelect('eight-sub-two','3','nine',this);\"><img src='img/bedroom-1-3.png'></a>
							<a onclick=\"optSelect('eight-sub-two','4','nine',this);\"><img src='img/bedroom-4-min.png'></a>
							<a onclick=\"optSelect('eight-sub-two','5','nine',this);\"><img src='img/bedroom-5-or-more.png'></a>
						</div>
					</div>	
				</div>
				";	
				$div_info = ['quesNumber' => 'eight', 'next' => 'data-'.$next, 'sub' => true];
				manage_session_data($html,'DoYouWantBoilerMoved',$opt_selected);
				break;			

			case 'seven-sub-two-extra':
				$html = "
				<div id='data-seven-sub-two-extra' class='row'>
					<div id='ques-seven-sub-two-extra'>
						<h3>How many bedrooms do you have?</h3>
						<div class='ans-wrapper'>
							<a onclick=\"optSelect('eight-sub-two-extra','3','nine',this);\"><img src='img/bedroom-1-3.png'></a>
							<a onclick=\"optSelect('eight-sub-two-extra','4','nine',this);\"><img src='img/bedroom-4-min.png'></a>
							<a onclick=\"optSelect('eight-sub-two-extra','5','nine',this);\"><img src='img/bedroom-5-or-more.png'></a>
						</div>
					</div>	
				</div>
				";	
				$div_info = ['quesNumber' => 'seven-sub-one', 'next' => 'data-'.$next, 'sub' => true];
				manage_session_data($html,$ques_num,$opt_selected);
				break;	
									
			case 'eight-sub-two':
				$html = "
				<div id='data-nine' class='row'>
					<div id='ques-nine'>
						<h3>How many bathtubs are in your home?</h3>
						<p>Just bathtubs, not bathrooms. If you plan to install more bathtubs soon, include those.</p>
						<div class='ans-wrapper'>
							<a onclick=\"optSelect('nine','0','ten',this);\"><img src='img/bathtub-0.png'></a>
							<a onclick=\"optSelect('nine','1','ten',this);\"><img src='img/bathtub-1.png'></a>
							<a onclick=\"optSelect('nine','2','ten',this);\"><img src='img/bathtubs-2.png'></a>
							<a onclick=\"optSelect('nine','3','ten',this);\"><img src='img/bathtubs-3-or-more.png'></a>
						</div>
					</div>	
				</div>
				";	
				$div_info = ['quesNumber' => $ques_num, 'next' => 'data-'.$next, 'sub' => true];
				manage_session_data($html,'HowManyRadiatorsAreInYourHome',$opt_selected);
				break;	
			
			case 'eight-sub-two-extra':
				$html = "
				<div id='data-nine' class='row'>
					<div id='ques-nine'>
						<h3>How many bathtubs are in your home?</h3>
						<p>Just bathtubs, not bathrooms. If you plan to install more bathtubs soon, include those.</p>
						<div class='ans-wrapper'>
							<a onclick=\"optSelect('nine','0','ten',this);\"><img src='img/bathtub-0.png'></a>
							<a onclick=\"optSelect('nine','1','ten',this);\"><img src='img/bathtub-1.png'></a>
							<a onclick=\"optSelect('nine','2','ten',this);\"><img src='img/bathtubs-2.png'></a>
							<a onclick=\"optSelect('nine','3','ten',this);\"><img src='img/bathtubs-3-or-more.png'></a>
						</div>
					</div>	
				</div>
				";	
				$div_info = ['quesNumber' => $ques_num, 'next' => 'data-'.$next, 'sub' => true];
				manage_session_data($html,'HowManyRadiatorsAreInYourHome',$opt_selected);
				break;	

			// case 'eight':
			// 	$html = "
			// 	<div id='data-nine' class='row'>
			// 		<div id='ques-nine'>
			// 			<h3>How many bathtubs are in your home?</h3>
			// 			<p>Just bathtubs, not bathrooms. If you plan to install more bathtubs soon, include those.</p>
			// 			<div class='ans-wrapper'>
			// 				<a onclick=\"optSelect('nine','0','ten',this);\"><img src='img/bathtub-0.png'></a>
			// 				<a onclick=\"optSelect('nine','1','ten',this);\"><img src='img/bathtub-1.png'></a>
			// 				<a onclick=\"optSelect('nine','2','ten',this);\"><img src='img/bathtubs-2.png'></a>
			// 				<a onclick=\"optSelect('nine','3','ten',this);\"><img src='img/bathtubs-3-or-more.png'></a>
			// 			</div>
			// 		</div>	
			// 	</div>
			// 	";	
			// 	$div_info = ['quesNumber' => $ques_num, 'next' => 'data-'.$next, 'sub' => true];
			// 	manage_session_data($html,$ques_num,$opt_selected);
			// 	break;

			case 'nine':
				$html = "
				<div id='data-ten' class='row'>
					<div id='ques-ten'>
						<h3>How many standalone mixer showers do you have?</h3>
						<p>You dont ned to include showers that are in baths. We mean a shower which isn’t electric and needs a working boiler to provide a lovely warm water.</p>
						<div class='ans-wrapper'>
							<a onclick=\"optSelect('ten','No shower','eleven',this);\"><img src='img/shower-0.png'></a>
							<a onclick=\"optSelect('ten','One shower','eleven',this);\"><img src='img/shower-1.png'></a>
							<a onclick=\"optSelect('ten','Two showers','eleven',this);\"><img src='img/showers-2.png'></a>
							<a onclick=\"optSelect('ten','Three or more showers','eleven',this);\"><img src='img/showers-3-or-more.png'></a>
						</div>
					</div>	
				</div>
				";	
				$div_info = ['quesNumber' => $ques_num, 'next' => 'data-'.$next, 'sub' => true];
				manage_session_data($html,$ques_num,$opt_selected);
				break;

			case 'ten':
				$html = "
				<div id='data-eleven' class='row'>
					<div id='ques-eleven'>
						<h3>What type of thermostat do you have?</h3>
						<p>This allows you to set and control the temperature.</p>
						<div class='ans-wrapper'>
							<a onclick=\"optSelect('eleven','No thermostat','twelve',this);\"><img src='img/thermostat-0.png'></a>
							<a onclick=\"optSelect('eleven','Wired thermostat','twelve',this);\"><img src='img/thermostat-wired.png'></a>
							<a onclick=\"optSelect('eleven','Not wired thermostat','twelve',this);\"><img src='img/thermostat-not-wired.png'></a>
						</div>
					</div>	
				</div>
				";	
				$div_info = ['quesNumber' => $ques_num, 'next' => 'data-'.$next, 'sub' => true];
				manage_session_data($html,$ques_num,$opt_selected);
				break;

			case 'eleven':
				$html = "
				<div id='data-twelve' class='row'>
					<div id='ques-twelve'>
						<h3>Do you have a thermostatic radiator valves?</h3>
						<p>This allows you to control the temperature at the radiator.</p>
						<div class='ans-wrapper'>
							<a onclick=\"optSelect('twelve','No thermostatic valve','thirteen',this);\"><img src='img/thermostatic-valve-0.png'></a>
							<a onclick=\"optSelect('twelve','One thermostatic valve','thirteen',this);\"><img src='img/thermostatic-valve-1.png'></a>
							<a onclick=\"optSelect('twelve','Two thermostatic valves','thirteen',this);\"><img src='img/thermostatic-valves-2.png'></a>
							<a onclick=\"optSelect('twelve','Three or more thermostatic valves','thirteen',this);\"><img src='img/thermostatic-valves-3-or-more.png'></a>
						</div>
					</div>	
				</div>
				";	
				$div_info = ['quesNumber' => $ques_num, 'next' => 'data-'.$next, 'sub' => true];
				manage_session_data($html,$ques_num,$opt_selected);
				break;

			case 'twelve':
				$html = "
				<div id='data-thirteen' class='row'>
					<div id='ques-thirteen'>
						<h3>Where is your flue located?</h3>
						<p>The flue is the pipe that gets rid of all the waste gases from your boiler.</p>
						<div class='ans-wrapper'>
							<a onclick=\"optSelect('twelve-roof','Flue roof','thirteen-roof',this);\"><img src='img/flue-roof.png'></a>
							<a onclick=\"optSelect('twelve-wall','Flue wall','thirteen-wall',this);\"><img src='img/flue-wall.png'></a>
						</div>
					</div>	
				</div>
				";	
				$div_info = ['quesNumber' => $ques_num, 'next' => 'data-'.$next, 'sub' => true];
				manage_session_data($html,$ques_num,$opt_selected);
				break;

			case 'twelve-roof':
				$html = "
				<div id='data-thirteen-roof' class='row'>
					<div id='ques-thirteen-roof'>
						<h3>If it’s in the roof, is it flat or sloped?</h3>
						<div class='ans-wrapper'>
							<a onclick=\"optSelect('thirteen-roof','Sloped roof','fourteen',this);\"><img src='img/roof-sloped.png'></a>
							<a onclick=\"optSelect('thirteen-roof','Flat roof','fourteen',this);\"><img src='img/roof-flat.png'></a>
						</div>
					</div>	
				</div>
				";	
				$div_info = ['quesNumber' => 'thirteen', 'next' => 'data-'.$next, 'sub' => true];
				manage_session_data($html,'WhereIsTheLocationOfFLue',$opt_selected);
				break;											

			case 'thirteen-roof':
				$html = "
				<div id='data-fourteen' class='row'>
					<div id='ques-fourteen'>
						<h3>What shape is your flue?</h3>
						<div class='ans-wrapper'>
							<a onclick=\"optSelect('fourteen','Flue round','fifteen',this);\"><img src='img/flue-round.png'></a>
							<a onclick=\"optSelect('fourteen','Flue square','fifteen',this);\"><img src='img/flue-square.png'></a>
						</div>
					</div>	
				</div>
				";	
				$div_info = ['quesNumber' => 'thirteen-roof', 'next' => 'data-'.$next, 'sub' => true];
				manage_session_data($html,$ques_num,$opt_selected);
				break;					

			case 'twelve-wall':
				$html = "
				<div id='data-thirteen-wall' class='row'>
					<div id='ques-thirteen-wall'>
						<h3>If it’s in the wall, is there a covering over it?</h3>
						<p>We need to know if there’s an awning or covering over the flue.</p>
						<div class='ans-wrapper'>
							<a onclick=\"optSelect('twelve-wall-two','Flue covered','thirteen-wall-two',this);\"><img src='img/flue-covered.png'></a>
							<a onclick=\"optSelect('twelve-wall-two','Flue not covered','thirteen-wall-two',this);\"><img src='img/flue-not-covered.png'></a>
						</div>
					</div>	
				</div>
				";	
				$div_info = ['quesNumber' => 'thirteen', 'next' => 'data-'.$next, 'sub' => true];
				manage_session_data($html,'WhereIsTheLocationOfFLue',$opt_selected);
				break;	

			case 'twelve-wall-two':
				$html = "
				<div id='data-thirteen-wall-two' class='row'>
					<div id='ques-thirteen-wall-two'>
						<h3>If it’s in the wall, how far from the ground is it?</h3>
						<div class='ans-wrapper'>
							<a onclick=\"optSelect('twelve-wall-three','Flue higher than 2m','thirteen-wall-three',this);\"><img src='img/flue-2m-higher.png'></a>
							<a onclick=\"optSelect('twelve-wall-three','Flue lower than 2m','thirteen-wall-three',this);\"><img src='img/flue-less-2m.png'></a>
						</div>
					</div>	
				</div>
				";	
				$div_info = ['quesNumber' => 'thirteen-wall', 'next' => 'data-'.$next, 'sub' => true];
				manage_session_data($html,$ques_num,$opt_selected);	
				break;

			case 'twelve-wall-three':
				$html = "
				<div id='data-thirteen-wall-three' class='row'>
					<div id='ques-thirteen-wall-three'>
						<h3>How far is it from your nearest neighbour?</h3>
						<p>This is the distance between the flue and nearest boundary of land that belongs to someone else.</p>
						<div class='ans-wrapper'>
							<a onclick=\"optSelect('twelve-wall-four','Neighbour less than 2m','thirteen-wall-four',this);\"><img src='img/neighbour-less-2m.png'></a>
							<a onclick=\"optSelect('twelve-wall-four','Neighbour more than 2m','thirteen-wall-four',this);\"><img src='img/neighbour-more-2m.png'></a>
						</div>
					</div>	
				</div>
				";	
				$div_info = ['quesNumber' => 'thirteen-wall-two', 'next' => 'data-'.$next, 'sub' => true];
				manage_session_data($html,$ques_num,$opt_selected);	
				break;	

			case 'twelve-wall-four':
				$html = "
				<div id='data-thirteen-wall-four' class='row'>
					<div id='ques-thirteen-wall-four'>
						<h3>Is the flue positioned more than 30 cm from the Window?</h3>
						<div class='ans-wrapper'>
							<a onclick=\"optSelect('thirteen-wall','Windows more than 30cm','fourteen',this);\"><img src='img/yes.png'></a>
							<a onclick=\"optSelect('thirteen-wall','Windows less than 30cm','fourteen',this);\"><img src='img/no.png'></a>
						</div>
					</div>	
				</div>
				";	
				$div_info = ['quesNumber' => 'thirteen-wall-three', 'next' => 'data-'.$next, 'sub' => true];
				manage_session_data($html,$ques_num,$opt_selected);	
				break;		

			case 'thirteen-wall':
				$html = "
				<div id='data-fourteen' class='row'>
					<div id='ques-fourteen'>
						<h3>What shape is your flue?</h3>
						<div class='ans-wrapper'>
							<a onclick=\"optSelect('fourteen','Flue round','fifteen',this);\"><img src='img/flue-round.png'></a>
							<a onclick=\"optSelect('fourteen','Flue square','fifteen',this);\"><img src='img/flue-square.png'></a>
						</div>
					</div>	
				</div>
				";	
				$div_info = ['quesNumber' => 'thirteen-wall-four', 'next' => 'data-'.$next, 'sub' => true];
				manage_session_data($html,$ques_num,$opt_selected);
				break;

			case 'fourteen':
				$html = "
				<div id='data-fifteen' class='row'>
					<div id='ques-fifteen'>
						<h3>How old is your boiler?</h3>
						<div class='ans-wrapper'>
							<a onclick=\"optSelect('fifteen','1-2 years','sixteen',this);\"><img src='img/boiler-1-2-yrs.png'></a>
							<a onclick=\"optSelect('fifteen','3-4 years','sixteen',this);\"><img src='img/boiler-3-4-yrs.png'></a>
							<a onclick=\"optSelect('fifteen','5-6 years','sixteen',this);\"><img src='img/boiler-5-6-yrs.png'></a>
							<a onclick=\"optSelect('fifteen','7 years or older','sixteen',this);\"><img src='img/boiler-7-yrs-older.png'></a>
						</div>
					</div>	
				</div>
				<button style=\"display: none\" class=\"btn btn-default btn-lg btn-loader\"><i class=\"fa fa-spinner fa-spin\"></i> Loading</button>
				";	
				$div_info = ['quesNumber' => $ques_num, 'next' => 'data-'.$next, 'sub' => true];
				manage_session_data($html,$ques_num,$opt_selected);
				break;	

			case 'fifteen':
				$select_make = get_make();
				$html = "
				<div id='data-sixteen' class='row'>
					<div id='ques-sixteen'>
						<h3>Tell us the make and model of your boiler</h3>
						<p>Select from the drop down menu the make and model of your boiler.</p>
						<div class='make'>
							$select_make
						</div>
						<div class='model-wrapper'>
							<select id='model'>
								<option value=''>Model</option>
							</select>
						</div>
						<div class='btn-wrapper'>
							<a onclick='getQuote()' class='btn'>See recommended boiler</a>	
						</div>
					</div>	
				</div>
				";	
				$div_info = ['quesNumber' => $ques_num, 'next' => 'data-'.$next, 'sub' => true];
				manage_session_data($html,$ques_num,$opt_selected);
				break;		
				
			default:
				# code...
				break;
	}
	return [
		'html' => $html,
		'divInfo' => $div_info,
		'optionsSelected' => $_SESSION[session_id()]['data'],
		'sessionID' => $_SESSION
	];
}

// - Helper functions
function manage_session_data($html,$ques_num,$opt_selected) {
	// - Track html
	$_SESSION[session_id()]['data'][$ques_num]['html'] = $html;
	// - Track options selected
	$_SESSION[session_id()]['data'][$ques_num]['optionsSelected'] = $opt_selected;
	// - Remove data after the index if exists
	$pos = array_search($ques_num, array_keys($_SESSION[session_id()]['data']));
	$_SESSION[session_id()]['data'] = array_slice($_SESSION[session_id()]['data'],0,$pos+1,true);
}

function obj2array($obj) {
  $out = array();
  foreach ($obj as $key => $val) {
		switch(true) {
			case is_object($val):
			 $out[$key] = obj2array($val);
			 break;
		  case is_array($val):
			 $out[$key] = obj2array($val);
			 break;
		  default:
			$out[$key] = $val;
		}
  }
  return $out;
}
function unique_multidim_array($array, $key) { 
  $temp_array = array(); 
  $i = 0; 
  $key_array = array(); 
  
  foreach($array as $val) { 
    if (!in_array($val[$key], $key_array)) { 
      $key_array[$i] = $val[$key]; 
      $temp_array[$i] = $val; 
    } 
    $i++; 
  } 
  return $temp_array; 
} 

function get_make() {
	$client = new SoapClient("https://hr360api.247staywarm.co.uk/Service1.asmx?WSDL", array('trace' => 1, 'cache_wsdl' => WSDL_CACHE_NONE));
	$boilers = $client->__soapCall("Service_GetMakeModel", array());
	$boilers = obj2array($boilers);
	$boilers = $boilers['Service_GetMakeModelResult']['CertDdls'];
	$boilers_make = unique_multidim_array($boilers,'Make');
	$select_make = '<select id="make" onchange="getModel(this);">';
	$select_make .= '<option value="">Make</option>';
	foreach ($boilers_make as $key => $value) {
		if(!empty($value['Make'])){
			$select_make .= '<option value="'.$value['Make'].'">'.$value['Make'].'</option>';
		}
	}
	$select_make .= '</select>';
	return $select_make;
}

function get_model($make) {
	// $client = new SoapClient("http://engineers4.flynetmedia.co.uk/Service1.asmx?WSDL", array('trace' => 1, 'cache_wsdl' => WSDL_CACHE_NONE));
	$client = new SoapClient("https://hr360api.247staywarm.co.uk/Service1.asmx?WSDL", array('trace' => 1, 'cache_wsdl' => WSDL_CACHE_NONE));

	$boilers = $client->__soapCall("Service_GetMakeModel", array());
	$boilers = obj2array($boilers);
	$boilers = $boilers['Service_GetMakeModelResult']['CertDdls'];
	$select_model = '<div class="model-wrapper"><select id="model">';
	$select_model .= '<option value="">Model</option>';
	foreach ($boilers as $key => $value) {
		if($value['Make'] == $make){
			$select_model .= '<option value="'.$value['Model'].'">'.$value['Model'].'</option>';
		}
	}
	$select_model .= '</select></div>';
	return [
		'selectModel' => $select_model,
	];
}

echo json_encode($return);
?>