<?php
require_once "../includes/funcoes.php";

$id_obra = (int) $_GET['id_obra'];
$mangaRepository = new App\Repositories\MangaRepository();
$chapterRepository = new App\Repositories\ChapterRepository();
$favoriteRepository = new App\Repositories\FavoriteRepository();
$genreRepository = new App\Repositories\GenreRepository();
$obra = $mangaRepository->find($id_obra);

if (!$obra) {
    header("Location: listar.php");
    exit;
}

$favorito = $favoriteRepository->isFavorite($id_obra);
$capitulos = $chapterRepository->byManga($id_obra);
$generos = $genreRepository->rowsForManga($id_obra);
$primeiroCapitulo = count($capitulos) > 0 ? $capitulos[count($capitulos) - 1] : null;
$tituloPagina = $obra['titulo'];
$breadcrumbs = array(
    array('label' => 'Home', 'url' => base_url('home.php')),
    array('label' => 'Títulos', 'url' => base_url('crud_mangas/listar.php')),
    array('label' => $obra['titulo'])
);
include "../includes/header.php";
?>

<section class="card mr-title-detail mb-4">
    <div class="card-body">
    <div class="row g-4 align-items-start">
        <div class="col-md-4 col-xl-3">
            <img src="<?php echo caminho_capa($obra['capa_obra']); ?>" class="mr-detail-cover" alt="<?php echo e($obra['titulo']); ?>">
        </div>

        <div class="col-md-8 col-xl-9">
            <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                <span class="badge text-bg-warning"><?php echo e($obra['demografia']); ?></span>
                <span class="badge <?php echo status_obra_classe($obra['status_obra']); ?>"><?php echo e(status_obra_label($obra['status_obra'])); ?></span>
            </div>

            <h1 class="mr-detail-title">
                <i class="bi <?php echo $favorito ? 'bi-bookmark-fill' : 'bi-bookmark'; ?>"></i>
                <?php echo e($obra['titulo']); ?>
            </h1>

            <div class="d-flex flex-wrap gap-2 mb-4">
                <?php if ($primeiroCapitulo) { ?>
                    <a class="btn btn-primary" href="ler.php?id_cap=<?php echo $primeiroCapitulo['id_cap']; ?>"><i class="bi bi-play-fill"></i> Começar leitura</a>
                <?php } ?>
                <a class="btn btn-outline-primary" href="editar.php?id_obra=<?php echo $obra['id_obra']; ?>"><i class="bi bi-pencil-fill"></i> Editar</a>
                <a class="btn btn-outline-primary" href="../crud_capitulos/cadastrar.php?id_obra=<?php echo $obra['id_obra']; ?>"><i class="bi bi-plus-lg"></i> Capítulo</a>
                <?php if ($favorito) { ?>
                    <a class="btn btn-outline-danger" href="favoritar.php?id_obra=<?php echo $obra['id_obra']; ?>&acao=remover"><i class="bi bi-heartbreak-fill"></i> Remover favorito</a>
                <?php } else { ?>
                    <a class="btn btn-outline-primary" href="favoritar.php?id_obra=<?php echo $obra['id_obra']; ?>&acao=adicionar"><i class="bi bi-heart-fill"></i> Favoritar</a>
                <?php } ?>
            </div>

            <div class="mr-meta-grid mb-4">
                <div><span>Nomes alternativos</span><strong><?php echo !empty($obra['titulo_alt']) ? e($obra['titulo_alt']) : e($obra['titulo']); ?></strong></div>
                <div><span>Autor</span><strong><?php echo e($obra['autor']); ?></strong></div>
                <div>
                    <span>Gêneros</span>
                    <strong>
                        <?php if (count($generos) > 0) { ?>
                            <?php foreach ($generos as $genero) { ?>
                                <a class="badge bg-primary text-decoration-none me-1 mb-1" href="listar.php?genero=<?php echo $genero['id_genero']; ?>"><?php echo e($genero['nome_genero']); ?></a>
                            <?php } ?>
                        <?php } else { ?>
                            <?php echo e($obra['genero']); ?>
                        <?php } ?>
                    </strong>
                </div>
                <div><span>Lançamento</span><strong><?php echo e($obra['ano_lanc']); ?></strong></div>
                <div><span>Status da scan</span><strong>Em trabalho</strong></div>
                <div><span>Adicionado</span><strong><?php echo e(substr($obra['data_cadastro'], 0, 10)); ?></strong></div>
            </div>

            <div class="accordion" id="accordionDescricao">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingDescricao">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDescricao" aria-expanded="true" aria-controls="collapseDescricao">
                            Descrição da obra
                        </button>
                    </h2>
                    <div id="collapseDescricao" class="accordion-collapse collapse show" aria-labelledby="headingDescricao" data-bs-parent="#accordionDescricao">
                        <div class="accordion-body">
                            <?php echo nl2br(e($obra['sinopse'])); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

<ul class="nav mr-tabs">
    <li class="nav-item"><a class="nav-link active" href="#capitulos">Capítulos</a></li>
    <li class="nav-item"><a class="nav-link" href="#comentarios">Comentários</a></li>
</ul>

<div class="table-responsive" id="capitulos">
    <table class="table table-hover align-middle mb-0 mr-table">
        <thead>
            <tr>
                <th>Capítulo</th>
                <th>Título do capítulo</th>
                <th class="text-center">Adicionado por</th>
                <th class="text-end">Adicionado em</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($capitulos as $capitulo) { ?>
                <tr>
                    <td><a class="fw-bold" href="ler.php?id_cap=<?php echo $capitulo['id_cap']; ?>">Vol. 1 Cap. <?php echo e($capitulo['numero_cap']); ?></a></td>
                    <td>
                        <?php echo e($capitulo['titulo_cap']); ?>
                        <a class="badge bg-primary text-decoration-none" href="../crud_capitulos/editar.php?id_cap=<?php echo $capitulo['id_cap']; ?>"><i class="bi bi-pencil-fill"></i> Editar</a>
                    </td>
                    <td class="text-center"><?php echo isset($_SESSION['nome']) ? e($_SESSION['nome']) : 'Manga Reader'; ?></td>
                    <td class="text-end"><?php echo e($capitulo['data_cadastro']); ?></td>
                </tr>
            <?php } ?>
            <?php if (count($capitulos) == 0) { ?>
                <tr><td colspan="4" class="text-center text-secondary py-4">Nenhum capítulo cadastrado.</td></tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<div id="comentarios" class="mt-4">
    <div class="mr-synopsis">Comentários desativados nesta versão local do TCC.</div>
</div>

<?php include "../includes/footer.php"; ?>
