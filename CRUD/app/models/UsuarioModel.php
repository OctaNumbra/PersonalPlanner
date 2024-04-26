<?php

namespace App\models;

use App\Banco;

class UsuarioModel
{

    public function getDados()
    {
        $pdo = Banco::conectar();
        $select = 'SELECT * FROM tb_planner ORDER BY id DESC';
        $dados = $pdo->query($select)->fetchAll(\PDO::FETCH_ASSOC);
        // return array('dado1','dado2','dado3','dado4');
        return $dados;
    }

    public function getPlanner($id)
    {
        $pdo = Banco::conectar();
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM tb_planner where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(\PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $data;
    }
    public function setPlanner($nome, $endereco, $telefone, $email, $sexo)
    {
        $pdo = Banco::conectar();
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO tb_planner (titulo, data_nota, descricao, conteudo) VALUES(?,?,?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($nome, $endereco, $telefone, $email, $sexo));
        Banco::desconectar();
        return '';
    }

    public function readPlanner($id)
    {
        $pdo = Banco::conectar();
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM tb_planner where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(\PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $data;
    }

    public function updatePlanner($id, $nome, $endereco, $telefone, $email, $sexo)
    {
        $pdo = Banco::conectar();
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE tb_planner  set titulo = ?, data_nota = ?, descricao = ?, conteudo = ? WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($nome, $endereco, $telefone, $email, $sexo, $id));
        Banco::desconectar();
        return '';
    }

    public function deletePlanner($id)
    {
        $pdo = Banco::conectar();
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM tb_planner where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        Banco::desconectar();
        return '';
    }
}
