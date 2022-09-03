<?php
require_once "../includes/conecta.php";
require_once "../includes/funcoes.php";

$id_obra = (int) $_GET['id_obra'];
$resultado = mysqli_query($conexao, "SELECT * FROM obras WHERE id_obra = $id_obra");
$obra = mysqli_fetch_assoc($resultado);

if (!$obra) {
    header("Location: listar.php");
    exit;
}

$favorito = false;
if (isset($_SESSION['id_usuario'])) {
    $id_usuario = (int) $_SESSION['id_usuario'];
    $fav = mysqli_query($conexao, "SELECT id_favorito FROM favorito WHERE usuario_id_usuario = $id_usuario AND obras_id_obra = $id_obra");
    $favorito = mysqli_num_rows($fav) > 0;
} elseif (isset($_COOKIE['mangareader_favorito_' . $id_obra])) {
    $favorito = true;
}

$capitulos = mysqli_query($conexao, "SELECT * FROM capitulo WHERE obras_id_obra = $id_obra ORDER BY numero_cap DESC");
$tituloPagina = $obra['titulo'];
include "../includes/header.php";
?>

<div class="row">
    <div class="col-md-3 mb-4">
        <img src="<?php echo caminho_capa($obra['capa_obra']); ?>" class="mr-detail-cover" alt="<?php echo e($obra['titulo']); ?>">
    </div>

    <div class="col-md-9">
        <h1 class="h2">
            <i class="bi <?php echo $favorito ? 'bi-bookmark-fill' : 'bi-bookmark'; ?>"></i>
            <u><?php echo e($obra['titulo']); ?></u>
        </h1>

        <div class="mb-3">
            <a class="badge bg-primary text-decoration-none" href="editar.php?id_obra=<?php echo $obra['id_obra']; ?>"><i class="bi bi-pencil-fill"></i> Editar título</a>
            <a class="badge bg-primary text-decoration-none" href="../crud_capitulos/cadastrar.php?id_obra=<?php echo $obra['id_obra']; ?>"><i class="bi bi-plus-lg"></i> Adicionar capítulo</a>
            <?php if ($favorito) { ?>
                <a class="badge bg-primary text-decoration-none" href="favoritar.php?id_obra=<?php echo $obra['id_obra']; ?>&acao=remover"><i class="bi bi-x-lg"></i> Remover Favorito</a>
            <?php } else { ?>
                <a class="badge bg-primary text-decoration-none" href="favoritar.php?id_obra=<?php echo $obra['id_obra']; ?>&acao=adicionar"><i class="bi bi-bookmark-fill"></i> Adicionar Favorito</a>
            <?php } ?>
        </div>

        <p><strong>Nomes Alternativos:</strong> <?php echo !empty($obra['titulo_alt']) ? e($obra['titulo_alt']) : e($obra['titulo']); ?></p>
        <p><strong>Autor(es):</strong> <?php echo e($obra['autor']); ?></p>
        <p><strong>Gênero(s):</strong> <?php echo e($obra['genero']); ?></p>
        <p><strong>Tipo de livro:</strong> <?php echo e($obra['demografia']); ?></p>
        <p><strong>Lançamento (Ano):</strong> <?php echo e($obra['ano_lanc']); ?></p>
        <p><strong>Status do livro:</strong> <?php echo e(status_obra_label($obra['status_obra'])); ?></p>
        <p><strong>Status da Scan:</strong> Em trabalho</p>
        <p><em>Este mangá foi adicionado em <?php echo e($obra['data_cadastro']); ?></em></p>

        <div class="accordion mb-4" id="accordionDescricao">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingDescricao">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDescricao" aria-expanded="true" aria-controls="collapseDescricao">
                        Descrição da obra
                    </button>
                </h2>
                <div id="collapseDescricao" class="accordion-collapse collapse show" aria-labelledby="headingDescricao" data-bs-parent="#accordionDescricao">
                    <div class="accordion-body">
                        <?php echo nl2br(e($obra['sinopse'])); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<ul class="nav mr-tabs">
    <li class="nav-item"><a class="nav-link active" href="#capitulos">Capítulos</a></li>
    <li class="nav-item"><a class="nav-link" href="#comentarios">Comentários</a></li>
</ul>

<div class="table-responsive" id="capitulos">
    <table class="table table-hover table-striped align-middle">
        <thead>
            <tr>
                <th>Capítulo</th>
                <th>Título do capítulo</th>
                <th class="text-center">Adicionado por</th>
                <th class="text-end">Adicionado em</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($capitulo = mysqli_fetch_assoc($capitulos)) { ?>
                <tr>
                    <td><a href="ler.php?id_cap=<?php echo $capitulo['id_cap']; ?>">Vol. 1 Cap. <?php echo e($capitulo['numero_cap']); ?></a></td>
                    <td>
                        <?php echo e($capitulo['titulo_cap']); ?>
                        <a class="badge bg-primary text-decoration-none" href="../crud_capitulos/editar.php?id_cap=<?php echo $capitulo['id_cap']; ?>"><i class="bi bi-pencil-fill"></i> Editar capítulo</a>
                    </td>
                    <td class="text-center"><?php echo isset($_SESSION['nome']) ? e($_SESSION['nome']) : 'Izayoi'; ?></td>
                    <td class="text-end"><?php echo e($capitulo['data_cadastro']); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<div id="comentarios" class="mt-4">
    <div class="mr-synopsis p-3">Comentários desativados nesta versão local do TCC.</div>
</div>

<?php include "../includes/footer.php"; ?>
