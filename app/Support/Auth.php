<?php

namespace App\Support;

class Auth
{
    public static function id()
    {
        return isset($_SESSION['id_usuario']) ? (int) $_SESSION['id_usuario'] : null;
    }

    public static function check()
    {
        return self::id() !== null;
    }

    public static function name()
    {
        return isset($_SESSION['nome']) ? $_SESSION['nome'] : 'Visitante';
    }

    public static function login($usuario)
    {
        $_SESSION['id_usuario'] = $usuario['id_usuario'];
        $_SESSION['nome'] = $usuario['nome'];
        $_SESSION['email'] = $usuario['email'];
        $_SESSION['permissao'] = $usuario['permissao'];
    }

    public static function logout()
    {
        session_destroy();
    }
}
