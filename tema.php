<?php
require_once "includes/funcoes.php";

$tema = isset($_GET['tema']) ? $_GET['tema'] : 'escuro';
$voltar = App\Support\Url::safeBack('home.php');

if ($tema != 'claro') {
    $tema = 'escuro';
}

setcookie('mangareader_tema', $tema, time() + 31536000, '/');

App\Support\Url::redirect($voltar);
