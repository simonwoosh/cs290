<?php #livesearch agent
include 'config.php';
users::protectArea();
//Flight lookup

	if(isset($_GET['directflight'])) {
		$result = array();
		//Airport from
		$af_id = htmlspecialchars($_GET['fromairport']);
		//Airport to
		$at_id = htmlspecialchars($_GET['toairport']);

		/* For later
		$af_id = airports::search(htmlspecialchars($_GET['fromairport']));
		//Airport to
		$at_id = airports::search(htmlspecialchars($_GET['toairport']));
		*/
		//Leave Date
		$ds = htmlspecialchars($_GET['datestart']);
		//Return Date
		$dr = htmlspecialchars($_GET['datereturn']);
		//lookup flight from
		$ff_id = flights::getFlight_by_locations($af_id, $at_id);
		//lookup flight return
		$fr_id = flights::getFlight_by_locations($at_id, $af_id);
		//flights from
		if($ff_id) {
		$from_flights = flight_details::getFlights_detail_by_ut($ff_id, $ds); 
		array_push($result, $from_flights);
		}
		else {echo "No matches found, try another date."; }
		if(isset($_GET['datereturn'])) {
		//return flights
		if($fr_id) { 
			$return_flights = flight_details::getFlights_detail_by_ut($fr_id, $dr);
			array_push($result, $return_flights);
			}
		else { echo "No matches found, try another return date."; }

		echo json_encode($result);


	}
}
?>			