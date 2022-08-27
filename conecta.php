<?php
$bdServidor = '127.0.0.1';
$bdUsuario = 'root';
$bdSenha = '';
$bdBanco = 'mangareader';
$conexao = mysqli_connect($bdServidor, $bdUsuario, $bdSenha, $bdBanco);

if ($conexao === false) {
    echo "Problemas para conectar no banco. Erro: ";
    echo mysqli_connect_error();
    //String vazia,nao ocorreu erro
} else {
    //echo "Tudo ok";
}

/*if (!mysqli_set_charset($conexao, 'utf8'))
{
    printf('Error ao usar utf8: %s', mysqli_error($conexao));
    exit;
}
*/
mysqli_set_charset($conexao, "utf8mb4");