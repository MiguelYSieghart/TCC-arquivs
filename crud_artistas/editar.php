<?php
require_once "../includes/funcoes.php";

$id_art = (int) $_GET['id_art'];
$artistRepository = new App\Repositories\ArtistRepository();
$linha = $artistRepository->find($id_art);

if (!$linha) {
    header("Location: listar.php");
    exit;
}

$tituloPagina = "Editar artista";
$breadcrumbs = array(
    array('label' => 'Home', 'url' => base_url('home.php')),
    array('label' => 'Artistas', 'url' => base_url('crud_artistas/listar.php')),
    array('label' => 'Editar')
);
include "../includes/header.php";
?>

<?php mr_page_header('<i class="bi bi-pencil-square"></i> Edição', 'Editar artista', 'Atualize o cadastro do artista ou grupo.'); ?>

<form action="alterar.php" method="post" class="card mr-form">
    <div class="card-body">
    <input type="hidden" name="id_art" value="<?php echo $linha['id_art']; ?>">

    <div class="mb-3">
        <label for="nome_artist" class="form-label">Nome</label>
        <input id="nome_artist" type="text" name="nome_artist" class="form-control" value="<?php echo e($linha['nome_artist']); ?>" required>
    </div>

    <div class="mb-3">
        <label for="descricao" class="form-label">Descrição</label>
        <textarea id="descricao" name="descricao" class="form-control" rows="4"><?php echo e($linha['descricao']); ?></textarea>
    </div>

    <div class="mr-form-actions">
        <button type="submit" class="btn btn-primary">Salvar alterações</button>
        <a href="listar.php" class="btn btn-outline-primary">Cancelar</a>
    </div>
    </div>
</form>

<?php include "../includes/footer.php"; ?>
