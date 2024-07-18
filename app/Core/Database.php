<?php

namespace App\Core;

class Database
{
    private static $conexao;

    public static function connection()
    {
        if (self::$conexao) {
            return self::$conexao;
        }

        $config = require APP_ROOT . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'database.php';

        self::$conexao = mysqli_connect(
            $config['host'],
            $config['user'],
            $config['password'],
            $config['database'],
            $config['port']
        );

        if (self::$conexao === false) {
            die('Problemas para conectar no banco. Erro: ' . mysqli_connect_error());
        }

        mysqli_set_charset(self::$conexao, $config['charset']);
        self::ensureSchema();

        return self::$conexao;
    }

    public function escape($valor)
    {
        return mysqli_real_escape_string(self::connection(), (string) $valor);
    }

    public function query($sql)
    {
        return mysqli_query(self::connection(), $sql);
    }

    public function fetch($sql)
    {
        $resultado = $this->query($sql);
        return $resultado ? mysqli_fetch_assoc($resultado) : null;
    }

    public function fetchAll($sql)
    {
        $resultado = $this->query($sql);
        $linhas = array();

        if ($resultado) {
            while ($linha = mysqli_fetch_assoc($resultado)) {
                $linhas[] = $linha;
            }
        }

        return $linhas;
    }

    public function execute($sql)
    {
        return $this->query($sql);
    }

    public function insertId()
    {
        return mysqli_insert_id(self::connection());
    }

    public function error()
    {
        return mysqli_error(self::connection());
    }

    private static function ensureSchema()
    {
        self::ensureColumn('obras', 'pasta_obra', "ALTER TABLE obras ADD COLUMN pasta_obra varchar(255) DEFAULT NULL AFTER capa_obra");
        self::queryStatic("ALTER TABLE obras MODIFY capa_obra varchar(500) DEFAULT NULL");
        self::queryStatic("UPDATE obras SET slug = CONCAT('obra-', id_obra) WHERE slug IS NULL OR slug = ''");
        self::queryStatic("UPDATE obras SET pasta_obra = CONCAT('assets/images/obras/', slug) WHERE pasta_obra IS NULL OR pasta_obra = ''");
        self::queryStatic(
            "CREATE TABLE IF NOT EXISTS genero (
                id_genero int(11) NOT NULL AUTO_INCREMENT,
                nome_genero varchar(100) NOT NULL,
                slug varchar(120) DEFAULT NULL,
                PRIMARY KEY (id_genero),
                KEY idx_genero_nome (nome_genero),
                KEY idx_genero_slug (slug)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci"
        );

        self::queryStatic(
            "CREATE TABLE IF NOT EXISTS obra_genero (
                obras_id_obra int(11) NOT NULL,
                genero_id_genero int(11) NOT NULL,
                PRIMARY KEY (obras_id_obra, genero_id_genero),
                KEY fk_obra_genero_genero_idx (genero_id_genero),
                KEY fk_obra_genero_obras_idx (obras_id_obra)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci"
        );

        self::queryStatic(
            "CREATE TABLE IF NOT EXISTS leitura_historico (
                id_historico int(11) NOT NULL AUTO_INCREMENT,
                usuario_id_usuario int(11) NOT NULL,
                obras_id_obra int(11) NOT NULL,
                capitulo_id_cap int(11) NOT NULL,
                data_leitura datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (id_historico),
                UNIQUE KEY uk_leitura_usuario_capitulo (usuario_id_usuario, capitulo_id_cap),
                KEY fk_leitura_usuario_idx (usuario_id_usuario),
                KEY fk_leitura_obras_idx (obras_id_obra),
                KEY fk_leitura_capitulo_idx (capitulo_id_cap)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci"
        );
    }

    private static function ensureColumn($table, $column, $sql)
    {
        $table = mysqli_real_escape_string(self::$conexao, $table);
        $column = mysqli_real_escape_string(self::$conexao, $column);
        $resultado = self::queryStatic("SHOW COLUMNS FROM `$table` LIKE '$column'");

        if ($resultado && mysqli_num_rows($resultado) == 0) {
            self::queryStatic($sql);
        }
    }

    private static function queryStatic($sql)
    {
        return mysqli_query(self::$conexao, $sql);
    }
}
