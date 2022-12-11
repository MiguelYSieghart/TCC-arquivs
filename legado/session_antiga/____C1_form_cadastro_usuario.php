<?php
session_start();
require_once "../_______necessarios/.funcoes.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <title>Criação de Conta</title>

</head>

<body>

    <main class="container">

        <form action="____C2_cadastro_usuario.php" method="post" enctype="multipart/form-data">

            <?php if (isset($_SESSION['mensagem'])) {
                echo "<div class='red'>" . exibeMensagens() . "</div>";
            } ?><br>

            Nome de Usuário:<input id="nome_usuario" name="nome_usuario" type="text" class="validate" required><br>

            <br>

            Imagem de Perfil:<input id="endereco_imagem_usuario" name="endereco_imagem_usuario" type="file" accept="image/*" class="validate"><br>

            <br>

            Email:<input id="email" name="email" type="email" class="validate" required><br>

            <br>

            Senha:<input id="senha" name="senha" type="password" class="validate" required><br>

            <br>

            Confirmar Senha:<input id="confirmar_senha" name="confirmar_senha" type="password" class="validate" required><br>

            <br>
            <br>

            <input type="submit" value="Criar Conta">
            <a href="../index/entrada.php">Cancelar</a>

        </form>

    </main>

    <br>
    <br>

</body>

</html>