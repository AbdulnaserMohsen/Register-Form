<?php 
	
	//$name_ar=$name_en=$email=$phone=$country=$state=$city=$address=$gender=$password=$confirm=$agree="";
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$name_ar = $_POST['name_ar'];
		$name_en = $_POST['name_en'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$country = $_POST['country'];
		$state = $_POST['state'];
		$city = $_POST['city'];
		$address = $_POST['address'];
		$gender = $_POST['gender'];
		$password = $_POST['password'];
		$confirm = $_POST['confirm-password'];
		$agree = $_POST['agree'];
		
		//echo $name_ar,$name_en,$email,$phone,$country,$state,$city,$address,$gender,$password,$confirm,$agree;
		$inputs=['name_ar'=>$name_ar,'name_en'=>$name_en,'email'=>$email,'phone'=>$phone,'country'=>$country,'state'=>$state,'city'=>$city,'address'=>$address,'gender'=>$gender,'password'=>$password,'confirm'=>$confirm,"agree"=>$agree];
		
		$errors=['name_ar'=>false,'name_en'=>false,'email'=>false,'phone'=>false,'country'=>false,'state'=>false,'city'=>false,'address'=>false,'gender'=>false,'password'=>false,'confirm'=>false,"agree"=>false];
		
		$error_message=['name_ar'=>"",'name_en'=>"",'email'=>"",'phone'=>"",'country'=>"",'state'=>"",'city'=>"",'address'=>"",'gender'=>"",'password'=>"",'confirm'=>"","agree"=>""];
		
		if(validate($inputs,$errors,$error_message))
		{
			$password = password_hash($password,PASSWORD_DEFAULT);
			require_once("db_connection.php");
			$connection = open_connection();
			
			$add_user_query = "INSERT INTO users ";
			$add_user_query .= " (name_ar, name_en, email, phone, ";
			$add_user_query .= "  address, country, state, city, gender, ";
			$add_user_query .= "  password, type)";
			$add_user_query .= " VALUES ('$name_ar', '$name_en', '$email',";
			$add_user_query .= " '$phone', '$address', '$country',";
			$add_user_query .= " '$state', '$city', '$gender', '$password', 1)";
			
			$execute_query = mysqli_query($connection,$add_user_query);
			
			if(!$execute_query)
			{
				echo "there is an error : ".mysqli_error($connection)." number: ".mysqli_errno($connection);
				//exit("there is an error : ".mysqli_error($connection)." number: ".mysqli_errno($connection));
			}
			else
			{
				//echo "success";
				header( 'Location: success.php' );
			}
			
			
		}
		
	}
	
	
	
	
	
	//vallidations
	function validate($inputs,&$errors,&$error_message) 
	{
		$valid = true;
		foreach($inputs as $key => $value)
		{
			//echo $key;
			if($key=="name_ar")
			{
				validator($value,"/\p{Arabic}/u",$errors[$key],$valid);
			}
			if($key=="name_en")
			{
				validator($value,"/^[a-zA-Z ]+$/",$errors[$key],$valid);
			}
			if($key=="email")
			{
				validator($value,"/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/",$errors[$key],$valid);
				if($valid)
				{
					if(!is_email_unique($value))
					{
						$valid =false;
						$errors[$key]=true;
						$error_message['email'] ="This email is already exists";
					}
				}
			}
			if($key=="phone")
			{
				validator($value,"/^\+?\d{10,}$/",$errors[$key],$valid);
			}
			if($key=="country")
			{
				if(empty(trim($value))) 
				{
					$errors[$key] =true;
					$valid = false;
				}
			}
			if($key=="state")
			{
				if(empty(trim($value))) 
				{
					$errors[$key] =true;
					$valid = false;
				}
			}
			if($key=="city")
			{
				if(empty(trim($value))) 
				{
					$errors[$key] =true;
					$valid = false;
				}
			}
			if($key=="address")
			{
				validator($value,"/^([\p{Arabic}0-9\-, ]{3,})|([a-zA-Z0-9\-, ]{3,})+$/u",$errors[$key],$valid);
			}
			if($key=="gender")
			{
				if(empty(trim($value))) 
				{
					$errors[$key] =true;
					$valid = false;
				}
			}
			if($key=="password")
			{
				if(empty(trim($value)) || strlen(trim($value))<8) 
				{
					$errors[$key] =true;
					$valid = false;
				}
				//validator($value,"/^{8,}$/",$errors[$key]);
			}
			if($key=="confirm")
			{
				if(empty(trim($value))) 
				{
					$errors[$key] =true;
					$valid = false;
				}
				else if($value != $inputs['password'])
				{ 
					$errors[$key]=true;
					$valid = false;
				}
			}
			if($key=="agree")
			{
				if(empty(trim($value))) 
				{
					$errors[$key] =true;
					$valid = false;
				}
			}
		}
		return $valid;
	}
	function validator($value,$preg,&$error_state,&$valid)
	{
		if(empty(trim($value)) || !preg_match($preg,$value)) 
		{
			$error_state =true;
			$valid=false;
		}
		else
		{
			$error_state =false;
		}
	}
	function is_email_unique($email)
	{
		require_once("db_connection.php");
		$connection = open_connection();
		$exists_email = "SELECT * from users where email = '$email' ";
			
		$execute_query = mysqli_query($connection,$exists_email);
		
		if(!$execute_query)
		{
			echo "there is an error : ".mysqli_error($connection)." number: ".mysqli_errno($connection);
		}
		else
		{
			$num_rows = mysqli_num_rows($execute_query);
			if($num_rows >= 1)
			{
				return false;
			}
			return true;
		}
		
	}
	
	
?>
