<?php 
session_start();
include ('config.php');
include ('funcoes.php');
require('verifica.php');

if ($_SESSION["usuarioNivel"] == "0") {
	echo "<script>alert('Você não é Administrador!');top.location.href='menu.php';</script>"; 
}

$idUser = @$_REQUEST['idUser'];
@$idCategoria = $_REQUEST['idCategoria'];


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
	<link rel="stylesheet" type="text/css" href="styles/style-relatorioMedicamento.css" media="screen">
	<title>Criar Categoria</title>
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
						<th>Classe</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					
					<?php
					@$interacoes = $_POST['id_inter'];

					$query = "SELECT * FROM medicamento INNER JOIN classe ON medicamento.id_classe = classe.id_classe WHERE id_med > 0 AND medicamento.ativo = 1";
					
					$result = mysqli_query($con, $query);

					while ($coluna=mysqli_fetch_array($result)) 
					{
                        
					?>
					<tr>
						<th><?php echo $coluna['id_med'];?> </th>
						<th><?php echo $coluna['nome_med'];?> </th>
						<th><?php echo $coluna['nome_classe'];?> </th>
						<th>
					<a href="cadMedicamento.php?id_med=<?php echo $coluna['id_med']; ?>" >
						<img src="images/icone-editar.png" height="18px" width="18px">
					</a>
					</th>
					</tr>

					<?php } ?>
					
				</tbody>
			</table>
		</div>

			<div>
				<h1 id="cabecalho">Importar para excel!</h1>
			</div>
		

			<div>
				<form action=# method=post>
					<button type=submit name="botaoExcel" value="Exportar">Exportar</button>
				</form>
			</div>
	</main>

	<?php include('rodape.html'); ?>
	
</body>
</html>