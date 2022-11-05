<?php
require_once "../includes/conecta.php";

$id_usuario = (int) $_GET['id_usuario'];
mysqli_query($conexao, "DELETE FROM favorito WHERE usuario_id_usuario = $id_usuario");
mysqli_query($conexao, "DELETE FROM usuario WHERE id_usuario = $id_usuario");

header("Location: listar.php");
exit;
