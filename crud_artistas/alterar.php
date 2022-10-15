<?php
require_once "../includes/conecta.php";
require_once "../includes/funcoes.php";

$id_art = (int) $_POST['id_art'];
$nome_artist = mysqli_real_escape_string($conexao, $_POST['nome_artist']);
$slug = mysqli_real_escape_string($conexao, gerar_slug($_POST['nome_artist']));
$descricao = mysqli_real_escape_string($conexao, $_POST['descricao']);

$resultado = mysqli_query($conexao, "UPDATE artista SET nome_artist='$nome_artist', slug='$slug', descricao='$descricao' WHERE id_art=$id_art");

if ($resultado) {
    header("Location: listar.php");
    exit;
}

echo "Erro ao alterar artista: " . mysqli_error($conexao);

