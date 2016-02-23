<?php #class airports
class airports {

	//returns an array of airport objects
	public static function getAll() {
		$query = db::query("SELECT id FROM airport");
		$airportArray = array();
		foreach($query as $airportRow) {
			if ($airportRow['id']>0){
				$airportArray[] = new airport($airportRow['id']);
			}
		}
		return $airportArray;
	}

	public static function create($name, $code, $timezone) {
		//Preparing the database query
        $query = db::prepare("SELECT id FROM airport WHERE name=? AND code=? AND timezone=?");
        //Binding $address data with prepared query
        $query->bindValue(1, $name);
        $query->bindValue(2, $code);
        $query->bindValue(3, $timezone);
        //Atempting query execution
        try{
            $query->execute();
		    $id = $query->fetchColumn();
		    if($id >= 1) {
            return $id;   
            }
			else {
				$query2 = db::prepare("INSERT INTO airport (name, code,timezone,date_added) VALUES(?,?,?,NOW())");
				$query2->bindValue(1, $name);
				$query2->bindValue(2, $code);
				$query2->bindValue(3, $timezone);
	            $query2->execute();
			    $this->create($name, $code, $timezone);
			}  

            
        }
        //Exception handing
        catch (PDOException $e){
            die($e->getMessage());
        }
        


	}
     public static function update($id, $name, $code, $timezone){         
	    //Preparing database query
	    $query =db::prepare("UPDATE airport SET name=?, code=?, timezone=? WHERE id=?");
	                               	          
        //Binding values to query
   	    
    	$query->bindValue(1, $name);
	    $query->bindValue(2, $code);
	    $query->bindValue(3, $timezone);
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

    $query = db::prepare("DELETE FROM airport WHERE id=?");
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