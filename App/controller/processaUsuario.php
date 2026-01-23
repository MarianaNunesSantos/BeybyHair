<?php
    switch($_REQUEST["op"]){
        case "Incluir":
            incluir();
        break;
        case "Alterar":
            alterar();
        break;
        case "Excluir":
            excluir();
        break;
        case "Listar":
            listar();
        break;
        default:
            echo"não encontrou chave";
    }

    function incluir(){
        $nome = $_POST["nome"];
        $sobrenome = $_POST["sobrenome"];
        $cpf = $_POST["cpf"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        $nascimento = $_POST["nascimento"];
        $telefone = $_POST["telefone"];
        $cep = $_POST["cep"];
        $endereco = $_POST["endereco"];
        $numero = $_POST["numero"];
        $cep2 = $_POST["cep2"];
        $endereco2 = $_POST["endereco2"];
        $numero2 = $_POST["numero2"];
        $cep3 = $_POST["cep3"];
        $endereco3 = $_POST["endereco3"];
        $numero3 = $_POST["numero3"];
        include 'usuarioController.php';
        $contr = new usuarioController();
        $contr->cadastrarUsuario($nome, $sobrenome, $cpf, $email, $senha, $nascimento, $telefone, $cep, $endereco, $numero, $cep2, $endereco2, $numero2, $cep3, $endereco3, $numero3);
    }

    function alterar(){
        $nome = $_POST["nome"];
        $sobrenome = $_POST["sobrenome"];
        $cpf = $_POST["cpf"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        $nascimento = $_POST["nascimento"];
        $telefone = $_POST["telefone"];
        $cep = $_POST["cep"];
        $endereco = $_POST["endereco"];
        $numero = $_POST["numero"];
        $cep2 = $_POST["cep2"];
        $endereco2 = $_POST["endereco2"];
        $numero2 = $_POST["numero2"];
        $cep3 = $_POST["cep3"];
        $endereco3 = $_POST["endereco3"];
        $numero3 = $_POST["numero3"];
        $id = $_POST['idUsuario'];
        include 'usuarioController.php';
        $contr = new usuarioController();
        $contr->alterarUsuario($id, $nome, $sobrenome, $cpf, $email, $senha, $nascimento, $telefone, $cep, $endereco, $numero, $cep2, $endereco2, $numero2, $cep3, $endereco3, $numero3);
    }

    function excluir(){
        $id = $_REQUEST["idUsuario"];
        include 'usuarioController.php';
        $contr = new usuarioController();
        $contr->excluirUsuario($id);
    }

    function listar(){
        include '../view/pages/formListarUsuario.php';
    }
?>