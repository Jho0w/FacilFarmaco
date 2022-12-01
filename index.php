

<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="styles/style-index.css" media="screen">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

	<title>Início</title>
</head>
<body> 


<?php
//if (!isset($_SESSION["idUserAtivo"]) || isset($_SESSION["login"]) ){ 
    include('menu.php');	
//} 
?>

	<main>
		
		<div>
			<h2 id="titulo"><p>O uso incorreto e a inadequada prescrição de medicamentos podem causar sérios problemas de saúde.</p> <br><br>
				<p>Esse site visa ajudar os profissionais prescritores de medicamentos a detectar possíveis interações medicamentosas</p> <br><br>
				<p>Também ajudar a esclarecer os pacientes que usam medicamentos prescritos as usarem adequadamente</p> <br><br>
				<p>Em caso de necessidade de medicamento, procure um profissional.</p>
				</h2>
		</div>


    </main>

<?php include('rodape.html'); ?>
	
</body>
</html>
