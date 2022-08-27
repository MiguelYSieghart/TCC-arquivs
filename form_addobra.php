<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Cadastar Obra</title>

</head>

<body>
    <?php

    ?>

    <div id="parallelogram"></div>

    <section>

        <form action="insere_obra.php" method="post" enctype="multipart/form-data">

            <h1>Cadastro de Obras</h1>

            <fieldset>

                <center>
                    <div class="max-width">
                        <div class="imageContainer">
                            <img src="camera.png" alt="Selecione uma imagem" id="imgPhoto">
                        </div>


                        <input type="file" id="flImage" name="capa_obra" accept="images/*">

                    </div>
                </center>

            </fieldset>

            <fieldset>
                <div class="container">
                    <label>Titulo da Obra:</label> <input type="text" name="titulo" required>
                </div>

                <div class="container">
                    <label>Nome Autor:</label> <input type="text" name="autor" required>
                </div>
            </fieldset>

            <fieldset>
                <div class="ano">
                    <label>Ano de lançamento:</label><input type="date" name="ano_lanc" required>
                </div>

                <div class="container">
                    <label>Status:</label> <input type="text" name="status_obra" required>
                </div>
            </fieldset>

            <fieldset>
                <div class="container">
                    <label>Sinopse:</label> <br><textarea rows="8" cols="40" name="sinopse" required></textarea>
                </div>
            </fieldset>

            <fieldset>
                <div class="radio">
                    <label>Dêmografia:</label> <br>
                    <input id="novel" type="radio" name="demografia" value="Novel" required> Novel
                    <input id="manga" type="radio" name="demografia" value="Manga" required> Manga
                    <input id="manhua" type="radio" name="demografia" value="Manhua" required> Manhua
                    <input id="manhwa" type="radio" name="demografia" value="Manhwa" required> Manhwa
                </div>
            </fieldset>

            <fieldset>
                <div class="buttom">
                    <input type="submit" value="Enviar">
                </div>

                <div class="buttom">
                    <input type="reset" value="Redefinir">
                </div>

                <div class="buttom">
                    <a href="obras.php">Cancelar</a>
                </div>
            </fieldset>

        </form>

    </section>

    <script src="script.js"></script>
</body>

</html>