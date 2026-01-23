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
        $marca = $_POST["marca"];
        $descricao = $_POST["descricao"];
        $especialidade = $_POST["especialidade"];
        $tipo = $_POST["tipo"];
        $valor = $_POST["valor"];
        include 'produtoController.php';
        $contr = new produtoController();
        $contr->cadastrarProduto($nome, $marca, $descricao, $especialidade, $tipo, $valor);
    }

    function alterar(){
        $nome = $_POST['nome'];
        $marca = $_POST['marca'];
        $descricao = $_POST['descricao'];
        $especialidade = $_POST['especialidade'];
        $tipo = $_POST['tipo'];
        $valor = $_POST["valor"];
        $id = $_POST['idProduto'];
        include 'produtoController.php';
        $contr = new produtoController();
        $contr->alterarProduto($id, $nome, $marca, $descricao, $especialidade, $tipo, $valor);
    }

    function excluir(){
        $id = $_REQUEST["idProduto"];
        include 'produtoController.php';
        $contr = new produtoController();
        $contr->excluirProduto($id);
    }

    function listar(){
        include '../view/formListarProduto.php';
    }
?>