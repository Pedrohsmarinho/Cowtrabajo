<?php 
include 'connect.php';
include 'init.php';

if (logado()){
   
    $id = $_GET['rm'];
    
    $smt = $con -> prepare("DELETE FROM reservas WHERE id = ? AND usuario_id = ?");
    $smt -> execute([$id,id()['id']]);
    var_dump($id);
    var_dump(id()['id']);  
}

header('location:index.php');
?>