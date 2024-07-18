<?php

namespace App\Support;

class Options
{
    public static function mangaStatuses()
    {
        return array(
            'Plano para Scan' => 'Plano para Scan',
            'Em Lançamento' => 'Em trabalhos',
            'Pausada' => 'Scan em Hiatus',
            'Hiatus Forçado' => 'Hiatus Forçado (devido à exposição)',
            'Finalizada' => 'Completado',
            'Dropado' => 'Dropado'
        );
    }

    public static function mangaStatusLabel($status)
    {
        $lista = self::mangaStatuses();
        return isset($lista[$status]) ? $lista[$status] : $status;
    }

    public static function mangaStatusClass($status)
    {
        $classes = array(
            'Plano para Scan' => 'mr-status-plano',
            'Em Lançamento' => 'mr-status-trabalho',
            'Pausada' => 'mr-status-hiatus',
            'Hiatus Forçado' => 'mr-status-forcado',
            'Finalizada' => 'mr-status-completo',
            'Dropado' => 'mr-status-dropado'
        );

        return isset($classes[$status]) ? $classes[$status] : 'bg-secondary';
    }

    public static function mangaTypes()
    {
        return array('Manga', 'Manhwa', 'Manhua', 'Novel');
    }

    public static function userStatusLabel($status)
    {
        if ($status == 'A') {
            return 'Ativo';
        }

        if ($status == 'I') {
            return 'Inativo';
        }

        return $status;
    }

    public static function userPermissionLabel($permissao)
    {
        if ($permissao == 'A') {
            return 'Administrador';
        }

        if ($permissao == 'L') {
            return 'Leitor';
        }

        return $permissao;
    }
}
