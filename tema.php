<?php
require_once "includes/funcoes.php";

$tema = isset($_GET['tema']) ? $_GET['tema'] : 'escuro';
$voltar = isset($_GET['voltar']) ? $_GET['voltar'] : 'home.php';

if ($tema != 'claro') {
    $tema = 'escuro';
}

if (preg_match('/^https?:\/\//i', $voltar) || strpos($voltar, '//') === 0 || strpos($voltar, "\n") !== false || strpos($voltar, "\r") !== false) {
    $voltar = 'home.php';
}

setcookie('mangareader_tema', $tema, time() + 31536000, '/');

header("Location: " . $voltar);
exit;
