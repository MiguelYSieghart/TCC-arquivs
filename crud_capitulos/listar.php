<?php
require_once "../includes/conecta.php";
require_once "../includes/funcoes.php";

$tituloPagina = "Capítulos";
$resultado = mysqli_query($conexao, "SELECT c.*, o.titulo FROM capitulo c INNER JOIN obras o ON o.id_obra = c.obras_id_obra ORDER BY c.data_cadastro DESC");
include "../includes/header.php";
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Capítulos</h1>
    <a class="btn btn-primary" href="cadastrar.php">Adicionar capítulo</a>
</div>

<div class="table-responsive">
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>Mangá</th>
                <th>Capítulo</th>
                <th>Título</th>
                <th>Data</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php while ($linha = mysqli_fetch_assoc($resultado)) { ?>
                <tr>
                    <td><a href="../crud_mangas/visualizar.php?id_obra=<?php echo $linha['obras_id_obra']; ?>"><?php echo e($linha['titulo']); ?></a></td>
                    <td>Cap. <?php echo e($linha['numero_cap']); ?></td>
                    <td><?php echo e($linha['titulo_cap']); ?></td>
                    <td><?php echo e($linha['data_cadastro']); ?></td>
                    <td class="text-end">
                        <a class="btn btn-sm btn-outline-dark" href="../crud_mangas/ler.php?id_cap=<?php echo $linha['id_cap']; ?>">Ler</a>
                        <a class="btn btn-sm btn-outline-primary" href="editar.php?id_cap=<?php echo $linha['id_cap']; ?>">Editar</a>
                        <a class="btn btn-sm btn-outline-danger" href="excluir.php?id_cap=<?php echo $linha['id_cap']; ?>" onclick="return confirm('Deseja excluir este capítulo?')">Excluir</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include "../includes/footer.php"; ?>
