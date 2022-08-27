<?php
session_start();

    $email = strtolower($_POST['email']);
    $senha = $_POST['senha'];
    $senhaMD5 = md5($senha);

    require_once "../_______necessarios/.conexao_bd.php";

    $sql = "SELECT * FROM usuarios WHERE email='$email'";
    $resultado = mysqli_query($conexao, $sql);
    $usuario = mysqli_fetch_assoc($resultado);


    if (is_null($usuario)) {

        $_SESSION['mensagem'] = "Usuário informado não existe";
        header("Location: ../index/entrada.php");

    } else if ($senhaMD5 == $usuario['senha']) {

        $_SESSION['id_usuario'] = $usuario['id_usuario'];
        $_SESSION['email'] = $email;
        header("Location: ../index/consumidor/CONS____home_consumidor.php");

    } else {

        $_SESSION['mensagem'] = "Senha inválida!";
        header("Location: ../index/entrada.php");
    }

?>