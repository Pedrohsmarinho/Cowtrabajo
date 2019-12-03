<?php 

include "connect.php";
include "init.php";

$nome = $_POST['nome']?? "";
$curso = $_POST['cursos']?? "";
$matricula = $_POST['matricula']?? "";
$mac = $_POST['mac']?? "";
$email = $_POST['email']?? "";
$senha = $_POST['senha']?? "";
$senha2 = $_POST['senha2']?? "";

if($senha != $senha2){
	echo 'As senhas nao podem ser diferentes';

}
if($nome == "" || $email == ""){
	echo 'Campos Vazios';
}

else{
	try {
		
		$smt = $con -> prepare("INSERT INTO usuarios(nome,curso_id,matricula,mac,email,senha) VALUES (?,?,?,?,?,?)");
		$smt -> bindParam(1,$nome);
		$smt -> bindParam(2,$curso);
		$smt -> bindParam(3,$matricula);
		$smt -> bindParam(4,$mac);
		$smt -> bindParam(5,$email);
		$smt -> bindParam(6,sha1($senha));
		$smt -> execute();
		
		// var_dump($smt->errorInfo());Example

		echo 'Usuario Cadastrado';

	} catch (Exception $e) {
		var_dump($e -> getMessage());
	}
}
//var_dump([$nome,$curso,$matricula,$mac,$email,$senha]);
?>