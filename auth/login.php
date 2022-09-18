<?php
require_once "../includes/funcoes.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['id_usuario'])) {
    header("Location: ../home.php");
    exit;
}

$tituloPagina = "Login";
include "../includes/header.php";
?>

<div class="row justify-content-center">
    <div class="col-md-5">
        <h1 class="h3 mb-4">Login</h1>

        <?php if (isset($_SESSION['mensagem'])) { ?>
            <div class="alert alert-warning"><?php echo e($_SESSION['mensagem']); unset($_SESSION['mensagem']); ?></div>
        <?php } ?>

        <form action="entrar.php" method="post" class="mr-form">
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input id="email" name="email" type="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input id="senha" name="senha" type="password" class="form-control" required>
            </div>

            <div class="mr-form-actions">
                <button type="submit" class="btn btn-primary">Entrar</button>
                <a href="../home.php" class="btn btn-outline-primary">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<?php include "../includes/footer.php"; ?>
