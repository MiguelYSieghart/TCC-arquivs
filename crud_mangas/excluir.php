<?php
require_once "../includes/funcoes.php";

$controller = new App\Controllers\MangaController();
$controller->destroy($_GET['id_obra']);
