<?php 
//session_start();
require ('config.php');
//require('verifica.php');

$idUser = $_SESSION["idUserAtivo"];
@$id_inter = $_REQUEST["id_inter"];

/*if (@$_REQUEST['botao'] == "Excluir") {

		$query_excluir = "
			DELETE FROM interacoes WHERE id_inter=$id_inter
		";
		$result_excluir = mysqli_query($con, $query_excluir);
		
		if ($result_excluir) echo "<h2> Registro excluido com sucesso!!!</h2>";
		else echo "<h2> Nao consegui excluir!!!</h2>";
		#Ele exclue só se tiver com todos os campos na tabela preenchidos
}*/

if (@$_REQUEST['id_inter'] and @!$_REQUEST['botao'])
{
	$query = "
		SELECT * FROM medicamentos WHERE id_med=$id_med
	";
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_assoc($result);
	foreach( $row as $key => $value )
	{
		$_POST[$key] = $value;
	}

	
}

if (@$_REQUEST['botao'] == "Gravar") 
{
	if ($_SESSION["usuarioNivel"] == "1"){ 
	$anuncioAtivo = $_POST['anuncioAtivo'];
	}
	else{ 
	$anuncioAtivo = 2; 
	}
	
	if (@!$_REQUEST['id_med'])
	{
		$insere = "INSERT INTO medicamento (nome_med, id_classe, ativo) VALUES ('{$_POST['nome_med']}', '{$_POST['id_classe']}', '1')";
		$result_insere = mysqli_query($con, $insere);
		
		if ($result_insere) echo "<h2> Registro inserido com sucesso!!!</h2>";
		else echo "<h2> Nao consegui inserir!!!</h2>";
		
	} else 	
	{
		$insere = "UPDATE interacoes SET 
					composicao = '{$_POST['composicao']}'
					, interagente = '{$_POST['interagente']}'
					, id_classe = '{$_POST['id_classe']}'
					, interacao = '{$_POST['interacao']}'
					WHERE id_inter = '{$_REQUEST['id_inter']}'
				";
		$result_update = mysqli_query($con, $insere);

		if ($result_update) echo "<h2> Registro atualizado com sucesso!!!</h2>";
		else echo "<h2> Nao consegui atualizar!!!</h2>";
		
	}
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="styles/style-cadMedicamento.css" media="screen">
	
	<title>Cadastro de Medicamentos</title>
</head>
<body>

<?php
//if (!isset($_SESSION["idUserAtivo"]) || isset($_SESSION["login"]) ){ 
    include('menu.php');	
//} 
?>
	<main>
		<div>
			<h1 id="cabecalho">Cadastro de Medicamentos!</h1>
		</div>	
		
		<form enctype="multipart/form-data" action="cadMedicamento.php?botao=gravar" method="post" name="anuncio">
		<div>
			<label><strong>Código</strong></label>
			<label><?php echo @$_POST['id_inter']; ?></label>
		</div>
		<fieldset class="grupo">
			<div class="campo">
				<label for="nome_med"><strong>Nome:</strong></label>
				<input class="campo-nome" type="text" name="nome_med" id="nome_med" required value=<?php echo @$_POST['nome_med'];?> >
			</div>
			<div class="campo">
				<label for="classe"><strong>Classe</strong></label>
                <!-- Início da Combo de Classe -->
				<?php
				
				$query = "
					SELECT id_classe, nome
					FROM classe
				";
				$result = mysqli_query($con, $query);
			?>

			<select name="id_classe" required>
			<option selected disabled value="">Selecione</option>
			
			<?php
			while( $row = mysqli_fetch_assoc($result) )
			{	
			?>
			
			<option value="<?php echo $row['id_classe']; ?>" 
			<?php echo $row['id_classe'] == @$_POST['id_classe'] ? "selected" : "" ?>><?php echo @$row['nome'];?></option>

			</option>
			
			<?php
				}
			?>
			</select>
            <!-- Fim da Combo de Classe -->
			</div>
		</fieldset>	

			<button class="botao1" type="submit" name="botao" value="Gravar">Concluido</button>
			<?php if (@$_SESSION["usuarioNivel"] == "1"){ ?>
			<button class="botao2" type="image" name="botao" value="Excluir" onclick="return confirm('Tem certeza que deseja deletar este registro?')">
				<img src="images/icone-excluir.png" height="20px" width="20px"></button>
		
			<?php } ?>
			
			<input type="hidden" name="id_inter" value="<?php echo @$_POST['id_inter'] ?>" />
		</form>
		
	</main>

	<?php include('rodape.html'); ?>
	
</body>
</html>