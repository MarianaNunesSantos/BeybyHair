<?php
class FavoritoDAO {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function adicionarFavorito($idUsu, $idPro) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO favoritos (idUsu, idPro) VALUES (?, ?)");
            return $stmt->execute([$idUsu, $idPro]);
        } catch (PDOException $e) {
            error_log("Erro ao adicionar favorito: " . $e->getMessage());
            return false;
        }
    }

    public function removerFavorito($idUsu, $idPro) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM favoritos WHERE idUsu = ? AND idPro = ?");
            return $stmt->execute([$idUsu, $idPro]);
        } catch (PDOException $e) {
            error_log("Erro ao remover favorito: " . $e->getMessage());
            return false;
        }
    }

    public function verificaFavorito($idUsu, $idPro) {
        try {
            $stmt = $this->pdo->prepare("SELECT idFav FROM favoritos WHERE idUsu = ? AND idPro = ?");
            $stmt->execute([$idUsu, $idPro]);
            return $stmt->fetch() !== false;
        } catch (PDOException $e) {
            error_log("Erro ao verificar favorito: " . $e->getMessage());
            return false;
        }
    }

    public function listarPorUsuario($idUsu) {
        try {
            $stmt = $this->pdo->prepare("
                SELECT p.* 
                FROM produto p
                JOIN favoritos f ON p.idPro = f.idPro
                WHERE f.idUsu = ?
                ORDER BY p.nomePro
            ");
            $stmt->execute([$idUsu]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao listar favoritos: " . $e->getMessage());
            return [];
        }
    }
}
?>