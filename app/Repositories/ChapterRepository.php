<?php

namespace App\Repositories;

use App\Core\Database;
use App\Support\Text;

class ChapterRepository
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function latest($limit = 10)
    {
        return $this->db->fetchAll(
            'SELECT c.*, o.titulo, o.demografia, o.capa_obra
             FROM capitulo c
             INNER JOIN (
                SELECT c1.obras_id_obra, MAX(c1.id_cap) AS id_cap
                FROM capitulo c1
                INNER JOIN (
                    SELECT obras_id_obra, MAX(data_cadastro) AS ultima_data
                    FROM capitulo
                    GROUP BY obras_id_obra
                ) ultimos ON ultimos.obras_id_obra = c1.obras_id_obra AND ultimos.ultima_data = c1.data_cadastro
                GROUP BY c1.obras_id_obra
             ) atualizados ON atualizados.id_cap = c.id_cap
             INNER JOIN obras o ON o.id_obra = c.obras_id_obra
             ORDER BY c.data_cadastro DESC, c.id_cap DESC
             LIMIT ' . (int) $limit
        );
    }

    public function allWithManga()
    {
        return $this->db->fetchAll('SELECT c.*, o.titulo FROM capitulo c INNER JOIN obras o ON o.id_obra = c.obras_id_obra ORDER BY c.data_cadastro DESC');
    }

    public function byManga($idObra, $limit = null)
    {
        $sql = 'SELECT * FROM capitulo WHERE obras_id_obra = ' . (int) $idObra . ' ORDER BY numero_cap DESC';
        if ($limit !== null) {
            $sql .= ' LIMIT ' . (int) $limit;
        }

        return $this->db->fetchAll($sql);
    }

    public function findWithManga($id)
    {
        return $this->db->fetch('SELECT c.*, o.titulo, o.id_obra FROM capitulo c INNER JOIN obras o ON o.id_obra = c.obras_id_obra WHERE c.id_cap = ' . (int) $id);
    }

    public function find($id)
    {
        return $this->db->fetch('SELECT * FROM capitulo WHERE id_cap = ' . (int) $id);
    }

    public function previous($idObra, $numero)
    {
        return $this->db->fetch('SELECT * FROM capitulo WHERE obras_id_obra = ' . (int) $idObra . ' AND numero_cap < ' . (int) $numero . ' ORDER BY numero_cap DESC LIMIT 1');
    }

    public function next($idObra, $numero)
    {
        return $this->db->fetch('SELECT * FROM capitulo WHERE obras_id_obra = ' . (int) $idObra . ' AND numero_cap > ' . (int) $numero . ' ORDER BY numero_cap ASC LIMIT 1');
    }

    public function images($idCap)
    {
        return $this->db->fetchAll('SELECT * FROM imagem_cap WHERE capitulo_id_cap = ' . (int) $idCap . ' ORDER BY ordem ASC, id_img_cap ASC');
    }

    public function create($dados)
    {
        $idObra = (int) $dados['obras_id_obra'];
        $numero = (int) $dados['numero_cap'];
        $titulo = $this->db->escape($dados['titulo_cap']);
        $slug = $this->db->escape(Text::slug("obra-$idObra-capitulo-$numero"));

        $resultado = $this->db->execute("INSERT INTO capitulo (titulo_cap, slug, numero_cap, obras_id_obra, tipo) VALUES ('$titulo', '$slug', $numero, $idObra, 'strip')");

        if (!$resultado) {
            return false;
        }

        return $this->db->insertId();
    }

    public function update($idCap, $dados)
    {
        $idCap = (int) $idCap;
        $idObra = (int) $dados['obras_id_obra'];
        $numero = (int) $dados['numero_cap'];
        $titulo = $this->db->escape($dados['titulo_cap']);
        $slug = $this->db->escape(Text::slug("obra-$idObra-capitulo-$numero"));

        return $this->db->execute("UPDATE capitulo SET titulo_cap='$titulo', slug='$slug', numero_cap=$numero, obras_id_obra=$idObra WHERE id_cap=$idCap");
    }

    public function addImage($idCap, $caminho, $ordem)
    {
        $idCap = (int) $idCap;
        $ordem = (int) $ordem;
        $caminho = $this->db->escape($caminho);

        return $this->db->execute("INSERT INTO imagem_cap (caminho, capitulo_id_cap, ordem) VALUES ('$caminho', $idCap, $ordem)");
    }

    public function nextImageOrder($idCap)
    {
        $linha = $this->db->fetch('SELECT MAX(ordem) AS maior_ordem FROM imagem_cap WHERE capitulo_id_cap = ' . (int) $idCap);
        return isset($linha['maior_ordem']) ? (int) $linha['maior_ordem'] + 1 : 1;
    }

    public function delete($idCap)
    {
        $idCap = (int) $idCap;
        $capitulo = $this->find($idCap);
        $this->db->execute("DELETE FROM leitura_historico WHERE capitulo_id_cap = $idCap");
        $this->db->execute("DELETE FROM imagem_cap WHERE capitulo_id_cap = $idCap");
        $this->db->execute("DELETE FROM capitulo WHERE id_cap = $idCap");

        return $capitulo;
    }
}
