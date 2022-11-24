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
	<title>Relatório Classe</title>
</head>
<body>
	<?php include('menu.php'); ?>

	<main>

			<div>
				<h1 id="meio">Todos as Classes!</h1>
			</div>


		<!--Tabela para mostrar todas as categorias-->
		<div class="table100">
			<table>
				<thead>
					<tr>
						<th>Código</th>
						<th>Nome</th>
						<th>Função</th>
						<th>Quando</th>
						<th>Como</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					
					<?php
					@$interacoes = $_POST['id_inter'];

					$query = "SELECT * FROM classe WHERE id_classe > 0 AND ativo = 1";
					
					$result = mysqli_query($con, $query);

					while ($coluna=mysqli_fetch_array($result)) 
					{
                        
					?>
					<tr>
						<th><?php echo $coluna['id_classe'];?> </th>
						<th><?php echo $coluna['nome_classe'];?> </th>
						<th><?php echo $coluna['funcao'];?> </th>
						<th><?php echo $coluna['quando'];?> </th>
						<th><?php echo $coluna['como'];?> </th>
						<th>
					<a href="cadClasse.php?id_classe=<?php echo $coluna['id_classe']; ?>" >
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