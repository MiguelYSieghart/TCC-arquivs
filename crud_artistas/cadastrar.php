<?php
require_once "../includes/funcoes.php";
$tituloPagina = "Cadastrar artista";
include "../includes/header.php";
?>

<h1 class="h3 mb-4">Cadastrar artista</h1>

<form action="inserir.php" method="post" class="mr-form">
    <div class="mb-3">
        <label for="nome_artist" class="form-label">Nome</label>
        <input id="nome_artist" type="text" name="nome_artist" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="descricao" class="form-label">Descrição</label>
        <textarea id="descricao" name="descricao" class="form-control" rows="4"></textarea>
    </div>

    <div class="mr-form-actions">
        <button type="submit" class="btn btn-primary">Cadastrar</button>
        <a href="listar.php" class="btn btn-outline-primary">Cancelar</a>
    </div>
</form>

<?php include "../includes/footer.php"; ?>
