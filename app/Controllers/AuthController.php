<?php

namespace App\Controllers;

use App\Repositories\UserRepository;
use App\Support\Auth;
use App\Support\Url;

class AuthController
{
    private $users;

    public function __construct()
    {
        $this->users = new UserRepository();
    }

    public function login($post)
    {
        $usuario = $this->users->findActiveByEmail($post['email']);

        if (!$usuario) {
            $_SESSION['mensagem'] = 'Usuário informado não existe ou está inativo.';
            Url::redirect('login.php');
        }

        $senha = $post['senha'];
        if ($senha == $usuario['senha'] || md5($senha) == $usuario['senha']) {
            Auth::login($usuario);
            Url::redirect('../home.php');
        }

        $_SESSION['mensagem'] = 'Senha inválida!';
        Url::redirect('login.php');
    }

    public function logout()
    {
        Auth::logout();
        Url::redirect('../home.php');
    }
}
