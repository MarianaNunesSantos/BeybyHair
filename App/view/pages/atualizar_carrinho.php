<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $quantidade = $_POST['quantidade'] ?? 1;

    if ($id && isset($_SESSION['carrinho'])) {
        foreach ($_SESSION['carrinho'] as &$item) {
            if ($item['id'] == $id) {
                $item['quantidade'] = max(1, (int)$quantidade);
                break;
            }
        }

        $total = array_reduce($_SESSION['carrinho'], function($sum, $item) {
            return $sum + ($item['valor'] * $item['quantidade']);
        }, 0);

        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'precoItem' => $item['valor'] * $quantidade,
            'total' => $total
        ]);
        exit;
    }
}

header('Content-Type: application/json');
echo json_encode(['success' => false]);
?>