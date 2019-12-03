<?php 

	$user = "ph";
	$password = "Parzival@29";

	global $con;

	try{
		$con = new PDO('mysql:host=localhost:3306;dbname=web20192coworking;charset=utf8', 'ph', 'Parzival@29');
	}
	catch(PDOException $e){
		$e -> getMessage();
	}


?>