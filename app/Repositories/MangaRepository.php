<?php

namespace App\Repositories;

use App\Core\Database;
use App\Support\Asset;
use App\Support\Text;

class MangaRepository
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function random($limit = 5)
    {
        return $this->db->fetchAll('SELECT * FROM obras ORDER BY RAND() LIMIT ' . (int) $limit);
    }

    public function latest($limit = 20)
    {
        return $this->db->fetchAll('SELECT * FROM obras ORDER BY data_cadastro DESC, id_obra DESC LIMIT ' . (int) $limit);
    }

    public function search($busca = '', $status = '', $idGenero = 0)
    {
        $where = array();
        $join = '';

        if ($busca != '') {
            $buscaSql = $this->db->escape($busca);
            $where[] = "(o.titulo LIKE '%$buscaSql%' OR o.autor LIKE '%$buscaSql%' OR o.demografia LIKE '%$buscaSql%' OR o.genero LIKE '%$buscaSql%' OR EXISTS (
                SELECT 1 FROM obra_genero og_busca
                INNER JOIN genero g_busca ON g_busca.id_genero = og_busca.genero_id_genero
                WHERE og_busca.obras_id_obra = o.id_obra AND g_busca.nome_genero LIKE '%$buscaSql%'
            ))";
        }

        if ($status != '') {
            $statusSql = $this->db->escape($status);
            $where[] = "o.status_obra = '$statusSql'";
        }

        if ((int) $idGenero > 0) {
            $idGenero = (int) $idGenero;
            $join = ' INNER JOIN obra_genero og ON og.obras_id_obra = o.id_obra ';
            $where[] = "og.genero_id_genero = $idGenero";
        }

        $sql = 'SELECT DISTINCT o.* FROM obras o' . $join;
        if (count($where) > 0) {
            $sql .= ' WHERE ' . implode(' AND ', $where);
        }

        return $this->db->fetchAll($sql . ' ORDER BY o.titulo ASC');
    }

    public function find($id)
    {
        return $this->db->fetch('SELECT * FROM obras WHERE id_obra = ' . (int) $id);
    }

    public function create($dados)
    {
        $slugTexto = Text::slug($dados['titulo']);
        $titulo = $this->db->escape($dados['titulo']);
        $slug = $this->db->escape($slugTexto);
        $tituloAlt = $this->db->escape($dados['titulo_alt']);
        $autor = $this->db->escape($dados['autor']);
        $genero = $this->db->escape(isset($dados['genero']) ? $dados['genero'] : '');
        $tipo = $this->db->escape($dados['demografia']);
        $anoLanc = $this->db->escape($dados['ano_lanc']);
        $status = $this->db->escape($dados['status_obra']);
        $sinopse = $this->db->escape($dados['sinopse']);
        $capa = $this->db->escape($dados['capa_obra']);
        $pasta = $this->db->escape(Asset::mangaFolder($slugTexto));

        $sql = "INSERT INTO obras (slug, titulo, titulo_alt, autor, genero, tipo, ano_lanc, status_obra, sinopse, demografia, capa_obra, pasta_obra)
                VALUES ('$slug', '$titulo', '$tituloAlt', '$autor', '$genero', '$tipo', '$anoLanc', '$status', '$sinopse', '$tipo', '$capa', '$pasta')";

        if (!$this->db->execute($sql)) {
            return false;
        }

        return $this->db->insertId();
    }

    public function update($id, $dados)
    {
        $id = (int) $id;
        $slugTexto = Text::slug($dados['titulo']);
        $titulo = $this->db->escape($dados['titulo']);
        $slug = $this->db->escape($slugTexto);
        $tituloAlt = $this->db->escape($dados['titulo_alt']);
        $autor = $this->db->escape($dados['autor']);
        $genero = $this->db->escape(isset($dados['genero']) ? $dados['genero'] : '');
        $tipo = $this->db->escape($dados['demografia']);
        $anoLanc = $this->db->escape($dados['ano_lanc']);
        $status = $this->db->escape($dados['status_obra']);
        $sinopse = $this->db->escape($dados['sinopse']);
        $capa = $this->db->escape($dados['capa_obra']);
        $pasta = $this->db->escape(Asset::mangaFolder($slugTexto));

        $sql = "UPDATE obras SET slug='$slug', titulo='$titulo', titulo_alt='$tituloAlt', autor='$autor', genero='$genero',
                tipo='$tipo', ano_lanc='$anoLanc', status_obra='$status', sinopse='$sinopse', demografia='$tipo', capa_obra='$capa', pasta_obra='$pasta'
                WHERE id_obra=$id";

        return $this->db->execute($sql);
    }

    public function delete($id)
    {
        $id = (int) $id;
        $this->db->execute("DELETE FROM leitura_historico WHERE obras_id_obra = $id");
        $this->db->execute("DELETE FROM obra_genero WHERE obras_id_obra = $id");
        $this->db->execute("DELETE FROM imagem_cap WHERE capitulo_id_cap IN (SELECT id_cap FROM capitulo WHERE obras_id_obra = $id)");
        $this->db->execute("DELETE FROM capitulo WHERE obras_id_obra = $id");
        $this->db->execute("DELETE FROM favorito WHERE obras_id_obra = $id");
        $this->db->execute("DELETE FROM artista_has_obras WHERE obras_id_obra = $id");
        return $this->db->execute("DELETE FROM obras WHERE id_obra = $id");
    }
}
