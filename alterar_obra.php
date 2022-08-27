<?php

include "conecta.php";

$capa_pre_alteracao = $_POST['capa_pre_alteracao'];

if (isset($_FILES['capa_obra'])) {

    $ext = strrchr($_FILES['capa_obra']['name'], '.');
    $nome = md5(time()) . $ext;
    $dir = "images/";

    move_uploaded_file($_FILES['capa_obra']['tmp_name'], $dir . $nome);
}
if ($ext != "") {

    $capa_obra = $dir . $nome;
} else {

    $capa_obra = $capa_pre_alteracao;
}


$id_obra = $_POST['id_obra'];
$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$ano_lanc = $_POST['ano_lanc'];
$status_obra = $_POST['status_obra'];
$sinopse = $_POST['sinopse'];
$demografia = $_POST['demografia'];


$sql = "UPDATE obras SET titulo = '$titulo', autor = '$autor', ano_lanc = '$ano_lanc', status_obra = '$status_obra',
sinopse = '$sinopse', demografia = '$demografia', capa_obra = '$capa_obra'
 WHERE id_obra = $id_obra";
$resultado = mysqli_query($conexao, $sql);

mysqli_close($conexao);

if ($resultado) {
    header("Location: obras.php");
}