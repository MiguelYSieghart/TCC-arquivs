<?php
require_once "../includes/conecta.php";

$id_cap = (int) $_GET['id_cap'];
$capitulo = mysqli_fetch_assoc(mysqli_query($conexao, "SELECT obras_id_obra FROM capitulo WHERE id_cap = $id_cap"));
$id_obra = isset($capitulo['obras_id_obra']) ? (int) $capitulo['obras_id_obra'] : 0;

mysqli_query($conexao, "DELETE FROM imagem_cap WHERE capitulo_id_cap = $id_cap");
mysqli_query($conexao, "DELETE FROM capitulo WHERE id_cap = $id_cap");

if ($id_obra > 0) {
    header("Location: ../crud_mangas/visualizar.php?id_obra=$id_obra");
} else {
    header("Location: listar.php");
}
exit;
