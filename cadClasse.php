<?php 
session_start();
require ('config.php');
require('verifica.php');

$idUser = $_SESSION["idUserAtivo"];
@$id_classe = $_REQUEST["id_classe"];

if (@$_REQUEST['botao'] == "Excluir") {

		$query_excluir = "
			UPDATE classe SET 
			ativo = '2' WHERE id_classe=$id_classe
		";
		$result_excluir = mysqli_query($con, $query_excluir);
		
		if ($result_excluir) echo "<h2> Registro excluido com sucesso!!!</h2>";
		else echo "<h2> Nao consegui excluir!!!</h2>";
		#Ele exclue só se tiver com todos os campos na tabela preenchidos
}

if (@$_REQUEST['id_classe'] and @!$_REQUEST['botao'])
{
	$query = "
		SELECT * FROM classe WHERE id_classe=$id_classe AND ativo=1
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
	
	if (@!$_REQUEST['id_classe'])
	{
		$insere = "INSERT INTO classe (nome_classe, funcao, quando, como, ativo) VALUES ('{$_POST['nome_classe']}', '{$_POST['funcao']}', '{$_POST['quando']}', '{$_POST['como']}', '1')";
		$result_insere = mysqli_query($con, $insere);
		
		if ($result_insere) echo "<h2> Registro inserido com sucesso!!!</h2>";
		else echo "<h2> Nao consegui inserir!!!</h2>";
		
	} else 	
	{
		$insere = "UPDATE classe SET 
					nome_classe = '{$_POST['nome_classe']}'
					, funcao = '{$_POST['funcao']}'
					, quando = '{$_POST['quando']}'
					, como = '{$_POST['como']}'
					WHERE id_classe = '{$_REQUEST['id_classe']}'
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
	<link rel="stylesheet" type="text/css" href="styles/style-cadClasse.css" media="screen">
	
	<title>Cadastro de classe</title>
</head>
<body>

<?php
//if (!isset($_SESSION["idUserAtivo"]) || isset($_SESSION["login"]) ){ 
    include('menu.php');	
//} 
?>
	<main>
		<div>
			<h1 id="cabecalho">Cadastro de Classe!</h1>
		</div>	
		
		<form enctype="multipart/form-data" action="cadClasse.php?botao=gravar" method="post" name="anuncio">
		<div>
			<label><strong>Código</strong></label>
			<label><?php echo @$_POST['id_classe']; ?></label>
		</div>
		<fieldset class="grupo">
			<div class="campo">
				<label for="nome_classe"><strong>Nome</strong></label>
				<input class="campo-nome" type="text" name="nome_classe" id="nome_classe" required value=<?php echo @$_POST['nome_classe'];?> >
			</div>
			<div class="campo">
				<label for="funcao"><strong>Função</strong></label>
				<textarea name="funcao" id="funcao"> <?php echo @$_POST['funcao'];?> </textarea>
			</div>
			<div class="campo">
				<label for="quando"><strong>Quando</strong></label>
				<input type=text name="quando" value=<?php echo @$_POST['quando']; ?> >
			</div>
		</fieldset>	
		<div class="campo">
			<label for="como"><strong>Como</strong></label>
			<input type=text name="como" value=<?php echo @$_POST['como']; ?> >
		</div>

			<button class="botao1" type="submit" name="botao" value="Gravar">Concluido</button>
			<?php if (@$_SESSION["usuarioNivel"] == "1"){ ?>
			<button class="botao2" type="image" name="botao" value="Excluir" onclick="return confirm('Tem certeza que deseja deletar este registro?')">
				<img src="images/icone-excluir.png" height="20px" width="20px"></button>
		
			<?php } ?>
			
			<input type="hidden" name="id_classe" value="<?php echo @$_POST['id_classe'] ?>" />
		</form>
	</main>

	<?php include('rodape.html'); ?>
	
</body>
</html>