<?php
require_once "../includes/conecta.php";
require_once "../includes/funcoes.php";

$dirUpload = caminho_upload_capa();
$capa_obra = "assets/images/capas/";

if (isset($_FILES['capa_obra']) && is_uploaded_file($_FILES['capa_obra']['tmp_name'])) {
    $ext = strtolower(strrchr($_FILES['capa_obra']['name'], '.'));
    $nome = md5(time() . $_FILES['capa_obra']['name']) . $ext;

    if (move_uploaded_file($_FILES['capa_obra']['tmp_name'], $dirUpload . $nome)) {
        $capa_obra = "assets/images/" . $nome;
    }
}

$titulo = mysqli_real_escape_string($conexao, $_POST['titulo']);
$slug = mysqli_real_escape_string($conexao, gerar_slug($_POST['titulo']));
$titulo_alt = mysqli_real_escape_string($conexao, $_POST['titulo_alt']);
$autor = mysqli_real_escape_string($conexao, $_POST['autor']);
$ano_lanc = mysqli_real_escape_string($conexao, $_POST['ano_lanc']);
$status_obra = mysqli_real_escape_string($conexao, $_POST['status_obra']);
$sinopse = mysqli_real_escape_string($conexao, $_POST['sinopse']);
$demografia = mysqli_real_escape_string($conexao, $_POST['demografia']);
$genero = mysqli_real_escape_string($conexao, $_POST['genero']);
$capa_obra = mysqli_real_escape_string($conexao, $capa_obra);

$sql = "INSERT INTO obras (slug, titulo, titulo_alt, autor, genero, tipo, ano_lanc, status_obra, sinopse, demografia, capa_obra)
VALUES ('$slug', '$titulo', '$titulo_alt', '$autor', '$genero', '$demografia', '$ano_lanc', '$status_obra', '$sinopse', '$demografia', '$capa_obra')";

$resultado = mysqli_query($conexao, $sql);

if ($resultado) {
    header("Location: listar.php");
    exit;
}

echo "Erro ao cadastrar mangá: " . mysqli_error($conexao);

