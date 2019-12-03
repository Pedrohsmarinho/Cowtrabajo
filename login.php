<?php 
	
include 'connect.php';
include 'init.php';


$nome = $_POST['nome']?? "";
$senha = $_POST['senha']?? "";

if($nome == "" || $senha == ""){
	echo 'Nome ou Senha Estao Vazios';
	exit();
}

$smt = $con -> prepare("SELECT nome,email  FROM usuarios WHERE nome = ? AND senha = ?");
$smt -> bindParam(1,$nome);
$smt -> bindParam(2, sha1($senha));
$smt -> execute();
$resul = $smt -> fetch();
// var_dump($resul);
if (!empty($resul)) {
	
// var_dump($resul);

	login($resul["nome"], $resul["email"]);
	//header('location: index.php');
	echo 'Login Efetuado com Sucesso';
}
else{
	echo 'Login Errado Tente Novamente';
}

?>