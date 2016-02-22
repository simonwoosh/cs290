<?php #class passengers
class passengers {

	//returns an array of passenger objects
	public static function getAll() {
		$query = db::query("SELECT id FROM passenger");
		$passengerArray = array();
		foreach($query as $passengerRow) {
			if ($passengerRow['id']>0){
				$passengerArray[] = new passenger($passengerRow['id']);
			}
		}
		return $passengerArray;
	}
	public static function create($prefix, $first_name, $last_name, $middle_name, $suffix, $date_of_birth, $gender, $emergency_contact_phone, $emergency_contact_country, $emergency_contact_first_name, $emergency_contact_last_name) {
		//Preparing the database query
        $query = db::prepare("SELECT id FROM passenger WHERE prefix=? AND first_name=? AND last_name=? AND middle_name=? AND suffix=? AND date_of_birth=? AND gender=? AND emergency_contact_phone=? AND emergency_contact_country=? AND emergency_contact_first_name=? AND emergency_contact_last_name=?");
        //Binding $address data with prepared query
        $query->bindValue(1, $prefix);
        $query->bindValue(2, $first_name);
        $query->bindValue(3, $last_name);
        $query->bindValue(4, $middle_name);
        $query->bindValue(5, $suffix);
        $query->bindValue(6, $date_of_birth);
        $query->bindValue(7, $gender);
        $query->bindValue(8, $emergency_contact_phone);
        $query->bindValue(9, $emergency_contact_country);
        $query->bindValue(10, $emergency_contact_first_name);
        $query->bindValue(11, $emergency_contact_last_name);
        //Atempting query execution
        try{
            $query->execute();
		    $id = $query->fetchColumn();
		    if($id >= 1) {
            return $id;   
            }
			else {
				$query2 = db::prepare("INSERT INTO passenger (prefix, first_name,last_name, middle_name, suffix, date_of_birth, gender,date_added) VALUES(?,?,?,?,?,?,?,?,?,?,?,NOW())");
				$query2->bindValue(1, $prefix);
				$query2->bindValue(2, $first_name);
				$query2->bindValue(3, $last_name);
				$query2->bindValue(4, $middle_name);
				$query2->bindValue(5, $suffix);
				$query2->bindValue(6, $date_of_birth);
				$query2->bindValue(7, $gender);
				$query2->bindValue(8, $emergency_contact_phone);
				$query2->bindValue(9, $emergency_contact_country);
				$query2->bindValue(10, $emergency_contact_first_name);
				$query2->bindValue(11, $emergency_contact_last_name);
	            $query2->execute();
			    $this->create($prefix, $first_name, $last_name, $middle_name, $suffix, $date_of_birth, $gender, $emergency_contact_phone, $emergency_contact_country, $emergency_contact_first_name, $emergency_contact_last_name);
			}  

            
        }
        //Exception handing
        catch (PDOException $e){
            die($e->getMessage());
        }
        


	}
     public static function update($id, $prefix, $first_name, $last_name, $middle_name, $suffix, $date_of_birth, $gender, $emergency_contact_phone, $emergency_contact_country, $emergency_contact_first_name, $emergency_contact_last_name){         
	    //Preparing database query
	    $query =db::prepare("UPDATE passenger SET prefix=?, first_name=?, last_name=? middle_name=?, suffix=?, date_of_birth=?, gender=?, emergency_contact_phone=?, emergency_contact_country=?, emergency_contact_first_name=?, emergency_contact_last_name=? WHERE id=?");
	                               	          
        //Binding values to query
   	    
    	$query->bindValue(1, $prefix);
	    $query->bindValue(2, $first_name);
	    $query->bindValue(3, $last_name);
	    $query->bindValue(4, $middle_name);
        $query->bindValue(5, $suffix);
        $query->bindValue(6, $date_of_birth);
        $query->bindValue(7, $gender);
        $query->bindValue(8, $emergency_contact_phone);
        $query->bindValue(9, $emergency_contact_country);
        $query->bindValue(10, $emergency_contact_first_name);
        $query->bindValue(11, $emergency_contact_last_name);
	    $query->bindValue(12, $id);
	    
	    try{
	        $query->execute();
	        return True;	    
	    
	    }
	    catch(PDOException $e){
		    die($e->getMessage());
		}
		
	}
	public static function delete($id) {

    $query = db::prepare("DELETE FROM passenger WHERE id=?");
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