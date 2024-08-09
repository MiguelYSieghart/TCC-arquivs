<?php
require_once "../includes/funcoes.php";

$id_cap = (int) $_GET['id_cap'];
$chapterRepository = new App\Repositories\ChapterRepository();
$historyRepository = new App\Repositories\ReadingHistoryRepository();
$capitulo = $chapterRepository->findWithManga($id_cap);

if (!$capitulo) {
    header("Location: listar.php");
    exit;
}

$id_obra = (int) $capitulo['id_obra'];
$historyRepository->register($id_cap);
$anterior = $chapterRepository->previous($id_obra, $capitulo['numero_cap']);
$proximo = $chapterRepository->next($id_obra, $capitulo['numero_cap']);
$imagens = $chapterRepository->images($id_cap);

$tituloPagina = $capitulo['titulo'] . " - Cap. " . $capitulo['numero_cap'];
include "../includes/header.php";
?>

<div class="text-center mb-4">
    <h1 class="h3"><?php echo e($capitulo['titulo']); ?> - Cap. <?php echo e($capitulo['numero_cap']); ?></h1>
    <p><?php echo e($capitulo['titulo_cap']); ?></p>

    <div class="btn-group mb-3">
        <a class="btn btn-outline-primary <?php echo empty($anterior['id_cap']) ? 'disabled' : ''; ?>" href="ler.php?id_cap=<?php echo isset($anterior['id_cap']) ? $anterior['id_cap'] : ''; ?>">Anterior</a>
        <a class="btn btn-outline-dark" href="visualizar.php?id_obra=<?php echo $id_obra; ?>">Voltar ao mangá</a>
        <a class="btn btn-outline-primary <?php echo empty($proximo['id_cap']) ? 'disabled' : ''; ?>" href="ler.php?id_cap=<?php echo isset($proximo['id_cap']) ? $proximo['id_cap'] : ''; ?>">Próximo</a>
    </div>
</div>

<div class="mr-reader mx-auto">
    <?php $temImagem = false; foreach ($imagens as $imagem) { $temImagem = true; ?>
        <img src="<?php echo base_url($imagem['caminho']); ?>" alt="Página <?php echo e($imagem['ordem']); ?>">
    <?php } ?>

    <?php if (!$temImagem) { ?>
        <div class="alert alert-info">Este capítulo ainda não possui imagens cadastradas.</div>
    <?php } ?>
</div>

<?php include "../includes/footer.php"; ?>
