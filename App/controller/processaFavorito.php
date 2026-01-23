<?php
session_start();
require_once 'favoritoController.php';

if (!isset($_SESSION['id'])) {
    header('Location: ../view/pages/login.php');
    exit();
}

if (!isset($_GET['idProduto'])) {
    header('Location: ../index.php');
    exit();
}

$idUsu = $_SESSION['id'];
$idPro = $_GET['idProduto'];

$favoritoController = new FavoritoController();
$favoritoController->toggleFavorito($idUsu, $idPro);

header('Location: ../view/pages/produto.php?id=' . $idPro);
?>