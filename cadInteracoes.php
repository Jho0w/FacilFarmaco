<?php 
if(!isset($_SESSION)) session_start();
require ('config.php');
require('verifica.php');

$idUser = $_SESSION["idUserAtivo"];
@$id_inter = $_REQUEST["id_inter"];

if (@$_REQUEST['botao'] == "Excluir") {

		$query_excluir = "
			DELETE FROM interacao WHERE id_inter=$id_inter
		";
		$result_excluir = mysqli_query($con, $query_excluir);
		
		if ($result_excluir) echo "<h2> Registro excluido com sucesso!!!</h2>";
		else echo "<h2> Nao consegui excluir!!!</h2>";
		#Ele exclue só se tiver com todos os campos na tabela preenchidos
}

if (@$_REQUEST['id_inter'] and @!$_REQUEST['botao'])
{
	$query = "
		SELECT * FROM interacao WHERE id_inter=$id_inter
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
	
	if (@!$_REQUEST['id_inter'])
	{
		$insere = "INSERT INTO interacao (id_med1, id_med2, interacao, ativo) VALUES ('{$_POST['id_med1']}', '{$_POST['id_med2']}', '{$_POST['interacao']}', '1')";
		$result_insere = mysqli_query($con, $insere);
		
		if ($result_insere) echo "<h2> Registro inserido com sucesso!!!</h2>";
		else echo "<h2> Nao consegui inserir!!!</h2>";
		
	} else 	
	{
		$insere = "UPDATE interacao SET 
					id_med1 = '{$_POST['id_med1']}'
					, id_med2 = '{$_POST['id_med2']}'
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
	<link rel="stylesheet" type="text/css" href="styles/style-cadInteracoes.css" media="screen">
	
	<title>Cadastro de Interações</title>
</head>
<body>

<?php
    include('menu.php');
?>
	<main>
		<div>
			<h1 id="cabecalho">Cadastro de Interações!</h1>
		</div>	
		
		<form enctype="multipart/form-data" action="cadInteracoes.php?botao=gravar" method="post" name="anuncio">
		<div>
			<label><strong>Código</strong></label>
			<label><?php echo @$_POST['id_inter']; ?></label>
		</div>
		<fieldset class="grupo">
			
			<div class="campo">
				<label for="classe"><strong>Composição</strong></label>
                <!-- Início da Combo de Composição -->
				<?php
				
				$query = "
					SELECT id_med, nome_med
					FROM medicamento WHERE ativo = 1
				";
				$result = mysqli_query($con, $query);
			?>

			<select name="id_med1" required>
			<option selected disabled value="">Selecione</option>
			
			<?php
			while( $row = mysqli_fetch_assoc($result) )
			{	
			?>
			
			<option value="<?php echo $row['id_med']; ?>" 
			<?php echo $row['id_med'] == @$_POST['id_med'] ? "selected" : "" ?>><?php echo @$row['nome_med'];?></option>

			</option>
			
			<?php
				}
			?>
			</select>
			</div>

			<div class="campo">
				<label for="classe"><strong>Interagente</strong></label>
            <!-- Inicio da Combo de Interagente -->


							<?php
				
				$query = "
					SELECT id_med, nome_med
					FROM medicamento WHERE ativo = 1
				";
				$result = mysqli_query($con, $query);
			?>

			<select name="id_med2" required>
			<option selected disabled value="">Selecione</option>
			
			<?php
			while( $row = mysqli_fetch_assoc($result) )
			{	
			?>
			
			<option value="<?php echo $row['id_med']; ?>" 
			<?php echo $row['id_med'] == @$_POST['id_med'] ? "selected" : "" ?>><?php echo @$row['nome_med'];?></option>

			</option>
			
			<?php
				}
			?>
			</select>
			</div>
		</fieldset>	
		<div class="campo">
			<label for="interacao"><strong>Interação</strong></label>
            <textarea name="interacao" id="interacao"> <?php echo @$_POST['interacao'];?> </textarea>
		</div>

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