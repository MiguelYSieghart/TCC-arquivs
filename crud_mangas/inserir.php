<?php
require_once "../includes/funcoes.php";

$controller = new App\Controllers\MangaController();
$controller->store($_POST);

