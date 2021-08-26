<?php
require_once "db_config.php";
require_once "functions_def.php";
require_once "../db.php";

session_start();


if(isset($_POST['registerbutton'])){
    $firstname =  $_POST['firstname'];
    $lastname =  $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $dentist = $_POST['dentist'] ?? NULL;
    $dentist_name = $_POST['dentist_name'];
    $specialization = $_POST['specialization'];

    $pass_hash = password_hash($password, PASSWORD_DEFAULT);

    $type = 2;
    if($dentist == '1'){
        $type = 3;
    }

    if(empty($firstname)||empty($lastname)){
        redirection('index.php?r=15');
    }
    else if(empty($email)){
        redirection('index.php?r=8');
    }
    else if(!preg_match("/^[.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+.)+[a-zA-Z]{2,6}$/i", $email)){
        redirection('index.php?r=8');
    }
    else if($password == ""){
        redirection('index.php?r=15');
    }
    else{
		if(!existsUser($email)) {
        	$code = createCode(40);
        	$sql_insert_registration = "INSERT INTO users (firstname,lastname, user_type, email, password, phone, code,registration_expires)
        	values (:fname, :lname,:type, :email, :passw, :phone, :code, DATE_ADD(now(),INTERVAL 1 DAY))";
        	$query = $conn -> prepare($sql_insert_registration);
        	$query->bindValue(':fname',$firstname);
        	$query->bindValue(':lname',$lastname);
        	$query->bindValue(':type',$type);
        	$query->bindValue(':phone',$phone);
        	$query->bindValue(':passw',$pass_hash);
        	$query->bindValue(':email',$email);
   			$query->bindValue(':code',$code);

        	$query -> execute();

        	$lastInsertID = $conn -> lastInsertID();
        	
        	if($lastInsertID >= 0){
            	if($type == 3){
					$fileName = "team-1.jpg";
					if($_FILES['picture']['name'] != ''){
						$test = explode('.', $_FILES['picture']['name']);
						$extension = end($test);    
						$name = rand(100,999).'.'.$extension;
					
						$location = '../uploads/'.$name;
						move_uploaded_file($_FILES['picture']['tmp_name'], $location);
					
						$fileName = $name;
					}
                	$sql_insert_registration = "INSERT INTO dentists (id, name, specialization, picture)
                	values (:user_id,:name, :spec, :picture)";
                	$query = $conn -> prepare($sql_insert_registration);
                	$query->bindValue(':name',$dentist_name);
                	$query->bindValue(':spec',$specialization);
                	$query->bindValue(':user_id',$lastInsertID);
					$query->bindValue(':picture',$fileName);
                	$query -> execute();
            	}
            	sendData($firstname,$email,$code);
            	redirection('index.php?r=3');
        	} else{
            	redirection('index.php?r=15'); 
        	}
        } else{
        	redirection('index.php?r=2');
        }
    }
   	redirection('index.php?r=16');
}

?>