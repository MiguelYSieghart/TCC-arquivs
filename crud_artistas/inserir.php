<?php
require_once "../includes/funcoes.php";

$controller = new App\Controllers\ArtistController();
$controller->store($_POST);

