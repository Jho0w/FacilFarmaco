<?php
session_start(); 
require ('config.php');

$idUser = @$_REQUEST['id_user'];

if (@$_REQUEST['botao'] == "Excluir") {
		$query_excluir = "
			DELETE FROM userusuario WHERE id_user=$idUser
		";
		$result_excluir = mysqli_query($con, $query_excluir);
		
		if ($result_excluir) echo "<h2> Registro excluido com sucesso!!!</h2>";
		else echo "<h2> Nao consegui excluir!!!</h2>";
}

if (@$_REQUEST['id_user'] and @!$_REQUEST['botao'])
{
	$query = "
		SELECT * FROM usuario WHERE id_user=$idUser
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
	
	$senha = md5($_POST['senha']);
	
	if (@!$_REQUEST['id_user'])
	{
		
		if (@$_SESSION["usuarioNivel"] == "1"){ 
			$admin = $_POST['admin'];
			echo $admin;
			}
			else{ 
			$admin = 2; 
			}

		$insere = "INSERT INTO usuario (nome, login, senha, perfil, ativo) VALUES ('{$_POST['nome']}', '{$_POST['login']}', '$senha', '$admin', '1')";
		$result_insere = mysqli_query($con, $insere);
		
		
		if ($result_insere) echo "<h2> Registro inserido com sucesso!!!</h2>";
		else echo "<h2> Nao consegui inserir!!!</h2>";
		
	} else 	
	{
		$insere = "UPDATE user SET 
					nome = '{$_POST['nome']}'
					, idade = '{$_POST['idade']}'
					, login = '{$_POST['login']}'
					, senha = '$senha'
					, admin = '$admin'
					WHERE id_user = '{$_REQUEST['id_user']}'
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
	<link rel="stylesheet" type="text/css" href="styles/style-cadUser.css" media="screen">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

	<title>Criar conta</title>
</head>
<body> 

	<main>

	<?php
//if (!isset($_SESSION["idUserAtivo"]) || isset($_SESSION["login"]) ){ 
    include('menu.php');	
//} 
?>
		<div>
			<h1 id="titulo">Faça seu cadastro</h1>
		</div>
		
		<!-- começo do formulário pra mandar os dados -->
		
		<form enctype="multipart/form-data" action="cadUser.php?botao=gravar" method="post" name="user">	
			<label for="id"><strong>Código</strong></label>
			<div>
				<?php echo @$_POST['idUser']; ?>
			</div>
			<fieldset class="grupo">
				<div class="campo">
					<label for="nome"><strong>Nome</strong></label>
					<input type="text" name="nome" id="nome" required value=<?php echo @$_POST['nome'];?> >
				</div>
			</fieldset>	
			<div class="campo">
				<label for="login"><strong>Login</strong></label>
				<input type=text name="login" id="login" value=<?php echo @$_POST['login'];?> >
			</div>
			<div class="campo">
				<label for="senha"><strong>Senha</strong></label>
				<input type=password name="senha" id="senha" value=<?php echo @$_POST['senha'];?> >
			</div>
			<div class="campo">
				<label for="senha2"><strong>Confirme sua Senha</strong></label>
				<input type=password name="senha2" id="senha2">
			</div>

			<!-- Função para saber se digitou as senhas iguais -->
			<script>
				$('form').on('submit', function () {
				if ($('#senha').val() != $('#senha2').val()) {
					alert('Senhas diferentes');
					return false;
				}
			});
			</script>

			<!-- fim da função para saber senhas iguais -->

			
			<div class="campo">
				<label><strong>Nível do Usuário</strong></label>
				<label>
					<input type="radio" name="admin" value="1" <?php echo (@$_POST['admin'] == "1" ? " checked" : "" );?> > Administrador
				</label>
				<label>
					<input type="radio" name="admin" value="2" <?php echo (@$_POST['admin'] == "2" ? " checked" : "" );?> > Usuário
				</label>
			</div>
			
			<div class="botao">
			<button class="botao1" type="submit" name="botao" value="Gravar">Concluido</button>
			<!-- VOU ADICIONAR DEPOIS ESSA FUNÇÃO
			< ?php if (@$_SESSION["usuarioNivel"] == "1"){ ?>
				<button class="botao2" type="image" name="botao" value="Gravar"
				onclick="return confirm('Tem certeza que deseja deletar este registro?')">
				Excluir</button></button>
			< ?php } ?>
			-->
			<input type="hidden" name="idUser" value="<?php echo @$_POST['idUser'] ?>" />
			</div>
		</form>
		<!-- fim do formulário pra mandar os dados -->
	</main>

	<?php include('rodape.html'); ?>
	
</body>
</html>
