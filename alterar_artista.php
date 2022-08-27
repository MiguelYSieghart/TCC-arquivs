<?php

include "conecta.php";

$id_art = $_POST['id_art'];
$nome_artist = $_POST['nome_artist'];

$sql = "UPDATE artista SET nome_artist = '$nome_artist' WHERE id_art = $id_art";
$resultado = mysqli_query($conexao, $sql);

mysqli_close($conexao);

if ($resultado) {
    header("Location:artista.php");
}