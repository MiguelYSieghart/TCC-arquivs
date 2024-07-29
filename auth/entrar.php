<?php
require_once "../includes/funcoes.php";

$controller = new App\Controllers\AuthController();
$controller->login($_POST);

