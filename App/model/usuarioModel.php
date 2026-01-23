<?php
    class usuarioModel {
        protected $id;
        protected $nome;
        protected $sobrenome;
        protected $cpf;
        protected $email;
        protected $senha;
        protected $nascimento;
        protected $telefone;
        protected $cep;
        protected $endereco;
        protected $numero;
        protected $cep2;
        protected $endereco2;
        protected $numero2;
        protected $cep3;
        protected $endereco3;
        protected $numero3;
   
        public function __construct($id, $nome, $sobrenome, $cpf, $email, $senha, $nascimento, $telefone, $cep, $endereco, $numero, $cep2, $endereco2, $numero2, $cep3, $endereco3, $numero3){
            $this->id = $id;
            $this->nome = $nome;
            $this->sobrenome = $sobrenome;
            $this->cpf = $cpf;
            $this->email = $email;
            $this->senha = $senha;
            $this->nascimento = $nascimento;
            $this->telefone = $telefone;
            $this->cep = $cep;
            $this->endereco = $endereco;
            $this->numero = $numero;
            $this->cep2 = $cep2;
            $this->endereco2 = $endereco2;
            $this->numero2 = $numero2;
            $this->cep3 = $cep3;
            $this->endereco3 = $endereco3;
            $this->numero3 = $numero3;
        }

        public function getId(){
            return $this->id;
        }

        public function getNome(){
            return $this->nome;
        }

        public function getSobrenome(){
            return $this->sobrenome;
        }

        public function getCpf(){
            return $this->cpf;
        }

        public function getEmail(){
            return $this->email;
        }

        public function getSenha(){
            return $this->senha;
        }

        public function getNascimento(){
            return $this->nascimento;
        }

        public function getTelefone(){
            return $this->telefone;
        }

        public function getCep(){
            return $this->cep;
        }

        public function getEndereco(){
            return $this->endereco;
        }

        public function getNumero(){
            return $this->numero;
        }

        public function getCep2(){
            return $this->cep2;
        }

        public function getEndereco2(){
            return $this->endereco2;
        }

        public function getNumero2(){
            return $this->numero2;
        }

        public function getCep3(){
            return $this->cep3;
        }

        public function getEndereco3(){
            return $this->endereco3;
        }

        public function getNumero3(){
            return $this->numero3;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setNome($nome){
            $this->nome = $nome;
        }

        public function setSobrenome($sobrenome){
            $this->sobrenome = $sobrenome;
        }

        public function setCpf($cpf){
            $this->cpf = $cpf;
        }

        public function setEmail($email){
            $this->email = $email;
        }

        public function setSenha($senha){
            $this->senha = $senha;
        }

        public function setNascimento($nascimento){
            $this->nascimento = $nascimento;
        }

        public function setTelefone($telefone){
            $this->telefone = $telefone;
        }

        public function setCep($cep){
            $this->cep = $cep;
        }

        public function setEndereco($endereco){
            $this->endereco = $endereco;
        }

        public function setNumero($numero){
            $this->numero = $numero;
        }

        public function setCep2($cep2){
            $this->cep2 = $cep2;
        }

        public function setEndereco2($endereco2){
            $this->endereco2 = $endereco2;
        }

        public function setNumero2($numero2){
            $this->numero2 = $numero2;
        }

        public function setCep3($cep3){
            $this->cep3 = $cep3;
        }

        public function setEndereco3($endereco3){
            $this->endereco3 = $endereco3;
        }

        public function setNumero3($numero3){
            $this->numero3 = $numero3;
        }

        public function cadastrarUsuario(usuarioModel $usuario){
            include_once '../DAO/usuarioDAO.php';
            $usuario = new usuarioDAO();
            $usuario->cadastrarUsuario($this);
        }

        public function listarUsuarios(){
            include '../DAO/usuarioDAO.php';
            $dao = new usuarioDAO();
            return $dao->listarUsuarios();
        }

        public function resgatarPorID($id){
            include '../../DAO/usuarioDAO.php';
            $model = new usuarioDAO();
            return $model->resgatarPorID($id);
        }

        public function alterarUsuario(usuarioModel $usuario){
            include_once '../DAO/usuarioDAO.php';
            $usuario = new usuarioDAO();
            $usuario->alterarUsuario($this);
        }

        public function excluirUsuario($id){
            include_once '../DAO/usuarioDAO.php';
            $usuario = new usuarioDAO();
            $usuario->excluirUsuario($id);
        }
    }
?>