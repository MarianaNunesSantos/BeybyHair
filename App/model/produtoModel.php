<?php
    class produtoModel {
        protected $id;
        protected $nome;
        protected $marca;
        protected $descricao;
        protected $especialidade;
        protected $tipo;
        protected $valor;

        public function __construct($id, $nome, $marca, $descricao, $especialidade, $tipo, $valor){
            $this->id = $id;
            $this->nome = $nome;
            $this->marca = $marca;
            $this->descricao = $descricao;
            $this->especialidade = $especialidade;
            $this->tipo = $tipo;
            $this->valor = $valor;
        }

        public function getId(){
            return $this->id;
        }

        public function getNome(){
            return $this->nome;
        }

        public function getMarca(){
            return $this->marca;
        }

        public function getDescricao(){
            return $this->descricao;
        }

        public function getEspecialidade() {
            return $this->especialidade;
        }

        public function getTipo(){
            return $this->tipo;
        }

        public function getValor() {
            return $this->valor;
        }

        public function setId(){
            $this->id;
        }

        public function setNome($nome){
            $this->nome = $nome;
        }

        public function setMarca($marca){
            $this->marca = $marca;
        }

        public function setDescricao($descricao){
            $this->descricao = $descricao;
        }

        public function setEspecialidade($especialidade) {
            $this->especialidade = $especialidade;
        }

        public function setTipo($tipo){
            $this->tipo = $tipo;
        }

        public function setValor($valor) {
            $this->valor = $valor;
        }

        public function cadastrarProduto(produtoModel $produto){
            include_once '../DAO/produtoDAO.php';
            $produto = new produtoDAO();
            $produto->cadastrarProduto($this);
        }

        public function listarProdutos(){
            include '../DAO/produtoDAO.php';
            $dao = new produtoDAO();
            return $dao->listarprodutos();
        }

        public function resgatarPorID($idProduto){
            include '../../DAO/produtoDAO.php';
            $model = new produtoDAO();
            return $model->resgatarPorID($idProduto);
        }

        public function alterarProduto(produtoModel $produto){
            include_once '../DAO/produtoDAO.php';
            $produto = new produtoDAO();
            $produto->alterarProduto($this);
        }

        public function excluirProduto($idProduto){
            include_once '../DAO/produtoDAO.php';
            $produto = new produtoDAO();
            $produto->excluirProduto($idProduto);
        }
    }
?>