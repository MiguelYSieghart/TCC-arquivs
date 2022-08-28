<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function base_url($caminho = '')
{
    $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
    $pastaAtual = basename($scriptDir);

    if (in_array($pastaAtual, array('crud_mangas', 'crud_capitulos', 'crud_artistas', 'crud_usuarios', 'auth'))) {
        $scriptDir = dirname($scriptDir);
    }

    $base = $scriptDir == '/' ? '' : $scriptDir;
    return $base . '/' . ltrim($caminho, '/');
}

function e($valor)
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

function gerar_slug($texto)
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

function caminho_capa($capa)
{
    if (empty($capa) || $capa == 'assets/images/capas/' || $capa == 'images/capas/') {
        return base_url('assets/images/no-cover.jpg');
    }

    if (strpos($capa, 'images/') === 0) {
        $capa = 'assets/' . $capa;
    }

    return base_url($capa);
}

function status_obra_texto($status)
{
    $status = (int) $status;

    if ($status == 1) {
        return 'Em lançamento';
    }

    if ($status == 2) {
        return 'Finalizada';
    }

    if ($status == 3) {
        return 'Pausada';
    }

    return 'Indefinido';
}

function status_obras()
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

function status_obra_label($status)
{
    $statusLista = status_obras();

    if (isset($statusLista[$status])) {
        return $statusLista[$status];
    }

    return $status;
}

function status_obra_classe($status)
{
    if ($status == 'Plano para Scan') {
        return 'mr-status-plano';
    }

    if ($status == 'Em Lançamento') {
        return 'mr-status-trabalho';
    }

    if ($status == 'Pausada') {
        return 'mr-status-hiatus';
    }

    if ($status == 'Hiatus Forçado') {
        return 'mr-status-forcado';
    }

    if ($status == 'Finalizada') {
        return 'mr-status-completo';
    }

    if ($status == 'Dropado') {
        return 'mr-status-dropado';
    }

    return 'bg-secondary';
}

function tipos_obras()
{
    return array('Manga', 'Manhwa', 'Manhua', 'Novel');
}

function status_usuario_label($status)
{
    if ($status == 'A') {
        return 'Ativo';
    }

    if ($status == 'I') {
        return 'Inativo';
    }

    return $status;
}

function permissao_usuario_label($permissao)
{
    if ($permissao == 'A') {
        return 'Administrador';
    }

    if ($permissao == 'L') {
        return 'Leitor';
    }

    return $permissao;
}

function caminho_upload_capa()
{
    return dirname(__DIR__) . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR;
}
