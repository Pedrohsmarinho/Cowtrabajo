<?php 
	
include 'connect.php';
session_start();

	function logado(){
		return $_SESSION['logado']?? false;
	
	}

	function login($name, $email){
		$_SESSION['logado'] = true;
		$_SESSION['nome'] = $name;
		$_SESSION['email'] =  $email;
		return true;
	}
	
	function redirect($url){
		header('location:' . $url);
		exit();
	}	
	function logout(){
		session_destroy();
	}
	function dias($el){
		$dias = [1 => 'segunda', 2 => 'terça', 3 => 'quarta', 4 => 'quinta', 5 => 'sexta'];

		return $dias[$el];
}
	function id(){
		global $con;
		$stmt = $con -> prepare ('SELECT id FROM usuarios WHERE nome = ?');
		$stmt -> bindParam(1,$_SESSION['nome']);
		$stmt -> execute();
		$click = $stmt -> fetch();
//var_dump($click);
		return $click;
	}

?>