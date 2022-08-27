<?php

include "conecta.php";

$id_usuario = $_POST['id_usuario'];
$nome_usuario = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$sts = $_POST['sts'];
$permissao = $_POST['permissao'];

$sql = "UPDATE usuario SET nome = '$nome_usuario', email = '$email', senha = '$senha', sts = '$sts', permissao = '$permissao'
WHERE id_usuario = $id_usuario";
echo $sql;
$resultado = mysqli_query($conexao, $sql);

mysqli_close($conexao);

if ($resultado) {
    header("Location:usuario.php");
}