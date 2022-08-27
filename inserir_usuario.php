<html>

<head>
    <meta charset="UTF-8">
    <!--<link rel="stylesheet" type="text/css" href="estilo.css">-->
</head>

<body>

    <?php

	include_once "./conecta.php";

	$nome_usuario = $_GET['nome'];
	$email = $_GET['email'];
	$senha = $_GET['senha'];
	$sts = $_GET['sts'];
	$permissao = $_GET['permissao'];

	$sql = "INSERT INTO usuario (nome,email,senha,sts,permissao) VALUES ('$nome_usuario','$email','$senha','$sts','$permissao')";


	$resultado = mysqli_query($conexao, $sql);
	mysqli_close($conexao);

	if ($resultado) {
		header("Location:usuario.php");
	}
	?>
</body>

</html>