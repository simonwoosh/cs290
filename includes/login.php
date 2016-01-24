<?php #Login

		if(isset($_POST['login'])) {
			
		    $username = trim($_POST['username']);
		    $password = trim($_POST['password']);


		    

		   
		        $postElements = array( "Username" => $username, "Password" => $password);
		        foreach ($postElements as $identifier => $postElement) {
		            if(empty($postElement) == true) {
		                $errors[] = 'You haven\'t filled in the ' . $identifier . ' field.';
		            }
		        }
		        
		        
		      
		        if(empty($errors) == true){
		        	
		        	$userID = users::login($username, $password);
		        	
		            if ($userID == false) {
		                $errors[] = 'Sorry your username & password do not match.';
		            }       
		      
		            else {
		          	//Creating session and assigning id.
		            $_SESSION['id'] = $userID;
		            // Sending user to home
		            header('Location: main.php');



		            }
		            
		        }
		    
		    
			//Error displayer
		    if(empty($errors) === false){
		        echo '<p>' . implode('</p><p>', $errors) . '</p>';
		    }

		}

?>