<?php

namespace App\Services;

use App\Support\Asset;
use App\Support\Text;
use ZipArchive;

class UploadService
{
    private $imageExtensions = array('.jpg', '.jpeg', '.png', '.gif', '.webp');

    public function cover($arquivo, $atual = 'assets/images/capas/')
    {
        if (!isset($arquivo) || !is_uploaded_file($arquivo['tmp_name'])) {
            return $atual;
        }

        $ext = strtolower(strrchr($arquivo['name'], '.'));
        if (!in_array($ext, $this->imageExtensions)) {
            return $atual;
        }

        $nome = md5(time() . $arquivo['name']) . $ext;
        $destino = Asset::uploadPath();

        if (!is_dir($destino)) {
            mkdir($destino, 0777, true);
        }

        if (move_uploaded_file($arquivo['tmp_name'], $destino . $nome)) {
            return 'assets/images/' . $nome;
        }

        return $atual;
    }

    public function chapterImages($arquivos)
    {
        $salvos = array();

        if (!isset($arquivos)) {
            return $salvos;
        }

        $destino = Asset::uploadPath('caps');
        if (!is_dir($destino)) {
            mkdir($destino, 0777, true);
        }

        for ($i = 0; $i < count($arquivos['name']); $i++) {
            if (!is_uploaded_file($arquivos['tmp_name'][$i])) {
                continue;
            }

            $ext = strtolower(strrchr($arquivos['name'][$i], '.'));
            if (!in_array($ext, $this->imageExtensions)) {
                continue;
            }

            $nome = md5(time() . $arquivos['name'][$i] . $i) . $ext;

            if (move_uploaded_file($arquivos['tmp_name'][$i], $destino . $nome)) {
                $salvos[] = 'assets/images/caps/' . $nome;
            }
        }

        return $salvos;
    }

    public function chapterZip($arquivo, $slugObra, $numeroCapitulo)
    {
        $salvos = array();

        if (!isset($arquivo) || !is_uploaded_file($arquivo['tmp_name'])) {
            return $salvos;
        }

        $ext = strtolower(strrchr($arquivo['name'], '.'));
        if ($ext != '.zip') {
            return $salvos;
        }

        if (!class_exists('ZipArchive')) {
            return $salvos;
        }

        $zip = new ZipArchive();
        if ($zip->open($arquivo['tmp_name']) !== true) {
            return $salvos;
        }

        $destino = Asset::chapterFolderPath($slugObra, $numeroCapitulo);
        if (!is_dir($destino)) {
            mkdir($destino, 0777, true);
        }

        $entradas = array();
        for ($i = 0; $i < $zip->numFiles; $i++) {
            $nomeOriginal = $zip->getNameIndex($i);
            $extensao = strtolower(strrchr($nomeOriginal, '.'));

            if (!in_array($extensao, $this->imageExtensions)) {
                continue;
            }

            $entradas[] = $nomeOriginal;
        }

        sort($entradas, SORT_NATURAL | SORT_FLAG_CASE);

        foreach ($entradas as $indice => $entrada) {
            $extensao = strtolower(strrchr($entrada, '.'));
            $nomeArquivo = str_pad((string) ($indice + 1), 4, '0', STR_PAD_LEFT) . '-' . Text::slug(pathinfo($entrada, PATHINFO_FILENAME)) . $extensao;
            $conteudo = $zip->getFromName($entrada);

            if ($conteudo === false) {
                continue;
            }

            file_put_contents($destino . DIRECTORY_SEPARATOR . $nomeArquivo, $conteudo);
            $salvos[] = Asset::chapterFolder($slugObra, $numeroCapitulo) . '/' . $nomeArquivo;
        }

        $zip->close();

        return $salvos;
    }
}
