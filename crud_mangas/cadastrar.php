<?php
require_once "../includes/funcoes.php";

$tituloPagina = "Cadastrar mangá";
$genreRepository = new App\Repositories\GenreRepository();
$generos = $genreRepository->all();
$breadcrumbs = array(
    array('label' => 'Home', 'url' => base_url('home.php')),
    array('label' => 'Títulos', 'url' => base_url('crud_mangas/listar.php')),
    array('label' => 'Cadastrar')
);
include "../includes/header.php";
?>

<?php mr_page_header('<i class="bi bi-plus-circle"></i> Cadastro', 'Cadastrar mangá', 'A capa agora é um link externo e a pasta da obra é criada automaticamente pelo sistema.'); ?>

<form action="inserir.php" method="post" class="card mr-form">
    <div class="card-body">
    <div class="row">
        <div class="col-md-4 mb-3">
            <label for="capa_obra" class="form-label">Link da capa</label>
            <input id="capa_obra" type="url" name="capa_obra" class="form-control" placeholder="https://site.com/capa.jpg">
            <div class="form-text">A pasta da obra será criada automaticamente.</div>
        </div>

        <div class="col-md-8">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input id="titulo" type="text" name="titulo" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="titulo_alt" class="form-label">Título alternativo</label>
                <input id="titulo_alt" type="text" name="titulo_alt" class="form-control">
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="autor" class="form-label">Autor</label>
                    <input id="autor" type="text" name="autor" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="ano_lanc" class="form-label">Ano de lançamento</label>
                    <input id="ano_lanc" type="date" name="ano_lanc" class="form-control" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="demografia" class="form-label">Tipo</label>
                    <select id="demografia" name="demografia" class="form-select" required>
                        <?php foreach (tipos_obras() as $tipo) { ?>
                            <option value="<?php echo e($tipo); ?>"><?php echo e($tipo); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="status_obra" class="form-label">Status</label>
                    <select id="status_obra" name="status_obra" class="form-select" required>
                        <?php foreach (status_obras() as $valor => $texto) { ?>
                            <option value="<?php echo e($valor); ?>"><?php echo e($texto); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Gêneros</label>
                <div class="mr-tags-panel" role="group" aria-label="Gêneros da obra">
                    <?php foreach ($generos as $genero) { ?>
                        <input type="checkbox" class="btn-check" name="generos[]" id="genero_<?php echo $genero['id_genero']; ?>" value="<?php echo $genero['id_genero']; ?>" autocomplete="off">
                        <label class="btn btn-sm btn-outline-primary" for="genero_<?php echo $genero['id_genero']; ?>"><?php echo e($genero['nome_genero']); ?></label>
                    <?php } ?>
                </div>
            </div>

            <div class="mb-3">
                <label for="sinopse" class="form-label">Sinopse</label>
                <textarea id="sinopse" name="sinopse" class="form-control" rows="6" required></textarea>
            </div>

            <div class="mr-form-actions">
                <button type="submit" class="btn btn-primary">Cadastrar</button>
                <a href="listar.php" class="btn btn-outline-primary">Cancelar</a>
            </div>
        </div>
    </div>
    </div>
</form>

<?php include "../includes/footer.php"; ?>
