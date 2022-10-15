<?php
require_once "../includes/conecta.php";
require_once "../includes/funcoes.php";

$nome_artist = mysqli_real_escape_string($conexao, $_POST['nome_artist']);
$slug = mysqli_real_escape_string($conexao, gerar_slug($_POST['nome_artist']));
$descricao = mysqli_real_escape_string($conexao, $_POST['descricao']);

$resultado = mysqli_query($conexao, "INSERT INTO artista (nome_artist, slug, descricao) VALUES ('$nome_artist', '$slug', '$descricao')");

if ($resultado) {
    header("Location: listar.php");
    exit;
}

echo "Erro ao cadastrar artista: " . mysqli_error($conexao);

