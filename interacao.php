<?php include('config.php'); ?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="styles/style-interacao.css" media="screen">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

	<script language="JavaScript">
		function goToUrl(selObj, goToLocation) {
			eval("document.location.href = '" + goToLocation + "&id_med=" + selObj.options[selObj.selectedIndex].value + "'");
		}

		function goToUrl2(selObj1, selObj2, goToLocation) {
			eval("document.location.href = '" + goToLocation + "&id_med1=" + selObj2.options[selObj2.selectedIndex].value + "&id_med2=" + selObj1.options[selObj1.selectedIndex].value + "'");
		}
	</script>

	<title>Interação</title>
</head>

<body>


	<?php
	include('menu.php');

	//goToUrl(this,'interacao.php?pag=interacao');

	?>
	<br><br><br><br><br><br>
	<main>
		<div class="campo">
			<label for="categoria"><strong>Medicamento 1</strong></label>

			<?php

			$query = "
			SELECT id_med, nome_med
			FROM medicamento
			WHERE ativo = 1
		";
			$result = mysqli_query($con, $query);
			?>
			<select name="id_med" onChange="goToUrl(this,'interacao.php?pag=interacao')">
				<option value=""> ..:: selecione ::.. </option>
				<?php

				if ($_REQUEST['id_med'] == "") $medicamento1_combo = $_GET['id_med'];
				else $medicamento1_combo = $_REQUEST['id_med'];

				while ($row = mysqli_fetch_assoc($result)) {
				?>
					<option value="<?php echo $row['id_med']; ?>" <?php echo $row['id_med'] == $medicamento1_combo ? "selected" : "" ?>><?php echo $row['nome_med']; ?></option>
				<?php
				}
				?>
			</select>


			<!-- Combo 1 -->

			<?php

			@$id_med1 = $_GET['id_med'];

			$query = "
			SELECT *
			FROM interacao
			INNER JOIN medicamento ON interacao.id_med2 = medicamento.id_med
			WHERE id_med1 = '$id_med1' AND medicamento.ativo = 1
			ORDER BY nome_med
		";

			//echo "$query";
			$result = mysqli_query($con, $query);

			?>

			<br><br>

			<label for="categoria"><strong>Medicamento 2</strong></label>
			<select name="id_med2" onChange="goToUrl2('<?php echo $_REQUEST['id_med2'] ?>','interacao.php?pag=interacao', '<?php echo $id_med1 ?>')">
				<option value=""> ..:: selecione ::.. </option>
				<?php
				if (@$_REQUEST['id_med2'] == "") $medicamento2_combo = @$_POST['id_med2'];
				else $medicamento2_combo = @$_REQUEST['id_med2'];

				while ($row = mysqli_fetch_assoc($result)) {
				?>
					<option value="<?php echo $row['id_med2']; ?>" 
					<?php echo $row['id_med2'] == $medicamento2_combo ? "selected" : "" ?>>
					<?php echo $row['nome_med']; ?></option>
				<?php
				@$id_med2 = $_REQUEST['id_med2'];
				}
				?>
			</select>

			<br><br><br>


	</main>
	<br><br><br><br><br><br>


	<!-- ************************** TESTES DE FUNCIONALIDADEEEEE *************************** -->


	<h2>TESTES DE USABILIDADE</h2>

	<main>
		<div class="campo">
			<div>

				
					<table>
						<thead>
							<tr>
								<th>Medicamento 1</th>
							</tr>
						</thead>
						<tbody>

							<?php

							$query = "
								SELECT id_med, nome_med
								FROM medicamento
								WHERE ativo = 1
							";
							$result = mysqli_query($con, $query);

							if (@$_REQUEST['id_med'] == "") $medicamento1_combo = @$_GET['id_med'];
							else $medicamento1_combo = @$_REQUEST['id_med'];

							while ($row = mysqli_fetch_assoc($result)) 
							{ ?>
								<tr>
									<th>
										<input class="nome_medicamento" type="submit" onclick="goToUrl(<?php echo $row['id_med']; ?>,'interacao.php?pag=interacao')" value="<?php echo $row['nome_med']; ?>">
									</th>
								</tr>

							<?php } ?>

						</tbody>
					</table>


				<br><br><br>
				<div class="table100">
					<table>
						<thead>
							<tr>
								<th>Medicamento 2</th>
							</tr>
						</thead>
						<tbody>

						<?php

							@$id_med1 = $_GET['id_med'];

							$query = "
								SELECT *
								FROM interacao
								INNER JOIN medicamento ON interacao.id_med2 = medicamento.id_med
								WHERE id_med1 = '$id_med1' AND medicamento.ativo = 1
								ORDER BY medicamento.nome_med
							";

							//echo "$query";
							$result = mysqli_query($con, $query);
							if (@$_REQUEST['id_med2'] == "") $medicamento2_combo = @$_POST['id_med2'];
								else $medicamento2_combo = @$_REQUEST['id_med2'];

								while ($row = mysqli_fetch_assoc($result)) {
								?>
								<tr>
									<th>
										<input class="nome_medicamento" type="submit" value="<?php echo $row['nome_med']; ?>">
									</th>
								</tr>

							<?php 
							@$id_med2 = $_GET['id_med2'];
							$interacao = $row['interacao'];
						} 
							
							?>

						</tbody>
					</table>
				</div>

<br><br><br>

				<div>
					<?php echo $id_med1; ?><br>
					<?php echo $id_med2; ?><br>
					<?php echo $interacao; ?>
				</div>


	</main>

	<?php include('rodape.html'); ?>

</body>

</html>