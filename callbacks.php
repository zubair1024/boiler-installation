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
						<a onclick=\"optSelect('two-sub','yes','five',this);\"><img src='img/yes.png'></a>
						<a onclick=\"optSelect('two-sub','no','five',this);\"><img src='img/no.png'></a>
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
							<a onclick=\"optSelect('seven-sub-two','slow','seven-sub-two',this);\"><img src='img/tap-slow.png'></a>
							<a onclick=\"optSelect('seven-sub-two','average','seven-sub-two',this);\"><img src='img/tap-average.png'></a>
							<a onclick=\"optSelect('seven-sub-two','fast','seven-sub-two',this);\"><img src='img/tap-fast.png'></a>	
						</div>
					</div>	
				</div>
				";
				$div_info = ['quesNumber' => $ques_num, 'next' => 'data-'.$next, 'sub' => false];
				manage_session_data($html,$ques_num,$opt_selected);
				break;

			case 'seven-sub-two':
				$html = "
				<div id='data-seven-sub-two' class='row'>
					<div id='ques-seven-sub-two'>
						<h3>How many bedrooms do you have?</h3>
						<div class='ans-wrapper'>
							<a onclick=\"optSelect('fifteen','3','sixteen',this);\"><img src='img/bedroom-1-3.png'></a>
							<a onclick=\"optSelect('fifteen','4','sixteen',this);\"><img src='img/bedroom-4-min.png'></a>
							<a onclick=\"optSelect('fifteen','5','sixteen',this);\"><img src='img/bedroom-5-or-more.png'></a>
						</div>
					</div>	
				</div>
				<button style=\"display: none\" class=\"btn btn-default btn-lg btn-loader\"><i class=\"fa fa-spinner fa-spin\"></i> Loading</button>
				";	
				$div_info = ['quesNumber' => $ques_num, 'next' => 'data-'.$next, 'sub' => true];
				manage_session_data($html,"seven-sub-two",$opt_selected);
				break;			

			case 'fifteen':
				// $select_make = get_make();
				// $html = "
				// <div id='data-sixteen' class='row'>
				// 	<div id='ques-sixteen'>
				// 		<h3>Tell us the make and model of your boiler</h3>
				// 		<p>Select from the drop down menu the make and model of your boiler.</p>
				// 		<div class='make'>
				// 			$select_make
				// 		</div>
				// 		<div class='model-wrapper'>
				// 			<select id='model'>
				// 				<option value=''>Model</option>
				// 			</select>
				// 		</div>
				// 		<div class='btn-wrapper'>
				// 			<a onclick='getQuote()' class='btn'>See recommended boiler</a>	
				// 		</div>
				// 	</div>	
				// </div>
				// ";	
				$html = "";
				$div_info = ['quesNumber' => $ques_num, 'next' => 'data-'.$next, 'sub' => true];
				manage_session_data($html,"HowManyRadiatorsAreInYourHome",$opt_selected);
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