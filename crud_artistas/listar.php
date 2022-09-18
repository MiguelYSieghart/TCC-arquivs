<?php
require_once "../includes/conecta.php";
require_once "../includes/funcoes.php";

$tituloPagina = "Artistas";
$resultado = mysqli_query($conexao, "SELECT * FROM artista ORDER BY nome_artist ASC");
include "../includes/header.php";
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Artistas</h1>
    <a class="btn btn-primary" href="cadastrar.php">Adicionar artista</a>
</div>

<div class="table-responsive">
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php while ($linha = mysqli_fetch_assoc($resultado)) { ?>
                <tr>
                    <td><?php echo e($linha['id_art']); ?></td>
                    <td><?php echo e($linha['nome_artist']); ?></td>
                    <td><div class="mr-row-desc"><?php echo e($linha['descricao']); ?></div></td>
                    <td class="text-end">
                        <a class="btn btn-sm btn-outline-primary" href="editar.php?id_art=<?php echo $linha['id_art']; ?>">Editar</a>
                        <a class="btn btn-sm btn-outline-danger" href="excluir.php?id_art=<?php echo $linha['id_art']; ?>" onclick="return confirm('Deseja excluir este artista?')">Excluir</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include "../includes/footer.php"; ?>
