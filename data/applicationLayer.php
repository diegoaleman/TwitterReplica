<?php
	header('Content-type: application/json');
	require_once __DIR__ . '/dataLayer.php';
	
	$action = $_POST['action'];

	switch($action){
		case 'LOGIN':			loginAction();
								break;
		case 'REGISTRATION': 	registrationAction();
								break;
		case 'SAVE_TWEET': 		saveTweetAction();
								break;
		case 'GET_TWEETS': 		getTweetsAction();
								break;
		case 'GET_PROFILE': 	getProfileAction();
								break;
		case 'UPDATE_PROFILE': 	updateProfileAction();
								break;					
		case 'GET_FRIENDS': 	getFriendsAction();
								break;		
		case 'END_SESSION': 	endSession();
								break;		
		case 'CHECK_SESSION': 	checkSession();
								break;	


																												
	}




	function loginAction(){
		$email = $_POST['email'];
		$pass = $_POST['userPassword'];

		$result = login($email, $pass);

		if ($result['message'] == 'OK'){
	    	startSession($result['fName'], $result['lName'], $result['email'], $result['username']);

		    echo json_encode($result);
		}
		else{
			die(json_encode($result));
		}
	}




	function registrationAction(){
		$fName = $_POST['firstName'];
		$lName = $_POST['lastName'];
		$userName = $_POST['userName'];
		$email = $_POST['email'];
		$pass = $_POST['userPassword'];

		$result = registration($fName, $lName, $userName, $email, $pass);

		if ($result['message'] == 'OK'){
	    	startSession($fName, $lName, $email, $userName);

		    echo json_encode($result);
		}
		else{
			die(json_encode($result));
		}
	}




	function saveTweetAction(){
		session_start();

		$content = $_POST['content'];

		$result = saveTweet($_SESSION['email'], $content);

		if ($result['message'] == 'OK'){
	    	$response = array('message' => 'OK');  

		    echo json_encode($response);
		}
		else{
			die(json_encode($result));
		}

	}





	// Gets all tweets from all users
	function getTweetsAction(){
		$result = getAllTweets();
		echo json_encode($result);
	}





	function getProfileAction(){
		session_start();

		$result = getProfileInfo($_SESSION['email']);
		echo json_encode($result);
	}



	function updateProfileAction(){

		session_start();

		$fName = $_POST['fName'];
		$lName = $_POST['lName'];
		$username = $_POST['username'];
		$email = $_SESSION['email'];
		$pass = $_POST['passwrd'];
		$age = $_POST['age'];
		$description = $_POST['description'];


		$result = updateProfileInfo($email, $fName, $lName, $username, $pass, $age, $description);

		echo json_encode($result);
	}


	function getFriendsAction(){
		session_start();
		
		$result = getFriends($_SESSION['email']);
		echo json_encode($result);

	}




	function endSession(){
		session_start();
		if (isset($_SESSION['fName']) && isset($_SESSION['lName']) && isset($_SESSION['email']) && isset($_SESSION['username'])){
			unset($_SESSION['fName']);
			unset($_SESSION['lName']);
			unset($_SESSION['email']);
			unset($_SESSION['username']);
			session_destroy();
			
			echo json_encode(array('success' => 'Session deleted'));   	    
		}
		else
		{
			die(json_encode(errors(417)));
		}

	}



	function checkSession(){
		$result = getSession();
		if ($result['message'] == 'OK') {
			echo json_encode($result);
		} else {
			die (json_encode($result));
		}
	}

	

?>