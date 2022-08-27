<?php

include "conecta.php";
$id_obra = $_GET['id_obra'];

$sql = "DELETE FROM obras WHERE id_obra = $id_obra";
$resultado = mysqli_query($conexao, $sql);

mysqli_close($conexao);

if ($resultado) {
    header("Location: obras.php");
}