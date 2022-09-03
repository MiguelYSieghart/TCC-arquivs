<?php
require_once "../includes/conecta.php";
require_once "../includes/funcoes.php";

$tituloPagina = "Favoritos";

if (isset($_SESSION['id_usuario'])) {
    $id_usuario = (int) $_SESSION['id_usuario'];
    $sql = "SELECT o.* FROM favorito f INNER JOIN obras o ON o.id_obra = f.obras_id_obra WHERE f.usuario_id_usuario = $id_usuario ORDER BY f.data_favorito DESC";
} else {
    $ids = array();
    foreach ($_COOKIE as $nome => $valor) {
        if (strpos($nome, 'mangareader_favorito_') === 0) {
            $ids[] = (int) $valor;
        }
    }

    if (count($ids) > 0) {
        $sql = "SELECT * FROM obras WHERE id_obra IN (" . implode(',', $ids) . ") ORDER BY titulo ASC";
    } else {
        $sql = "SELECT * FROM obras WHERE 1 = 0";
    }
}

$resultado = mysqli_query($conexao, $sql);
include "../includes/header.php";
?>

<h1 class="mr-page-title">Favoritos</h1>

<?php if (mysqli_num_rows($resultado) == 0) { ?>
    <div class="alert alert-info">Nenhum mangá favorito ainda.</div>
<?php } ?>

<?php while ($obra = mysqli_fetch_assoc($resultado)) { ?>
    <?php $capitulos = mysqli_query($conexao, "SELECT * FROM capitulo WHERE obras_id_obra = " . (int) $obra['id_obra'] . " ORDER BY numero_cap DESC LIMIT 3"); ?>
    <div class="row mb-5">
        <div class="col-md-2 mb-3">
            <a href="visualizar.php?id_obra=<?php echo $obra['id_obra']; ?>">
                <img src="<?php echo caminho_capa($obra['capa_obra']); ?>" class="img-fluid" alt="<?php echo e($obra['titulo']); ?>">
            </a>
        </div>
        <div class="col-md-10">
            <h2 class="h3">
                <i class="bi bi-bookmark-fill"></i>
                <a href="visualizar.php?id_obra=<?php echo $obra['id_obra']; ?>"><u><?php echo e($obra['titulo']); ?></u></a>
            </h2>

            <table class="table table-sm mb-3">
                <thead>
                    <tr>
                        <th>Capítulo</th>
                        <th>Título do Capítulo</th>
                        <th class="text-end">Adicionado em</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($capitulo = mysqli_fetch_assoc($capitulos)) { ?>
                        <tr>
                            <td><a href="ler.php?id_cap=<?php echo $capitulo['id_cap']; ?>">Cap. <?php echo e($capitulo['numero_cap']); ?></a></td>
                            <td><?php echo e($capitulo['titulo_cap']); ?></td>
                            <td class="text-end"><?php echo e($capitulo['data_cadastro']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <div class="mr-synopsis p-3">
                <div class="mr-row-desc">
                    <?php echo nl2br(e($obra['sinopse'])); ?>
                </div>
                <a class="btn btn-sm btn-outline-primary mt-3" href="visualizar.php?id_obra=<?php echo $obra['id_obra']; ?>">Ler mais</a>
            </div>
        </div>
    </div>
<?php } ?>

<?php include "../includes/footer.php"; ?>
