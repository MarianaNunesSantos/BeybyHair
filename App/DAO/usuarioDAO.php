<?php
    class usuarioDAO{
        public function cadastrarUsuario(usuarioModel $usuario){
            include_once 'conexao.php';
            $conex = new Conexao();
            $conex->fazConexao();
            $sql = "INSERT INTO usuario (nomeUsu, sobrenomeUsu, cpfUsu, emailUsu, senhaUsu, nascimentoUsu, telefoneUsu, cepUsu, enderecoUsu, numeroUsu, cep2Usu, endereco2Usu, numero2Usu, cep3Usu, endereco3Usu, numero3Usu)
                        VALUES (:nome, :sobrenome, :cpf, :email, :senha, :nascimento, :telefone, :cep, :endereco, :numero, :cep2, :endereco2, :numero2, :cep3, :endereco3, :numero3)";
            $stmt = $conex->conn->prepare($sql);
            $stmt->bindValue(':nome', $usuario->getNome());
            $stmt->bindValue(':sobrenome', $usuario->getSobrenome());
            $stmt->bindValue(':cpf', $usuario->getCpf());
            $stmt->bindValue(':email', $usuario->getEmail());
            $stmt->bindValue(':senha', $usuario->getSenha());
            $stmt->bindValue(':nascimento', $usuario->getNascimento());
            $stmt->bindValue(':telefone', $usuario->getTelefone());
            $stmt->bindValue(':cep', $usuario->getCep());
            $stmt->bindValue(':endereco', $usuario->getEndereco());
            $stmt->bindValue(':numero', $usuario->getNumero());
            $stmt->bindValue(':cep2', $usuario->getCep2());
            $stmt->bindValue(':endereco2', $usuario->getEndereco2());
            $stmt->bindValue(':numero2', $usuario->getNumero2());
            $stmt->bindValue(':cep3', $usuario->getCep3());
            $stmt->bindValue(':endereco3', $usuario->getEndereco3());
            $stmt->bindValue(':numero3', $usuario->getNumero3());
            $res = $stmt->execute();
            if($res){
                echo "<script>alert('Cadastro Realizado com sucesso');</script>";
            }else{
                echo "<script>alert('Erro: Não foi possível realizar o cadastro');</script>";
            }
            echo "<script>location.href='../view/pages/login.php';</script>";
        }

        public function listarUsuarios(){
            include_once "conexao.php";
            $conex = new Conexao();
            $conex->fazConexao();
            $sql = "SELECT * FROM usuario ORDER BY idUsu";
            return $conex->conn->query($sql);
        }

        public function resgatarPorID($id){
            include_once 'conexao.php';
            $conex = new Conexao();
            $conex->fazConexao();
            $sql = "SELECT * FROM usuario WHERE idUsu='$id'";
            return $conex->conn->query($sql);
        }

        public function alterarUsuario(usuarioModel $usuario){
            include_once 'conexao.php';
            $conex = new Conexao();
            $conex->fazConexao();
            $sql = "UPDATE usuario SET nomeUsu = :nome, sobrenomeUsu = :sobrenome, cpfUsu = :cpf, emailUsu = :email, senhaUsu = :senha, nascimentoUsu = :nascimento, telefoneUsu = :telefone, cepUsu = :cep, enderecoUsu = :endereco, numeroUsu = :numero, cep2Usu = :cep2, endereco2Usu = :endereco2, numero2Usu = :numero2, cep3Usu = :cep3, endereco3Usu = :endereco3, numero3Usu = :numero3 WHERE idUsu = :id";
            $stmt = $conex->conn->prepare($sql);
            $stmt->bindValue('id', $usuario->getId());
            $stmt->bindValue('nome', $usuario->getNome());
            $stmt->bindValue('sobrenome', $usuario->getSobrenome());
            $stmt->bindValue('cpf', $usuario->getCpf());
            $stmt->bindValue('email', $usuario->getEmail());
            $stmt->bindValue('senha', $usuario->getSenha());
            $stmt->bindValue('nascimento', $usuario->getNascimento());
            $stmt->bindValue('telefone', $usuario->getTelefone());
            $stmt->bindValue('cep', $usuario->getCep());
            $stmt->bindValue(':endereco', $usuario->getEndereco());
            $stmt ->bindValue('numero', $usuario->getNumero());
            $stmt->bindValue('cep2', $usuario->getCep2());
            $stmt->bindValue(':endereco2', $usuario->getEndereco2());
            $stmt ->bindValue('numero2', $usuario->getNumero2());
            $stmt->bindValue('cep3', $usuario->getCep3());
            $stmt->bindValue(':endereco3', $usuario->getEndereco3());
            $stmt ->bindValue('numero3', $usuario->getNumero3());
            $res = $stmt->execute();
            if($res){
                echo "<script>alert('Registro Alterado com sucesso');</script>";
            }else{
                echo "<script>alert('Erro: Não foi possível alterar o cadastro');</script>";
            }
            echo "<script>location.href='../view/pages/perfil.php';</script>";
        }

        public function excluirUsuario($idUsuario){
            include_once 'conexao.php';
            $conex = new Conexao();
            $conex->fazConexao();
            
            try {
                // Prepara e executa cada DELETE
                $stmt = $conex->conn->prepare("DELETE FROM favoritos WHERE idUsu = ?");
                $stmt->execute([$idUsuario]);
                
                $stmt = $conex->conn->prepare("DELETE FROM compra WHERE idUsu = ?");
                $stmt->execute([$idUsuario]);
                
                $stmt = $conex->conn->prepare("DELETE FROM agendamento WHERE idUsu = ?");
                $stmt->execute([$idUsuario]);
                
                $stmt = $conex->conn->prepare("DELETE FROM usuario WHERE idUsu = ?");
                $res = $stmt->execute([$idUsuario]);
                
                if($res){
                    echo "<script>alert('Exclusão realizada com sucesso!');</script>";
                } else {
                    echo "<script>alert('Erro: Não foi possível excluir o cadastro');</script>";
                }
            } catch (PDOException $e) {
                echo "<script>alert('Erro ao excluir: " . addslashes($e->getMessage()) . "');</script>";
            }
            
            echo "<script>location.href='../view/pages/logout.php';</script>";
        }
    }
    
?>