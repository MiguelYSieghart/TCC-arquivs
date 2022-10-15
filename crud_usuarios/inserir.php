<?php
require_once "../includes/conecta.php";

$nome_usuario = mysqli_real_escape_string($conexao, $_POST['nome']);
$email = mysqli_real_escape_string($conexao, $_POST['email']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);
$sts = mysqli_real_escape_string($conexao, $_POST['sts']);
$permissao = mysqli_real_escape_string($conexao, $_POST['permissao']);

$resultado = mysqli_query($conexao, "INSERT INTO usuario (nome, email, senha, sts, permissao) VALUES ('$nome_usuario', '$email', '$senha', '$sts', '$permissao')");

if ($resultado) {
    header("Location: listar.php");
    exit;
}

echo "Erro ao cadastrar usuário: " . mysqli_error($conexao);

