<?php
require_once "../includes/funcoes.php";

$tituloPagina = "Títulos";
$busca = isset($_GET['busca']) ? $_GET['busca'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';
$generoSelecionado = isset($_GET['genero']) ? (int) $_GET['genero'] : 0;
$mangaRepository = new App\Repositories\MangaRepository();
$chapterRepository = new App\Repositories\ChapterRepository();
$favoriteRepository = new App\Repositories\FavoriteRepository();
$genreRepository = new App\Repositories\GenreRepository();
$resultado = $mangaRepository->search($busca, $status, $generoSelecionado);
$abas = array_merge(array('' => 'Todos'), status_obras());
$generos = $genreRepository->all();
$generoAtual = 'Todos os gêneros';
foreach ($generos as $generoItem) {
    if ($generoSelecionado == $generoItem['id_genero']) {
        $generoAtual = $generoItem['nome_genero'];
        break;
    }
}
$idsObras = array();
foreach ($resultado as $obraTags) {
    $idsObras[] = $obraTags['id_obra'];
}
$tagsPorObra = $genreRepository->tagsForMangas($idsObras);
$breadcrumbs = array(
    array('label' => 'Home', 'url' => base_url('home.php')),
    array('label' => 'Títulos')
);

include "../includes/header.php";
?>

<?php mr_page_header('<i class="bi bi-search"></i> Buscar', 'Biblioteca de obras', 'Explore os títulos cadastrados, filtre por status e abra a página da obra para ver a descrição completa.', array('label' => 'Adicionar', 'url' => 'cadastrar.php', 'icon' => '<i class="bi bi-plus-lg"></i>')); ?>

<form class="card mr-library-filter mb-3" method="get">
    <div class="card-body">
        <input type="hidden" name="status" value="<?php echo e($status); ?>">

        <div class="input-group input-group-lg">
            <span class="input-group-text"><i class="bi bi-search"></i></span>
            <input type="search" name="busca" class="form-control" placeholder="Buscar por título, autor ou gênero..." value="<?php echo e($busca); ?>" aria-label="Buscar obra">
            <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i> Buscar</button>
        </div>

        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mt-3">
            <div class="btn-toolbar gap-2" role="toolbar" aria-label="Filtros da biblioteca">
                <button class="btn btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#filtrosBiblioteca" aria-expanded="<?php echo $generoSelecionado > 0 ? 'true' : 'false'; ?>" aria-controls="filtrosBiblioteca">
                    <i class="bi bi-sliders"></i> Filtros
                </button>

                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo e($generoAtual); ?>
                    </button>
                    <ul class="dropdown-menu mr-filter-dropdown">
                        <li><a class="dropdown-item <?php echo $generoSelecionado == 0 ? 'active' : ''; ?>" href="listar.php?status=<?php echo urlencode($status); ?>&busca=<?php echo urlencode($busca); ?>&genero=0">Todos os gêneros</a></li>
                        <?php foreach ($generos as $genero) { ?>
                            <li><a class="dropdown-item <?php echo $generoSelecionado == $genero['id_genero'] ? 'active' : ''; ?>" href="listar.php?status=<?php echo urlencode($status); ?>&busca=<?php echo urlencode($busca); ?>&genero=<?php echo $genero['id_genero']; ?>"><?php echo e($genero['nome_genero']); ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>

            <div class="d-flex flex-wrap align-items-center gap-2">
                <span class="badge text-bg-secondary"><?php echo count($resultado); ?> obras</span>
                <?php if ($status != '') { ?>
                    <span class="badge <?php echo status_obra_classe($status); ?>"><?php echo e(status_obra_label($status)); ?></span>
                <?php } ?>
            </div>
        </div>

        <div class="collapse <?php echo $generoSelecionado > 0 ? 'show' : ''; ?>" id="filtrosBiblioteca">
            <div class="mr-filter-collapse mt-3 pt-3">
                <label class="form-label mb-2">Gêneros</label>
                <div class="mr-filter-chips" role="group" aria-label="Filtrar por gênero">
                    <input type="radio" class="btn-check" name="genero" id="genero_0" value="0" autocomplete="off" <?php echo $generoSelecionado == 0 ? 'checked' : ''; ?>>
                    <label class="btn btn-sm btn-outline-primary" for="genero_0">Todos</label>

                    <?php foreach ($generos as $genero) { ?>
                        <input type="radio" class="btn-check" name="genero" id="genero_<?php echo $genero['id_genero']; ?>" value="<?php echo $genero['id_genero']; ?>" autocomplete="off" <?php echo $generoSelecionado == $genero['id_genero'] ? 'checked' : ''; ?>>
                        <label class="btn btn-sm btn-outline-primary" for="genero_<?php echo $genero['id_genero']; ?>"><?php echo e($genero['nome_genero']); ?></label>
                    <?php } ?>
                </div>

                <div class="d-flex flex-wrap gap-2 mt-3">
                    <button class="btn btn-primary" type="submit"><i class="bi bi-check-lg"></i> Aplicar filtros</button>
                    <a class="btn btn-outline-secondary" href="listar.php?status=<?php echo urlencode($status); ?>"><i class="bi bi-x-lg"></i> Limpar filtros</a>
                </div>
            </div>
        </div>
    </div>
</form>

<ul class="nav mr-tabs">
    <?php foreach ($abas as $valor => $texto) { ?>
        <li class="nav-item">
            <a class="nav-link <?php echo $status == $valor ? 'active' : ''; ?>" href="listar.php?status=<?php echo urlencode($valor); ?>&busca=<?php echo urlencode($busca); ?>&genero=<?php echo $generoSelecionado; ?>">
                <?php echo e($texto); ?>
            </a>
        </li>
    <?php } ?>
</ul>

<?php if (count($resultado) == 0) { ?>
    <div class="alert alert-info">Nenhuma obra encontrada.</div>
<?php } ?>

<div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xl-6 row-cols-xxl-8 g-3 mr-library-grid">
    <?php foreach ($resultado as $obra) { ?>
        <?php
        $capitulos = $chapterRepository->byManga($obra['id_obra'], 1);
        $capitulo = count($capitulos) > 0 ? $capitulos[0] : null;
        $favorito = $favoriteRepository->isFavorite($obra['id_obra']);
        ?>
        <div class="col">
            <article class="card h-100 mr-modern-card mr-library-card">
                <a class="mr-card-media" href="visualizar.php?id_obra=<?php echo $obra['id_obra']; ?>">
                    <img src="<?php echo caminho_capa($obra['capa_obra']); ?>" alt="<?php echo e($obra['titulo']); ?>">
                    <span class="badge mr-card-badge <?php echo status_obra_classe($obra['status_obra']); ?>"><?php echo e(status_obra_label($obra['status_obra'])); ?></span>
                </a>
                <a class="mr-fav-dot <?php echo $favorito ? 'active' : ''; ?>" href="favoritar.php?id_obra=<?php echo $obra['id_obra']; ?>&acao=<?php echo $favorito ? 'remover' : 'adicionar'; ?>" title="<?php echo $favorito ? 'Remover favorito' : 'Adicionar favorito'; ?>">
                    <i class="bi bi-heart-fill"></i>
                </a>
                <div class="card-body">
                    <h3 class="card-title"><a href="visualizar.php?id_obra=<?php echo $obra['id_obra']; ?>"><?php echo e($obra['titulo']); ?></a></h3>
                    <div class="mr-card-meta">
                        <span><i class="bi bi-book"></i> <?php echo $capitulo ? 'Cap. ' . e($capitulo['numero_cap']) : 'Sem cap.'; ?></span>
                        <span><i class="bi bi-stars"></i> <?php echo e($obra['demografia']); ?></span>
                    </div>
                    <div class="mr-card-tags">
                        <?php if (isset($tagsPorObra[$obra['id_obra']])) { ?>
                            <?php foreach (array_slice($tagsPorObra[$obra['id_obra']], 0, 3) as $tag) { ?>
                                <span><?php echo e($tag); ?></span>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="mr-actions w-100 mt-2">
                        <a class="btn btn-sm btn-outline-primary flex-fill" href="editar.php?id_obra=<?php echo $obra['id_obra']; ?>" title="Editar"><i class="bi bi-pencil-fill"></i></a>
                        <?php $modalId = 'modalExcluirObra' . $obra['id_obra']; ?>
                        <?php mr_delete_button($modalId); ?>
                    </div>
                </div>
            </article>
        </div>
    <?php } ?>
</div>

<?php foreach ($resultado as $obra) { ?>
    <?php mr_delete_modal('modalExcluirObra' . $obra['id_obra'], 'Excluir obra', 'Deseja realmente excluir este mangá?', 'excluir.php?id_obra=' . $obra['id_obra']); ?>
<?php } ?>

<?php include "../includes/footer.php"; ?>
