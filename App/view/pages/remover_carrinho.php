<?php
session_start();

$id = $_POST['id'];

$_SESSION['carrinho'] = array_filter($_SESSION['carrinho'], function($item) use ($id) {
    return $item['id'] != $id;
});

$total = calcularTotal();
$totalItens = array_reduce($_SESSION['carrinho'], function($total, $item) {
    return $total + $item['quantidade'];
}, 0);

echo json_encode([
    'success' => true,
    'total' => $total,
    'totalItens' => $totalItens
]);

function calcularTotal() {
    return array_reduce($_SESSION['carrinho'], function($sum, $item) {
        return $sum + ($item['valor'] * $item['quantidade']);
    }, 0);
}
?>