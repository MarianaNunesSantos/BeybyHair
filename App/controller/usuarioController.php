<?php

    class usuarioController{
        public static function cadastrarUsuario($nome, $sobrenome, $cpf, $email, $senha, $nascimento, $telefone, $cep, $endereco, $numero, $cep2, $endereco2, $numero2, $cep3, $endereco3, $numero3){
            include '../model/usuarioModel.php';
            $usuario = new usuarioModel(null, $nome, $sobrenome, $cpf, $email, $senha, $nascimento, $telefone, $cep, $endereco, $numero, $cep2, $endereco2, $numero2, $cep3, $endereco3, $numero3);
            $usuario->cadastrarUsuario($usuario);
        }

        public static function listarUsuarios(){
            include '../model/usuarioModel.php';
            $model = new usuarioModel(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
            return $model->listarUsuarios();
        }

        public static function resgatarPorID($idUsuario){
            include '../../model/usuarioModel.php';
            $model = new usuarioModel(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
            return $model->resgatarPorID($idUsuario);
        }

        public static function alterarUsuario($id, $nome, $sobrenome, $cpf, $email, $senha, $nascimento, $telefone, $cep, $endereco, $numero, $cep2, $endereco2, $numero2, $cep3, $endereco3, $numero3){
            include '../model/usuarioModel.php';
            $usuario = new usuarioModel ($id, $nome, $sobrenome, $cpf, $email, $senha, $nascimento, $telefone, $cep, $endereco, $numero, $cep2, $endereco2, $numero2, $cep3, $endereco3, $numero3);
            $usuario->alterarUsuario($usuario);
        }

        public static function excluirUsuario($id){
            include '../model/usuarioModel.php';
            $usuario = new usuarioModel (null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
            $usuario->excluirUsuario($id);
        }

        
    }
?>