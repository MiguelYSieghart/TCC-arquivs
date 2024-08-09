<?php
require_once "../includes/funcoes.php";

$controller = new App\Controllers\ChapterController();
$controller->destroy($_GET['id_cap']);
