<?php
$bdServidor = '127.0.0.1';
$bdUsuario = 'root';
$bdSenha = '123456';
$bdBanco = 'mangareader';
$bdPorta = 3306;

$conexao = mysqli_connect($bdServidor, $bdUsuario, $bdSenha, $bdBanco, $bdPorta);

if ($conexao === false) {
    echo "Problemas para conectar no banco. Erro: ";
    echo mysqli_connect_error();
}

mysqli_set_charset($conexao, "utf8mb4");