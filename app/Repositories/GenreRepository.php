<?php

namespace App\Repositories;

use App\Core\Database;
use App\Support\Text;

class GenreRepository
{
    private $db;
    private static $seeded = false;

    public function __construct()
    {
        $this->db = new Database();

        if (!self::$seeded) {
            $this->seedDefaults();
            $this->migrateLegacyGenres();
            self::$seeded = true;
        }
    }

    public function all()
    {
        return $this->db->fetchAll('SELECT * FROM genero ORDER BY nome_genero ASC, id_genero ASC');
    }

    public function idsForManga($idObra)
    {
        $linhas = $this->db->fetchAll('SELECT genero_id_genero FROM obra_genero WHERE obras_id_obra = ' . (int) $idObra);
        $ids = array();

        foreach ($linhas as $linha) {
            $ids[] = (int) $linha['genero_id_genero'];
        }

        return $ids;
    }

    public function namesForManga($idObra)
    {
        $linhas = $this->db->fetchAll(
            'SELECT g.nome_genero
             FROM obra_genero og
             INNER JOIN genero g ON g.id_genero = og.genero_id_genero
             WHERE og.obras_id_obra = ' . (int) $idObra . '
             ORDER BY g.nome_genero ASC'
        );

        $nomes = array();
        foreach ($linhas as $linha) {
            $nomes[] = $linha['nome_genero'];
        }

        return $nomes;
    }

    public function rowsForManga($idObra)
    {
        return $this->db->fetchAll(
            'SELECT g.*
             FROM obra_genero og
             INNER JOIN genero g ON g.id_genero = og.genero_id_genero
             WHERE og.obras_id_obra = ' . (int) $idObra . '
             ORDER BY g.nome_genero ASC'
        );
    }

    public function tagsForMangas($idsObras)
    {
        $ids = array();
        foreach ($idsObras as $idObra) {
            $ids[] = (int) $idObra;
        }

        $ids = array_values(array_unique(array_filter($ids)));
        if (count($ids) == 0) {
            return array();
        }

        $linhas = $this->db->fetchAll(
            'SELECT og.obras_id_obra, g.nome_genero
             FROM obra_genero og
             INNER JOIN genero g ON g.id_genero = og.genero_id_genero
             WHERE og.obras_id_obra IN (' . implode(',', $ids) . ')
             ORDER BY g.nome_genero ASC'
        );

        $tags = array();
        foreach ($linhas as $linha) {
            $idObra = (int) $linha['obras_id_obra'];
            if (!isset($tags[$idObra])) {
                $tags[$idObra] = array();
            }
            $tags[$idObra][] = $linha['nome_genero'];
        }

        return $tags;
    }

    public function namesStringFromIds($ids)
    {
        $idsLimpos = $this->cleanIds($ids);
        if (count($idsLimpos) == 0) {
            return '';
        }

        $linhas = $this->db->fetchAll('SELECT nome_genero FROM genero WHERE id_genero IN (' . implode(',', $idsLimpos) . ') ORDER BY nome_genero ASC');
        $nomes = array();

        foreach ($linhas as $linha) {
            $nomes[] = $linha['nome_genero'];
        }

        return implode(', ', $nomes);
    }

    public function syncForManga($idObra, $ids)
    {
        $idObra = (int) $idObra;
        $idsLimpos = $this->cleanIds($ids);
        $this->db->execute("DELETE FROM obra_genero WHERE obras_id_obra = $idObra");

        foreach ($idsLimpos as $idGenero) {
            $this->db->execute("INSERT IGNORE INTO obra_genero (obras_id_obra, genero_id_genero) VALUES ($idObra, $idGenero)");
        }

        $generosTexto = $this->db->escape($this->namesStringFromIds($idsLimpos));
        $this->db->execute("UPDATE obras SET genero = '$generosTexto' WHERE id_obra = $idObra");
    }

    private function cleanIds($ids)
    {
        if (!is_array($ids)) {
            return array();
        }

        $limpos = array();
        foreach ($ids as $id) {
            $id = (int) $id;
            if ($id > 0) {
                $limpos[] = $id;
            }
        }

        return array_values(array_unique($limpos));
    }

    private function seedDefaults()
    {
        foreach ($this->defaultGenres() as $nome) {
            $this->createIfMissing($nome);
        }
    }

    private function migrateLegacyGenres()
    {
        $obras = $this->db->fetchAll("SELECT id_obra, genero FROM obras WHERE genero IS NOT NULL AND genero <> ''");

        foreach ($obras as $obra) {
            $idObra = (int) $obra['id_obra'];
            $existe = $this->db->fetch("SELECT obras_id_obra FROM obra_genero WHERE obras_id_obra = $idObra LIMIT 1");

            if ($existe) {
                continue;
            }

            $ids = array();
            foreach (preg_split('/,|;/', $obra['genero']) as $nome) {
                $nome = trim($nome);
                if ($nome == '') {
                    continue;
                }

                $ids[] = $this->createIfMissing($nome);
            }

            if (count($ids) > 0) {
                $this->syncForManga($idObra, $ids);
            }
        }
    }

    private function createIfMissing($nome)
    {
        $nomeSql = $this->db->escape($nome);
        $linha = $this->db->fetch("SELECT id_genero FROM genero WHERE BINARY nome_genero = '$nomeSql' LIMIT 1");

        if ($linha) {
            return (int) $linha['id_genero'];
        }

        $slug = $this->db->escape(Text::slug($nome));
        $this->db->execute("INSERT INTO genero (nome_genero, slug) VALUES ('$nomeSql', '$slug')");

        return $this->db->insertId();
    }

    private function defaultGenres()
    {
        return array(
            '+18',
            'Absolute Cinema!!! 🙌',
            'Academia',
            'Ação',
            'Aconchegante',
            'action',
            'Adaptação',
            'Adult',
            'Adultério',
            'Adulto',
            'Adventure',
            'Agentes',
            'Alta Fantasia',
            'Amadurecimento',
            'Animais',
            'Anti-Herói',
            'Apocalipse',
            'Apocalíptico',
            'Arte Marcial',
            'Artes Marciais',
            'Aventura',
            'Bullying',
            'Colorido',
            'Com?dia',
            'Comédia',
            'Construção',
            'Cotidiano',
            'Crime',
            'Culinaria',
            'Cultivação',
            'Cultivo',
            'Dança',
            'Deliquentes',
            'Dem?nios',
            'Demônio',
            'Demônios',
            'Demons',
            'Drama',
            'Dungeon',
            'Ecchi',
            'Escola',
            'Escolar',
            'Escritório',
            'Esporte',
            'Esportes',
            'Familia',
            'Fantasia',
            'Fantasia Sombria',
            'Fatia da Vida/Slice of Life',
            'Fazenda',
            'Ficção Científica',
            'Game Elements',
            'Gore',
            'Guerra',
            'Harém',
            'Heterossexual',
            'Histórico',
            'Horror',
            'Isekai',
            'Jogo',
            'Jogos',
            'Josei',
            'Linha do Tempo',
            'Luta',
            'Maduro',
            'máfia',
            'Magia',
            'manhua',
            'Manhwa',
            'martial arts',
            'Masmorra',
            'Mecha',
            'Medieval',
            'Militar',
            'Mist?rio',
            'Mistério',
            'Moderno',
            'Monstro',
            'Monstros',
            'Murim',
            'Musculação',
            'Necromante',
            'Novel',
            'One-shot',
            'Oneshot',
            'Overpower',
            'overpowered',
            'Pets',
            'Psicológico',
            'Psicopata',
            'Realidade Virtual',
            'Reencarna??o',
            'Reencarnação',
            'Regressão',
            'regressão de idade',
            'Regresso em Busca de Vingança',
            'Retorno',
            'revange',
            'Revenge',
            'Revenge Quest',
            'Romance',
            'Romance Escolar',
            'Seinen',
            'Shoujo',
            'Shounen',
            'Shounen Ai',
            'Sistema',
            'Sistema de Jogo',
            'Slice of Life',
            'Sobrenatura',
            'Sobrenatural',
            'Sobrevivência',
            'Super Poderes',
            'SuperPoder',
            'Suspense',
            'Tela de Sistema',
            'Terror',
            'teste',
            'Thriller',
            'Time Manipulation',
            'Tragédia',
            'Tragédias',
            'Transmigração',
            'Viagem no Tempo',
            'Vida escolar',
            'Vingança',
            'Violência',
            'Vizinhos',
            'Volta no Tempo',
            'Zumbi'
        );
    }
}
