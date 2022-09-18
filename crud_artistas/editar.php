<?php
require_once "../includes/conecta.php";
require_once "../includes/funcoes.php";

$id_art = (int) $_GET['id_art'];
$resultado = mysqli_query($conexao, "SELECT * FROM artista WHERE id_art = $id_art");
$linha = mysqli_fetch_assoc($resultado);

if (!$linha) {
    header("Location: listar.php");
    exit;
}

$tituloPagina = "Editar artista";
include "../includes/header.php";
?>

<h1 class="h3 mb-4">Editar artista</h1>

<form action="alterar.php" method="post" class="mr-form">
    <input type="hidden" name="id_art" value="<?php echo $linha['id_art']; ?>">

    <div class="mb-3">
        <label for="nome_artist" class="form-label">Nome</label>
        <input id="nome_artist" type="text" name="nome_artist" class="form-control" value="<?php echo e($linha['nome_artist']); ?>" required>
    </div>

    <div class="mb-3">
        <label for="descricao" class="form-label">Descrição</label>
        <textarea id="descricao" name="descricao" class="form-control" rows="4"><?php echo e($linha['descricao']); ?></textarea>
    </div>

    <div class="mr-form-actions">
        <button type="submit" class="btn btn-primary">Salvar alterações</button>
        <a href="listar.php" class="btn btn-outline-primary">Cancelar</a>
    </div>
</form>

<?php include "../includes/footer.php"; ?>
