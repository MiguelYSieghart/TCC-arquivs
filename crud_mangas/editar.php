<?php
require_once "../includes/conecta.php";
require_once "../includes/funcoes.php";

$id_obra = (int) $_GET['id_obra'];
$resultado = mysqli_query($conexao, "SELECT * FROM obras WHERE id_obra = $id_obra");
$linha = mysqli_fetch_assoc($resultado);

if (!$linha) {
    header("Location: listar.php");
    exit;
}

$tituloPagina = "Editar mangá";
include "../includes/header.php";
?>

<h1 class="h3 mb-4">Editar mangá</h1>

<form action="alterar.php" method="post" enctype="multipart/form-data" class="mr-form">
    <input type="hidden" name="id_obra" value="<?php echo $linha['id_obra']; ?>">
    <input type="hidden" name="capa_pre_alteracao" value="<?php echo e($linha['capa_obra']); ?>">

    <div class="row">
        <div class="col-md-4 mb-3">
            <img src="<?php echo caminho_capa($linha['capa_obra']); ?>" class="img-fluid mb-3" alt="<?php echo e($linha['titulo']); ?>">
            <label for="capa_obra" class="form-label">Trocar capa</label>
            <input id="capa_obra" type="file" name="capa_obra" class="form-control" accept="image/*">
        </div>

        <div class="col-md-8">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input id="titulo" type="text" name="titulo" class="form-control" value="<?php echo e($linha['titulo']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="titulo_alt" class="form-label">Título alternativo</label>
                <input id="titulo_alt" type="text" name="titulo_alt" class="form-control" value="<?php echo e($linha['titulo_alt']); ?>">
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="autor" class="form-label">Autor</label>
                    <input id="autor" type="text" name="autor" class="form-control" value="<?php echo e($linha['autor']); ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="ano_lanc" class="form-label">Ano de lançamento</label>
                    <input id="ano_lanc" type="date" name="ano_lanc" class="form-control" value="<?php echo e($linha['ano_lanc']); ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="demografia" class="form-label">Tipo</label>
                    <select id="demografia" name="demografia" class="form-select" required>
                        <?php foreach (tipos_obras() as $tipo) { ?>
                            <option value="<?php echo e($tipo); ?>" <?php echo $linha['demografia'] == $tipo ? 'selected' : ''; ?>><?php echo e($tipo); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="status_obra" class="form-label">Status</label>
                    <select id="status_obra" name="status_obra" class="form-select" required>
                        <?php foreach (status_obras() as $valor => $texto) { ?>
                            <option value="<?php echo e($valor); ?>" <?php echo $linha['status_obra'] == $valor ? 'selected' : ''; ?>><?php echo e($texto); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="genero" class="form-label">Gênero</label>
                    <input id="genero" type="text" name="genero" class="form-control" value="<?php echo e($linha['genero']); ?>">
                </div>
            </div>

            <div class="mb-3">
                <label for="sinopse" class="form-label">Sinopse</label>
                <textarea id="sinopse" name="sinopse" class="form-control" rows="6" required><?php echo e($linha['sinopse']); ?></textarea>
            </div>

            <div class="mr-form-actions">
                <button type="submit" class="btn btn-primary">Salvar alterações</button>
                <a href="listar.php" class="btn btn-outline-primary">Cancelar</a>
            </div>
        </div>
    </div>
</form>

<?php include "../includes/footer.php"; ?>
