<?php

namespace App\Controllers;

use App\Repositories\FavoriteRepository;
use App\Repositories\GenreRepository;
use App\Repositories\MangaRepository;
use App\Support\Asset;
use App\Support\Text;
use App\Support\Url;

class MangaController
{
    private $mangas;
    private $favorites;
    private $genres;

    public function __construct()
    {
        $this->mangas = new MangaRepository();
        $this->favorites = new FavoriteRepository();
        $this->genres = new GenreRepository();
    }

    public function store($post)
    {
        $dados = $post;
        $dados['capa_obra'] = isset($post['capa_obra']) ? trim($post['capa_obra']) : '';
        $dados['generos'] = isset($post['generos']) ? $post['generos'] : array();
        $dados['genero'] = $this->genres->namesStringFromIds($dados['generos']);
        $this->createMangaFolder($post['titulo']);

        $idObra = $this->mangas->create($dados);
        if ($idObra) {
            $this->genres->syncForManga($idObra, $dados['generos']);
            Url::redirect('listar.php');
        }

        echo 'Erro ao cadastrar mangá.';
    }

    public function update($post)
    {
        $id = (int) $post['id_obra'];
        $dados = $post;
        $dados['capa_obra'] = isset($post['capa_obra']) ? trim($post['capa_obra']) : '';
        $dados['generos'] = isset($post['generos']) ? $post['generos'] : array();
        $dados['genero'] = $this->genres->namesStringFromIds($dados['generos']);
        $this->createMangaFolder($post['titulo']);

        if ($this->mangas->update($id, $dados)) {
            $this->genres->syncForManga($id, $dados['generos']);
            Url::redirect("visualizar.php?id_obra=$id");
        }

        echo 'Erro ao alterar mangá.';
    }

    public function destroy($id)
    {
        $this->mangas->delete($id);
        Url::redirect('listar.php');
    }

    public function favorite($id, $acao)
    {
        $this->favorites->toggle($id, $acao);
        $padrao = 'visualizar.php?id_obra=' . (int) $id;
        $voltar = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $padrao;

        if (strpos($voltar, "\n") !== false || strpos($voltar, "\r") !== false) {
            $voltar = $padrao;
        }

        Url::redirect($voltar);
    }

    private function createMangaFolder($titulo)
    {
        $pasta = Asset::mangaFolderPath(Text::slug($titulo));

        if (!is_dir($pasta)) {
            mkdir($pasta, 0777, true);
        }
    }
}
