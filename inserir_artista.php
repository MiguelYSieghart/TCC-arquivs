<html>

<head>
    <meta charset="UTF-8">
    <!--<link rel="stylesheet" type="text/css" href="estilo.css">-->
</head>

<body>

    <?php

	include_once "conecta.php";

	$nome_artist = $_POST['nome_artist'];

	$sql = "INSERT INTO artista (nome_artist) VALUES ('$nome_artist')";


	$resultado = mysqli_query($conexao, $sql);
	mysqli_close($conexao);

	if ($resultado) {
		header("Location:artista.php");
	}
	?>
</body>

</html>