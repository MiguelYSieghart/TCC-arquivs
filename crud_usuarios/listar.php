<?php
require_once "../includes/conecta.php";
require_once "../includes/funcoes.php";

$tituloPagina = "Usuários";
$resultado = mysqli_query($conexao, "SELECT * FROM usuario ORDER BY nome ASC");
include "../includes/header.php";
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Usuários</h1>
    <a class="btn btn-primary" href="cadastrar.php">Adicionar usuário</a>
</div>

<div class="table-responsive">
    <table class="table table-hover table-striped">
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
            <?php while ($linha = mysqli_fetch_assoc($resultado)) { ?>
                <tr>
                    <td><?php echo e($linha['id_usuario']); ?></td>
                    <td><?php echo e($linha['nome']); ?></td>
                    <td><?php echo e($linha['email']); ?></td>
                    <td><?php echo e(status_usuario_label($linha['sts'])); ?></td>
                    <td><?php echo e(permissao_usuario_label($linha['permissao'])); ?></td>
                    <td class="text-end">
                        <a class="btn btn-sm btn-outline-primary" href="editar.php?id_usuario=<?php echo $linha['id_usuario']; ?>">Editar</a>
                        <a class="btn btn-sm btn-outline-danger" href="excluir.php?id_usuario=<?php echo $linha['id_usuario']; ?>" onclick="return confirm('Deseja excluir este usuário?')">Excluir</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include "../includes/footer.php"; ?>
