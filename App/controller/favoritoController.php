<?php
require_once __DIR__ . '/../DAO/conexao.php';
require_once __DIR__ . '/../DAO/favoritoDAO.php';

class FavoritoController {
    private $favoritoDAO;

    public function __construct() {
        $conexao = new Conexao();
        $pdo = $conexao->fazConexao();
        $this->favoritoDAO = new FavoritoDAO($pdo);
    }

    public function toggleFavorito($idUsu, $idPro) {
        if ($this->favoritoDAO->verificaFavorito($idUsu, $idPro)) {
            $this->favoritoDAO->removerFavorito($idUsu, $idPro);
            return false;
        } else {
            $this->favoritoDAO->adicionarFavorito($idUsu, $idPro);
            return true;
        }
    }

    public function listarFavoritos($idUsu) {
        return $this->favoritoDAO->listarPorUsuario($idUsu);
    }

    public function verificaFavorito($idUsu, $idPro) {
        return $this->favoritoDAO->verificaFavorito($idUsu, $idPro);
    }
}
?>