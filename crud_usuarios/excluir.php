<?php
require_once "../includes/funcoes.php";

$controller = new App\Controllers\UserController();
$controller->destroy($_GET['id_usuario']);
