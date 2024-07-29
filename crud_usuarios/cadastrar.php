<?php
require_once "../includes/funcoes.php";
$tituloPagina = "Cadastrar usuário";
$breadcrumbs = array(
    array('label' => 'Home', 'url' => base_url('home.php')),
    array('label' => 'Usuários', 'url' => base_url('crud_usuarios/listar.php')),
    array('label' => 'Cadastrar')
);
include "../includes/header.php";
?>

<?php mr_page_header('<i class="bi bi-person-plus"></i> Cadastro', 'Cadastrar usuário', 'Crie um usuário para acessar favoritos, perfil e histórico de leitura.'); ?>

<form action="inserir.php" method="post" class="card mr-form">
    <div class="card-body">
    <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input id="nome" type="text" name="nome" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">E-mail</label>
        <input id="email" type="email" name="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="senha" class="form-label">Senha</label>
        <input id="senha" type="password" name="senha" class="form-control" required>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="sts" class="form-label">Status</label>
            <select id="sts" name="sts" class="form-select">
                <option value="A">Ativo</option>
                <option value="I">Inativo</option>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label for="permissao" class="form-label">Permissão</label>
            <select id="permissao" name="permissao" class="form-select">
                <option value="A">Administrador</option>
                <option value="L">Leitor</option>
            </select>
        </div>
    </div>

    <div class="mr-form-actions">
        <button type="submit" class="btn btn-primary">Cadastrar</button>
        <a href="listar.php" class="btn btn-outline-primary">Cancelar</a>
    </div>
    </div>
</form>

<?php include "../includes/footer.php"; ?>
