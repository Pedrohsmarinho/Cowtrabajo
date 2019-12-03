<?php 

include 'init.php';
include 'connect.php';

$user = $_POST['usuario_id'];
$dia = $_POST['dia_da_semana'];
$turno = $_POST['turnos_id'];
//var_dump($dia);
//var_dump($turno);
try {
	$smt = $con -> prepare("INSERT into reservas(usuario_id, dia_da_semana, turno_id) values (?,?,?)");
	$smt -> execute([id()['id'], $dia, $turno]);
	$id = $smt -> fetch();

header('location:index.php');
} catch (Exception $e) {
	$e -> getMessage();
}
?>