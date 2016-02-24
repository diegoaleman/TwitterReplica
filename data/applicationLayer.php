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
		case 'ADD_FRIEND': 		addFriendAction();
								break;																							
	}




	function loginAction(){
		$email = $_POST['email'];
		$pass = $_POST['userPassword'];

		$result = login($email, $pass);

		if ($result['message'] == 'OK'){
		    
	    	$response = array('message' => 'OK');  

		    echo json_encode($response);
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
		    
	    	$response = array('message' => 'OK');  

		    echo json_encode($response);
		}

		else{
			die(json_encode($result));
		}
	}




	function saveTweetAction(){

		$email = $_POST['email'];
		$content = $_POST['content'];


		$result = saveTweet($email, $content);

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

	}





	function addFriendAction(){

	}

	

?>