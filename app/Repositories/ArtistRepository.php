<?php

namespace App\Repositories;

use App\Core\Database;
use App\Support\Text;

class ArtistRepository
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function all()
    {
        return $this->db->fetchAll('SELECT * FROM artista ORDER BY nome_artist ASC');
    }

    public function find($id)
    {
        return $this->db->fetch('SELECT * FROM artista WHERE id_art = ' . (int) $id);
    }

    public function create($dados)
    {
        $nome = $this->db->escape($dados['nome_artist']);
        $slug = $this->db->escape(Text::slug($dados['nome_artist']));
        $descricao = $this->db->escape($dados['descricao']);

        return $this->db->execute("INSERT INTO artista (nome_artist, slug, descricao) VALUES ('$nome', '$slug', '$descricao')");
    }

    public function update($id, $dados)
    {
        $id = (int) $id;
        $nome = $this->db->escape($dados['nome_artist']);
        $slug = $this->db->escape(Text::slug($dados['nome_artist']));
        $descricao = $this->db->escape($dados['descricao']);

        return $this->db->execute("UPDATE artista SET nome_artist='$nome', slug='$slug', descricao='$descricao' WHERE id_art=$id");
    }

    public function delete($id)
    {
        $id = (int) $id;
        $this->db->execute("DELETE FROM artista_has_obras WHERE artista_id_art = $id");
        return $this->db->execute("DELETE FROM artista WHERE id_art = $id");
    }
}
