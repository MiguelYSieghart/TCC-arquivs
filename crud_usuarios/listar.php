<?php
require_once "../includes/funcoes.php";

$tituloPagina = "Usuários";
$userRepository = new App\Repositories\UserRepository();
$resultado = $userRepository->all();
$breadcrumbs = array(
    array('label' => 'Home', 'url' => base_url('home.php')),
    array('label' => 'Usuários')
);
include "../includes/header.php";
?>

<?php mr_page_header('<i class="bi bi-person-gear"></i> Administração', 'Usuários', 'Gerencie os acessos usados no ambiente local do Manga Reader.', array('label' => 'Adicionar usuário', 'url' => 'cadastrar.php', 'icon' => '<i class="bi bi-plus-lg"></i>')); ?>

<div class="table-responsive">
    <table class="table table-hover table-striped align-middle mr-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Status</th>
                <th>Permissão</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($resultado as $linha) { ?>
                <tr>
                    <td><?php echo e($linha['id_usuario']); ?></td>
                    <td><?php echo e($linha['nome']); ?></td>
                    <td><?php echo e($linha['email']); ?></td>
                    <td><?php echo e(status_usuario_label($linha['sts'])); ?></td>
                    <td><?php echo e(permissao_usuario_label($linha['permissao'])); ?></td>
                    <td class="text-end">
                        <div class="mr-actions">
                        <a class="btn btn-sm btn-outline-primary" href="editar.php?id_usuario=<?php echo $linha['id_usuario']; ?>"><i class="bi bi-pencil-fill"></i></a>
                        <?php $modalId = 'modalExcluirUsuario' . $linha['id_usuario']; ?>
                        <?php mr_delete_button($modalId); ?>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php foreach ($resultado as $linha) { ?>
    <?php mr_delete_modal('modalExcluirUsuario' . $linha['id_usuario'], 'Excluir usuário', 'Deseja excluir este usuário?', 'excluir.php?id_usuario=' . $linha['id_usuario']); ?>
<?php } ?>

<?php include "../includes/footer.php"; ?>
