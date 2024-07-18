<?php

namespace App\Support;

class Url
{
    public static function base($caminho = '')
    {
        $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
        $pastaAtual = basename($scriptDir);

        if (in_array($pastaAtual, array('crud_mangas', 'crud_capitulos', 'crud_artistas', 'crud_usuarios', 'auth'))) {
            $scriptDir = dirname($scriptDir);
        }

        $base = $scriptDir == '/' ? '' : $scriptDir;
        return $base . '/' . ltrim($caminho, '/');
    }

    public static function redirect($caminho)
    {
        header('Location: ' . $caminho);
        exit;
    }

    public static function safeBack($padrao = 'home.php')
    {
        $voltar = isset($_GET['voltar']) ? $_GET['voltar'] : $padrao;

        if (preg_match('/^https?:\/\//i', $voltar) || strpos($voltar, '//') === 0 || strpos($voltar, "\n") !== false || strpos($voltar, "\r") !== false) {
            return $padrao;
        }

        return $voltar;
    }
}
