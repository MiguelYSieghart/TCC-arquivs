<?php
require_once "../includes/conecta.php";
require_once "../includes/funcoes.php";

$id_cap = (int) $_GET['id_cap'];
$resultado = mysqli_query($conexao, "SELECT * FROM capitulo WHERE id_cap = $id_cap");
$capitulo = mysqli_fetch_assoc($resultado);

if (!$capitulo) {
    header("Location: listar.php");
    exit;
}

$obras = mysqli_query($conexao, "SELECT id_obra, titulo FROM obras ORDER BY titulo ASC");
$imagens = mysqli_query($conexao, "SELECT * FROM imagem_cap WHERE capitulo_id_cap = $id_cap ORDER BY ordem ASC, id_img_cap ASC");

$tituloPagina = "Editar capítulo";
include "../includes/header.php";
?>

<h1 class="h3 mb-4">Editar capítulo</h1>

<form action="alterar.php" method="post" enctype="multipart/form-data" class="mr-form">
    <input type="hidden" name="id_cap" value="<?php echo $capitulo['id_cap']; ?>">

    <div class="mb-3">
        <label for="obras_id_obra" class="form-label">Mangá</label>
        <select id="obras_id_obra" name="obras_id_obra" class="form-select" required>
            <?php while ($obra = mysqli_fetch_assoc($obras)) { ?>
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
        <label for="imagens_cap" class="form-label">Adicionar novas imagens</label>
        <input id="imagens_cap" type="file" name="imagens_cap[]" class="form-control" accept="image/*" multiple>
    </div>

    <div class="mb-4">
        <h2 class="h5">Imagens cadastradas</h2>
        <div class="mr-image-preview-grid">
            <?php $temImagem = false; while ($imagem = mysqli_fetch_assoc($imagens)) { $temImagem = true; ?>
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
</form>

<?php include "../includes/footer.php"; ?>
