<?php
require_once "../includes/conecta.php";

$id_obra = (int) $_GET['id_obra'];

mysqli_query($conexao, "DELETE FROM imagem_cap WHERE capitulo_id_cap IN (SELECT id_cap FROM capitulo WHERE obras_id_obra = $id_obra)");
mysqli_query($conexao, "DELETE FROM capitulo WHERE obras_id_obra = $id_obra");
mysqli_query($conexao, "DELETE FROM favorito WHERE obras_id_obra = $id_obra");
mysqli_query($conexao, "DELETE FROM artista_has_obras WHERE obras_id_obra = $id_obra");
mysqli_query($conexao, "DELETE FROM obras WHERE id_obra = $id_obra");

header("Location: listar.php");
exit;
