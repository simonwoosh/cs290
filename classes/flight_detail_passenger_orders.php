<?php #class flight_detail_passenger_orders
class flight_detail_passenger_orders {

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
	public static function create($fdp_id, $o_id) {
		//Preparing the database query
        $query = db::prepare("SELECT id FROM flight_detail_passenger_order WHERE fdp_id=? AND o_id=?");
        //Binding $address data with prepared query
        $query->bindValue(1, $fdp_id);
        $query->bindValue(2, $o_id);
        //Atempting query execution
        try{
            $query->execute();
		    $id = $query->fetchColumn();
		    if($id >= 1) {
            return $id;   
            }
			else {
				$query2 = db::prepare("INSERT INTO flight_detail_passenger_order (fdp_id, o_id,date_added) VALUES(?,?,,NOW())");
				$query2->bindValue(1, $fdp_id);
				$query2->bindValue(2, $o_id);
	            $query2->execute();
			    $this->create($fdp_id, $o_id);
			}  

            
        }
        //Exception handing
        catch (PDOException $e){
            die($e->getMessage());
        }
        


	}
     public static function update($id, $fdp_id, $o_id){         
	    //Preparing database query
	    $query =db::prepare("UPDATE flight_detail_passenger_order SET fdp_id=?, o_id=? WHERE id=?");
	                               	          
        //Binding values to query
   	    
    	$query->bindValue(1, $fdp_id);
	    $query->bindValue(2, $o_id);
	    $query->bindValue(3, $id);
	    
	    try{
	        $query->execute();
	        return True;	    
	    
	    }
	    catch(PDOException $e){
		    die($e->getMessage());
		}
		
	}
	public static function delete($id) {

    $query = db::prepare("DELETE FROM flight_detail_passenger_order WHERE id=?");
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