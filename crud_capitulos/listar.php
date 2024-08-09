<?php
require_once "../includes/funcoes.php";

$tituloPagina = "Capítulos";
$chapterRepository = new App\Repositories\ChapterRepository();
$resultado = $chapterRepository->allWithManga();
$breadcrumbs = array(
    array('label' => 'Home', 'url' => base_url('home.php')),
    array('label' => 'Capítulos')
);
include "../includes/header.php";
?>

<?php mr_page_header('<i class="bi bi-book-half"></i> Capítulos', 'Capítulos cadastrados', 'Gerencie os capítulos enviados por ZIP e abra o leitor para conferir as páginas.', array('label' => 'Adicionar capítulo', 'url' => 'cadastrar.php', 'icon' => '<i class="bi bi-plus-lg"></i>')); ?>

<div class="table-responsive">
    <table class="table table-hover table-striped align-middle mr-table">
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
            <?php foreach ($resultado as $linha) { ?>
                <tr>
                    <td><a href="../crud_mangas/visualizar.php?id_obra=<?php echo $linha['obras_id_obra']; ?>"><?php echo e($linha['titulo']); ?></a></td>
                    <td>Cap. <?php echo e($linha['numero_cap']); ?></td>
                    <td><?php echo e($linha['titulo_cap']); ?></td>
                    <td><?php echo e($linha['data_cadastro']); ?></td>
                    <td class="text-end">
                        <div class="mr-actions">
                        <a class="btn btn-sm btn-outline-dark" href="../crud_mangas/ler.php?id_cap=<?php echo $linha['id_cap']; ?>"><i class="bi bi-eye-fill"></i></a>
                        <a class="btn btn-sm btn-outline-primary" href="editar.php?id_cap=<?php echo $linha['id_cap']; ?>"><i class="bi bi-pencil-fill"></i></a>
                        <?php $modalId = 'modalExcluirCapitulo' . $linha['id_cap']; ?>
                        <?php mr_delete_button($modalId); ?>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php foreach ($resultado as $linha) { ?>
    <?php mr_delete_modal('modalExcluirCapitulo' . $linha['id_cap'], 'Excluir capítulo', 'Deseja excluir este capítulo?', 'excluir.php?id_cap=' . $linha['id_cap']); ?>
<?php } ?>

<?php include "../includes/footer.php"; ?>
