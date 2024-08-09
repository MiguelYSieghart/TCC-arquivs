<?php
require_once "includes/funcoes.php";

$tituloPagina = "Home";
$mangaRepository = new App\Repositories\MangaRepository();
$chapterRepository = new App\Repositories\ChapterRepository();
$favoriteRepository = new App\Repositories\FavoriteRepository();
$historyRepository = new App\Repositories\ReadingHistoryRepository();

$destaques = $mangaRepository->random(5);
$destaque = count($destaques) > 0 ? $destaques[0] : null;
$ultimasObras = $mangaRepository->latest(18);
$ultimosCapitulos = $chapterRepository->latest(24);
$historico = App\Support\Auth::check() ? $historyRepository->recent(12) : array();
$favoritos = $favoriteRepository->allForCurrentUser();

if (count($favoritos) == 0) {
    $favoritos = array_slice($ultimasObras, 0, 12);
}

function mr_card_obra($obra, $chapterRepository, $favoriteRepository)
{
    $capitulos = $chapterRepository->byManga($obra['id_obra'], 1);
    $capitulo = count($capitulos) > 0 ? $capitulos[0] : null;
    $favorito = $favoriteRepository->isFavorite($obra['id_obra']);
    ?>
    <article class="card mr-modern-card">
        <a class="mr-card-media" href="<?php echo base_url('crud_mangas/visualizar.php?id_obra=' . $obra['id_obra']); ?>">
            <img src="<?php echo caminho_capa($obra['capa_obra']); ?>" alt="<?php echo e($obra['titulo']); ?>">
            <span class="badge text-bg-dark mr-card-badge"><?php echo e($obra['demografia']); ?></span>
        </a>
        <a class="mr-fav-dot <?php echo $favorito ? 'active' : ''; ?>" href="<?php echo base_url('crud_mangas/favoritar.php?id_obra=' . $obra['id_obra'] . '&acao=' . ($favorito ? 'remover' : 'adicionar')); ?>" title="<?php echo $favorito ? 'Remover favorito' : 'Adicionar favorito'; ?>">
            <i class="bi bi-heart-fill"></i>
        </a>
        <div class="card-body">
            <h3 class="card-title"><a href="<?php echo base_url('crud_mangas/visualizar.php?id_obra=' . $obra['id_obra']); ?>"><?php echo e($obra['titulo']); ?></a></h3>
            <div class="mr-card-meta">
                <span><i class="bi bi-book"></i> <?php echo $capitulo ? 'Cap. ' . e($capitulo['numero_cap']) : 'Sem cap.'; ?></span>
                <span><i class="bi bi-stars"></i> <?php echo e($obra['demografia']); ?></span>
            </div>
        </div>
    </article>
<?php }

function mr_card_capitulo($capitulo, $marcarNovo = false)
{
    $numeroExibido = $capitulo['numero_cap'];
    $idCapitulo = $capitulo['id_cap'];
    $dataCapitulo = $capitulo['data_cadastro'];
    $temNovo = $marcarNovo;

    if (isset($capitulo['ultimo_numero_cap']) && (int) $capitulo['ultimo_numero_cap'] > (int) $capitulo['numero_cap']) {
        $numeroExibido = $capitulo['ultimo_numero_cap'];
        $idCapitulo = $capitulo['ultimo_id_cap'];
        $dataCapitulo = $capitulo['ultimo_data_cadastro'];
        $temNovo = true;
    }
    ?>
    <article class="card mr-modern-card">
        <a class="mr-card-media" href="<?php echo base_url('crud_mangas/ler.php?id_cap=' . $idCapitulo); ?>">
            <img src="<?php echo caminho_capa($capitulo['capa_obra']); ?>" alt="<?php echo e($capitulo['titulo']); ?>">
            <span class="badge text-bg-dark mr-card-badge"><?php echo e($capitulo['demografia']); ?></span>
            <?php if ($temNovo) { ?>
                <span class="badge text-bg-primary mr-card-badge-top"><i class="bi bi-lightning-charge-fill"></i> Novo cap.</span>
            <?php } ?>
        </a>
        <div class="card-body">
            <h3 class="card-title"><a href="<?php echo base_url('crud_mangas/visualizar.php?id_obra=' . $capitulo['obras_id_obra']); ?>"><?php echo e($capitulo['titulo']); ?></a></h3>
            <div class="mr-card-meta">
                <span><i class="bi bi-book"></i> Cap. <?php echo e($numeroExibido); ?></span>
                <span><i class="bi bi-clock"></i> <?php echo e(substr($dataCapitulo, 0, 10)); ?></span>
            </div>
        </div>
    </article>
<?php }

include "includes/header.php";
?>

<?php if (count($destaques) > 0) { ?>
    <section id="destaquesCarousel" class="carousel slide mr-hero-carousel mb-5" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <?php foreach ($destaques as $index => $itemDestaque) { ?>
                <button type="button" data-bs-target="#destaquesCarousel" data-bs-slide-to="<?php echo $index; ?>" class="<?php echo $index == 0 ? 'active' : ''; ?>" aria-current="<?php echo $index == 0 ? 'true' : 'false'; ?>" aria-label="Destaque <?php echo $index + 1; ?>"></button>
            <?php } ?>
        </div>

        <div class="carousel-inner">
            <?php foreach ($destaques as $index => $itemDestaque) { ?>
                <?php $capituloDestaque = $chapterRepository->byManga($itemDestaque['id_obra'], 1); ?>
                <div class="carousel-item <?php echo $index == 0 ? 'active' : ''; ?>">
                    <div class="mr-hero">
                        <div class="mr-hero-glow"></div>
                        <div class="row g-4 align-items-center position-relative">
                            <div class="col-md-auto">
                                <a href="<?php echo base_url('crud_mangas/visualizar.php?id_obra=' . $itemDestaque['id_obra']); ?>">
                                    <img class="mr-hero-cover" src="<?php echo caminho_capa($itemDestaque['capa_obra']); ?>" alt="<?php echo e($itemDestaque['titulo']); ?>">
                                </a>
                            </div>
                            <div class="col-md">
                                <span class="badge rounded-pill text-bg-warning mb-3"><i class="bi bi-lightning-charge-fill"></i> Destaque</span>
                                <h1><?php echo e($itemDestaque['titulo']); ?></h1>
                                <p class="mr-hero-text"><?php echo e($itemDestaque['sinopse']); ?></p>
                                <div class="d-flex flex-wrap gap-2">
                                    <?php if (count($capituloDestaque) > 0) { ?>
                                        <a class="btn btn-primary" href="<?php echo base_url('crud_mangas/ler.php?id_cap=' . $capituloDestaque[0]['id_cap']); ?>"><i class="bi bi-play-fill"></i> Começar a ler</a>
                                    <?php } ?>
                                    <a class="btn btn-outline-light" href="<?php echo base_url('crud_mangas/visualizar.php?id_obra=' . $itemDestaque['id_obra']); ?>"><i class="bi bi-info-circle"></i> Ver detalhes</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#destaquesCarousel" data-bs-slide="prev" aria-label="Destaque anterior">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#destaquesCarousel" data-bs-slide="next" aria-label="Próximo destaque">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
    </section>
<?php } ?>

<?php if (count($historico) > 0) { ?>
    <section class="mb-5">
        <div class="mr-section-heading">
            <h2><i class="bi bi-book-half"></i> Continue lendo</h2>
            <a href="<?php echo base_url('auth/perfil.php'); ?>">Histórico</a>
        </div>
        <div class="mr-shelf">
            <?php foreach ($historico as $item) { ?>
                <?php mr_card_capitulo($item); ?>
            <?php } ?>
        </div>
    </section>
<?php } ?>

<section class="mb-5">
    <div class="mr-section-heading">
        <h2><i class="bi bi-heart-fill"></i> Favoritas atualizadas</h2>
        <a href="<?php echo base_url('crud_mangas/favoritos.php'); ?>">Minha coleção</a>
    </div>
    <div class="mr-shelf">
        <?php foreach ($favoritos as $obra) { ?>
            <?php mr_card_obra($obra, $chapterRepository, $favoriteRepository); ?>
        <?php } ?>
    </div>
</section>

<section class="mb-5">
    <div class="mr-section-heading">
        <h2><i class="bi bi-compass-fill"></i> Lançamentos</h2>
        <a href="<?php echo base_url('crud_mangas/listar.php'); ?>">Ver todos</a>
    </div>
    <div class="mr-shelf">
        <?php foreach ($ultimasObras as $obra) { ?>
            <?php mr_card_obra($obra, $chapterRepository, $favoriteRepository); ?>
        <?php } ?>
    </div>
</section>

<section>
    <div class="mr-section-heading">
        <h2><i class="bi bi-clock-history"></i> Atualizados recentes</h2>
        <a href="<?php echo base_url('crud_capitulos/listar.php'); ?>">Capítulos</a>
    </div>
    <div class="mr-modern-grid">
        <?php foreach ($ultimosCapitulos as $capitulo) { ?>
            <?php mr_card_capitulo($capitulo, true); ?>
        <?php } ?>
    </div>
</section>

<?php include "includes/footer.php"; ?>
