<?php
require_once "../includes/funcoes.php";

$tituloPagina = "Cadastrar capítulo";
$mangaRepository = new App\Repositories\MangaRepository();
$obras = $mangaRepository->search();
$idSelecionado = isset($_GET['id_obra']) ? (int) $_GET['id_obra'] : 0;
$breadcrumbs = array(
    array('label' => 'Home', 'url' => base_url('home.php')),
    array('label' => 'Capítulos', 'url' => base_url('crud_capitulos/listar.php')),
    array('label' => 'Cadastrar')
);

include "../includes/header.php";
?>

<?php mr_page_header('<i class="bi bi-file-earmark-zip"></i> Cadastro', 'Cadastrar capítulo', 'Envie um ZIP com as páginas em imagem; o sistema cria a pasta do capítulo dentro da pasta da obra.'); ?>

<form action="inserir.php" method="post" enctype="multipart/form-data" class="card mr-form">
    <div class="card-body">
    <div class="mb-3">
        <label for="obras_id_obra" class="form-label">Mangá</label>
        <select id="obras_id_obra" name="obras_id_obra" class="form-select" required>
            <?php foreach ($obras as $obra) { ?>
                <option value="<?php echo $obra['id_obra']; ?>" <?php echo $idSelecionado == $obra['id_obra'] ? 'selected' : ''; ?>><?php echo e($obra['titulo']); ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="row">
        <div class="col-md-4 mb-3">
            <label for="numero_cap" class="form-label">Número</label>
            <input id="numero_cap" type="number" name="numero_cap" class="form-control" required>
        </div>
        <div class="col-md-8 mb-3">
            <label for="titulo_cap" class="form-label">Título do capítulo</label>
            <input id="titulo_cap" type="text" name="titulo_cap" class="form-control">
        </div>
    </div>

    <div class="mb-3">
        <label for="zip_capitulo" class="form-label">Arquivo ZIP do capítulo</label>
        <input id="zip_capitulo" type="file" name="zip_capitulo" class="form-control" accept=".zip,application/zip" required>
        <div class="form-text">Use um ZIP com as páginas em imagem. A ordem segue o nome dos arquivos.</div>
    </div>

    <div class="mr-form-actions">
        <button type="submit" class="btn btn-primary">Cadastrar capítulo</button>
        <a href="listar.php" class="btn btn-outline-primary">Cancelar</a>
    </div>
    </div>
</form>

<?php include "../includes/footer.php"; ?>
