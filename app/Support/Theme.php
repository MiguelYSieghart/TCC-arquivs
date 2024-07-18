<?php

namespace App\Support;

class Theme
{
    public static function current()
    {
        $tema = isset($_COOKIE['mangareader_tema']) ? $_COOKIE['mangareader_tema'] : 'escuro';
        return $tema == 'claro' ? 'claro' : 'escuro';
    }

    public static function bootstrapMode()
    {
        return self::current() == 'claro' ? 'light' : 'dark';
    }

    public static function next()
    {
        return self::current() == 'claro' ? 'escuro' : 'claro';
    }

    public static function icon()
    {
        return self::current() == 'claro' ? 'bi-moon-stars' : 'bi-sun';
    }
}
