<?php 
if(!isset($_SESSION)) session_start();
include ('config.php');
include ('funcoes.php');
require('verifica.php');

if ($_SESSION["usuarioNivel"] == "0") {
	echo "<script>alert('Você não é Administrador!');top.location.href='menu.php';</script>"; 
}

$idUser = @$_REQUEST['idUser'];


if(@$_REQUEST['botaoExcel'] == "Exportar"){
	
	exportcsvUsuario();

}
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="styles/style-relatorioMedicamento.css" media="screen">
	<title>Relatório Medicamento</title>
</head>
<body>
	<?php include('menu.php'); ?>

	<main>

			<div>
				<h1 id="meio">Todos os medicamentos!</h1>
			</div>


		<!--Tabela para mostrar todas as categorias-->
		<div class="table100">
			<table>
				<thead>
					<tr>
						<th>Código</th>
						<th>Nome</th>
						<th>Login</th>
						<th>Perfil</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					
					<?php
					@$interacoes = $_POST['id_inter'];

					$query = "SELECT * FROM usuario WHERE id_user > 0 AND ativo = 1";
					
					$result = mysqli_query($con, $query);

					while ($coluna=mysqli_fetch_array($result)) 
					{
						if($coluna['perfil'] == 1){
							$admin = 'Administrador';
						} else{
							$admin = 'Usuário';
						}
                        
					?>
					<tr>
						<th><?php echo $coluna['id_user'];?> </th>
						<th><?php echo $coluna['nome'];?> </th>
						<th><?php echo $coluna['login'];?> </th>
						<th><?php echo $admin;?> </th>
						<th>
					<a href="cadUsuario.php?id_user=<?php echo $coluna['id_user']; ?>" >
						<img src="images/icone-editar.png" height="18px" width="18px">
					</a>
					</th>
					</tr>

					<?php } ?>
					
				</tbody>
			</table>
		</div>

			<div>
				<h1 id="excel">Importar para excel!</h1>
			</div>
		

			<div>
				<form action=# method=post>
					<button id="botaoExcel" type=submit name="botaoExcel" value="Exportar">Exportar</button>
				</form>
			</div>
	</main>

	<?php include('rodape.html'); ?>
	
</body>
</html>