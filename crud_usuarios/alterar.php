<?php
require_once "../includes/conecta.php";

$id_usuario = (int) $_POST['id_usuario'];
$nome_usuario = mysqli_real_escape_string($conexao, $_POST['nome']);
$email = mysqli_real_escape_string($conexao, $_POST['email']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);
$sts = mysqli_real_escape_string($conexao, $_POST['sts']);
$permissao = mysqli_real_escape_string($conexao, $_POST['permissao']);

$resultado = mysqli_query($conexao, "UPDATE usuario SET nome='$nome_usuario', email='$email', senha='$senha', sts='$sts', permissao='$permissao' WHERE id_usuario=$id_usuario");

if ($resultado) {
    header("Location: listar.php");
    exit;
}

echo "Erro ao alterar usuário: " . mysqli_error($conexao);

