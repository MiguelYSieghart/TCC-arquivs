<?php
require_once "../includes/conecta.php";
require_once "../includes/funcoes.php";

$tituloPagina = "Títulos";
$busca = isset($_GET['busca']) ? mysqli_real_escape_string($conexao, $_GET['busca']) : '';
$status = isset($_GET['status']) ? mysqli_real_escape_string($conexao, $_GET['status']) : '';

$where = array();
if ($busca != '') {
    $where[] = "(titulo LIKE '%$busca%' OR autor LIKE '%$busca%' OR demografia LIKE '%$busca%' OR genero LIKE '%$busca%')";
}
if ($status != '') {
    $where[] = "status_obra = '$status'";
}

$sql = "SELECT * FROM obras";
if (count($where) > 0) {
    $sql .= " WHERE " . implode(" AND ", $where);
}
$sql .= " ORDER BY titulo ASC";

$resultado = mysqli_query($conexao, $sql);
$abas = array_merge(array('' => 'Todos'), status_obras());

include "../includes/header.php";
?>

<form class="mb-2" method="get">
    <input type="hidden" name="status" value="<?php echo e($status); ?>">
    <input type="text" name="busca" class="form-control mr-search" placeholder="Busque um Manga..." value="<?php echo e($busca); ?>">
</form>

<ul class="nav mr-tabs">
    <?php foreach ($abas as $valor => $texto) { ?>
        <li class="nav-item">
            <a class="nav-link <?php echo $status == $valor ? 'active' : ''; ?>" href="listar.php?status=<?php echo urlencode($valor); ?>">
                <?php echo e($texto); ?>
            </a>
        </li>
    <?php } ?>
</ul>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Listagem das obras</h1>
    <a class="btn btn-primary" href="cadastrar.php"><i class="bi bi-plus-lg"></i> Adicionar</a>
</div>

<div class="mr-cover-grid">
    <?php while ($linha = mysqli_fetch_assoc($resultado)) { ?>
        <div>
            <a class="mr-cover-card" href="visualizar.php?id_obra=<?php echo $linha['id_obra']; ?>">
                <img src="<?php echo caminho_capa($linha['capa_obra']); ?>" alt="<?php echo e($linha['titulo']); ?>">
                <div class="mr-cover-title"><?php echo e($linha['titulo']); ?></div>
            </a>
            <div class="mt-2 text-center">
                <a class="badge bg-primary text-decoration-none" href="editar.php?id_obra=<?php echo $linha['id_obra']; ?>">Editar</a>
                <a class="badge bg-danger text-decoration-none" href="excluir.php?id_obra=<?php echo $linha['id_obra']; ?>" onclick="return confirm('Deseja realmente excluir este mangá?')">Excluir</a>
            </div>
        </div>
    <?php } ?>
</div>

<?php include "../includes/footer.php"; ?>
