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
	public static function create($flight_id, $capacity, $flight_status, $delayed_time, $estimated_duration, $departure_time, $unit_price) {
		//Preparing the database query
        $query = db::prepare("SELECT id FROM airport WHERE flight_id=? AND capacity=? AND flight_status=? AND delayed_time=? AND estimated_duration=? AND departure_time=? AND unit_price=?");
        //Binding $address data with prepared query
        $query->bindValue(1, $flight_id);
        $query->bindValue(2, $capacity);
        $query->bindValue(3, $flight_status);
        $query->bindValue(4, $delayed_time);
        $query->bindValue(5, $estimated_duration);
        $query->bindValue(6, $departure_time);
        $query->bindValue(7, $unit_price);
        //Atempting query execution
        try{
            $query->execute();
		    $id = $query->fetchColumn();
		    if($id >= 1) {
            return $id;   
            }
			else {
				$query2 = db::prepare("INSERT INTO airport (flight_id, capacity,flight_status, delayed_time, estimated_duration, departure_time, unit_price,date_added) VALUES(?,?,?,?,?,?,?,NOW())");
				$query2->bindValue(1, $flight_id);
				$query2->bindValue(2, $capacity);
				$query2->bindValue(3, $flight_status);
				$query2->bindValue(4, $delayed_time);
				$query2->bindValue(5, $estimated_duration);
				$query2->bindValue(6, $departure_time);
				$query2->bindValue(7, $unit_price);
	            $query2->execute();
			    $this->create($flight_id, $capacity, $flight_status, $delayed_time, $estimated_duration, $departure_time, $unit_price);
			}  

            
        }
        //Exception handing
        catch (PDOException $e){
            die($e->getMessage());
        }
        


	}
     public static function update($id, $flight_id, $capacity, $flight_status, $delayed_time, $estimated_duration, $departure_time, $unit_price){         
	    //Preparing database query
	    $query =db::prepare("UPDATE airport SET flight_id=?, capacity=?, flight_status=?, delayed_time=? AND estimated_duration=? AND departure_time=? AND unit_price=? WHERE id=?");
	                               	          
        //Binding values to query
   	    
    	$query->bindValue(1, $flight_id);
	    $query->bindValue(2, $capacity);
	    $query->bindValue(3, $flight_status);
	    $query->bindValue(4, $delayed_time);
        $query->bindValue(5, $estimated_duration);
        $query->bindValue(6, $departure_time);
        $query->bindValue(7, $unit_price);
	    $query->bindValue(8, $id);
	    
	    try{
	        $query->execute();
	        return True;	    
	    
	    }
	    catch(PDOException $e){
		    die($e->getMessage());
		}
		
	}
	public static function delete($id) {

    $query = db::prepare("DELETE FROM aiport WHERE id=?");
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