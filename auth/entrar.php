<?php
session_start();

require_once "../includes/conecta.php";

$email = mysqli_real_escape_string($conexao, strtolower($_POST['email']));
$senha = $_POST['senha'];
$senhaMD5 = md5($senha);

$sql = "SELECT * FROM usuario WHERE email='$email' AND sts='A'";
$resultado = mysqli_query($conexao, $sql);
$usuario = mysqli_fetch_assoc($resultado);

if (is_null($usuario)) {
    $_SESSION['mensagem'] = "Usuário informado não existe ou está inativo.";
    header("Location: login.php");
    exit;
}

if ($senha == $usuario['senha'] || $senhaMD5 == $usuario['senha']) {
    $_SESSION['id_usuario'] = $usuario['id_usuario'];
    $_SESSION['nome'] = $usuario['nome'];
    $_SESSION['email'] = $email;
    $_SESSION['permissao'] = $usuario['permissao'];
    header("Location: ../home.php");
    exit;
}

$_SESSION['mensagem'] = "Senha inválida!";
header("Location: login.php");
exit;

