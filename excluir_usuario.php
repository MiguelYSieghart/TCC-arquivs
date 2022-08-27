<?php

include "conecta.php";
$id_usuario = $_GET['id_usuario'];

$sql = "DELETE FROM usuario WHERE id_usuario = '$id_usuario'";
$resultado = mysqli_query($conexao, $sql);

mysqli_close($conexao);

if ($resultado) {
    header("Location:usuario.php");
}