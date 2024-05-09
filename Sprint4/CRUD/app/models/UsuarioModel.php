<?php

namespace App\models;

use App\Banco;

class UsuarioModel
{

    public function getDados()
    {
        $pdo = Banco::conectar();
        $select = 'SELECT * FROM tb_avisonotas ORDER BY id DESC';
        $dados = $pdo->query($select)->fetchAll(\PDO::FETCH_ASSOC);
        // return array('dado1','dado2','dado3','dado4');
        return $dados;
    }

    public function getPlanner($id)
    {
        $pdo = Banco::conectar();
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM tb_avisonotas where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(\PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $data;
    }
    public function setPlanner($titulo, $data_nota, $descricao, $conteudo, $tipo)
    {
        $pdo = Banco::conectar();
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO tb_avisonotas (titulo, data_nota, descricao, conteudo, tipo) VALUES(?,?,?,?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($titulo, $data_nota, $descricao, $conteudo, $tipo));
        Banco::desconectar();
        return '';
    }

    public function readPlanner($id)
    {
        $pdo = Banco::conectar();
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM tb_avisonotas where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(\PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $data;
    }

    public function updatePlanner($titulo, $data_nota, $descricao, $conteudo, $tipo, $id)
    {
        $pdo = Banco::conectar();
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE tb_avisonotas  set titulo = ?, data_nota = ?, descricao = ?, conteudo = ?, tipo = ? WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($titulo, $data_nota, $descricao, $conteudo, $tipo, $id));
        Banco::desconectar();
        return '';
    }

    public function deletePlanner($id)
    {
        $pdo = Banco::conectar();
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM tb_avisonotas where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        Banco::desconectar();
        return '';
    }
}
