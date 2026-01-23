<?php
session_start();

$cupom = $_POST['cupom'];

$desconto = 0;

if(strtoupper($cupom) == 'BEYBYHAIR10') {
    $desconto = 10; 
}

// Armazena o cupom e desconto na sessão
$_SESSION['cupom_aplicado'] = [
    'codigo' => strtoupper($cupom),
    'desconto' => $desconto
];

$total = array_reduce($_SESSION['carrinho'], function($sum, $item) {
    return $sum + ($item['valor'] * $item['quantidade']);
}, 0);

echo json_encode([
    'success' => $desconto > 0,
    'total' => $total,
    'desconto' => $desconto,
    'message' => $desconto > 0 ? 'Cupom aplicado com sucesso!' : 'Cupom inválido'
]);
?>