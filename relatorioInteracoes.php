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
	
	exportcsv();

}
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="styles/style-relatorioClasse.css" media="screen">
	<title>Relatório Interações</title>
</head>
<body>
	<?php include('menu.php'); ?>

	<main>

			<div>
				<h1 id="meio">Todos as Interações!</h1>
			</div>


		<!--Tabela para mostrar todas as categorias-->
		<div class="table100">
			<table>
				<thead>
					<tr>
						<th>Código</th>
						<th>Medicamento 1</th>
						<th>Medicamento 2</th>
						<th>Interação</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					
					<?php
					@$interacoes = $_POST['id_inter'];

					$query = "SELECT * FROM interacao 
                    WHERE id_inter > 0 AND ativo = 1";
					
					$result = mysqli_query($con, $query);

					while ($coluna=mysqli_fetch_array($result)) 
					{
                        
					?>
					<tr>
						<th><?php echo $coluna['id_inter'];?> </th>
						<th><?php echo $coluna['id_med1'];?> </th>
						<th><?php echo $coluna['id_med2'];?> </th>
						<th><?php echo $coluna['interacao'];?> </th>
						<th>
					<a href="cadInteracoes.php?id_inter=<?php echo $coluna['id_inter']; ?>" >
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
					<button type=submit id="botaoExcel" name="botaoExcel" value="Exportar">Exportar</button>
				</form>
			</div>
	</main>

	<?php include('rodape.html'); ?>
	
</body>
</html>