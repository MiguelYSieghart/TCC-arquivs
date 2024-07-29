<?php
require_once "../includes/funcoes.php";

$controller = new App\Controllers\ArtistController();
$controller->update($_POST);

