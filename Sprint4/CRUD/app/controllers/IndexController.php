<?php

namespace App\controllers;

// use App\Banco;
use App\models\UsuarioModel;

class IndexController
{

    // chamada na rota / (raiz)
    public function index()
    {

        //Acessando o Banco
        // $db = Banco::conectar();

        // echo 'Controler: IndexController - Acao: index() <br>';
        $usuarios = new UsuarioModel();
        // $dados = array('dado1','dado2','dado3','dado4');
        $dados = $usuarios->getDados();
        require_once '..\app\views\indexUsuario.phtml';
    }

    // chamada na rota /create
    public function create()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $tituloErro = null;
            $dataErro = null;
            $descricaoErro = null;
            $conteudoErro = null;
            $tipoErro = null;

            if (!empty($_POST)) {
                $validacao = True;
                $novoTitulo = False;
                if (!empty($_POST['titulo'])) {
                    $titulo = $_POST['titulo'];
                } else {
                    $tituloErro = 'Por favor digite o Titulo!';
                    $validacao = False;
                }


                if (!empty($_POST['data_nota'])) {
                    $data_nota = $_POST['data_nota'];
                } else {
                    $dataErro = 'Por favor selecione a data limite!';
                    $validacao = False;
                }


                if (!empty($_POST['descricao'])) {
                    $descricao = $_POST['descricao'];
                } else {
                    $descricaoErro = 'Por favor digite o número do telefone!';
                    $validacao = False;
                }


                if (!empty($_POST['conteudo'])) {
                    $conteudo = $_POST['conteudo'];
                } else {
                    $conteudoErro = 'Por favor digite o conteudo!';
                    $validacao = False;
                }


                if (!empty($_POST['tipo'])) {
                    $tipo = $_POST['tipo'];
                } else {
                    $tipoErro = 'Por favor seleccione um campo!';
                    $validacao = False;
                }
            }

            //Inserindo no Banco:
            if ($validacao) {
                $usuarios = new UsuarioModel();
                $dados = $usuarios->setPlanner($titulo, $data_nota, $descricao, $conteudo, $tipo);
                header("Location: /");
            }
        }
        require_once '..\app\views\createUsuario.phtml';
    }

    public function read()
    {
        $id = null;

        if (!empty($_GET['id'])) {
            $id = $_REQUEST['id'];
        }

        if (null == $id) {
            header("Location: /");
        } else {
            $usuarios = new UsuarioModel();
            $data = $usuarios->readPlanner($id);
        }
        require_once '..\app\views\readUsuario.phtml';
    }

    public function update()
    {
       
        $id = null;
        if (!empty($_GET['id'])) {
            $id = $_REQUEST['id'];
        }

        if (null == $id) {
            header("Location: /");
        }

        if (!empty($_POST)) {

            $tituloErro = null;
            $dataErro = null;
            $descricaoErro = null;
            $conteudoErro = null;
            $tipoErro = null;

            $titulo = $_POST['titulo'];
            $data_nota = $_POST['data_nota'];
            $descricao = $_POST['descricao'];
            $conteudo = $_POST['conteudo'];
            $tipo= $_POST['tipo'];

            //Validação
            $validacao = true;
            if (empty($titulo)) {
                $tituloErro = 'Por favor digite o titulo!';
                $validacao = false;
            }

            if (empty($data_nota)) {
                $dataErro = 'Por favor digite a data limite!';
                $validacao = false;
            }

            if (empty($descricao)) {
                $descricaoErro = 'Por favor digite a descricao!';
                $validacao = false;
            }

            if (empty($conteudo)) {
                $conteudoErro = 'Por favor digite o conteudo!';
                $validacao = false;
            }

            if (empty($tipo)) {
                $tipoErro = 'Por favor preenche o campo!';
                $validacao = false;
            }

            // update data
            if ($validacao) {
                $usuarios = new UsuarioModel();
                echo 'fazendo update';
                $data = $usuarios->updatePlanner($id, $titulo, $data_nota, $descricao, $conteudo, $tipo);
                header("Location: /");
            }
        } else {

            $usuarios = new UsuarioModel();
            $data = $usuarios->getPlanner($id);

            $titulo = $data['titulo'];
            $data_nota = $data['data_nota'];
            $descricao = $data['descricao'];
            $conteudo = $data['conteudo'];
            $tipo = $data['tipo'];
        }
        require_once '..\app\views\updateUsuario.phtml';
    }

    public function delete()
    {
        $id = 0;

        if (!empty($_GET['id'])) {
            $id = $_REQUEST['id'];
        }

        if (!empty($_POST)) {
            $id = $_POST['id'];
            header("Location: /");
            $usuarios = new UsuarioModel();
            $data = $usuarios->deletePlanner($id);
        }
        require_once '..\app\views\deleteUsuario.phtml';
    }
}
