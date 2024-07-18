<?php
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'bootstrap.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'components.php';

function base_url($caminho = '')
{
    return App\Support\Url::base($caminho);
}

function e($valor)
{
    return App\Support\Text::e($valor);
}

function gerar_slug($texto)
{
    return App\Support\Text::slug($texto);
}

function caminho_capa($capa)
{
    return App\Support\Asset::cover($capa);
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
    return App\Support\Options::mangaStatuses();
}

function status_obra_label($status)
{
    return App\Support\Options::mangaStatusLabel($status);
}

function status_obra_classe($status)
{
    return App\Support\Options::mangaStatusClass($status);
}

function tipos_obras()
{
    return App\Support\Options::mangaTypes();
}

function status_usuario_label($status)
{
    return App\Support\Options::userStatusLabel($status);
}

function permissao_usuario_label($permissao)
{
    return App\Support\Options::userPermissionLabel($permissao);
}

function caminho_upload_capa()
{
    return App\Support\Asset::uploadPath();
}
