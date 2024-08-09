<?php
require_once "../includes/funcoes.php";

$id_cap = (int) $_GET['id_cap'];
$chapterRepository = new App\Repositories\ChapterRepository();
$mangaRepository = new App\Repositories\MangaRepository();
$capitulo = $chapterRepository->find($id_cap);

if (!$capitulo) {
    header("Location: listar.php");
    exit;
}

$obras = $mangaRepository->search();
$imagens = $chapterRepository->images($id_cap);

$tituloPagina = "Editar capítulo";
$breadcrumbs = array(
    array('label' => 'Home', 'url' => base_url('home.php')),
    array('label' => 'Capítulos', 'url' => base_url('crud_capitulos/listar.php')),
    array('label' => 'Editar')
);
include "../includes/header.php";
?>

<?php mr_page_header('<i class="bi bi-file-earmark-zip"></i> Edição', 'Editar capítulo', 'Altere os dados do capítulo ou acrescente novas páginas usando outro ZIP.'); ?>

<form action="alterar.php" method="post" enctype="multipart/form-data" class="card mr-form">
    <div class="card-body">
    <input type="hidden" name="id_cap" value="<?php echo $capitulo['id_cap']; ?>">

    <div class="mb-3">
        <label for="obras_id_obra" class="form-label">Mangá</label>
        <select id="obras_id_obra" name="obras_id_obra" class="form-select" required>
            <?php foreach ($obras as $obra) { ?>
                <option value="<?php echo $obra['id_obra']; ?>" <?php echo $capitulo['obras_id_obra'] == $obra['id_obra'] ? 'selected' : ''; ?>><?php echo e($obra['titulo']); ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="row">
        <div class="col-md-4 mb-3">
            <label for="numero_cap" class="form-label">Número</label>
            <input id="numero_cap" type="number" name="numero_cap" class="form-control" value="<?php echo e($capitulo['numero_cap']); ?>" required>
        </div>
        <div class="col-md-8 mb-3">
            <label for="titulo_cap" class="form-label">Título do capítulo</label>
            <input id="titulo_cap" type="text" name="titulo_cap" class="form-control" value="<?php echo e($capitulo['titulo_cap']); ?>">
        </div>
    </div>

    <div class="mb-3">
        <label for="zip_capitulo" class="form-label">Adicionar ZIP com novas páginas</label>
        <input id="zip_capitulo" type="file" name="zip_capitulo" class="form-control" accept=".zip,application/zip">
        <div class="form-text">As imagens do ZIP serão adicionadas depois das páginas atuais.</div>
    </div>

    <div class="mb-4">
        <h2 class="h5">Imagens cadastradas</h2>
        <div class="mr-image-preview-grid">
            <?php $temImagem = false; foreach ($imagens as $imagem) { $temImagem = true; ?>
                <div>
                    <img src="<?php echo base_url($imagem['caminho']); ?>" alt="Página <?php echo e($imagem['ordem']); ?>">
                    <span>Página <?php echo e($imagem['ordem']); ?></span>
                </div>
            <?php } ?>
        </div>

        <?php if (!$temImagem) { ?>
            <div class="alert alert-info mb-0">Este capítulo ainda não possui imagens cadastradas.</div>
        <?php } ?>
    </div>

    <div class="mr-form-actions">
        <button type="submit" class="btn btn-primary">Salvar alterações</button>
        <a href="../crud_mangas/visualizar.php?id_obra=<?php echo $capitulo['obras_id_obra']; ?>" class="btn btn-outline-primary">Voltar ao mangá</a>
        <a href="listar.php" class="btn btn-outline-secondary">Listagem</a>
    </div>
    </div>
</form>

<?php include "../includes/footer.php"; ?>
