<?php
require_once "../includes/funcoes.php";

$controller = new App\Controllers\UserController();
$controller->update($_POST);

