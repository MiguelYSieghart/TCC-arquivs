<?php
session_start();
    require_once "../_______necessarios/.conexao_bd.php";

    $id_usuario = $_SESSION['id_usuario'];

    $endereco_imagem_usuario_pre_alteracao = $_POST['endereco_imagem_usuario_pre_alteracao'];

    $nome_usuario = $_POST['nome_usuario'];
    if(isset($_FILES['endereco_imagem_usuario'])){

        $ext = strrchr($_FILES['endereco_imagem_usuario']['name'], '.');
        $nome = md5(time()).$ext;
        $dir = "imgs_usuarios/";
    
        move_uploaded_file($_FILES['endereco_imagem_usuario']['tmp_name'], $dir.$nome);
    
    }
    if($ext != ""){
    
        $endereco_imagem_usuario = "../../______usuarios/".$dir.$nome;
    
    } else {
    
        $endereco_imagem_usuario = $endereco_imagem_usuario_pre_alteracao;
    
    }
    $senha_antiga = $_POST['senha_antiga'];
    $senha_nova = $_POST['senha_nova'];
    $confirmar_senha = $_POST['confirmar_senha'];

    $senha_antiga_MD5 = md5($senha_antiga);
    $senha_nova_MD5 = md5($senha_nova);


    $sq = "SELECT * FROM usuarios WHERE id_usuario='$id_usuario'";
    $re = mysqli_query($conexao, $sq);
    $li = mysqli_fetch_assoc($re);

    
    if($senha_antiga!="" and $senha_nova!=""){
    
        if($confirmar_senha!=""){

            if($senha_antiga_MD5 == $li['senha']){

                $sql = "UPDATE usuarios SET nome_usuario='$nome_usuario', senha='$senha_nova_MD5', endereco_imagem_usuario='$endereco_imagem_usuario' WHERE id_usuario=$id_usuario";
                $resultado = mysqli_query($conexao, $sql);

            } else {

                $_SESSION['mensagem'] = 'A senha antiga submetida está incorreta!';
            
                header("Location: __U1_form_altera_usuario.php");

                die;

            }

        } else {

            $_SESSION['mensagem'] = 'Não houve confirmação da nova senha!';
        
            header("Location: __U1_form_altera_usuario.php");

            die;
        }

    } else {
        
        $sql = "UPDATE usuarios SET nome_usuario='$nome_usuario', endereco_imagem_usuario='$endereco_imagem_usuario' WHERE id_usuario='$id_usuario'";
        $resultado = mysqli_query($conexao, $sql);

    }

    if($resultado){

        header("Location: ../index/consumidor/CONS____home_consumidor.php");

    }
?>