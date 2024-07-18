<?php

namespace App\Controllers;

use App\Repositories\ArtistRepository;
use App\Support\Url;

class ArtistController
{
    private $artists;

    public function __construct()
    {
        $this->artists = new ArtistRepository();
    }

    public function store($post)
    {
        if ($this->artists->create($post)) {
            Url::redirect('listar.php');
        }

        echo 'Erro ao cadastrar artista.';
    }

    public function update($post)
    {
        if ($this->artists->update($post['id_art'], $post)) {
            Url::redirect('listar.php');
        }

        echo 'Erro ao alterar artista.';
    }

    public function destroy($id)
    {
        $this->artists->delete($id);
        Url::redirect('listar.php');
    }
}
