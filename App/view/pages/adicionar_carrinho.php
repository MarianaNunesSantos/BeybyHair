<?php
session_start();
require_once '../../DAO/conexao.php';

$conexao = new Conexao();
$pdo = $conexao->fazConexao();

$idProduto = $_POST['id'];

try {
    $stmt = $pdo->prepare("SELECT * FROM produto WHERE idPro = ?");
    $stmt->execute([$idProduto]);
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if(!$produto) {
        echo json_encode(['success' => false, 'message' => 'Produto não encontrado']);
        exit;
    }
    
    if(!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = [];
    }
    
    $produtoNoCarrinho = false;
    foreach($_SESSION['carrinho'] as &$item) {
        if($item['id'] == $idProduto) {
            $item['quantidade']++;
            $produtoNoCarrinho = true;
            break;
        }
    }
    
    if(!$produtoNoCarrinho) {
        $_SESSION['carrinho'][] = [
            'id' => $produto['idPro'],
            'nome' => $produto['nomePro'],
            'marca' => $produto['marcaPro'],
            'descricao' => $produto['descricaoPro'],
            'valor' => $produto['valorPro'],
            'quantidade' => 1,
            'imagem' => $produto['imgPro']
        ];
    }
    
    $totalItens = array_reduce($_SESSION['carrinho'], function($total, $item) {
        return $total + $item['quantidade'];
    }, 0);
    
    echo json_encode(['success' => true, 'totalItens' => $totalItens]);
    
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Erro ao adicionar ao carrinho: ' . $e->getMessage()]);
}
?>