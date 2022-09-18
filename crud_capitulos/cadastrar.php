<?php
require_once "../includes/conecta.php";
require_once "../includes/funcoes.php";

$tituloPagina = "Cadastrar capítulo";
$obras = mysqli_query($conexao, "SELECT id_obra, titulo FROM obras ORDER BY titulo ASC");
$idSelecionado = isset($_GET['id_obra']) ? (int) $_GET['id_obra'] : 0;

include "../includes/header.php";
?>

<h1 class="h3 mb-4">Cadastrar capítulo</h1>

<form action="inserir.php" method="post" enctype="multipart/form-data" class="mr-form">
    <div class="mb-3">
        <label for="obras_id_obra" class="form-label">Mangá</label>
        <select id="obras_id_obra" name="obras_id_obra" class="form-select" required>
            <?php while ($obra = mysqli_fetch_assoc($obras)) { ?>
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
        <label for="imagens_cap" class="form-label">Imagens do capítulo</label>
        <input id="imagens_cap" type="file" name="imagens_cap[]" class="form-control" accept="image/*" multiple>
    </div>

    <div class="mr-form-actions">
        <button type="submit" class="btn btn-primary">Cadastrar capítulo</button>
        <a href="listar.php" class="btn btn-outline-primary">Cancelar</a>
    </div>
</form>

<?php include "../includes/footer.php"; ?>
