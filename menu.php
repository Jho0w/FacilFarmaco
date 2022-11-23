<link rel="stylesheet" type="text/css" href="styles/style-menu.css" media="screen">
<?php
if(!isset($_SESSION)) session_start();


if (@$_SESSION["usuarioNivel"] == "2"){
?>
	<header>
		<a class="nome">Olá <strong>< 
			<?php echo $_SESSION["nomeUser"];?></strong></a>

		<nav id="menu">
			<ul>
				<li><a href="index.php">Início</a></li>
				<li><a href="interacao.php">Interação</a></li>
				<li class="sair"><a href="logout.php">Sair</a></li>
			</ul>
		</nav>
	</header>
<?php

} if((@$_SESSION["usuarioNivel"] == "1" )){

?>

	<header>
		<a class="nome">Olá <strong><?php echo @$_SESSION["nomeUser"];?></strong></a>

		<nav id="menu">
			<ul>
				<li><a href="index.php">Início</a></li>
				<li><a href="interacao.php">Interação</a></li>
				<li><a href="cadClasse.php">Cad Classe med</a></li>
				<li><a href="cadMedicamento.php">Cad medicamento</a></li>
				<li><a href="relatorioMedicamento.php">Todos os medicamento</a></li>
				<li><a href="cadInteracoes.php">Cad Interações</a></li>
				<li><a href="cadUser.php">Cad Cliente</a></li>
				<li class="sair"><a href="logout.php">Sair</a></li>
			</ul>
		<nav>
	</header>

	<?php
} else{
	?>
	<header>
		<a class="nome">Olá!<strong></strong></a>

		<nav id="menu">
			<ul>
				<li><a href="index.php">Início</a></li>
				<li><a href="interacao.php">Interação</a></li>
				<li class="sair"><a href="login.php">Login</a></li>
			</ul>
		</nav>
	</header>
<?php
}
?>