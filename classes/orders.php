<?php #class orders
class orders {

	//returns an array of order objects
	public static function getAll() {
		$query = db::query("SELECT id FROM order");
		$orderArray = array();
		foreach($query as $orderRow) {
			if ($orderRow['id']>0){
				$orderArray[] = new order($orderRow['id']);
			}
		}
		return $orderArray;
	}
	public static function create($user_id, $booking_code, $total_cost, $payment_confirmed) {
		//Preparing the database query
        $query = db::prepare("SELECT id FROM airport WHERE user_id=? AND booking_code=? AND total_cost=? AND payment_confirmed=?");
        //Binding $address data with prepared query
        $query->bindValue(1, $user_id);
        $query->bindValue(2, $booking_code);
        $query->bindValue(3, $total_cost);
        $query->bindValue(4, $payment_confirmed);
        //Atempting query execution
        try{
            $query->execute();
		    $id = $query->fetchColumn();
		    if($id >= 1) {
            return $id;   
            }
			else {
				$query2 = db::prepare("INSERT INTO airport (user_id, booking_code,total_cost,date_added) VALUES(?,?,?,?,NOW())");
				$query2->bindValue(1, $user_id);
				$query2->bindValue(2, $booking_code);
				$query2->bindValue(3, $total_cost);
				$query2->bindValue(4, $payment_confirmed);
	            $query2->execute();
			    $this->create($user_id, $booking_code, $total_cost, $payment_confirmed);
			}  

            
        }
        //Exception handing
        catch (PDOException $e){
            die($e->getMessage());
        }
        


	}
     public static function update($user_id, $booking_code, $total_cost, $payment_confirmed){         
	    //Preparing database query
	    $query =db::prepare("UPDATE airport SET user_id=?, booking_code=?, total_cost=?, payment_confirmed=? WHERE id=?");
	                               	          
        //Binding values to query
   	    
    	$query->bindValue(1, $user_id);
	    $query->bindValue(2, $booking_code);
	    $query->bindValue(3, $total_cost);
	    $query->bindValue(3, $payment_confirmed);
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