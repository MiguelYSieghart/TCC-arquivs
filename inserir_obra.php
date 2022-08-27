<html>

<head>
    <meta charset="UTF-8">
    <!--<link rel="stylesheet" type="text/css" href="estilo.css">-->
</head>

<body>

    <?php

	include_once "conecta.php";

	if (isset($_FILES['capa_obra'])) {

		$ext = strrchr($_FILES['capa_obra']['name'], '.');
		$nome = md5(time()) . $ext;
		$dir = "images/";

		move_uploaded_file($_FILES['capa_obra']['tmp_name'], $dir . $nome);
	}
	if ($ext != "") {

		$capa_obra = $dir . $nome;
	} else {

		$capa_obra = "images/capas/";
	}

	$titulo = $_POST['titulo'];
	$autor = $_POST['autor'];
	$ano_lanc = $_POST['ano_lanc'];
	$status_obra = $_POST['status_obra'];
	$sinopse = $_POST['sinopse'];
	$demografia = $_POST['demografia'];

	$sql = "INSERT INTO obras (capa_obra, titulo, autor, ano_lanc, status_obra, sinopse, demografia)
VALUES ('$capa_obra', '$titulo','$autor','$ano_lanc', '$status_obra','$sinopse','$demografia')";
	echo "$sql";

	$resultado = mysqli_query($conexao, $sql);
	mysqli_close($conexao);

	if ($resultado) {
		header("Location:obras.php");
	}
	?>
</body>

</html>