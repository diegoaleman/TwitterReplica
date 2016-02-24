<?php

	function connect() {
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "Twitter";

		$connection = new mysqli($servername, $username, $password, $dbname);
	
		// Check connection
		if ($connection->connect_error) 
		{
		    return null;
		}
		else
		{
			return $connection;
		}
	}

	function errors($type){
		$header = "HTTP/1.1 ";

		switch($type){
			case 500:	$header .= "500 Bad connection to Database";
						break;
			case 206:	$header .= "206 Wrong Credentials";
						break;
			case 406:	$header .= "406 User Not Found";
						break;
			case 417:	$header .= "417 No content set in the cookie/session";
						break;
			case 409: 	$header .= "409 Email already in use please select another one";
						break;
			case 410: 	$header .= "410 Username already in use please select another one";
						break;
			case 411: 	$header .= "411 User does not exist";
						break;
			default:	$header .= "404 Request Not Found";

		}

		header($header);
		return array('message' => 'ERROR', 'code' => $type);
	}



	// LOGIN
    function login($email, $pass) {
        $conn = connect();

        if ($conn != null){
        	$sql = "SELECT fName, lName, username, email, passwrd FROM Users WHERE email = '$email' AND passwrd = $pass";
			$result = $conn->query($sql);

			if ($result->num_rows > 0){
				while($row = $result->fetch_assoc()) {
		    		$response = array('message' => 'OK');   
		    	}

		    	$conn->close();
		    	return $response;
			}
			else{
				$conn->close();
				return errors(406);
			}
        }
        else{
        	$conn->close();
        	return errors(500);
        }
    }



    // REGISTRATION
    function registration($fName, $lName, $userName, $email, $pass){
    	$conn = connect();

        if ($conn != null){

        	// Error si existe usuario con mismo email
        	$sql = "SELECT email FROM Users WHERE email = '$email'";
			$result = $conn->query($sql);

			if ($result->num_rows > 0){
					return errors(409);
			}
			else{
				// Error si existe usuario con mismo username
				$sql = "SELECT username FROM Users WHERE username = '$userName'";
				$result = $conn->query($sql);

				if ($result->num_rows > 0){
					return errors(410);
				}
				// 	Si todo sale bien...
				else{
					$sql = "INSERT INTO Users (fName, lName, username, email, passwrd)
					VALUES ('$fName', '$lName', '$userName', '$email', $pass)";

					if (mysqli_query($conn, $sql)){
						$response = array('message' => 'OK'); 
					}
					else {
						return errors(500);
					}
				}
			}
        }
        else{
        	$conn->close();
        	return errors(500);
        }
    }




    function getAllTweets(){
    	$conn = connect();

    	if ($conn != null){
    		$sql = "SELECT * FROM Tweet";

    		$sql = "SELECT * FROM Tweet, Users WHERE Tweet.email = Users.email";
			$result = $conn->query($sql);

			
			$response = array();
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					array_push($response, array('tweetId' => $row['tweetId'], 'content' => $row['content'], 'likes' => $row['likes'],'email' => $row['email'], 'username' => $row['username'], 'fName' => $row['fName'] ,'lName' => $row['lName']));
				}

				return $response;
			}
			else {
				$conn->close();
				return $response; // no existen items
			}
    	}
    	else {
    		$conn->close();
        	return errors(500);
    	}


    }


    function saveTweet($email, $content){
    	$conn = connect();

        if ($conn != null){

        	// Error si existe usuario con mismo email
        	$sql = "SELECT email FROM Users WHERE email = '$email'";
			$result = $conn->query($sql);

			if ($result->num_rows > 0){
									// Error si existe usuario con mismo username
				
				$sql = "INSERT INTO Tweet (content, likes, email)
				VALUES ('$content', 0, '$email')";

				if (mysqli_query($conn, $sql)){
					$response = array('message' => 'OK'); 
				}
				else {
					return errors(500);
				}
			
			}
			else{
				$conn->close();
				return errors(411);

			}
        }
        else{
        	$conn->close();
        	return errors(500);
        }
    }
    
?>
