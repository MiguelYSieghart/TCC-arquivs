<?php
require_once "../includes/conecta.php";
require_once "../includes/funcoes.php";

$id_obra = (int) $_POST['id_obra'];
$capa_obra = $_POST['capa_pre_alteracao'];

if (isset($_FILES['capa_obra']) && is_uploaded_file($_FILES['capa_obra']['tmp_name'])) {
    $ext = strtolower(strrchr($_FILES['capa_obra']['name'], '.'));
    $nome = md5(time() . $_FILES['capa_obra']['name']) . $ext;

    if (move_uploaded_file($_FILES['capa_obra']['tmp_name'], caminho_upload_capa() . $nome)) {
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

$sql = "UPDATE obras SET slug='$slug', titulo='$titulo', titulo_alt='$titulo_alt', autor='$autor', genero='$genero', tipo='$demografia', ano_lanc='$ano_lanc', status_obra='$status_obra', sinopse='$sinopse', demografia='$demografia', capa_obra='$capa_obra' WHERE id_obra=$id_obra";
$resultado = mysqli_query($conexao, $sql);

if ($resultado) {
    header("Location: visualizar.php?id_obra=$id_obra");
    exit;
}

echo "Erro ao alterar mangá: " . mysqli_error($conexao);

