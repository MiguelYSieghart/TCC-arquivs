<?php

include "conecta.php";
$id_art = $_GET['id_art'];

$sql = "DELETE FROM artista WHERE id_art = '$id_art'";
$resultado = mysqli_query($conexao, $sql);

mysqli_close($conexao);

if ($resultado) {
    header("Location:artista.php");
}