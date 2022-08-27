<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title> Edição dos dados dos Artistas </title>

</head>


<body>

    <fieldset>

        <?php

        include "conecta.php";

        $id_art = $_GET['id_art'];
        $sql = "SELECT * FROM artista WHERE id_art = $id_art";
        $resultado = mysqli_query($conexao, $sql);
        $linha = mysqli_fetch_array($resultado);
        mysqli_close($conexao);

        ?>

        <form action="alterar_artista.php" id="alterar_artista" method="Post">
            <input type="hidden" name="id_art" value="<?php echo $linha['id_art']; ?>">

            <label for="nome_artist">
                <p> Nome: <br> <input id="nome_artist" type="text" name="nome_artist"
                        value="<?php echo $linha['nome_artist']; ?>">
                </p>
            </label> <br>


            <br> <input id="alterar" type="submit" name="alterar" value="SALVAR ALTERAÇÕES"></p>

        </form>

        <br> <a href="artista.php"> Listar Artistas</a>

    </fieldset>