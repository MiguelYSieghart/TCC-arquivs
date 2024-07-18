<?php

namespace App\Repositories;

use App\Core\Database;
use App\Support\Auth;

class ReadingHistoryRepository
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function register($idCapitulo)
    {
        if (!Auth::check()) {
            return false;
        }

        $idUsuario = Auth::id();
        $idCapitulo = (int) $idCapitulo;
        $capitulo = $this->db->fetch("SELECT obras_id_obra FROM capitulo WHERE id_cap = $idCapitulo");

        if (!$capitulo) {
            return false;
        }

        $idObra = (int) $capitulo['obras_id_obra'];
        $existe = $this->db->fetch("SELECT id_historico FROM leitura_historico WHERE usuario_id_usuario = $idUsuario AND capitulo_id_cap = $idCapitulo");

        if ($existe) {
            return $this->db->execute("UPDATE leitura_historico SET data_leitura = CURRENT_TIMESTAMP WHERE id_historico = " . (int) $existe['id_historico']);
        }

        return $this->db->execute("INSERT INTO leitura_historico (usuario_id_usuario, obras_id_obra, capitulo_id_cap) VALUES ($idUsuario, $idObra, $idCapitulo)");
    }

    public function recent($limit = 12)
    {
        if (!Auth::check()) {
            return array();
        }

        $idUsuario = Auth::id();

        return $this->db->fetchAll(
            "SELECT h.*, c.id_cap, c.numero_cap, c.titulo_cap, c.obras_id_obra, c.data_cadastro, o.titulo, o.capa_obra, o.demografia,
                    ultimo.id_cap AS ultimo_id_cap, ultimo.numero_cap AS ultimo_numero_cap, ultimo.data_cadastro AS ultimo_data_cadastro
             FROM leitura_historico h
             INNER JOIN (
                SELECT h1.obras_id_obra, MAX(h1.id_historico) AS id_historico
                FROM leitura_historico h1
                INNER JOIN (
                    SELECT obras_id_obra, MAX(data_leitura) AS ultima_leitura
                    FROM leitura_historico
                    WHERE usuario_id_usuario = $idUsuario
                    GROUP BY obras_id_obra
                ) recentes ON recentes.obras_id_obra = h1.obras_id_obra AND recentes.ultima_leitura = h1.data_leitura
                WHERE h1.usuario_id_usuario = $idUsuario
                GROUP BY h1.obras_id_obra
             ) ultimo_historico ON ultimo_historico.id_historico = h.id_historico
             INNER JOIN capitulo c ON c.id_cap = h.capitulo_id_cap
             INNER JOIN obras o ON o.id_obra = h.obras_id_obra
             LEFT JOIN (
                SELECT c2.*
                FROM capitulo c2
                INNER JOIN (
                    SELECT c3.obras_id_obra, MAX(c3.id_cap) AS id_cap
                    FROM capitulo c3
                    INNER JOIN (
                        SELECT obras_id_obra, MAX(numero_cap) AS ultimo_numero
                        FROM capitulo
                        GROUP BY obras_id_obra
                    ) ultimos_numeros ON ultimos_numeros.obras_id_obra = c3.obras_id_obra AND ultimos_numeros.ultimo_numero = c3.numero_cap
                    GROUP BY c3.obras_id_obra
                ) ultimos_capitulos ON ultimos_capitulos.id_cap = c2.id_cap
             ) ultimo ON ultimo.obras_id_obra = h.obras_id_obra
             WHERE h.usuario_id_usuario = $idUsuario
             ORDER BY h.data_leitura DESC
             LIMIT " . (int) $limit
        );
    }

    public function countForCurrentUser()
    {
        if (!Auth::check()) {
            return 0;
        }

        $idUsuario = Auth::id();
        $linha = $this->db->fetch("SELECT COUNT(*) AS total FROM leitura_historico WHERE usuario_id_usuario = $idUsuario");

        return isset($linha['total']) ? (int) $linha['total'] : 0;
    }
}
