<?php
    session_start();

    include_once "../_______necessarios/.conexao_bd.php";

    $email = $_SESSION['email'];
    $id_curso = $_GET['id_curso'];
    $i = $_GET['i'];


    $sql = "SELECT * FROM favoritos_curso WHERE email='$email' AND id_curso=$id_curso";
    $resultado = mysqli_query($conexao, $sql);

    $linha = mysqli_fetch_assoc($resultado);
    $situacao_favorito_curso = $linha['situacao_favorito_curso'];


    if(is_null($situacao_favorito_curso)){

        $sql_1 = "INSERT INTO favoritos_curso (email, id_curso, situacao_favorito_curso) 
                                       VALUES ('$email','$id_curso','favorito')";
        $resultado_1 = mysqli_query($conexao, $sql_1);

        if($i == 0){

        header("Location: ../index/consumidor/CONS____home_consumidor.php");

        }
        if($i == 1){

            header("Location: ../index/consumidor/CONS___tela_curso_consumidor.php?id_curso=$id_curso");

        }

        die;

    }

    if($situacao_favorito_curso == "favorito"){

        $sql_1 = "UPDATE favoritos_curso SET situacao_favorito_curso='não-favorito' WHERE email='$email' AND id_curso=$id_curso";
        $resultado_1 = mysqli_query($conexao, $sql_1);

    } elseif($situacao_favorito_curso == "não-favorito"){

        $sql_1 = "UPDATE favoritos_curso SET situacao_favorito_curso='favorito' WHERE email='$email' AND id_curso=$id_curso";
        $resultado_1 = mysqli_query($conexao, $sql_1);

    }

    if($i == 0){

        header("Location: ../index/consumidor/CONS____home_consumidor.php");
    }
    if($i == 1){

        header("Location: ../index/consumidor/CONS___tela_curso_consumidor.php?id_curso=$id_curso");
    }

?>