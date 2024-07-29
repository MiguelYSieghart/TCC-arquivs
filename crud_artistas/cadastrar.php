<?php
require_once "../includes/funcoes.php";
$tituloPagina = "Cadastrar artista";
$breadcrumbs = array(
    array('label' => 'Home', 'url' => base_url('home.php')),
    array('label' => 'Artistas', 'url' => base_url('crud_artistas/listar.php')),
    array('label' => 'Cadastrar')
);
include "../includes/header.php";
?>

<?php mr_page_header('<i class="bi bi-plus-circle"></i> Cadastro', 'Cadastrar artista', 'Adicione o nome e uma descrição curta do artista ou grupo.'); ?>

<form action="inserir.php" method="post" class="card mr-form">
    <div class="card-body">
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
    </div>
</form>

<?php include "../includes/footer.php"; ?>
