<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title> Edição dos dados dos usuários </title>

</head>


<body>

    <fieldset>

        <?php

        include "conecta.php";

        $id_usuario = $_GET['id_usuario'];
        $sql = "SELECT * FROM usuario WHERE id_usuario = $id_usuario";
        $resultado = mysqli_query($conexao, $sql);
        $linha = mysqli_fetch_array($resultado);
        mysqli_close($conexao);

        ?>

        <form action="alterar_usuario.php" method="Post" id="usuario">
            <input type="hidden" name="id_usuario" value="<?php echo $linha['id_usuario']; ?>">

            <label for="nome">
                <p> Nome: <br> <input id="nome" type="text" name="nome" value="<?php echo $linha['nome']; ?>"> </p>
            </label> <br>

            <label for="email">
                <p> E-mail <br> <input id="email" type="text" name="email" value="<?php echo $linha['email']; ?>"></p>
            </label> <br>

            <label for="senha">
                <p> Senha: <br> <input id="senha" type="text" name="senha" value="<?php echo $linha['senha']; ?>"></p>
            </label> <br>

            <label for="sts">
                <p> Status: <br> <input id="sts" type="text" name="sts" value="<?php echo $linha['sts']; ?>"></p>
            </label> <br>

            <label for="permissao">
                <p> Permissões: <br> <input id="permissao" type="text" name="permissao"
                        value="<?php echo $linha['permissao']; ?>"></p>
            </label> <br>


            <br> <input id="alterar" type="submit" name="alterar" value="SALVAR ALTERAÇÕES"></p>

        </form>

        <br> <a href="usuario.php"> Listar Usuários</a>

    </fieldset>