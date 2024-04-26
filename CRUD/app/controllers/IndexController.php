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
            $nomeErro = null;
            $enderecoErro = null;
            $telefoneErro = null;
            $emailErro = null;
            $sexoErro = null;

            if (!empty($_POST)) {
                $validacao = True;
                $novoUsuario = False;
                if (!empty($_POST['nome'])) {
                    $nome = $_POST['nome'];
                } else {
                    $nomeErro = 'Por favor digite o seu nome!';
                    $validacao = False;
                }


                if (!empty($_POST['endereco'])) {
                    $endereco = $_POST['endereco'];
                } else {
                    $enderecoErro = 'Por favor digite o seu endereço!';
                    $validacao = False;
                }


                if (!empty($_POST['telefone'])) {
                    $telefone = $_POST['telefone'];
                } else {
                    $telefoneErro = 'Por favor digite o número do telefone!';
                    $validacao = False;
                }


                if (!empty($_POST['email'])) {
                    $email = $_POST['email'];
                    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                        $emailErro = 'Por favor digite um endereço de email válido!';
                        $validacao = False;
                    }
                } else {
                    $emailErro = 'Por favor digite um endereço de email!';
                    $validacao = False;
                }


                if (!empty($_POST['sexo'])) {
                    $sexo = $_POST['sexo'];
                } else {
                    $sexoErro = 'Por favor seleccione um campo!';
                    $validacao = False;
                }
            }

            //Inserindo no Banco:
            if ($validacao) {
                $usuarios = new UsuarioModel();
                $dados = $usuarios->setPessoa($nome, $endereco, $telefone, $email, $sexo);
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
            $data = $usuarios->readPessoa($id);
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

            $nomeErro = null;
            $enderecoErro = null;
            $telefoneErro = null;
            $emailErro = null;
            $sexoErro = null;

            $nome = $_POST['nome'];
            $endereco = $_POST['endereco'];
            $telefone = $_POST['telefone'];
            $email = $_POST['email'];
            $sexo = $_POST['sexo'];

            //Validação
            $validacao = true;
            if (empty($nome)) {
                $nomeErro = 'Por favor digite o nome!';
                $validacao = false;
            }

            if (empty($email)) {
                $emailErro = 'Por favor digite o email!';
                $validacao = false;
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErro = 'Por favor digite um email válido!';
                $validacao = false;
            }

            if (empty($endereco)) {
                $enderecoErro = 'Por favor digite o endereço!';
                $validacao = false;
            }

            if (empty($telefone)) {
                $telefoneErro = 'Por favor digite o telefone!';
                $validacao = false;
            }

            if (empty($sexo)) {
                $sexoErro = 'Por favor preenche o campo!';
                $validacao = false;
            }

            // update data
            if ($validacao) {
                $usuarios = new UsuarioModel();
                $data = $usuarios->updatePessoa($id, $nome, $endereco, $telefone, $email, $sexo);
                header("Location: /");
            }
        } else {

            $usuarios = new UsuarioModel();
            $data = $usuarios->getPessoa($id);

            $nome = $data['nome'];
            $endereco = $data['endereco'];
            $telefone = $data['telefone'];
            $email = $data['email'];
            $sexo = $data['sexo'];
        }

        echo $sexo;
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
            $data = $usuarios->deletePessoa($id);
        }
        require_once '..\app\views\deleteUsuario.phtml';
    }
}
