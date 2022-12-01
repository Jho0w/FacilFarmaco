<?php include('config.php');


?>

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

		let tabela = document.getElementById('tableMed1');
		let linhas = tabela.querySelectorAll('tr');

		linhas.forEach((linha) => {
			linha.onclick = () => {
				eval("document.location.href = '" + goToLocation + "&id_med=" + selObj.options[selObj.selectedIndex].value + "'");
			}
		});
	</script>

	<title>Interação</title>
</head>

<body>

	<?php
	include('menu.php');
	?>

	<main>
		<div id="todo-arquivo">
			<div id="container-medicamentos">
				<div class="combo-box">
					<form action="interacao.php?" method="GET">
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
						</div>
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
				</div>
				<div class="combo-box">
					<label for="categoria" id="label_med2"><strong>Medicamento 2</strong></label>
					<select name="id_med2">
						<option value=""> ..:: selecione ::.. </option>
						<?php
						if (@$_REQUEST['id_med2'] == "") $medicamento2_combo = @$_POST['id_med2'];
						else $medicamento2_combo = @$_REQUEST['id_med2'];

						while ($row = mysqli_fetch_assoc($result)) {
						?>
							<option value="<?php echo $row['id_med2']; ?>" <?php echo $row['id_med2'] == $medicamento2_combo ? "selected" : "" ?>>
								<?php echo $row['nome_med']; ?></option>
						<?php
							@$id_med2 = $_REQUEST['id_med2'];
						}
						?>
					</select>

					<input type="submit" value="Selecionar">
					</form>
				</div>
			</div>

			<div id="group">
				<div class="container-itens">
					<form action="busca.php" method="GET">
						<label>Nome do medicamento</label>
						<input type="text" name="nome_med" size="30px" placeholder="Insira o nome do medicamento">
						<button>Buscar</button>
					</form>

					<form action="interacao.php?" method="GET">
						<div class="table-med">
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

									while ($row = mysqli_fetch_assoc($result)) { ?>
										<tr>
											<th>
												<button class="nome_medicamento" type="submit" onClick="top.location.href='interacao.php&id_med1='<?php $row['id_med']; ?>" value="<?php echo $row['id_med']; ?>"><?php echo $row['nome_med']; ?></button>
											</th>
										</tr>


									<?php } ?>

								</tbody>
							</table>
						</div>
					</form>
				</div>

				<div class="container-itens">
					<form action="busca.php" method="GET">
						<label>Nome do medicamento</label>
						<input type="text" name="nome_med" size="30px" placeholder="Insira o nome do medicamento">
						<button>Buscar</button>
					</form>

					<form action="interacao.php?" method="GET">
						<div class="table-med">
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
									}

									?>

								</tbody>
							</table>
						</div>
					</form>
				</div>
			</div>

			<?php
			if($id_med1 == null){
				$id_med1 = "Selecione um medicamento";
				$id_med2 = "Selecione um medicamento";
				$interacao = "Selecione um medicamento";
			} else if($id_med2 == null){
				$id_med2 = "Selecione um medicamento";
				$interacao = "Selecione o segundo medicamento";
			}
			?>
			
			<div id="interacao-box">
				<div id="interacao-container">
					<div id="classe-med1">
						<?php
						$query = "
								SELECT * FROM classe
								INNER JOIN medicamento ON medicamento.id_classe = classe.id_classe
								WHERE id_med = '$id_med1' AND classe.ativo = 1
							";
						$result = mysqli_query($con, $query);

						while ($row = mysqli_fetch_assoc($result)) {
						?>
							<div class="nome-medicamento"> <label><b>Medicamento: </b><?php echo $row['nome_med']; ?></label> </div>
							<div> <label><b>Pertence a classe: </b><?php echo $row['nome_classe']; ?></label> </div>
							<div> <label><b>Função: </b></label> <?php echo $row['funcao']; ?> </div>
							<div> <label><b>Quando tomar: </b></label> <?php echo $row['quando']; ?> </div>
							<div> <label><b>Como tomar: </b></label> <?php echo $row['como'] ?> </div>
						<?php } ?>
					</div>

					<div id="classe-med2">
						<?php
						$query = "
								SELECT * FROM classe
								INNER JOIN medicamento ON medicamento.id_classe = classe.id_classe
								WHERE id_med = '$id_med2' AND classe.ativo = 1
							";
						$result = mysqli_query($con, $query);

						while ($row = mysqli_fetch_assoc($result)) {
						?>
							<div class="nome-medicamento"> <label><b>Medicamento: </b><?php echo $row['nome_med']; ?></label> </div>
							<div> <label><b>Pertence a classe: </b><?php echo $row['nome_classe']; ?></label> </div>
							<div> <label><b>Função: </b></label> <?php echo $row['funcao']; ?> </div>
							<div> <label><b>Quando tomar: </b></label> <?php echo $row['quando']; ?> </div>
							<div> <label><b>Como tomar: </b></label> <?php echo $row['como'] ?> </div>
						<?php } ?>
					</div>
				</div>
				<div id="interacao-explicacao">
					<?php

					$query = "
									SELECT *
									FROM interacao
									INNER JOIN medicamento ON interacao.id_med2 = medicamento.id_med
									WHERE id_med1 = '$id_med1' AND id_med2 = '$id_med2' AND medicamento.ativo = 1
									ORDER BY medicamento.nome_med
								";

					//echo "$query";
					$result = mysqli_query($con, $query);

					while ($row = mysqli_fetch_assoc($result)) {

						@$interacao = $row['interacao'];
					}

					?>

					<label> <b>Interação: </b></label> <?php echo $interacao; ?>
				</div>
			</div>

		</div>


	</main>

	<?php include('rodape.html'); ?>

</body>

</html>