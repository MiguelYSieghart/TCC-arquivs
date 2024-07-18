<?php

namespace App\Controllers;

use App\Repositories\UserRepository;
use App\Support\Url;

class UserController
{
    private $users;

    public function __construct()
    {
        $this->users = new UserRepository();
    }

    public function store($post)
    {
        if ($this->users->create($post)) {
            Url::redirect('listar.php');
        }

        echo 'Erro ao cadastrar usuário.';
    }

    public function update($post)
    {
        if ($this->users->update($post['id_usuario'], $post)) {
            Url::redirect('listar.php');
        }

        echo 'Erro ao alterar usuário.';
    }

    public function destroy($id)
    {
        $this->users->delete($id);
        Url::redirect('listar.php');
    }
}
