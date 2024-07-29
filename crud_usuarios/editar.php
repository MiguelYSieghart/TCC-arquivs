<?php
require_once "../includes/funcoes.php";

$id_usuario = (int) $_GET['id_usuario'];
$userRepository = new App\Repositories\UserRepository();
$linha = $userRepository->find($id_usuario);

if (!$linha) {
    header("Location: listar.php");
    exit;
}

$tituloPagina = "Editar usuário";
$breadcrumbs = array(
    array('label' => 'Home', 'url' => base_url('home.php')),
    array('label' => 'Usuários', 'url' => base_url('crud_usuarios/listar.php')),
    array('label' => 'Editar')
);
include "../includes/header.php";
?>

<?php mr_page_header('<i class="bi bi-person-gear"></i> Edição', 'Editar usuário', 'Atualize os dados de acesso e permissão do usuário.'); ?>

<form action="alterar.php" method="post" class="card mr-form">
    <div class="card-body">
    <input type="hidden" name="id_usuario" value="<?php echo $linha['id_usuario']; ?>">

    <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input id="nome" type="text" name="nome" class="form-control" value="<?php echo e($linha['nome']); ?>" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">E-mail</label>
        <input id="email" type="email" name="email" class="form-control" value="<?php echo e($linha['email']); ?>" required>
    </div>

    <div class="mb-3">
        <label for="senha" class="form-label">Senha</label>
        <input id="senha" type="text" name="senha" class="form-control" value="<?php echo e($linha['senha']); ?>" required>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="sts" class="form-label">Status</label>
            <select id="sts" name="sts" class="form-select" required>
                <option value="A" <?php echo $linha['sts'] == 'A' ? 'selected' : ''; ?>>Ativo</option>
                <option value="I" <?php echo $linha['sts'] == 'I' ? 'selected' : ''; ?>>Inativo</option>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label for="permissao" class="form-label">Permissão</label>
            <select id="permissao" name="permissao" class="form-select" required>
                <option value="A" <?php echo $linha['permissao'] == 'A' ? 'selected' : ''; ?>>Administrador</option>
                <option value="L" <?php echo $linha['permissao'] == 'L' ? 'selected' : ''; ?>>Leitor</option>
            </select>
        </div>
    </div>

    <div class="mr-form-actions">
        <button type="submit" class="btn btn-primary">Salvar alterações</button>
        <a href="listar.php" class="btn btn-outline-primary">Cancelar</a>
    </div>
    </div>
</form>

<?php include "../includes/footer.php"; ?>
