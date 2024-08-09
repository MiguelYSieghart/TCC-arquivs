<?php
require_once "../includes/funcoes.php";

$controller = new App\Controllers\ChapterController();
$controller->update($_POST, $_FILES);
