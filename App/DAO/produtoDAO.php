<?php
    class produtoDAO{
        public function cadastrarProduto(produtoModel $produto){
            include_once 'conexao.php';
            $conex = new Conexao();
            $conex->fazConexao();
            $sql = "INSERT INTO produto (nomePro, marcaPro, descricaoPro, especialidadePro, tipoPro, valorPro)
                        VALUES (:nome, :marca, :descricao, :especialidade, :tipo, :valor)";
            $stmt = $conex->conn->prepare($sql);
            $stmt->bindValue(':nome', $produto->getNome());
            $stmt->bindValue(':marca',$produto->getMarca());
            $stmt->bindValue(':descricao',$produto->getDescricao());
            $stmt->bindValue(':especialidade',$produto->getEspecialidade());
            $stmt->bindValue(':tipo',$produto->getTipo());
            $stmt->bindValue(':valor',$produto->getValor());
            $res = $stmt->execute();
            if($res){
                echo "<script>alert('Cadastro Realizado com sucesso');</script>";
            }else{
                echo "<script>alert('Erro: Não foi possível realizar o cadastro');</script>";
            }
            echo "<script>location.href='../controller/processaProduto.php?op=Listar';</script>";
        }

        public function listarProdutos(){
            include_once 'Conexao.php';
            $conex = new Conexao();
            $conex->fazConexao();
            $sql = "SELECT * FROM produto ORDER BY idPro";
            return $conex->conn->query($sql);
        }

        public function resgatarPorID($idProduto){
            include_once 'Conexao.php';
            $conex = new Conexao();
            $conex->fazConexao();
            $sql = "SELECT * FROM produto WHERE idPro='$idProduto'";
            return $conex->conn->query($sql);
        }

        public function alterarProduto(ProdutoModel $produto){
            include_once 'Conexao.php';
            $conex = new Conexao();
            $conex->fazConexao();
            $sql = "UPDATE produto SET nomePro = :nome, marcaPro = :marca, descricaoPro = :descricao, especialidadePro = :especialidade, tipoPro = :tipo, valorPro = :valor WHERE idPro = :id";
            $stmt = $conex->conn->prepare($sql);
            $stmt->bindValue('id',$produto->getID());
            $stmt->bindValue('nome',$produto->getNome());
            $stmt->bindValue('marca',$produto->getMarca());
            $stmt->bindValue('descricao',$produto->getDescricao());
            $stmt->bindValue('especialidade',$produto->getEspecialidade());
            $stmt->bindValue('tipo',$produto->getTipo());
            $stmt->bindValue('valor',$produto->getValor());
            $res = $stmt->execute();
            if($res){
                echo "<script>alert('Registro Alterado com sucesso');</script>";
            }else{
                echo "<script>alert('Erro: Não foi possível alterar o cadastro');</script>";
            }
            echo "<script>location.href='../controller/processaProduto.php?op=Listar';</script>";
        }

        public function excluirProduto($idProduto){
            include_once 'Conexao.php';
            $conex = new Conexao();
            $conex->fazConexao();
            $sql = "DELETE FROM produto WHERE idPro='$idProduto'";
            $res = $conex->conn->query($sql);
            if($res){
                echo "<script>alert('Exclusão realizada com sucesso!');</script>";
            }else{
                echo "<script>alert('Erro: Não foi possível excluir o cadastro');</script>";
            }
            echo "<script>location.href='../controller/processaProduto.php?op=Listar';</script>";
        }
    }
?>