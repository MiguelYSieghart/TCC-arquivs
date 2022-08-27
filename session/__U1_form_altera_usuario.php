<?php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    $_SESSION['mensagem'] = "Você deve primeiro realizar o login!";
    header("Location: ../index/entrada.php");
}

require_once "../_______necessarios/.funcoes.php";
require_once "../_______necessarios/.conexao_bd.php";

$paginaCorrente = basename($_SERVER['SCRIPT_NAME']);

$sql = "SELECT * FROM usuarios WHERE id_usuario='" . $_SESSION['id_usuario']."'";
$resultado = mysqli_query($conexao, $sql);
$linha = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <title>Alteração de Usuário</title>

</head>

<body>

    <main>

        <form action="__U2_altera_usuario.php" method="post" enctype="multipart/form-data">

            <br>

            <?php if (isset($_SESSION['mensagem'])) {
                echo "<div class='red-text'>" . exibeMensagens() . "</div><br>";
            } ?><br>

            Nome de Usuário:<input id="nome_usuario" name="nome_usuario" type="text" class="validate" value="<?php echo $linha['nome_usuario']; ?>" required><br>

            <br>

            Imagem de Perfil:<input id="endereco_imagem_usuario" name="endereco_imagem_usuario" type="file" accept="image/*" class="validate"><br>

            <br>

            Senha Antiga:<input id="senha_antiga" name="senha_antiga" type="password" class="validate"><br>

            <br>

            Senha Nova:<input id="senha_nova" name="senha_nova" type="password" class="validate"><br>

            <br>

            Confirmar Senha Nova:<input id="confirmar_senha" name="confirmar_senha" type="password" onblur="validarSenha()" class="validate"><br>

            <br>
            <br>

            <input type="hidden" name="endereco_imagem_usuario_pre_alteracao" value="<?php echo $linha['endereco_imagem_usuario'];?>">


            <input type="submit" value="Enviar">
            <a href="javascript:window.history.go(-1)">Cancelar</a>

        </form>

    </main>

</body>

</html>