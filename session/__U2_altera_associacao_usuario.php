<?php
    echo '<meta charset="UTF-8">';

    include "../_______necessarios/.conexao_bd.php";

    $email_antigo = $_POST['email_antigo'];
    $email_novo = strtolower($_POST['email_novo']);
    $id_curso = $_POST['id_curso'];

    if($email_antigo == $email_novo){

        header("Location: ../index/produtor/PROD___tela_curso_produtor.php?id_curso=$id_curso");

    } else {

        $sql = "SELECT * FROM relacao_usuario_curso WHERE email='$email_novo' AND tipo_relacao='consumidor'";
        $resultado = mysqli_query($conexao,$sql);

        $linha = mysqli_fetch_array($resultado);


        if(isset($linha)){

            header("Location: ../index/produtor/PROD___tela_curso_produtor.php?id_curso=$id_curso");

        } else {

            //editando a relação do usuário com o curso-
            $sql_1 = "UPDATE relacao_usuario_curso SET email='$email_novo' WHERE email='$email_antigo' AND id_curso='$id_curso' AND tipo_relacao='consumidor'"; 
            $resultado_1 = mysqli_query($conexao,$sql_1);
            //-


            //editando a relação do usuário com os questionários-
            $sql_2 = "UPDATE relacao_usuario_questionario SET email='$email_novo' WHERE email='$email_antigo' AND id_curso='$id_curso'"; 
            $resultado_2 = mysqli_query($conexao,$sql_2);
            //-

            header("Location: ../index/produtor/PROD___tela_curso_produtor.php?id_curso=$id_curso");

        }

    }
    ?>