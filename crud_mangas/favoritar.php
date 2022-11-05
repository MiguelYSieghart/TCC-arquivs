<?php
require_once "../includes/conecta.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$id_obra = (int) $_GET['id_obra'];
$acao = isset($_GET['acao']) ? $_GET['acao'] : 'adicionar';

if (isset($_SESSION['id_usuario'])) {
    $id_usuario = (int) $_SESSION['id_usuario'];

    if ($acao == 'remover') {
        mysqli_query($conexao, "DELETE FROM favorito WHERE usuario_id_usuario = $id_usuario AND obras_id_obra = $id_obra");
    } else {
        mysqli_query($conexao, "INSERT IGNORE INTO favorito (usuario_id_usuario, obras_id_obra) VALUES ($id_usuario, $id_obra)");
    }
} else {
    if ($acao == 'remover') {
        setcookie('mangareader_favorito_' . $id_obra, '', time() - 3600, '/');
    } else {
        setcookie('mangareader_favorito_' . $id_obra, (string) $id_obra, time() + 31536000, '/');
    }
}

header("Location: visualizar.php?id_obra=$id_obra");
exit;
