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
		
		validate($inputs,$errors);
		
	}
	
	
	
	
	
	//vallidations
	function validate($inputs,&$errors) 
	{
		foreach($inputs as $key => $value)
		{
			echo $key;
			if($key=="name_ar")
			{
				validator($value,"/\p{Arabic}/u",$errors[$key]);
			}
			if($key=="name_en")
			{
				validator($value,"/^[a-zA-Z ]+$/",$errors[$key]);
			}
			if($key=="email")
			{
				validator($value,"/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/",$errors[$key]);
			}
			if($key=="phone")
			{
				validator($value,"/^\+?\d{10,}$/",$errors[$key]);
			}
			if($key=="country")
			{
				if(empty(trim($value))) 
				{
					$errors[$key] =true;
				}
			}
			if($key=="state")
			{
				if(empty(trim($value))) 
				{
					$errors[$key] =true;
				}
			}
			if($key=="city")
			{
				if(empty(trim($value))) 
				{
					$errors[$key] =true;
				}
			}
			if($key=="address")
			{
				validator($value,"/^([\p{Arabic}0-9\-, ]{3,})|([a-zA-Z0-9\-, ]{3,})+$/u",$errors[$key]);
			}
			if($key=="gender")
			{
				if(empty(trim($value))) 
				{
					$errors[$key] =true;
				}
			}
			if($key=="password")
			{
				if(empty(trim($value)) || strlen(trim($value))<8) 
				{
					$errors[$key] =true;
				}
				//validator($value,"/^{8,}$/",$errors[$key]);
			}
			if($key=="confirm")
			{
				if(empty(trim($value))) 
				{
					//echo$value;
					$errors[$key] =true;
				}
				else if($value != $inputs['password'])
				{ 
					echo$value; 
					$errors[$key]=true;
				}
			}
			if($key=="agree")
			{
				if(empty(trim($value))) 
				{
					$errors[$key] =true;
				}
			}
			
			
		}
	}
	function validator($value,$preg,&$error_state)
	{
		if(empty(trim($value)) || !preg_match($preg,$value)) 
		{
			$error_state =true;
		}
		else
		{
			$error_state =false;
		}
	}
	
	
?>
