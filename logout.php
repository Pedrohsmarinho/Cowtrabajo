<?php 

include 'init.php';


if(logado()){
	logout();
	redirect("index.php");
}

 ?>