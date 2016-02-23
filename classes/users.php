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
    public function emailExists($email){
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
   
    
   public static function register($first_name, $last_name, $username, $password, $email){
				            
	    //Onsite variables
	    $id = NULL;
	    $password = sha1($password);
	    $confirmed = 0;
	    $confirm_code = sha1($username . "salt");
	    $date_added = date();
	    //Preparing database query
	    $query =db::prepare("INSERT INTO user (id, first_name, last_name, username, password, email,
	    										 confirmed, confirm_code, date_added) VALUES (?,?,?,?,?,?,?,?,NOW()) ");
	                               	          
        //Binding values to query
   	    $query->bindValue(1, $id);
	    $query->bindValue(2, $first_name);
	    $query->bindValue(3, $last_name);
	    $query->bindValue(4, $username);
	    $query->bindValue(5, $password);
	    $query->bindValue(6, $email);
	    $query->bindValue(7, $confirmed);
	    $query->bindValue(8, $confirm_code);
	    
	    try{
	        $query->execute();
	        //Sending the activation email
	     	$headers = 'From: noreply@ourservice.com';
	     	mail($email, ' Our Service - Please activate your account.', "Hello " . $first_name . " " . $last_name . ",\r\nThank you for registering with us. Please visit the link below so we can
	        activate your account:\r\n\r\n http://em.local/CS290/activate.php?email=" . $email . "&confirm_code=" . $confirm_code . "\r\n\r\n-- Our Service", $headers);
	    
	    
	    }
	    catch(PDOException $e){
		    die($e->getMessage());
		}
	}
	public function activate_account($email, $confirm_code) {
	
	    //Prepare query
	    $query = db::prepare("SELECT COUNT(id) FROM user WHERE email=? AND confirm_code=? AND confirmed=?");
	    //Binding values
	    $query->bindValue(1, $email);
	    $query->bindValue(2, $confirm_code);
	    $query->bindValue(3, 0);
	    
	    try{
	    //Attempting execution
	    $query->execute();
	    $rows = $query->fetchColumn();
	    
	    if ($rows == 1) {
	    $query2 = db::prepare("UPDATE user SET confirmed=? WHERE email=?");
	    $query2->bindValue(1, 1);
	    $query2->bindValue(2, $email);
	    $query2->execute();
	    return true;
	    }
	    else { return false; }
	    
	    }
	    //Exeception handling
	    catch(PDOException $e){
	        die($e->getMessage());
	    }
	 }

   public static function update($id, $first_name, $last_name, $username, $password, $email){         
	    //Preparing database query
	    $query =db::prepare("UPDATE user SET first_name=?, last_name=?, username=?, password=?, email=?
	    					 WHERE id=?");
	                               	          
        //Binding values to query
   	    
    	$query->bindValue(1, $first_name);
	    $query->bindValue(2, $last_name);
	    $query->bindValue(3, $username);
	    $query->bindValue(4, $password);
	    $query->bindValue(5, $email);
	    $query->bindValue(6, $id);
	    
	    try{
	        $query->execute();
	    
	    
	    }
	    catch(PDOException $e){
		    die($e->getMessage());
		}
		return true;
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

    public static function delete($id) {

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
		if (self::loggedIn() === false) {
			header('Location: index.php');
			exit();
		}	
	}
	    
	
		
	} 
  
       
