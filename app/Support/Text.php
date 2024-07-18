<?php

namespace App\Support;

class Text
{
    public static function e($valor)
    {
        return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
    }

    public static function slug($texto)
    {
        $convertido = @iconv('UTF-8', 'ASCII//TRANSLIT', $texto);
        if ($convertido !== false) {
            $texto = $convertido;
        }

        $texto = strtolower($texto);
        $texto = preg_replace('/[^a-z0-9]+/', '-', $texto);
        $texto = trim($texto, '-');

        return $texto != '' ? $texto : md5(time());
    }
}
