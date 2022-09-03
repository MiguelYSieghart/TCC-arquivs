<?php
require_once "../includes/conecta.php";
require_once "../includes/funcoes.php";

$id_cap = (int) $_GET['id_cap'];
$resultado = mysqli_query($conexao, "SELECT c.*, o.titulo, o.id_obra FROM capitulo c INNER JOIN obras o ON o.id_obra = c.obras_id_obra WHERE c.id_cap = $id_cap");
$capitulo = mysqli_fetch_assoc($resultado);

if (!$capitulo) {
    header("Location: listar.php");
    exit;
}

$id_obra = (int) $capitulo['id_obra'];
$anterior = mysqli_fetch_assoc(mysqli_query($conexao, "SELECT * FROM capitulo WHERE obras_id_obra = $id_obra AND numero_cap < " . (int) $capitulo['numero_cap'] . " ORDER BY numero_cap DESC LIMIT 1"));
$proximo = mysqli_fetch_assoc(mysqli_query($conexao, "SELECT * FROM capitulo WHERE obras_id_obra = $id_obra AND numero_cap > " . (int) $capitulo['numero_cap'] . " ORDER BY numero_cap ASC LIMIT 1"));
$imagens = mysqli_query($conexao, "SELECT * FROM imagem_cap WHERE capitulo_id_cap = $id_cap ORDER BY ordem ASC, id_img_cap ASC");

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
    <?php $temImagem = false; while ($imagem = mysqli_fetch_assoc($imagens)) { $temImagem = true; ?>
        <img src="<?php echo base_url($imagem['caminho']); ?>" alt="Página <?php echo e($imagem['ordem']); ?>">
    <?php } ?>

    <?php if (!$temImagem) { ?>
        <div class="alert alert-info">Este capítulo ainda não possui imagens cadastradas.</div>
    <?php } ?>
</div>

<?php include "../includes/footer.php"; ?>
