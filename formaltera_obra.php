<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title> Edição dos dados das Obras </title>
</head>


<body>
    <fieldset>

        <?php

        include "conecta.php";

        $id_obra = $_GET['id_obra'];
        $sql = "SELECT * FROM obras WHERE id_obra = $id_obra";
        $resultado = mysqli_query($conexao, $sql);
        $linha = mysqli_fetch_array($resultado);

        mysqli_close($conexao);

        $capa_pre_alteracao = $linha['capa_obra'];

        ?>
        <form action="alterar_obra.php" id="alterar_obra" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_obra" value="<?php echo $linha['id_obra']; ?>">
            <input type="hidden" name="capa_pre_alteracao" value="<?php echo $capa_pre_alteracao; ?>">
            <label for="imagem">
                <p>Imagem de Capa: <br> <input type="file" name="capa_obra"></p>
            </label> <br>

            <label for="titulo">
                <p> Título: <br> <input id="titulo" type="text" name="titulo" value="<?php echo $linha['titulo']; ?>">
                </p>
            </label> <br>

            <label for="autor">
                <p> autor: <br> <input id="autor" type="text" name="autor" value="<?php echo $linha['autor']; ?>"></p>
            </label> <br>

            <label for="ano_lanc">
                <p> Ano Lançamento: <br> <input id="ano_lanc" type="date" name="ano_lanc"
                        value="<?php echo $linha['ano_lanc']; ?>"></p>
            </label> <br>

            <label for="Status_obra">
                <p> Status da obra: <br> <input id="status_obra" type="text" name="status_obra"
                        value="<?php echo $linha['status_obra']; ?>"></p>
            </label> <br>

            <label for="sinopse">
                <textarea id="sinopse" name="sinopse" type="text" form="alterar_obra" rows="8" cols="80"
                    required><?php echo $linha['sinopse']; ?></textarea>
            </label> <br>

            <label for=" demografia">
                <p> Demografia: <br> <input id="demografia" type="text" name="demografia" rows="8" cols="80"
                        value="<?php echo $linha['demografia']; ?>"></p>
            </label> <br>

            <br> <input id="alterar" type="submit" name="alterar" value="SALVAR ALTERAÇÕES"></p>

        </form>

        <br> <a href="obras.php"> Listar obras </a>

    </fieldset>