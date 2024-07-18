<?php

namespace App\Repositories;

use App\Core\Database;

class UserRepository
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function all()
    {
        return $this->db->fetchAll('SELECT * FROM usuario ORDER BY nome ASC');
    }

    public function find($id)
    {
        return $this->db->fetch('SELECT * FROM usuario WHERE id_usuario = ' . (int) $id);
    }

    public function findActiveByEmail($email)
    {
        $email = $this->db->escape(strtolower($email));
        return $this->db->fetch("SELECT * FROM usuario WHERE email='$email' AND sts='A'");
    }

    public function create($dados)
    {
        $nome = $this->db->escape($dados['nome']);
        $email = $this->db->escape($dados['email']);
        $senha = $this->db->escape($dados['senha']);
        $status = $this->db->escape($dados['sts']);
        $permissao = $this->db->escape($dados['permissao']);

        return $this->db->execute("INSERT INTO usuario (nome, email, senha, sts, permissao) VALUES ('$nome', '$email', '$senha', '$status', '$permissao')");
    }

    public function update($id, $dados)
    {
        $id = (int) $id;
        $nome = $this->db->escape($dados['nome']);
        $email = $this->db->escape($dados['email']);
        $senha = $this->db->escape($dados['senha']);
        $status = $this->db->escape($dados['sts']);
        $permissao = $this->db->escape($dados['permissao']);

        return $this->db->execute("UPDATE usuario SET nome='$nome', email='$email', senha='$senha', sts='$status', permissao='$permissao' WHERE id_usuario=$id");
    }

    public function delete($id)
    {
        $id = (int) $id;
        $this->db->execute("DELETE FROM leitura_historico WHERE usuario_id_usuario = $id");
        $this->db->execute("DELETE FROM favorito WHERE usuario_id_usuario = $id");
        return $this->db->execute("DELETE FROM usuario WHERE id_usuario = $id");
    }
}
