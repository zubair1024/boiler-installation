<?php 

header('Content-Type: application/json');

if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
	return false;
}
// - Check and initialise session
if (!isset($_SESSION)) {
  session_start();
}

$type = $_POST['type'];

if($type == 'bookAppointment') {
	$slot = $_POST['slot'];
	$return = book_appointment($slot);
}

if($type == 'getPeriods') {
	$return = get_periods();
}

function book_appointment($slot) {
	$_SESSION[session_id()]['data']['slot'] = $slot;
 	return [
 		'time' => $slot,
 		'status' => 'success' 
 	];	
}

function get_periods() {

	//Convert the date string into a unix timestamp.
	$unixTimestamp = strtotime(date("Y-m-d"));
	//Get the day of the week using PHP's date function.
	$dayOfWeek = date("l", $unixTimestamp);

	switch ($dayOfWeek) {
		case 'Thursday':
			$stTime = strtotime("+2 day");
			break;
		case 'Friday':
			$stTime = strtotime("+2 day");
			break;	
		case 'Saturday':
			$stTime = strtotime("+2 day");
			break;		
		case 'Sunday':
			$stTime = strtotime("+2 day");
			break;	
		default:
			$stTime = strtotime("+2 day");
			break;
	}

	switch ($dayOfWeek) {
		case 'Thursday':
			$enTime = strtotime("+30 day");
			break;
		case 'Friday':
			$enTime = strtotime("+29 day");
			break;	
		case 'Saturday':
			$enTime = strtotime("+28 day");
			break;		
		case 'Sunday':
			$enTime = strtotime("+27 day");
			break;	
		default:
			$enTime = strtotime("+26 day");
			break;
	}

	$stTime = date('M d, Y', $stTime);
	$enTime = date('M d, Y', $enTime);
	$duration = 120;
	$break = 0;

  $start = new DateTime($stTime);
  $end = new DateTime($enTime);
  $interval = new DateInterval("PT" . $duration. "M");
  $breakInterval = new DateInterval("PT" . $break. "M");

  for ($intStart = $start;  $intStart < $end; $intStart->add($interval)->add($breakInterval)) {
		$endPeriod = clone $intStart;
		$endPeriod->add($interval);
	 	if ($endPeriod > $end) {
		  $endPeriod=$end;
		}
		$unixTimestamp = strtotime($intStart->format('Y-m-d'));
		//Get the day of the week using PHP's date function.
		$dayOfWeek = date("l", $unixTimestamp);

		if($dayOfWeek != 'Sunday' && $dayOfWeek != 'Saturday'){
			if($intStart->format('Y-m-d H:i:s') >= $intStart->format('Y-m-d 08:00:00') && $intStart->format('Y-m-d H:i:s') <= $intStart->format('Y-m-d 18:00:00')) {
				$periods[] = [
					'title' => $intStart->format('g A'),
					'start' => $intStart->format('Y-m-d H:i:s'),
					'end' => $endPeriod->format('Y-m-d H:i:s')  
				];
			}
		}			
  }
  return $periods;
}	
echo json_encode($return);
?>