<?php
require_once "../includes/conecta.php";

$id_art = (int) $_GET['id_art'];
mysqli_query($conexao, "DELETE FROM artista_has_obras WHERE artista_id_art = $id_art");
mysqli_query($conexao, "DELETE FROM artista WHERE id_art = $id_art");

header("Location: listar.php");
exit;
