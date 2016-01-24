<?php #class users
class users {

	//returns an array of user objects
	public static function getAll() {
		$query = db::query("SELECT id FROM user");
		$userArray = array();
		foreach($query as $userRow) {
			if ($userRow['id']>0){
				$userArray[] = new user($userRow['id']);
			}
		}
		return $userArray;
	}
    //Defining username check function
    public static function userExists($username) {
        //Preparing the database query
        $query = db::prepare("SELECT COUNT(id) FROM user WHERE username=?");
        //Binding $username with prepared query
        $query->bindValue(1, $username);
        //Atempting query execution
        try{
            $query->execute();
            //Assigning database records to $rows
            $rows = $query->fetchColumn();
            //Checking if the amount of rows returned are equal to one
            if($rows == 1){
                return true;
            }
            else{
                return false;
            }
            
        }
        //Exception handling
        catch (PDOException $e){
            die($e->getMessage());
        }
    }
    //Email exists
  	public static function emailExists($email){
        //Preparing the database query
        $query = db::prepare("SELECT COUNT(id) FROM user WHERE email=?");
        //Binding $email with prepared query
        $query->bindValue(1, $email);
        //Attempting query execution
        try{
            $query->execute();
            //Assigning database records to $rows
            $rows = $query->fetchColumn();

            //Checking if the amount of rows returned are equal to one
            if($rows == 1){
                return true;
            }
            else{
                return false;
            }
        }
        //Exception handling
        catch (PDOException $e){
            die($e->getMessage());
        }
    }
    //Register
    public static function register($username, $password, $first_name,
				            $last_name, $email){
				            

	    //Onsite variables
	    $id = 'NULL';
	    $password = sha1($password);
	    $date_added = date('Y-m-d H:i:s');
	    
	    //Preparing database query
	    $query =db::prepare("INSERT INTO user (id, username, password, 
	                                      first_name, last_name, email, date_added) VALUES (?,?,?,?,?,?,?) ");
	                               	          
        //Binding values to query
	    $query->bindValue(1,  $id);
	    $query->bindValue(2,  $username);
	    $query->bindValue(3,  $password);
	    $query->bindValue(4,  $first_name);
	    $query->bindValue(5,  $last_name);
	    $query->bindValue(6,  $email);
	    $query->bindValue(7,  $date_added);
	    
	    try{
	        $query->execute();
	    
	    
	    }
	    catch(PDOException $e){
		    die($e->getMessage());
		}
	}	
   
    
	
	 
	//Defining login static function 
	public static function login($username, $password) {
 
	$query = db::prepare("SELECT password, id FROM user WHERE username=?");
	$query->bindValue(1, $username);
	
	try{
		
		    $query->execute();
		    $data 				= $query->fetch();
		    $stored_password 	= $data['password'];
		    $id 				= $data['id'];
		
		    #hashing the supplied password and comparing it with the stored hashed password.
		    if($stored_password === sha1($password)){
		    	return $id;   
			  }
		    else if ($stored_password !== sha1($password)) {
		        return false; 
		         }
		   
		}
 
	    catch(PDOException $e){
		    die($e->getMessage());
	    }
    }

    public static function deleteUser($id) {

    $query = db::prepare("DELETE FROM user WHERE id=?");
	$query->bindValue(1, $id);
	
	try{
		
		    $query->execute();
		    return 'Successfully Deleted';
		   
		}
 
	    catch(PDOException $e){
		    die($e->getMessage());
	    }
    }


    //Checking to see if session variable is hot
    public static function loggedIn() {
    	if(isset($_SESSION['id'])) {
    		return true;
    	}
    	else {
    		return false;
    	}
    	
		
	}
	
	// Protecting area
	public static function protectArea() {
		if (self::loggedIn() == false) {
			header('Location: index.php');
			exit();
		}	
	}
	    
	
		
	} 
  
       
