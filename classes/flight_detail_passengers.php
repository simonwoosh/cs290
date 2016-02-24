<?php #class flight_detail_passengers
class flight_detail_passengers {

	//returns an array of flight_detail_passenger objects
	public static function getAll() {
		$query = db::query("SELECT id FROM flight_detail_passenger");
		$flight_detail_passengerArray = array();
		foreach($query as $flight_detail_passengerRow) {
			if ($flight_detail_passengerRow['id']>0){
				$flight_detail_passengerArray[] = new flight_detail_passenger($flight_detail_passengerRow['id']);
			}
		}
		return $flight_detail_passengerArray;
	}
	public static function passengers_on_flight($fd_id){
		$query = db::prepare("SELECT count(p_id) FROM flight_detail_passenger WHERE fd_id=?");
		$query = bindValue(1, $fd_id);
		try {
			$query->execute();
			$count = $query->fetchColumn;
			return $count;

		}
        //Exception handing
        catch (PDOException $e){
            die($e->getMessage());
        }
        
	}
	public static function create($fd_id, $p_id, $p_seat) {
		//Preparing the database query
        $query = db::prepare("SELECT id FROM flight_detail_passenger WHERE fd_id=? AND p_id=? AND p_seat=?");
        //Binding $address data with prepared query
        $query->bindValue(1, $fd_id);
        $query->bindValue(2, $p_id);
        $query->bindValue(3, $p_seat);
        //Atempting query execution
        try{
            $query->execute();
		    $id = $query->fetchColumn();
		    if($id >= 1) {
            return $id;   
            }
			else {
				$query2 = db::prepare("INSERT INTO flight_detail_passenger (fd_id, p_id, p_seat, date_added) VALUES(?,?,?,NOW())");
				$query2->bindValue(1, $fd_id);
				$query2->bindValue(2, $p_id);
				$query2->bindValue(3, $p_seat);
	            $query2->execute();
			    $this->create($fd_id, $p_id, $p_seat);
			}  

            
        }
        //Exception handing
        catch (PDOException $e){
            die($e->getMessage());
        }
        


	}
     public static function update($id, $fd_id, $p_id, $p_seat){         
	    //Preparing database query
	    $query =db::prepare("UPDATE flight_detail_passenger SET fd_id=?, p_id=?, p_seat=? WHERE id=?");
	                               	          
        //Binding values to query
   	    
    	$query->bindValue(1, $fd_id);
	    $query->bindValue(2, $p_id);
	    $query->bindValue(3, $p_seat);
	    $query->bindValue(4, $id);
	    
	    try{
	        $query->execute();
	        return True;	    
	    
	    }
	    catch(PDOException $e){
		    die($e->getMessage());
		}
		
	}
	public static function delete($id) {

    $query = db::prepare("DELETE FROM flight_detail_passenger WHERE id=?");
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