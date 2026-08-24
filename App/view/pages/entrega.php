<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php?redirect=entrega");
    exit();
}

if (!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho'])) {
    header("Location: carrinho.php");
    exit();
}

$carrinho = $_SESSION['carrinho'];
$total = array_reduce($carrinho, function ($sum, $item) {
    return $sum + ($item['valor'] * $item['quantidade']);
}, 0);

require_once '../../DAO/conexao.php';
$conn = new Conexao();
$pdo = $conn->fazConexao();

$stmt = $pdo->prepare("SELECT * FROM usuario WHERE idUsu = ?");
$stmt->execute([$_SESSION['id']]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

//PHP para separar os dados de como o endereço está salvo no banco
function parseEndereco($enderecoCompleto)
{
    $partes = explode(',', $enderecoCompleto);
    $partes = array_map('trim', $partes);

    $logradouro = $partes[0] ?? '';
    $bairro = $partes[1] ?? '';

    $cidadeEstado = $partes[2] ?? '';
    $cidadeEstadoPartes = explode('-', $cidadeEstado);
    $cidadeEstadoPartes = array_map('trim', $cidadeEstadoPartes);
    $cidade = $cidadeEstadoPartes[0] ?? '';
    $uf = $cidadeEstadoPartes[1] ?? '';

    return [
        'logradouro' => $logradouro,
        'bairro' => $bairro,
        'cidade' => $cidade,
        'uf' => $uf
    ];
}

$enderecoFormatado = parseEndereco($usuario['enderecoUsu']);

//PHP para o cupom
// Verifica se há cupom aplicado
$descontoCupom = 0;
if (isset($_SESSION['cupom_aplicado'])) {
    $descontoCupom = $_SESSION['cupom_aplicado']['desconto'];
}

$totalComDesconto = $total - $descontoCupom;
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/logo-branco.png" type="image/x-icon">
    <!-- Link para o CSS do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Links para os nossos CSS -->
    <link rel="stylesheet" href="../styles/default.css">
    <link rel="stylesheet" href="../styles/cabecalho-rodape.css">
    <link rel="stylesheet" href="../styles/entrega.css">
    <script src="../script/cabecalho-rodape.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=menu" />
    <!-- Link para o CSS do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Entrega - BeybyHair</title>
</head>


<body>
    <!-- Barra superior -->
    <section class="top-bar">
        <div class="container-top col-md-8 col-12 row align-items-center">
            <!-- Parte do frete e das parcelas -->
            <span class="col-md-2 col-6 frete"><img src="../img/icon-caminhao.png" alt="Ícone de caminhão" width="25">
                FRETE GRÁTIS</span>
            <span class="col-md-2 col-6 frete"><img src="../img/icon-cartao.png" alt="Ícone de cartão de crédito"
                    width="25"> EM ATÉ 6X (SEM JUROS*)</span>

            <!-- Parte dos pedidos e atendimento -->
            <a href="#" class="col-md-2 d-none d-sm-block pedidos">Meus agendamentos</a>
            <a href="#" class="col-md-2 d-none d-sm-block pedidos"><img src="../img/icon-balao-conversa.png"
                    alt="Ícone de balão de conversa" width="20"> Fale conosco</a>
            <span class="col-md-2 d-none d-sm-block pedidos"><img src="../img/icon-telefone.png" alt="Ícone de telefone"
                    width="20"> (51)99002-8922</span>
        </div>
    </section>

    <!-- Cabeçalho Principal -->
    <header>
        <section class="container-fluid navbar-custom">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Logo -->
                    <div class="col-md-3 col-12 text-center navbar-brand">
                        <a href="../../../index.php">
                            <img src="../img/logo-com-título.png" alt="Ícone da logo do BeybyHair" width="75%">
                        </a>
                    </div>

                    <!-- Barra de pesquisa -->
                    <div class="col-md-4 col-12 nav-input">
                        <div class="search-box">
                            <input type="text" placeholder="O que você procura?">
                            <a href="#"><img src="../img/icon-lupa.png" class="lupa-barra-pesquisa" alt="Ícone de lupa"
                                    width="25"></a>
                        </div>
                    </div>

                    <!-- Ícones e links -->
                    <div class="col-md-5 col-12 text-end nav-icons">
                        <?php if (isset($_SESSION['id'])): ?>
                            <!-- Botão quando LOGADO -->
                            <?php
                            // Recupera os dados do usuário da sessão
                            $nome = $_SESSION['nome'] ?? '';
                            $sobrenome = $_SESSION['sobrenome'] ?? '';
                            ?>
                            <button class="btn-minha-conta"
                                onclick="window.location.href='../../controller/processaUsuario.php?&idUsuario=<?= $_SESSION['id'] ?>'">
                                <a href="perfil.php" class="btn btn-link"><img src="../img/icon-user-fundo-branco.png"
                                        alt="Ícone de user"><?= htmlspecialchars($nome . ' ' . $sobrenome) ?></a>
                            </button>
                        <?php else: ?>
                            <!-- Botão quando NÃO LOGADO -->
                            <a href="login.php" class="btn btn-link"><img src="../img/icon-user-fundo-branco.png"
                                    alt="Ícone de user">Entre
                                ou<br>cadastre-se</a>
                        <?php endif; ?>

                        <a href="favoritos.php" class="btn btn-link">
                            <img src="../img/icon-favoritar.png" alt="Ícone de coração vazado">Favoritos
                        </a>

                        <a href="carrinho.php" class="btn btn-link">
                            <img src="../img/icon-carrinho-cheio.png" alt="Ícone de carrinho de compras">Sacola
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Menu de categorias -->
        <section class="container-fluid category-menu">
            <div class="col text-center">
                <ul>
                    <button id="abrir-menu"><a href="#">☰ Todas as categorias</a></button> <span class="separador-categoria">|</span>

                    <!-- Menu Lateral -->
                    <div class="menu-lateral" id="menu-lateral">
                        <h5>Todas as categorias</h5>
                        <span class="fechar-menu" id="fechar-menu">×</span>
                        <ul>
                            <li><a href="#" data-submenu="coloracoes">COLORAÇÕES</a></li>
                            <li><a href="#" data-submenu="maquiagem">MAQUIAGEM</a></li>
                            <li><a href="#" data-submenu="maos-e-pes">MÃOS E PÉS</a></li>
                            <li><a href="#" data-submenu="cabelos">CABELOS</a></li>
                            <li><a href="#" data-submenu="higiene">HIGIENE PESSOAL</a></li>
                            <li><a href="#" data-submenu="skincare">SKINCARE</a></li>
                            <li><a href="#" data-submenu="depilacao">DEPILAÇÃO</a></li>
                            <li><a href="#" data-submenu="eletricos">ELÉTRICOS</a></li>
                            <li><a href="#" data-submenu="acessorios">ACESSÓRIOS</a></li>
                            <li><a href="#" data-submenu="homens">HOMENS</a></li>
                        </ul>
                    </div>

                    <!-- Submenu Lateral -->
                    <div class="submenu-lateral" id="submenu-lateral">
                        <span class="fechar-menu" id="fechar-submenu">×</span>
                        <ul id="submenu-conteudo">
                            <!-- Conteúdo do submenu será preenchido dinamicamente -->
                    </div>

                    <div class="d-inline-block categoria-wrapper">
                        <a href="categoria.php?categoria=COLORAÇÕES" class="categoria-link d-none d-sm-block">COLORAÇÕES</a>
                        <div class="submenu-flutuante">
                            <div class="item-submenu"><a
                                    href="subcategoria.php?subcategoria=Colorações para cabelo">Colorações para
                                    cabelo</a></div>
                            <div class="item-submenu"><a
                                    href="subcategoria.php?subcategoria=Tonalizantes">Tonalizantes</a></div>
                            <div class="item-submenu"><a href="subcategoria.php?subcategoria=Oxidantes">Oxidantes</a>
                            </div>
                            <div class="item-submenu"><a
                                    href="subcategoria.php?subcategoria=Descolorantes">Descolorantes</a></div>
                            <div class="item-submenu"><a
                                    href="subcategoria.php?subcategoria=Colorações para sobrancelha">Colorações para
                                    sobrancelha</a></div>
                            <div class="item-submenu"><a
                                    href="subcategoria.php?subcategoria=Retoques corretivos para raiz">Retoques
                                    corretivos para raiz</a></div>
                            <div class="item-submenu"><a
                                    href="subcategoria.php?subcategoria=Colorações temporárias">Colorações
                                    temporárias</a></div>
                            <div class="item-submenu"><a href="subcategoria.php?subcategoria=Acessórios">Acessórios</a>
                            </div>
                            <div class="item-submenu"><a
                                    href="subcategoria.php?subcategoria=Reveladores">Reveladores</a></div>
                        </div>
                    </div> <span class="separador-categoria">|</span>

                    <div class="d-inline-block categoria-wrapper">
                        <a href="categoria.php?categoria=MAQUIAGEM" class="categoria-link d-none d-sm-block">MAQUIAGEM</a>
                        <div class="submenu-flutuante">
                            <div class="item-submenu"><a href="subcategoria.php?subcategoria=Esponjas">Esponjas</a>
                            </div>
                            <div class="item-submenu"><a
                                    href="subcategoria.php?subcategoria=<?= urlencode('Batom/Gloss') ?>">Batom/Gloss</a>
                            </div>
                            <div class="item-submenu"><a
                                    href="subcategoria.php?subcategoria=Máscara para cílios">Máscara para cílios</a>
                            </div>
                            <div class="item-submenu"><a
                                    href="subcategoria.php?subcategoria=<?= urlencode('Bases/Pancakes') ?>">Bases/Pancakes</a>
                            </div>
                            <div class="item-submenu"><a href="subcategoria.php?subcategoria=Pós">Pós</a></div>
                            <div class="item-submenu"><a href="subcategoria.php?subcategoria=Blush">Blush</a></div>
                            <div class="item-submenu"><a
                                    href="subcategoria.php?subcategoria=Iluminadores">Iluminadores</a></div>
                            <div class="item-submenu"><a href="subcategoria.php?subcategoria=Corretivos">Corretivos</a>
                            </div>
                            <div class="item-submenu"><a
                                    href="subcategoria.php?subcategoria=<?= urlencode('Bronzers/Contornos') ?>">Bronzers/Contornos</a>
                            </div>
                            <div class="item-submenu"><a href="subcategoria.php?subcategoria=Lápis para os olhos">Lápis
                                    para os olhos</a></div>
                            <div class="item-submenu"><a href="subcategoria.php?subcategoria=Acessórios">Acessórios</a>
                            </div>
                        </div>
                    </div> <span class="separador-categoria">|</span>

                    <div class="d-inline-block categoria-wrapper">
                        <a href="categoria.php?categoria=CABELOS" class="categoria-link d-none d-sm-block">CABELOS</a>
                        <div class="submenu-flutuante">
                            <div class="item-submenu"><a href="subcategoria.php?subcategoria=Shampoos">Shampoos</a>
                            </div>
                            <div class="item-submenu"><a
                                    href="subcategoria.php?subcategoria=Condicionadores">Condicionadores</a></div>
                            <div class="item-submenu"><a href="subcategoria.php?subcategoria=Cremes">Cremes</a></div>
                            <div class="item-submenu"><a href="subcategoria.php?subcategoria=Óleos">Óleos</a></div>
                            <div class="item-submenu"><a
                                    href="subcategoria.php?subcategoria=Máscaras capilares">Máscaras capilares</a></div>
                            <div class="item-submenu"><a
                                    href="subcategoria.php?subcategoria=Finalizadores">Finalizadores</a></div>
                            <div class="item-submenu"><a
                                    href="subcategoria.php?subcategoria=<?= urlencode('Gel/Pomada/Cera') ?>">Gel/Pomada/Cera</a>
                            </div>
                            <div class="item-submenu"><a href="subcategoria.php?subcategoria=Spray fixador">Spray
                                    fixador</a></div>
                            <div class="item-submenu"><a href="subcategoria.php?subcategoria=Kit de finalização">Kit de
                                    finalização</a></div>
                        </div>
                    </div> <span class="separador-categoria">|</span>

                    <div class="d-inline-block categoria-wrapper">
                        <a href="categoria.php?categoria=SKINCARE" class="categoria-link d-none d-sm-block">SKINCARE</a>
                        <div class="submenu-flutuante">
                            <div class="item-submenu"><a
                                    href="subcategoria.php?subcategoria=Hidratantes">Hidratantes</a></div>
                            <div class="item-submenu"><a
                                    href="subcategoria.php?subcategoria=Bronzeadores">Bronzeadores</a></div>
                            <div class="item-submenu"><a
                                    href="subcategoria.php?subcategoria=Esfoliantes">Esfoliantes</a></div>
                            <div class="item-submenu"><a href="subcategoria.php?subcategoria=Protetor solar">Protetor
                                    solar</a></div>
                            <div class="item-submenu"><a href="subcategoria.php?subcategoria=Óleos">Óleos</a></div>
                            <div class="item-submenu"><a href="subcategoria.php?subcategoria=Máscaras">Máscaras</a>
                            </div>
                            <div class="item-submenu"><a
                                    href="subcategoria.php?subcategoria=Tratamento facial">Tratamento facial</a></div>
                            <div class="item-submenu"><a href="subcategoria.php?subcategoria=Repelentes">Repelentes</a>
                            </div>
                            <div class="item-submenu"><a href="subcategoria.php?subcategoria=Talcos">Talcos</a></div>
                            <div class="item-submenu"><a href="subcategoria.php?subcategoria=Acessórios">Acessórios</a>
                            </div>
                        </div>
                    </div> <span class="separador-categoria">|</span>

                    <div class="d-inline-block categoria-wrapper">
                        <a href="categoria.php?categoria=ELÉTRICOS" class="categoria-link d-none d-sm-block">ELÉTRICOS</a>
                        <div class="submenu-flutuante">
                            <div class="item-submenu"><a
                                    href="subcategoria.php?subcategoria=Máquinas de acabamento">Máquinas de
                                    acabamento</a></div>
                            <div class="item-submenu"><a href="subcategoria.php?subcategoria=Máquinas de corte">Máquinas
                                    de corte</a></div>
                            <div class="item-submenu"><a href="subcategoria.php?subcategoria=Pranchas">Pranchas</a>
                            </div>
                            <div class="item-submenu"><a href="subcategoria.php?subcategoria=Secadores">Secadores</a>
                            </div>
                            <div class="item-submenu"><a
                                    href="subcategoria.php?subcategoria=Modeladores">Modeladores</a></div>
                            <div class="item-submenu"><a href="subcategoria.php?subcategoria=Difusores">Difusores</a>
                            </div>
                            <div class="item-submenu"><a
                                    href="subcategoria.php?subcategoria=Aparadores de pelos">Aparadores de pelos</a>
                            </div>
                            <div class="item-submenu"><a
                                    href="subcategoria.php?subcategoria=<?= urlencode('Autoclaves/Estufas') ?>">Autoclaves/Estufas</a>
                            </div>
                            <div class="item-submenu"><a href="subcategoria.php?subcategoria=Cabines de unhas">Cabines
                                    de unhas</a></div>
                        </div>
                    </div> <span class="separador-categoria">|</span>

                    <div class="d-inline-block categoria-wrapper">
                        <a href="categoria.php?categoria=ACESSÓRIOS" class="categoria-link d-none d-sm-block">ACESSÓRIOS</a>
                        <div class="submenu-flutuante">
                            <div class="item-submenu"><a href="subcategoria.php?subcategoria=Maletas">Maletas</a></div>
                            <div class="item-submenu"><a
                                    href="subcategoria.php?subcategoria=Borrifadores e Pulverizadores">Borrifadores e
                                    Pulverizadores</a></div>
                            <div class="item-submenu"><a
                                    href="subcategoria.php?subcategoria=<?= urlencode('Navalhas/Navalhetes') ?>">Navalhas/Navalhetes</a>
                            </div>
                            <div class="item-submenu"><a href="subcategoria.php?subcategoria=Espelhos">Espelhos</a>
                            </div>
                            <div class="item-submenu"><a href="subcategoria.php?subcategoria=Lenço descartável">Lenço
                                    descartável</a></div>
                            <div class="item-submenu"><a href="subcategoria.php?subcategoria=Nécessaire">Nécessaire</a>
                            </div>
                            <div class="item-submenu"><a href="subcategoria.php?subcategoria=Aventais">Aventais</a>
                            </div>
                            <div class="item-submenu"><a href="subcategoria.php?subcategoria=Kit de viagem">Kit de
                                    viagem</a></div>
                            <div class="item-submenu"><a href="subcategoria.php?subcategoria=Capas para corte">Capas
                                    para corte</a></div>
                        </div>
                    </div> <span class="separador-categoria">|</span>

                    <div class="d-inline-block categoria-wrapper">
                        <a href="categoria.php?categoria=HOMENS" class="categoria-link d-none d-sm-block">HOMENS</a>
                        <div class="submenu-flutuante">
                            <div class="item-submenu"><a href="subcategoria.php?subcategoria=Shampoos">Shampoos</a>
                            </div>
                            <div class="item-submenu"><a
                                    href="subcategoria.php?subcategoria=Condicionadores">Condicionadores</a></div>
                            <div class="item-submenu"><a
                                    href="subcategoria.php?subcategoria=Tonalizantes">Tonalizantes</a></div>
                            <div class="item-submenu"><a href="subcategoria.php?subcategoria=Perfumes">Perfumes</a>
                            </div>
                            <div class="item-submenu"><a
                                    href="subcategoria.php?subcategoria=<?= urlencode('Gel/Pomada/Cera') ?>">Gel/Pomada/Cera</a>
                            </div>
                            <div class="item-submenu"><a
                                    href="subcategoria.php?subcategoria=Cuidados para barba">Cuidados para barba</a>
                            </div>
                            <div class="item-submenu"><a href="subcategoria.php?subcategoria=Pincel para barba">Pincel
                                    para barba</a></div>
                            <div class="item-submenu"><a
                                    href="subcategoria.php?subcategoria=Kit de tratamento capilar">Kit de tratamento
                                    capilar</a></div>
                            <div class="item-submenu"><a
                                    href="subcategoria.php?subcategoria=Finalizadores">Finalizadores</a></div>
                        </div>
                    </div> <span class="separador-categoria">|</span>
            </div>
        </section>
    </header>

    <main class="col-md-12 container-fluid">
        <section class="col-md-2 col-0"></section>

        <section class="col-md-8 col-12 section-entrega">
            <div class="d-flex row justify-content-center div-entrega">
                <h1 class="mb-4">Entrega</h1>

                <div class="row">

                    <!-- TABELA -->
                    <div class="col-md-8 tabela-endereco">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th colspan="2">ENDEREÇO DE ENTREGA</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="fw-bold" style="width: 30%;">CEP*</td>
                                        <td><input type="text" id="cep" class="form-control form-control-sm"
                                                value="<?= htmlspecialchars($usuario['cepUsu'] ?? '') ?>"></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Logradouro*</td>
                                        <td id="logradouro">
                                            <?= htmlspecialchars($enderecoFormatado['logradouro'] ?? '') ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Número*</td>
                                        <td><input type="text" id="numero" class="form-control form-control-sm"
                                                value="<?= htmlspecialchars($usuario['numeroUsu'] ?? '') ?>"></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Bairro*</td>
                                        <td id="bairro"><?= htmlspecialchars($enderecoFormatado['bairro'] ?? '') ?></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Cidade*</td>
                                        <td id="cidade"><?= htmlspecialchars($enderecoFormatado['cidade'] ?? '') ?></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">UF*</td>
                                        <td id="uf"><?= htmlspecialchars($enderecoFormatado['uf'] ?? '') ?></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Complemento</td>
                                        <td class="complemento">
                                            <input class="form-control form-control-sm" id="complemento" type="text"
                                                placeholder="Ex: Apartamento 210"
                                                value="<?= htmlspecialchars($usuario['complementoUsu'] ?? '') ?>">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="d-grid gap-2 mt-3">
                                <button class="btn btn-outline-primary" id="redefinir-endereco">
                                    USAR O ENDEREÇO PADRÃO
                                </button>
                            </div>

                        </div>
                    </div>

                    <!-- RESUMO -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><strong>RESUMO</strong></h5>
                                <hr>

                                <div class="mb-3">
                                    <label for="cupom" class="form-label"><strong>Cupom de desconto</strong></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="cupom"
                                            placeholder="Digite o código do cupom">
                                        <button class="btn btn-outline-secondary aplicar-cupom" type="button"
                                            id="aplicar-cupom">OK</button>
                                    </div>
                                </div>

                                <hr>

                                <div class="mb-3">
                                    <h6>Subtotal (<?= count($carrinho) ?> itens)</h6>
                                    <p class="text-end" id="subtotal">R$ <?= number_format($total, 2, ',', '.') ?></p>

                                    <h6>Descontos</h6>
                                    <p class="text-end text-danger" id="descontos">- R$ 0,00</p>

                                    <h6>Cupom</h6>
                                    <p class="text-end text-danger" id="cupom-desconto">
                                        <?php if ($descontoCupom > 0): ?>
                                            - R$ <?= number_format($descontoCupom, 2, ',', '.') ?>
                                        <?php else: ?>
                                            - R$ 0,00
                                        <?php endif; ?>
                                    </p>
                                </div>

                                <hr>

                                <div class="d-flex justify-content-between align-items-center mb-4 total-pedido">
                                    <h5>Total do pedido:</h5>
                                    <h4 id="total-pedido">R$ <?= number_format($totalComDesconto, 2, ',', '.') ?></h4>
                                </div>

                                <div class="d-flex row justify-content-center botoes-finalizar">
                                    <button class="btn btn-primary py-3" id="finalizar-compra">
                                        <a href="#">FINALIZAR COMPRA</a>
                                    </button>
                                    <button class="btn btn-primary py-3" id="continuar-comprando"><a
                                            href="../../../index.php">CONTINUAR COMPRANDO</a></button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <section class="col-md-2 col-0"></section>
    </main>

    <footer>
        <div class="container">
            <div class="row">
                <!-- Coluna Institucional -->
                <div class="col-md-3">
                    <h5>Institucional</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Nossas Lojas</a></li>
                        <li><a href="#">Nossos Salões</a></li>
                        <li><a href="#">A Empresa</a></li>
                        <li><a href="#">Trabalhe Conosco</a></li>
                    </ul>
                </div>

                <!-- Coluna Ajuda -->
                <div class="col-md-3">
                    <h5>Ajuda</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Como Comprar?</a></li>
                        <li><a href="#">Política de Trocas</a></li>
                        <li><a href="#">Política de Privacidade</a></li>
                    </ul>
                </div>

                <!-- Coluna Redes Sociais -->
                <div class="col-md-3">
                    <h5>Redes Sociais</h5>
                    <ul class="list-unstyled">
                        <li class="li-footer"> <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="20"
                                    height="20" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
                                </svg></i>
                            </a>
                            <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                                    <path
                                        d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334" />
                                </svg>
                            </a>
                            <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                                    <path
                                        d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334q.002-.211-.006-.422A6.7 6.7 0 0 0 16 3.542a6.7 6.7 0 0 1-1.889.518 3.3 3.3 0 0 0 1.447-1.817 6.5 6.5 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.32 9.32 0 0 1-6.767-3.429 3.29 3.29 0 0 0 1.018 4.382A3.3 3.3 0 0 1 .64 6.575v.045a3.29 3.29 0 0 0 2.632 3.218 3.2 3.2 0 0 1-.865.115 3 3 0 0 1-.614-.057 3.28 3.28 0 0 0 3.067 2.277A6.6 6.6 0 0 1 .78 13.58a6 6 0 0 1-.78-.045A9.34 9.34 0 0 0 5.026 15" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Coluna Central de Atendimento -->
                <div class="col-md-3">
                    <h5>Central de Atendimento</h5>
                    <ul class="list-unstyled">
                        <li> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-telephone-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z" />
                            </svg> Dúvidas, <a href="tel:51090025022">ligue 51 99002-8922</a></li>
                        <li> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-envelope-fill" viewBox="0 0 16 16">
                                <path
                                    d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586zm3.436-.586L16 11.801V4.697z" />
                            </svg> Envie um e-mail <a href="mailto:sac@beybyhair.com.br">sac@beybyhair.com.br</a></li>
                        <li> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-clock" viewBox="0 0 16 16">
                                <path
                                    d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
                            </svg> Horário de atendimento 08:30 às 19:30</li>
                    </ul>
                </div>
            </div>
        </div>

        <hr />

        <!-- Copyright -->
        <div class="copyright">
            <div class="container">
                <p class="mb-0">
                    Copyright © 2025 BeybyHair - Todos os Direitos Reservados.
                    Razão Social: BeybyHair Salão e Loja de Beleza LTDA - CNPJ: 01.10.500.1234–56
                </p>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../script/entrega.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!--vlibras-->
    <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script> new window.VLibras.Widget('https://vlibras.gov.br/app');</script>

    <!--acessibilidade fonte e tals-->
    <script src="https://website-widgets.pages.dev/dist/sienna.min.js" defer></script>
</body>

</html>