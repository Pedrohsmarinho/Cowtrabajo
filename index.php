<?php 
	
include 'init.php';
include 'connect.php';

if (!empty($_SESSION['nome'])) {
	$smt = $con -> prepare("SELECT id FROM USER WHERE USR_NAME = ?");
	$smt -> bindParam(1,$_SESSION['nome']);
	$smt -> execute();
	$resul = $smt -> fetch();
}
	$pp = $con -> prepare("SELECT * FROM cursos");
	$pp -> execute();
	$results = $pp -> fetchAll();

	$time = $con -> prepare("SELECT * FROM reservas");
	$time -> execute();
	$over = $time -> fetchAll();


	$os = $con -> prepare(" SELECT cursos.nome as curso, usuarios.id as usuario_id, usuarios.nome as usuario_nome,reservas.dia_da_semana,turnos.nome as turno_nome,reservas.id as id
    FROM reservas JOIN usuarios ON usuarios.id = reservas.usuario_id JOIN turnos ON turnos.id = reservas.turno_id JOIN cursos ON cursos.id = usuarios.curso_id
    ORDER BY reservas.dia_da_semana,turnos.hora_inicial,usuarios.nome");
	$os -> execute();
	$on = $os->fetchAll();
//var_dump($on);
	$temp = $con -> prepare ("SELECT * FROM turnos");
	$temp -> execute();
	$poster = $temp -> fetchAll();
//var_dump($poster);
?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>Coworking</title>
 	<link rel="stylesheet" href="css/index.css">
 	<script src="jquery-3.4.1.min.js"></script>
 </head>
 <body>



 	<?php if(logado()): ?>
 		<div class="user">
			<h4><?= $_SESSION['nome'] ?></h4>
 			<a class="sair" href="logout.php">Sair</a>
		</div>
	<?php endif ?>

 	<h3>Reserve seus Horarios</h3>
	<?php if(logado()): ?>		
 		<div class="reserva.php">
			<form id="" action="reserva.php" method="POST">
				<select name="dia_da_semana">
				<option value=""selected>Escolha o dia da Semana</option>
				<option value="0">Domingo</option>
				<option value="1">Segunda-Feira</option>
				<option value="2">Terça-Feira</option>
				<option value="3">Quarta-Feira</option>
				<option value="4">Quinta-Feira</option>
				<option value="5">Sexta-Feira</option>
				<option value="6">Sábado</option>
				</select>
				<select name="turnos_id">
				<option value="" selected>Selecione um turno</option>
			   <?php foreach ($poster as $os):?>
			   <option value="<?= $os['id']?>"><?=$os['nome']?></option>
			   <?php endforeach?>
			 
				
				<input type="submit" name="" value="Adicionar" >	
			</form>
		
		</div>
	<?php else:?>
		<div class="msg-div">
			<p class="msg" ></p>
		</div>
		
		<div class="login">
		<h1>Entrar:</h1>
			<form id="login" action="login.php" method="POST">
				<input class="ipt" type="text" name="nome" placeholder="Nome" maxlength="50">
				<input class="ipt" type="password" name="senha" placeholder="Password" maxlength="9">
				<input type="submit" name="Entrar" value="Entrar">
			</form>
		</div>
		<div class="cadastrar">
			<h1>Cadastrar:</h1>
			<form action="cadastrar.php" method="POST">
			<input type="text" name="nome" placeholder="Nome">
			<select name="cursos" id="cell">
			<option value="" selected>selecione o curso</option>
			<?php foreach ($results as $os):?>
			<option value="<?= $os['id']?>"><?=$os['nome']?></option>
			<?php endforeach?>
			</select>
			<input type="text" name="matricula" placeholder="Matricula">
			<input type="text" name="mac"placeholder="Mac">
			<input type="email" name="email"placeholder="email">
			<input type="password" name="senha"placeholder="senha">	
			<input type="password"name="senha2"placeholder="confirm senha">
			<input type="submit" name="Cadastrar">
			</form>
		</div>
 	<?php endif ?>

 	<table>
 		<thead>
 			<tr>
 				<th>Curso</th>
 				<th>Usuario</th>
				 <th>Dia da Semana</th>
				 <th> Turno </th>
 				<?php if(logado()): ?>
 					<th>Excluir</th>
 				<?php endif ?>
 			</tr>
 		</thead>
 		<tbody>
 			<?php foreach($on as $ender): ?>
		
			 <tr>	
				<td><?= $ender['curso'] ?></td>
 				<td><?= $ender['usuario_nome'] ?></td>
 				<td><?= dias($ender['dia_da_semana'] )?></td>
 				<td><?= $ender['turno_nome'] ?></td>
 				<?php if($ender['usuario_id'] == id()['id'] ): ?>
	 				<?php if(logado()): ?>
	 					<td><a href="remove.php?rm=<?=$ender['id']?>"> Excluir</a></td>
	 				<?php endif ?>
 				<?php endif ?>
 			</tr>
 			<?php endforeach ?>
		</tbody>
 	</table>

 </body>
 <script>
 	$(function(){

		


 		$('#btn-entrar').on('click',function(evt){
 			evt.preventDefault();

 			//console.log($('#login').serialize());

 			let login = $('#login').serialize();
 			//$('.msg').remove();

 			$.ajax({
 				type: 'POST',
 				url: 'login.php',
 				data: login,
 				dataType: 'html',

 				success: function(data){
 					$('.msg').fadeIn("slow",function(){
						 $('.msg').append(data).css('margin-left', '41%');
						location.reload();

 					})
 					setTimeout(function(){
 						$('.msg').fadeOut("slow", function(){
 							$('msg').remove();
 							//$(data).val('');
 						})
 					}, 300)
 					
 					console.log(data);

 				}



 			});

 		});
 	})

 </script>

 </html>