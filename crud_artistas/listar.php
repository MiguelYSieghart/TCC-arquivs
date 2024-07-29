<?php
require_once "../includes/funcoes.php";

$tituloPagina = "Artistas";
$artistRepository = new App\Repositories\ArtistRepository();
$resultado = $artistRepository->all();
$breadcrumbs = array(
    array('label' => 'Home', 'url' => base_url('home.php')),
    array('label' => 'Artistas')
);
include "../includes/header.php";
?>

<?php mr_page_header('<i class="bi bi-people"></i> Administração', 'Artistas', 'Cadastro dos grupos e artistas associados às obras.', array('label' => 'Adicionar artista', 'url' => 'cadastrar.php', 'icon' => '<i class="bi bi-plus-lg"></i>')); ?>

<div class="table-responsive">
    <table class="table table-hover table-striped align-middle mr-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($resultado as $linha) { ?>
                <tr>
                    <td><?php echo e($linha['id_art']); ?></td>
                    <td><?php echo e($linha['nome_artist']); ?></td>
                    <td><div class="mr-row-desc"><?php echo e($linha['descricao']); ?></div></td>
                    <td class="text-end">
                        <div class="mr-actions">
                        <a class="btn btn-sm btn-outline-primary" href="editar.php?id_art=<?php echo $linha['id_art']; ?>"><i class="bi bi-pencil-fill"></i></a>
                        <?php $modalId = 'modalExcluirArtista' . $linha['id_art']; ?>
                        <?php mr_delete_button($modalId); ?>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php foreach ($resultado as $linha) { ?>
    <?php mr_delete_modal('modalExcluirArtista' . $linha['id_art'], 'Excluir artista', 'Deseja excluir este artista?', 'excluir.php?id_art=' . $linha['id_art']); ?>
<?php } ?>

<?php include "../includes/footer.php"; ?>
