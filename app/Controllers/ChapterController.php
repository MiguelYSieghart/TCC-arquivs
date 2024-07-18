<?php

namespace App\Controllers;

use App\Repositories\ChapterRepository;
use App\Repositories\MangaRepository;
use App\Services\UploadService;
use App\Support\Url;

class ChapterController
{
    private $chapters;
    private $mangas;
    private $upload;

    public function __construct()
    {
        $this->chapters = new ChapterRepository();
        $this->mangas = new MangaRepository();
        $this->upload = new UploadService();
    }

    public function store($post, $files)
    {
        if (!isset($files['zip_capitulo']) || $files['zip_capitulo']['error'] != UPLOAD_ERR_OK) {
            echo 'Envie um arquivo ZIP válido para cadastrar o capítulo.';
            return;
        }

        if (!class_exists('ZipArchive')) {
            echo 'A extensão ZipArchive do PHP precisa estar habilitada no XAMPP.';
            return;
        }

        $idCap = $this->chapters->create($post);

        if (!$idCap) {
            echo 'Erro ao cadastrar capítulo.';
            return;
        }

        $totalImagens = $this->saveZipImages($idCap, $post, isset($files['zip_capitulo']) ? $files['zip_capitulo'] : null, 1);
        if ($totalImagens == 0) {
            $this->chapters->delete($idCap);
            echo 'O ZIP enviado não possui imagens válidas.';
            return;
        }

        Url::redirect('../crud_mangas/visualizar.php?id_obra=' . (int) $post['obras_id_obra']);
    }

    public function update($post, $files)
    {
        $idCap = (int) $post['id_cap'];

        if (!$this->chapters->update($idCap, $post)) {
            echo 'Erro ao alterar capítulo.';
            return;
        }

        $this->saveZipImages($idCap, $post, isset($files['zip_capitulo']) ? $files['zip_capitulo'] : null, $this->chapters->nextImageOrder($idCap));
        Url::redirect('../crud_mangas/visualizar.php?id_obra=' . (int) $post['obras_id_obra']);
    }

    public function destroy($idCap)
    {
        $capitulo = $this->chapters->delete($idCap);
        $idObra = isset($capitulo['obras_id_obra']) ? (int) $capitulo['obras_id_obra'] : 0;

        if ($idObra > 0) {
            Url::redirect("../crud_mangas/visualizar.php?id_obra=$idObra");
        }

        Url::redirect('listar.php');
    }

    private function saveZipImages($idCap, $post, $file, $ordemInicial)
    {
        $obra = $this->mangas->find($post['obras_id_obra']);
        if (!$obra) {
            return 0;
        }

        $ordem = $ordemInicial;
        $total = 0;
        foreach ($this->upload->chapterZip($file, $obra['slug'], $post['numero_cap']) as $caminho) {
            $this->chapters->addImage($idCap, $caminho, $ordem);
            $ordem++;
            $total++;
        }

        return $total;
    }
}
