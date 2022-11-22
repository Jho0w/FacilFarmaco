<?php
include ('config.php');
session_start();

if (@$_REQUEST['botao'])
{
	$login = $_POST['login'];
	$senha = md5($_POST['senha']);
	
	$query = "SELECT * FROM usuario WHERE login = '$login' AND senha = '$senha' ";
	
	$result = mysqli_query($con, $query);
	while ($row=mysqli_fetch_array($result)) 
	{
		$_SESSION["idUserAtivo"] = $row["id_user"]; 
		$_SESSION["nomeUser"] = $row["nome"];
		$_SESSION["login"] = $row["login"]; 
		$_SESSION["usuarioNivel"] = $row["perfil"];

		// caso queira direcionar para páginas diferentes
		$niv = $coluna['perfil'];
		header("Location: index.php"); 
		exit; 
		// ----------------------------------------------
	}
	
	//include('verifica.php');
}
?>