<?php
require_once "../includes/funcoes.php";
$tituloPagina = "Cadastrar usuário";
include "../includes/header.php";
?>

<h1 class="h3 mb-4">Cadastrar usuário</h1>

<form action="inserir.php" method="post" class="mr-form">
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
</form>

<?php include "../includes/footer.php"; ?>
