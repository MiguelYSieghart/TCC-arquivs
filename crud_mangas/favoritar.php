<?php
require_once "../includes/funcoes.php";

$controller = new App\Controllers\MangaController();
$controller->favorite($_GET['id_obra'], isset($_GET['acao']) ? $_GET['acao'] : 'adicionar');
