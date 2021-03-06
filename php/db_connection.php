<?php 

	
	define("DB_SERVER","localhost");
	define("DB_USER","root");
	define("DB_PASS","");
	define("DB_DATABASE","kohli");
	
	//function to open connection with database 
	function open_connection()
	{
		$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_DATABASE);
		
		if(mysqli_connect_errno())
		{
			$errorMessage = "Database connection failed : ". mysqli_connect_error . " and mysql error number : ".mysqli_connect_errno();
			exit($errorMessag);
		}
		
		return $connection;
	}
	
	
	function close_connection($connection)
	{
		if(isset($connection))
		{
			mysqli_close($connection);
		}
	}






?>
