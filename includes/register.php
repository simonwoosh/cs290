<?php #register Action
//Checking submission
if(isset($_POST['submit'])) {
	//Validation
		//Check user's existence 
		if (users::userExists($_POST['username']) === true) {
			$errors[] = 'That username already exists on our system.';
		}
		//Checking the username is between 6 and 15 characters
		if (strlen($_POST['username']) < 6 || strlen($_POST['username']) > 15 ){
		    $errors[] = 'Your username must be between 6 and 15 characters long.';
		} 	
		//Checking to see if the passwords are the same
		if($_POST['confirm_password'] !== $_POST['password']) {
		    $errors[] = 'The passwords you have entered do not match.';
		}
		
		if($_POST['username'] == $_POST['password']) {
		    $errors[] = 'Your username and password can not be the same.';
		}
		
		//Checking the password is between 6 and 18 characters
		if (strlen($_POST['password']) < 6 || strlen($_POST['password']) > 18 ){
		    $errors[] = 'Your password must be between 6 and 18 characters long.';
		} 
		
		if (users::emailExists($_POST['email']) == true) {
		    $errors[] = 'That email already exists on our system.';
		}

		if (strlen($_POST['first_name']) > 35){
		    $errors[] = 'Your first name must be less than 35 characters.';
		} 
		if (strlen($_POST['last_name']) > 35){
		    $errors[] = 'Your last name must be less than 35 characters.';
		} 

		$postElements = array( "Username" => $_POST['username'], "Password" => $_POST['password'],
							   "First name" => $_POST['first_name'], "Last name" => $_POST['last_name'],
							   "Email" => $_POST['email'], "Confirmation Password" => $_POST['confirm_password']);

		foreach ($postElements as $identifier => $postElement) {
			if(empty($postElement) == true) {
				$errors[] = 'You haven\'t filled in the ' . $identifier . ' field.';
			}
		}
		
		//Error displayer
        if(empty($errors) == false){
	        echo '<p>' . implode('</p><p>', $errors) . '</p>';
        }


	//Checking if error array is empty
	 if(empty($errors) == true) {
		//Assign post variables and stripping 
		$username = htmlentities($_POST['username']);
		$password = $_POST['password'];
		$email	  = htmlentities($_POST['email']);
		$first_name = htmlentities($_POST['first_name']);
		$last_name = htmlentities($_POST['last_name']);
		
		
		//Register function
		users::register($first_name, $last_name, $username, $password, $email);
		
		//Header change for sucessful sign up
		header('Location: register.php?success');
		exit();
		
	}
	
	
}


if (isset($_GET['success']) && empty($_GET['success'])) {
	echo 'You have signed up successfully, feel free to login <a href="login.php">here</a>.';
}	
	

	


 
