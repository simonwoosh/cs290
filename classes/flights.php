<?php #class flights
class flights {

	//returns an array of flight objects
	public static function getAll() {
		$query = db::query("SELECT id FROM flight");
		$flightArray = array();
		foreach($query as $flightRow) {
			if ($flightRow['id']>0){
				$flightArray[] = new flight($flightRow['id']);
			}
		}
		return $flightArray;
	}
	public static function getFlight_by_locations($from_location, $to_location){
		$query = db::prepare("SELECT id FROM flight WHERE start_location=? AND end_location=?")
		$query->bindValue(1, $from_location);
		$query->bindValue(2, $to_location);
		$query->execute();
		$id = $query->fetchColumn();
		return $id;
	}
	public static function create($start_location, $end_location) {
		//Preparing the database query
        $query = db::prepare("SELECT id FROM flight WHERE start_location=? AND end_location=?");
        //Binding $address data with prepared query
        $query->bindValue(1, $start_location);
        $query->bindValue(2, $end_location);
        //Atempting query execution
        try{
            $query->execute();
		    $id = $query->fetchColumn();
		    if($id >= 1) {
            return $id;   
            }
			else {
				$query2 = db::prepare("INSERT INTO flight (start_location, end_location,date_added) VALUES(?,?,,NOW())");
				$query2->bindValue(1, $start_location);
				$query2->bindValue(2, $end_location);
	            $query2->execute();
			    $this->create($start_location, $end_location);
			}  

            
        }
        //Exception handing
        catch (PDOException $e){
            die($e->getMessage());
        }
        


	}
     public static function update($id, $start_location, $end_location){         
	    //Preparing database query
	    $query =db::prepare("UPDATE flight SET start_location=?, end_location=? WHERE id=?");
	                               	          
        //Binding values to query
   	    
    	$query->bindValue(1, $start_location);
	    $query->bindValue(2, $end_location);
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

    $query = db::prepare("DELETE FROM flight WHERE id=?");
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