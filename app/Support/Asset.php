<?php

namespace App\Support;

class Asset
{
    public static function cover($capa)
    {
        if (empty($capa) || $capa == 'assets/images/capas/' || $capa == 'images/capas/') {
            return Url::base('assets/images/no-cover.jpg');
        }

        if (preg_match('/^https?:\/\//i', $capa)) {
            return $capa;
        }

        if (strpos($capa, 'images/') === 0) {
            $capa = 'assets/' . $capa;
        }

        return Url::base($capa);
    }

    public static function uploadPath($pasta = '')
    {
        return APP_ROOT . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . trim($pasta, '\\/') . ($pasta ? DIRECTORY_SEPARATOR : '');
    }

    public static function mangaFolder($slug)
    {
        return 'assets/images/obras/' . trim($slug, '/');
    }

    public static function mangaFolderPath($slug)
    {
        return APP_ROOT . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, self::mangaFolder($slug));
    }

    public static function chapterFolder($slug, $numero)
    {
        return self::mangaFolder($slug) . '/capitulo-' . (int) $numero;
    }

    public static function chapterFolderPath($slug, $numero)
    {
        return APP_ROOT . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, self::chapterFolder($slug, $numero));
    }
}
