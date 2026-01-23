<?php
    class ProdutoController{
        public static function cadastrarProduto($nome, $marca, $descricao, $especialidade, $tipo, $valor){
            include '../model/produtoModel.php';
            $produto = new produtoModel(null, $nome, $marca, $descricao, $especialidade, $tipo, $valor);
            $produto->cadastrarProduto($produto);
        }

        public static function listarProdutos(){
            include '../model/produtoModel.php';
            $model = new ProdutoModel(null, null, null, null, null, null, null);
            return $model->listarProdutos();
        }

        public static function resgatarPorID($idProduto){
            include '../model/produtoModel.php';
            $model = new produtoModel(null, null, null, null, null, null, null);
            return $model->resgatarPorID($idProduto);
        }

        public static function alterarProduto($id, $nome, $marca, $descricao, $especialidade, $tipo, $valor){
            include '../model/produtoModel.php';
            $produto = new produtoModel($id, $nome, $marca, $descricao, $especialidade, $tipo, $valor);
            $produto->alterarProduto($produto);
        }

        public static function excluirProduto($id){
            include '../model/produtoModel.php';
            $produto = new produtoModel(null, null, null, null, null, null, null);
            $produto->excluirProduto($id);
        }
    }
?>