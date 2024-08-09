<?php
require_once "../includes/funcoes.php";

$controller = new App\Controllers\ChapterController();
$controller->store($_POST, $_FILES);
