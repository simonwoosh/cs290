<?php #class flight_details
class flight_details {

	//returns an array of flight_detail objects
	public static function getAll() {
		$query = db::query("SELECT id FROM flight_detail");
		$flight_detailArray = array();
		foreach($query as $flight_detailRow) {
			if ($flight_detailRow['id']>0){
				$flight_detailArray[] = new flight_detail($flight_detailRow['id']);
			}
		}
		return $flight_detailArray;
	}

	public static function getFlights_detail_by_ut($f_id, $user_time){
		$start_time = strtotime($user_time);
		$end_time = $user_time . " 23:59:59";
		$end_time = strtotime($end_time);
		$query = db::prepare("SELECT id FROM flight_detail WHERE flight_id=? AND departure_time BETWEEN FROM_UNIXTIME(?) AND FROM_UNIXTIME(?) ");
		$query->bindValue(1, $f_id);
		$query->bindValue(2, $start_time);
		$query->bindValue(3, $end_time);

		 try{
            $query->execute();
		    $fd_ids = $query->fetchAll();
		}catch (PDOException $e){
            die($e->getMessage());
        }
        if($fd_ids) {

        $flights = array(); 
        foreach($fd_ids as $fd_id) {
        	$availablity = self::flight_availablity($fd_id['id']);
        	if ($availablity >= 1) {
        		$flights[] = new flight_detail($fd_id['id']);
        	}

		  }
		  return $flights;
    	} else { return false; }
	}
	public static function selectCapacity($fd_id){
		$query = db::prepare("SELECT capacity FROM flight_detail WHERE id=?");
		$query->bindValue(1, $fd_id);
		$query->execute();
		$capacity = $query->fetchColumn();
		return $capacity;
	}
	public static function flight_availablity($fd_id){
		$occupency = flight_detail_passengers::passengers_on_flight($fd_id);
		$capacity = self::selectCapacity($fd_id);
		$available = $capacity - $occupency;
		return $available;
	}
	public static function create($flight_id, $model_id, $capacity, $flight_status, $delayed_time, $estimated_duration, $departure_time, $unit_price) {
		//Preparing the database query
        $query = db::prepare("SELECT id FROM flight_detail WHERE flight_id=? AND model_id=? AND capacity=? AND flight_status=? AND delayed_time=? AND estimated_duration=? AND departure_time=? AND unit_price=?");
        //Binding $address data with prepared query
        $query->bindValue(1, $flight_id);
        $query->bindValue(2, $model_id);
        $query->bindValue(3, $capacity);
        $query->bindValue(4, $flight_status);
        $query->bindValue(5, $delayed_time);
        $query->bindValue(6, $estimated_duration);
        $query->bindValue(7, $departure_time);
        $query->bindValue(8, $unit_price);
        //Atempting query execution
        try{
            $query->execute();
		    $id = $query->fetchColumn();
		    if($id >= 1) {
            return $id;   
            }
			else {
				$query2 = db::prepare("INSERT INTO flight_detail (flight_id, model_id, capacity,flight_status, delayed_time, estimated_duration, departure_time, unit_price,date_added) VALUES(?,?,?,?,?,?,?,?,NOW())");
				$query2->bindValue(1, $flight_id);
				$query2->bindValue(2, $flight_id);
				$query2->bindValue(3, $capacity);
				$query2->bindValue(4, $flight_status);
				$query2->bindValue(5, $delayed_time);
				$query2->bindValue(6, $estimated_duration);
				$query2->bindValue(7, $departure_time);
				$query2->bindValue(8, $unit_price);
	            $query2->execute();
			    $this->create($flight_id, $model_id, $capacity, $flight_status, $delayed_time, $estimated_duration, $departure_time, $unit_price);
			}  

            
        }
        //Exception handing
        catch (PDOException $e){
            die($e->getMessage());
        }
        


	}
     public static function update($id, $flight_id, $model_id, $capacity, $flight_status, $delayed_time, $estimated_duration, $departure_time, $unit_price){         
	    //Preparing database query
	    $query =db::prepare("UPDATE flight_detail SET flight_id=?, model_id=?,capacity=?, flight_status=?, delayed_time=? AND estimated_duration=? AND departure_time=? AND unit_price=? WHERE id=?");
	                               	          
        //Binding values to query
   	    
    	$query->bindValue(1, $flight_id);
    	$query->bindValue(2, $model_id);
	    $query->bindValue(3, $capacity);
	    $query->bindValue(4, $flight_status);
	    $query->bindValue(5, $delayed_time);
        $query->bindValue(6, $estimated_duration);
        $query->bindValue(7, $departure_time);
        $query->bindValue(8, $unit_price);
	    $query->bindValue(9, $id);
	    
	    try{
	        $query->execute();
	        return True;	    
	    
	    }
	    catch(PDOException $e){
		    die($e->getMessage());
		}
		
	}
	public static function delete($id) {

    $query = db::prepare("DELETE FROM flight_detail WHERE id=?");
	$query->bindValue(1, $id);
	
	try{
		    $query->execute();
		    return True;
		   
		}
 
	    catch(PDOException $e){
		    die($e->getMessage());
	    }
    }
}