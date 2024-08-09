<?php
require_once "../includes/funcoes.php";

$tituloPagina = "Favoritos";
$favoriteRepository = new App\Repositories\FavoriteRepository();
$chapterRepository = new App\Repositories\ChapterRepository();
$historyRepository = new App\Repositories\ReadingHistoryRepository();
$resultado = $favoriteRepository->allForCurrentUser();
$totalLeituras = $historyRepository->countForCurrentUser();
$breadcrumbs = array(
    array('label' => 'Home', 'url' => base_url('home.php')),
    array('label' => 'Favoritos')
);

include "../includes/header.php";
?>

<?php mr_page_header('<i class="bi bi-collection"></i> Minha coleção', 'Favoritos', 'Organize as obras marcadas, acompanhe seu progresso e continue pelos capítulos recentes.', array('label' => 'Buscar obras', 'url' => 'listar.php', 'icon' => '<i class="bi bi-search"></i>')); ?>

<div class="row g-4">
    <aside class="col-lg-3 col-xl-2">
        <div class="mr-filter-panel sticky-lg-top">
            <h2>Principal</h2>
            <a class="active" href="favoritos.php"><i class="bi bi-heart-fill"></i> Favoritos <span><?php echo count($resultado); ?></span></a>
            <a href="../auth/perfil.php"><i class="bi bi-clock-history"></i> Histórico <span><?php echo $totalLeituras; ?></span></a>
            <a href="listar.php"><i class="bi bi-grid"></i> Catálogo</a>
            <hr>
            <h2>Status</h2>
            <span><i class="bi bi-play-fill"></i> Lendo</span>
            <span><i class="bi bi-check-lg"></i> Lido</span>
            <span><i class="bi bi-calendar-plus"></i> Planejo ler</span>
        </div>
    </aside>

    <div class="col-lg-9 col-xl-10">
        <?php if (count($resultado) == 0) { ?>
            <div class="alert alert-info">Nenhum mangá favorito ainda.</div>
        <?php } ?>

        <div class="mr-modern-grid">
            <?php foreach ($resultado as $obra) { ?>
                <?php
                $capitulos = $chapterRepository->byManga($obra['id_obra'], 1);
                $capitulo = count($capitulos) > 0 ? $capitulos[0] : null;
                ?>
                <article class="card mr-modern-card">
                    <a class="mr-card-media" href="visualizar.php?id_obra=<?php echo $obra['id_obra']; ?>">
                        <img src="<?php echo caminho_capa($obra['capa_obra']); ?>" alt="<?php echo e($obra['titulo']); ?>">
                        <span class="badge text-bg-danger mr-card-badge"><i class="bi bi-heart-fill"></i> Favorito</span>
                    </a>
                    <a class="mr-fav-dot active" href="favoritar.php?id_obra=<?php echo $obra['id_obra']; ?>&acao=remover" title="Remover favorito">
                        <i class="bi bi-heart-fill"></i>
                    </a>
                    <div class="card-body">
                        <h3 class="card-title"><a href="visualizar.php?id_obra=<?php echo $obra['id_obra']; ?>"><?php echo e($obra['titulo']); ?></a></h3>
                        <div class="mr-card-meta">
                            <span><i class="bi bi-book"></i> <?php echo $capitulo ? 'Cap. ' . e($capitulo['numero_cap']) : 'Sem cap.'; ?></span>
                            <span><i class="bi bi-stars"></i> <?php echo e($obra['demografia']); ?></span>
                        </div>
                    </div>
                </article>
            <?php } ?>
        </div>
    </div>
</div>

<?php include "../includes/footer.php"; ?>
