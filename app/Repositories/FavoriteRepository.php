<?php

namespace App\Repositories;

use App\Core\Database;
use App\Support\Auth;

class FavoriteRepository
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function allForCurrentUser()
    {
        if (Auth::check()) {
            $idUsuario = Auth::id();
            return $this->db->fetchAll("SELECT o.* FROM favorito f INNER JOIN obras o ON o.id_obra = f.obras_id_obra WHERE f.usuario_id_usuario = $idUsuario ORDER BY f.data_favorito DESC");
        }

        $ids = array();
        foreach ($_COOKIE as $nome => $valor) {
            if (strpos($nome, 'mangareader_favorito_') === 0) {
                $ids[] = (int) $valor;
            }
        }

        if (count($ids) == 0) {
            return array();
        }

        return $this->db->fetchAll('SELECT * FROM obras WHERE id_obra IN (' . implode(',', $ids) . ') ORDER BY titulo ASC');
    }

    public function isFavorite($idObra)
    {
        $idObra = (int) $idObra;

        if (Auth::check()) {
            $idUsuario = Auth::id();
            $linha = $this->db->fetch("SELECT id_favorito FROM favorito WHERE usuario_id_usuario = $idUsuario AND obras_id_obra = $idObra");
            return !empty($linha);
        }

        return isset($_COOKIE['mangareader_favorito_' . $idObra]);
    }

    public function countForCurrentUser()
    {
        if (Auth::check()) {
            $idUsuario = Auth::id();
            $linha = $this->db->fetch("SELECT COUNT(*) AS total FROM favorito WHERE usuario_id_usuario = $idUsuario");
            return isset($linha['total']) ? (int) $linha['total'] : 0;
        }

        $total = 0;
        foreach ($_COOKIE as $nome => $valor) {
            if (strpos($nome, 'mangareader_favorito_') === 0) {
                $total++;
            }
        }

        return $total;
    }

    public function toggle($idObra, $acao)
    {
        $idObra = (int) $idObra;

        if (Auth::check()) {
            $idUsuario = Auth::id();

            if ($acao == 'remover') {
                return $this->db->execute("DELETE FROM favorito WHERE usuario_id_usuario = $idUsuario AND obras_id_obra = $idObra");
            }

            return $this->db->execute("INSERT IGNORE INTO favorito (usuario_id_usuario, obras_id_obra) VALUES ($idUsuario, $idObra)");
        }

        if ($acao == 'remover') {
            setcookie('mangareader_favorito_' . $idObra, '', time() - 3600, '/');
        } else {
            setcookie('mangareader_favorito_' . $idObra, (string) $idObra, time() + 31536000, '/');
        }

        return true;
    }
}
