-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11/05/2025 às 20:34
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `beybyhair`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `agendamento`
--

CREATE TABLE `agendamento` (
  `idUsu` int(8) NOT NULL,
  `idSer` int(8) NOT NULL,
  `dataAge` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `compra`
--

CREATE TABLE `compra` (
  `idUsu` int(8) NOT NULL,
  `idPro` int(8) NOT NULL,
  `nota_fiscalCom` int(8) NOT NULL,
  `dataCom` datetime NOT NULL,
  `totalCom` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `favoritos`
--

CREATE TABLE `favoritos` (
  `idFav` int(8) NOT NULL,
  `idUsu` int(8) NOT NULL,
  `idPro` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `favoritos`
--

INSERT INTO `favoritos` (`idFav`, `idUsu`, `idPro`) VALUES
(1, 2, 2),
(4, 2, 3),
(5, 2, 6),
(6, 2, 13),
(7, 2, 4),
(8, 5, 9),
(9, 5, 13),
(10, 5, 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE `produto` (
  `idPro` int(8) NOT NULL,
  `nomePro` varchar(60) NOT NULL,
  `marcaPro` varchar(15) NOT NULL,
  `descricaoPro` text NOT NULL,
  `descricaoLongaPro` text NOT NULL,
  `categoriaPro` varchar(20) NOT NULL,
  `subcategoriaPro` varchar(30) NOT NULL,
  `valorPro` decimal(6,2) NOT NULL,
  `imgPro` varchar(255) NOT NULL,
  `img2Pro` varchar(255) DEFAULT NULL,
  `img3Pro` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produto`
--

INSERT INTO `produto` (`idPro`, `nomePro`, `marcaPro`, `descricaoPro`, `descricaoLongaPro`, `categoriaPro`, `subcategoriaPro`, `valorPro`, `imgPro`, `img2Pro`, `img3Pro`) VALUES
(1, ' WELLA PROFESSIONALS INVIGO', 'WELLA', 'Wella Professionals Invigo Nutri-Enrich Shampoo para cabelos secos, ressecados ou quimicamente tratados em tamanho salao.', 'Wella Professionals Invigo Nutri-Enrich Shampoo hidrata e nutre os fios desde o momento da lavagem e, assim, vai muito alem de limpar. Sua formula e rica em ingredientes que conseguem proporcionar maciez absoluta e muito brilho, uma vez que suaviza a superficie do cabelo. Afinal, Wella Professionals Invigo Nutri-Enrich Shampoo trabalha tanto na reposicao de nutrientes essenciais como na hidratacao. Ele ainda possui um perfume luxuoso frutal chipre almiscarado. O embaixador de Wella Professionals, Dougllas Dias, que assinou o look da campanha de Invigo Nutri-Enrich, diz: O que eu mais gosto dessa linha, e que ela deixa o cabelo cada vez mais tratado, com um toque sedoso, macio e muito brilho. E ainda e possivel intercalar com outros produtos Invigo, como da linha Balance para cuidar do seu couro cabeludo ou a Color Brilliance, para quem tem cabelo colorido, por exemplo. Acao Goji Berry: uma fruta com alta concentracao de vitaminas antioxidantes, minerais e peptideos que melhoram a saude do cabelo. Acido Oleico e Pantenol: proporcionam hidratacao e nutricao de alta performance. Vitamina E: protege o cabelo de danos futuros. Como Usar Wella Professionals Invigo Nutri-Enrich Conselho de Aplicacao Aplique o shampoo sobre o cabelo umido. Massageie suavemente e enxague. Caso necessario, repita o procedimento. Resultado Seu cabelo fica limpo, hidratado e nutrido, com muita maciez e brilho.', 'CABELOS', 'Shampoos', 119.90, 'view/img/produto-wella1.png', NULL, NULL),
(2, 'BAUNY BATOM BALA COR 010 3,5G', 'BAUNY', 'Versáteis, os batons bala Bauny possuem óleo de rícino em sua formulação, o que confere alto poder de hidratação aos lábios, sem contar a sua fixação, conforto e cobertura ímpar.', '24 cores, 24 opções para você usar e se encantar! São 16 tonalidades matte e 8 cremosas, divididas entre nudes, rosas, vermelhos, malvas, laranjas e uva.\r\nVersáteis, os batons bala Bauny possuem óleo de rícino em sua formulação, o que confere alto poder de hidratação aos lábios, sem contar a sua fixação, conforto e cobertura ímpar.\r\n\r\nProduto vegano\r\nDermatologicamente testado\r\nLivre de parabenos', 'MAQUIAGEM', 'Batom/Gloss', 24.90, 'view/img/bauny-batom-bala-cor-010-3-5g.png', 'view/img/bauny-batom-bala-cor-010-3-5g-2.png', 'view/img/bauny-batom-bala-cor-010-3-5g-3.png'),
(3, 'BAUNY BATOM LÍQUIDO COR 090 5ML', 'BAUNY', 'Uma make poderosa precisa de um batom para um destaque “daqueles”.', 'Uma make poderosa precisa de um batom para um destaque “daqueles”. O batom líquido da Bauny possui um aspecto sequinho e confortável nos lábios, sem deixar de ser hidratante, graças à presença de ativos como ácido hialurônico e vitamina E em sua fórmula. Com efeito antioxidante, atua também na prevenção de radicais livres de poluição e manteiga de karité.\r\n\r\nDisponível em 12 cores.\r\n\r\nProduto vegano.', 'MAQUIAGEM', 'Batom/Gloss', 29.90, 'view/img/bauny-batom-liquido-cor-090-5ml.png', 'view/img/bauny-batom-liquido-cor-090-5ml-2.png', NULL),
(4, 'BAUNY LIPTINT COR PINK 10 ML', 'BAUNY', 'Meu Ink Tint chegou para te trazer alta fixação, pigmentação e cuidado com seus lábios.', 'Ink Pink\r\nMeu Ink Tint chegou para te trazer alta fixação, pigmentação e cuidado com seus lábios. Para você que gosta do acabamento opaco e resistente do lip tint, o meu Ink Tint é tudo que você desejava. Com 5% de Pantenol, meu Ink Tint promove a hidratação da pele, retendo umidade por muito mais tempo, prevenindo envelhecimento precoce dos lábios e renovação da pele.\r\n\r\nMinha cor Ink Pink é para todas as mulheres que adoram aquele rosadinho na boca, com textura em gel você consegue aplicar e esfumar extremamente bem, ideal para todos os dias!', 'MAQUIAGEM', 'Batom/Gloss', 28.90, 'view/img/bauny-liptint-cor-pink-10-ml.png', 'view/img/bauny-liptint-cor-pink-10-ml-2.png', 'view/img/bauny-liptint-cor-pink-10-ml-3.png'),
(5, 'BAUNY BATOM SOMBRA LÍQUIDA LUMINOUS CANDY 3G', 'BAUNY', 'O batom líquido Luminous by Bauny é um batom líquido matte com brilho, que é ativado e potencializado após a secagem completa e fricção dos lábios.', 'Já imaginou brilhar de dia e também à noite com um produto para lábios e olhos em uma única embalagem?\r\n\r\nCom o batom líquido Luminous by Bauny você pode!\r\n\r\nO batom líquido Luminous by Bauny é um batom líquido matte com brilho, que é ativado e potencializado após a secagem completa e fricção dos lábios.\r\n\r\nSua fórmula ultra fina de alta performance é enriquecida com potentes ativos hidratantes como a Manteiga de Karitê e o Pantenol (1,5% de concentração para cada ativo), promovendo extremo conforto durante a aplicação e após a secagem.\r\n\r\nSeu aplicador anatômico permite o contorno e preenchimento do lábio com precisão e praticidade.', 'MAQUIAGEM', 'Lápis para os olhos', 34.90, 'view/img/bauny-batom-sombra-liquida-luminous-candy-3g.png', 'view/img/bauny-batom-sombra-liquida-luminous-candy-3g-2.png', 'view/img/bauny-batom-sombra-liquida-luminous-candy-3g-3.png'),
(6, 'BRUNA TAVARES BTSKIN BASE LÍQUIDA L40', 'BRUNA TAVARES', 'A BT Skin atua como tratamento antissinais, garantindo mais firmeza e elasticidade para a pele.', 'Formulada com ativos que protegem a degradação do colágeno e estimula sua produção natural. Contém ácido hialurônico, mantendo a pele hidratada e prolongando a duração da maquiagem. Possui textura aveludada e cobertura leve a média com incrível acabamento de “segunda pele”, permitindo a construção de camadas, sem perder o efeito natural.\r\n\r\nPossui ativo contra a luz azul, protegendo as células da luz visível emitida pelas telas de computadores, celulares e tablets. Evita o surgimento de manchas, o envelhecimento precoce e aumenta a energia celular, restaurando a vitalidade da pele. A BT Skin contém vitamina E, antioxidante que previne a formação de radicais livres, é hipoalergênica, não comedogênica, livre de parabenos, vegana e não testada em animais.\r\n\r\nModo de usar:\r\nAplique uma pequena quantidade da base com o auxílio de um pincel, esponja ou com a pontas dos dedos. Comece pelo centro do rosto e espalhe para as extremidades. Agite antes de usar.', 'MAQUIAGEM', 'Bases/Pancakes', 89.90, 'view/img/bruna-tavares-base.png', NULL, NULL),
(7, 'BRUNA TAVARES BLUSH LÍQUIDO HELLO KITTY COFFEE SHOP', 'BRUNA TAVARES', 'Blush liquido com acabamento fosco luminoso. Bruna Tavares Hello Kitty é super versátil, também pode ser usado como batom ou sombra. ', 'O Blush Líquido Bruna Tavares Hello Kitty é o segredo para um coradinho fresh & natural que você sempre quis! A textura é uma delícia: leve e sedosa, do jeito que a gente ama! É só aplicar e se apaixonar pelo resultado: um efeito saudável, sem marcas ou textura. Experimente as cores disponíveis e prepare-se para os elogios. Corre para garantir o seu produto da collab mais fofa do momento e arrase na make com a gatinha mais amada de todas! ', 'MAQUIAGEM', 'Blush', 62.60, 'view/img/bruna-tavares-blush.png', NULL, NULL),
(8, 'BRUNA TAVARES PALETA DE ILUMINADORES BT HOLIDAY', 'BRUNA TAVARES', 'A Paleta de Iluminadores BT Holiday, da Bruna Tavares, é uma edição especial que traz tons sofisticados e versáteis para realçar a pele com um brilho luxuoso. Desenvolvida com partículas ultrafinas de brilho, ela proporciona um efeito radiante e espelhado, sem marcar textura ou pesar na maquiagem.', 'Uma paleta de iluminadores para celebrar o fim do ano em BT. Ela conta com fórmula exclusiva e cores que funcionam sozinhas ou misturadas entre si. São três tons de iluminadores com nuances únicas e acabamentos exuberantes. As cores Holiday Light e Holiday Rose Gold possuem uma fórmula cintilante que abraça a textura da pele, resultando em um glow ultra sofisticado. Já a tonalidade Holiday Party é uma explosão de brilho ouro velho, champagne e cristal em uma fórmula marshmallow super sedosa. A BT Holiday é um relançamento da paleta lançada no final de 2021. A fórmula, as cores e a embalagem permanecem as mesmas da primeira versão.', 'MAQUIAGEM', 'Iluminadores', 75.90, 'view/img/bruna-tavares-paleta.png', NULL, NULL),
(9, 'BRUNA TAVARES PRIMER FACIAL - BTBLUR', 'BRUNA TAVARES', 'O BT Blur é um primer matificante, que suaviza as imperfeições através de um disfarce óptico instantâneo.', 'Com textura uniforme e toque aveludada deixa sua pele impecável, livre de oleosidade e com acabamento matte.\r\nPode ser utilizado tanto sozinho como antes da maquiagem. Contém Vitamina E, poderosa antioxidante que previne envelhecimento precoce.\r\nLivre de parabenos.\r\n\r\n•Efeito matte\r\n•Oil free\r\n•Suaviza imperfeições\r\n\r\nModo de usar:\r\nCom a pele limpa, aplique o BT Blur pelo rosto com as pontas dos dedos ou com auxílio de um pincel. Primer em pasta: Disfarce óptico instantâneo.', 'MAQUIAGEM', 'Primers', 69.90, 'view/img/bruna-tavares-blur-primer.png', NULL, NULL),
(10, 'OLLIE BASTAO PROTETOR SOLAR COM COR FPS95 20 15G', 'OLLIE', 'O Protetor Solar em Bastão Com Cor da Ollie tem efeito de base, oferecendo cobertura média, longa duração e FPS 95 com FPUVA 40!', 'Praticidade como você nunca viu! O Protetor Solar em Bastão Com Cor da Ollie tem efeito de base, oferecendo cobertura média, longa duração e FPS 95 com FPUVA 40! Perfeito para todos os tipos de pele, incluindo as oleosas e maduras, suaviza manchas de acne e melasma e tem toque sequinho, com benefícios adicionais de tratamento da Vitamina C, Vitamina E e Ácido Hialurônico.', 'SKINCARE', 'Protetor Solar', 139.90, 'view/img/ollie-protetor.jpg', NULL, NULL),
(11, 'OLLIE GLOW CORPORAL FPS 40', 'OLLIE', 'Para que serve o óleo corporal?​ O da Ollie é a proteção e hidratação completa para o seu dia. Com proteção solar ba-ba-dei-ra, óleos hidratantes, como o de rosa mosqueta, vitamina E com efeito antioxidante e, claro, aquele brilho discreto que disfarça manchinhas e estrias e deixa sua pele com um Glow de dar inveja.​', 'Nosso Glow Corporal é um óleo iluminador corporal, com FPS 40 e FPUVA 20 que além de proteger a pele dos raios solares, hidrata, deixando-a com aspecto saudável, iluminado e com viço.\r\n\r\nO óleo corporal Ollie tem ativos nutritivos de rápida absorção e um brilho suave que deixa a sua pele com cara de verão, o ano todo. Ele é a solução perfeita, e incrível, para proteger a pele diariamente, enquanto hidrata e ilumina. Vem conhecer!', 'SKINCARE', 'Óleos', 99.00, 'view/img/ollie-bronzer.jpg', NULL, NULL),
(12, 'OLLIE PÓ TRANSLÚCIDO FACIAL FPS 30', 'OLLIE', 'Com aplicação prática, controle de oleosidade e filtros 100% minerais o Pó Translúcido FPS 30/FPUVA 10 é o reforço ideal para sua proteção diária com o benefício extra de controle da oleosidade da pele. ', 'Produzida com filtros 100% minerais, nossa proteção FPS 30 em Pó está disponível na versão translúcida, desenvolvida para adaptar-se aos diferentes rostos e cor de pele. Vai por nós: essa é a escolha perfeita para quem procura uma reposição prática para o protetor solar e um fixador poderoso para a sua make.\r\n\r\nO Pó Translúcido FPS 30 é composto por minipartículas translúcidas que promovem toque seco, deixando seu rosto mais nivelado e removendo o brilho excessivo, enquanto cria um escudo protetor para sua pele e fixa a sua make. Multi que chama, né?!', 'MAQUIAGEM', 'Pós', 119.90, 'view/img/ollie-po.png', NULL, NULL),
(13, 'OLLIE PROTETOR SOLAR TRANSPARENTE FPS 30', 'OLLIE', 'Com textura levinha levinha, um delicioso toque aveludado e cobertura transparente nos diferentes tons de pele, este protetor solar é a opção perfeita para T-O-D-O-S os rostos que buscam uma proteção segura e confortável que, de quebra, ainda garante a manutenção do colágeno e controle de oleosidade por até 8h. ', '100% transparente em todas as peles, ele promove a alta proteção e os cuidados que sua face demanda sem deixar vestígios brancos ou manchar o rosto. É como dizem por aí: totalmente invisível para quem vê, mas poderoso para quem usa. \r\n\r\nAcabamento levíssimo, sensorial aveludado delicioso e conforto incomparável? Vem de textura em gel do Protetor Facial Transparente Aveludado. Uma combinação de filtros poderosos.\r\n\r\nUm produto leve e extraordinário, como você.', 'SKINCARE', 'Protetor solar', 99.90, 'view/img/ollie-protetor-solar-transparente-fps-30.png', NULL, NULL),
(14, 'YAMA OXICREME OX 30 VOL 60ML', 'YAMA', 'A Yamá Cosméticos apresenta a nova Água Oxigenada Oxicreme 30 volumes, com fórmula enriquecida com Ômega Plus.', 'A Yamá Cosméticos apresenta a nova Água Oxigenada Oxicreme 30 volumes, com fórmula enriquecida com Ômega Plus. Uma combinação sinérgica de óleos vegetais ricos em ômega 3, 6, 7 e 9, ácidos graxos essenciais composto por óleos de girassol, gergelim, macadâmia e milho que garantem suavidade, emoliência e restauração da barreira hídrica dos fios e ação reparadora dos danos.\r\n\r\nPROVA DE TOQUE: Aplique uma pequena porção no antebraço ou atrás da orelha. Lave após 45 minutos. Aguarde 24 horas. Caso apresentar na pele irritação, ardência ou coceira no local ou na sua proximidade, não deve ser utilizado. \r\nMODO DE USAR: Utilizar na preparação de descolorações e colorações conforme quantidade indicada no modo de preparo do produto a ser utilizado.', 'COLORAÇÕES', 'Colorações para cabelo', 4.99, 'view/img/yama-oxicreme.png', NULL, NULL),
(15, 'BEAUTYCOLOR ÁGUA OXIGENADA 67,5ML', 'BEAUTYCOLOR', 'A Água Oxigenada BEAUTYCOLOR é um agente oxidante ideal para processos de coloração e descoloração capilar.', 'Sua fórmula estabilizada assegura uma ótima aderência ao pó descolorante. Além disso, é perfumada e neutraliza o odor de amônia, proporcionando uma experiência mais agradável. Esta água oxigenada é liberada para técnicas de \"low\" e \"no\".\r\n\r\nÁgua Oxigenada Cremosa\r\nAgente oxidante revelador\r\nÓtima aderência ao pó descolorante\r\nLiberada para técnicas de “low” e “no”\r\nFórmula estabilizada\r\nProduto perfumado\r\n20 volumes \r\n67,5ml', 'COLORAÇÕES', 'Colorações para cabelo', 6.98, 'view/img/beauty-color-agua-oxigenada.png', NULL, NULL),
(16, 'IGORA ROYAL COLOR CREME Nº6-77', 'IGORA', 'IGORA ROYAL da Schwarzkopf Professional traz-lhe cor real em Alta Definição que permite uma retenção e cobertura de brancos perfeitas. Desenvolvida por coloristas para coloristas, IGORA ROYAL deixa a a sua criatividade voar livremente proporcionando-lhe as ferramentas para transformar a imaginação em realidade, com resultados de cor fiéis à carta de cor – mesmo sob as condições mais desafiantes.', 'IGORA ROYAL oferece um portifólio holístico com gamas dedicadas, te dando a confiança na cor para dominar qualquer serviço de coloração permanente que a sua cliente peça.\r\nOferece embalagens sustentáveis, um portifólio simplificado e a MESMA fórmula única - IGORA ROYAL fornece tudo que precisa para dominar qualquer desafio e te empodera para ser o colorista que quer ser.\r\nA embalagem modernizada e simplificada para a nossa linha principal e linhas técnicas permitem que você reconheça facilmente cada gama e encontre o produto perfeito para a necessidade da sua cliente, seja IGORA ROYAL, IGORA ROYAL Highlifts, IGORA ROYAL Fashion Lights, IGORA ROYAL Absolutes ou IGORA ROYAL Silver Whites.\r\n\r\nSEJA PODEROSA com IGORA ROYAL\r\nA marca de referência para uma verdadeira performance de cor em alta definição', 'COLORAÇÕES', 'Colorações para cabelo', 39.90, 'view/img/igora-royal-color-creme.png', NULL, NULL),
(17, 'KEUNE DEVELOPER OXIDANTE 20VOL. 6%', 'KEUNE', 'O Creme Oxidante Tinta Developer Keune foi desenvolvido especialmente para complementar os processos de coloração e descoloração para garantir resultado perfeito e uniforme.', 'A Loção Oxidante Tinta Developer da Keune 6% volume 20 foi desenvolvida para ser utilizada exclusivamente com as colorações Keune. Ela é cremosa e enriquecida com o exclusivo estabilizador LP 300, que mantém os fios protegidos durante o processo e realça o brilho. Além disso, ela aumenta a durabilidade da cor e obtém melhor resultado na coloração.', 'COLORAÇÕES', 'Colorações para cabelo', 19.90, 'view/img/keune-developer-oxidante.png', NULL, NULL),
(18, 'YAMA PÓ DESCOLORANTE ÁCIDO HIALURÔNICO 20G', 'YAMA', 'O Pó Descolorante Yamá Ácido Hialurônico possui em sua composição o ácido hialurônico, um ativo capaz de auxiliar a hidratação e a preservar a estrutura dos fios, mantendo seus cabelos saudáveis durante o processo de descoloração. Sua formulação com pó branco permite a abertura de até 9 Tons.', ' A fórmula avançada do Pó Descolorante Yamá com Ácido Hialurônico traz o poder do ácido hialurônico, que hidrata e preserva a estrutura dos fios, protegendo-os dos danos da descoloração. Esta fórmula permite uma abertura de até 9 tons, proporcionando resultados incríveis. Cuide dos seus cabelos com o melhor da Yamá.\r\nDescubra o segredo para loiros deslumbrantes com nosso Pó Descolorante Yamá com Ácido Hialurônico.\r\n\r\nPor que escolher o nosso pó descolorante?\r\nÁcido Hialurônico Hidratante: Hidrata e protege a estrutura dos fios durante o processo de descoloração.\r\nAbertura de Até 9 Tons: Resultados impressionantes que vão além das expectativas.\r\nFórmula Avançada: Garanta um clareamento excepcional com a confiança da marca Yamá.\r\nCuide dos seus cabelos com o melhor. Experimente o Pó Descolorante Yamá com Ácido Hialurônico e revele a beleza dos seus loiros.', 'COLORAÇÕES', 'Colorações para cabelo', 11.00, 'view/img/yama-po-descolorante.png', NULL, NULL),
(19, 'AMEND COLOR DELICATÉ ÁGUA OXIGENADA 20 VOLUMES 75 ml', 'AMEND', 'A Água Oxigenada Estabilizada Cremosa foi especialmente desenvolvida para o uso com os produtos da linha Amend Color Intensy.', 'A Água Oxigenada Estabilizada Cremosa foi especialmente desenvolvida para o uso com os produtos da linha Amend Color Intensy.\r\nSó para uso profissional. Contém Peróxido de Hidrogênio.\r\nDescolore e auxilia no tingimento dos cabelos.', 'COLORAÇÕES', 'Colorações para cabelo', 14.90, 'view/img/amend-color-delicate-agua-oxigenada.png', NULL, NULL),
(20, 'IGORA OX NOVA HD 20 VOL 60ML', 'IGORA', 'Com Fórmula exclusiva, contém azeite e ingredientes especiais que atuam como protetores dos fios, aumentando a intensidade da cor, além de não agredir e manter a hidratação do cabelo.\r\n\r\n\r\n', 'A água oxigenada Schwarzkopf é indicada para facilitar a descoloração dos fios. Agindo juntamente com o pó descolorante a água Oxigenada 20Vol clareia até 2 tons – de acordo com a base atual dos cabelos. A fórmula exclusiva desenvolvida pela Schwarzkopf contém azeite e ingredientes especiais que atuam como protetores dos fios, aumentando a intensidade da cor, além de não agredir e manter a hidratação do cabelo.\r\n\r\nModo de uso:\r\nMisturar a loção ativadora com a coloração ou o pó descolorante como indicado no folheto explicativo que você encontra dentro da embalagem. A quantidade, a concentração e o tempo de pausa adequados estão especificados nas instruções de uso dos produtos de coloração e descoloração da linha Igora. Contém Peróxido de hidrogênio (6% = 20vol.).', 'COLORAÇÕES', 'Colorações para cabelo', 19.90, 'view/img/igora-ox-nova.png', NULL, NULL),
(21, 'KEUNE SEMI COLOR TONAL 6 60ML', 'KEUNE', 'Coloração permanente. Keune Tinta Color pigmenta com longa durabilidade e com intensa, mantém a maciez e saúde dos fios.\r\n\r\n', 'A Coloração Keune Tinta Color se diferencia por sua textura perolada e seu sistema de Tripla Proteção da Cor. Proporciona cobertura de até 100% dos fios brancos em cores semelhantes ao cabelo natural ou com reflexos variados. \r\n\r\nAlém de possuir tecnologia de maior fixação dos pigmentos, essa tinta Keune protege dos danos causados pela radiação solar, trata e condiciona profundamente os fios ao mesmo tempo em que colore. ', 'COLORAÇÕES', 'Colorações para cabelo', 59.90, 'view/img/keune-semi-color-tonal.png', NULL, NULL),
(22, 'CLESS CARE LISS PO DESCOLORANTE ÓLEO ARGAN 20G', 'CLESS', 'Previne o ressecamento dos fios durante o processo de descoloração.', 'COMO USAR: Despeje o Pó Descolorante Care Liss em um recipiente não metálico e adicione aos poucos o oxidante. Para 1 medida de Pó Descolorante, utilize 2 medidas de Água Oxigenada Care Liss. Misture com uma espátula (não metálica) até formar um creme homogêneo e aplique sobre os cabelos secos. Deixe agir de 10 a 45 minutos no máximo, de acordo com o grau de clareamento desejado, estrutura, porosidade e cor base do cabelo. Caso necessário, reaplique o produto até obter o grau de clareamento desejado, de acordo com a saúde dos fios. Não se exponha ao sol durante a aplicação. Enxague com água morna e lave os cabelos com shampoo e condicionador para retirar totalmente o produto. Siga rigorosamente as instruções de uso e faça o teste de toque e de mecha antes de aplicar. Recomendações de volumagem: 20 volumes - clareia de 2 a 3 tons. 30 volumes - clareia 3 a 5 tons. 40 volumes - clareia de 6 a 8 tons.', 'COLORAÇÕES', 'Colorações para cabelo', 6.00, 'view/img/cless-care-liss-po-descolorante.png', NULL, NULL),
(23, 'NIINA SECRETS BASE LÍQUIDA HIDRA GLOW COR 10 30ML', 'NIINA SECRETS', 'A Base Líquida Niina Secrets Hidra Glow é a base que hidrata e deixa sua pele radiante! A cor 10 é uma base de intensidade de cor clara que faz parte das 17 cores da linha para combinar com os diversos tons de pele, sendo uma ótima opção de base para a pele branca. Escolha a sua cor e conquiste o efeito desejado!', 'Niina Secrets Hidra Glow contém ácido hialurônico de última geração que deixa a pele hidratada, radiante como uma pétala, deixando um viço natural sem deixar oleosa.\r\n\r\nPossui cobertura média, permite construção de camadas sem craquelar e acumular nas linhas faciais, e deixa uma sensação confortável na pele. Sua textura é surpreendente e sua fragrância exclusiva é encantadora.\r\n\r\nCom Dupla proteção: Protege contra luz azul (luz do seu computador ou celular) e FPS16/UVA+++.\r\n\r\nSão 17 tons de base que representam a diversidade brasileira.\r\n\r\nA exclusiva tecnologia Secrets combina Óleo de rosas e vitaminas, que nutre a pele, possui ação antioxidante e auxilia a formação de colágeno.', 'MAQUIAGEM', 'Bases/Pancakes', 88.90, 'view/img/niina-secrets-base-liquida.png', NULL, NULL),
(24, 'LOREAL PROFESSIONNEL NUTRIOIL SHAMPOO 300ML', 'LOREAL', 'Cabelos secos e sem brilho? O shampoo NutriOil de L\'Oréal Professionnel é a solução ideal para cabelos mais nutridos e com muito mais brilho.', 'Cabelos secos e sem brilho? O shampoo NutriOil de L\'Oréal Professionnel é a solução ideal para cabelos mais nutridos e com muito mais brilho. Ideal para complementar sua etapa de nutrição no cronograma capilar. Sua fórmula profissional é enriquecida com óleo de coco em uma textura leve que confere a dose certa de nutrição sem pesar os fios. Com NutriOil, os cabelos se transformam instantaneamente: 4x mais nutridos*, mais macios e com muito mais brilho.\r\n*Teste Instrumental com o uso do shampoo e condicionador vs shampoo clássico.', 'CABELOS', 'Shampoos', 99.90, 'view/img/loreal-professionnel-nutrioil-shampoo.png', NULL, NULL),
(25, 'NIINA SECRETS PALETTE LUMINOUS COR 01', 'NIINA SECRETS', 'A Palette Multifuncional Cor 01 Niina Secrets Luminous chegou para iluminar a sua beleza neste verão com tudo o que precisa para finalizar a sua maquiagem. E o melhor: pode ser usada no rosto, olhos e corpo.', '1 palette, 4 efeitos, que podem ser utilizados como iluminador, blush e blush brilho, que podem ser usados como sombra devido à alta pigmentação, com texturas diferentes para efeitos multidimensionais:\r\n\r\nO iluminador possui ultra partículas de brilho, efeito espelhado e o acabamento glow que amamos para um look sofisticado. \r\n\r\nE para completar a paleta de maquiagem, apresentamos os blushes, com efeito saudável natural, alta pigmentação e fixação, em duas texturas: matte e super brilho. ', 'MAQUIAGEM', 'Iluminadores', 149.90, 'view/img/ninna-secrets-palette-luminous.png', NULL, NULL),
(26, 'RARE BEAUTY BRONZER EM BASTÃO POWER BOOST', 'RARE BEAUTY', 'O Bronzer em Bastão Rare Beauty Warm Wishes Effortless combina praticidade e sofisticação para realçar sua beleza natural com um toque de sol.', 'O Bronzer em Bastão Rare Beauty Warm Wishes Effortless combina praticidade e sofisticação para realçar sua beleza natural com um toque de sol.\r\n\r\nSua textura cremosa desliza suavemente sobre a pele, proporcionando um acabamento radiante e naturalmente iluminado. Ideal para criar contornos suaves e brilho sutil, este bronzer é perfeito para qualquer ocasião, adicionando calor e luminosidade com um simples gesto.\r\n\r\nEste bronzer em bastão inovador de Rare Beauty é cremoso e adere à pele deixando um bronzeado que não se apaga. Fácil de espalhar e construir camadas, desliza com leveza, contornando o rosto suavemente. Sua fórmula não pegajosa e à prova d’água não craquela, mancha ou obstrui os poros.', 'MAQUIAGEM', 'Bronzers/Contornos', 249.90, 'view/img/rare-beauty-bronzer.png', NULL, NULL),
(27, 'NIINA SECRETS NÉCESSAIRE PINK', 'NIINA SECRETS', 'Precisa de um acessório para guardar seus queridinhos Niina Secrets? O Nécessaire Pink Niina Secrets é o item que faltava no seu dia a dia. ', 'Prático e com design moderno que combina com todos os locais e ocasiões, este nécessaire vai ser seu aliado para organizar e carregar seus produtos para todos os lugares. \r\n\r\nEspaçoso, este nécessaire comporta os itens Niina Secrets que não podem faltar na sua rotina, mantendo você linda e com a make sempre pronta. \r\n\r\nCom zíper para manter seus produtos seguros, o Nécessaire Pink Niina Secrets é funcional e tem forro de poliéster super fácil de limpar. Além disso, possui espaço com transparência para facilitar a organização e visualização das suas maquiagens. \r\n\r\nCom um tom de cor-de-rosa belo e cheio de estilo como Niina Secrets é, este Nécessaire Pink Niina Secrets pode ser o complemento de um presente criativo ou um item a mais para a sua coleção de maquiagens e amor próprio! ', 'ACESSÓRIOS', 'Nécessaire', 64.90, 'view/img/niina-secrets-necessaire-pink.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `servico`
--

CREATE TABLE `servico` (
  `idSer` int(8) NOT NULL,
  `especialidadeSer` varchar(20) NOT NULL,
  `nomeSer` varchar(30) NOT NULL,
  `valorSer` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `idUsu` int(8) NOT NULL,
  `nomeUsu` varchar(20) NOT NULL,
  `sobrenomeUsu` varchar(30) NOT NULL,
  `cpfUsu` varchar(14) NOT NULL,
  `emailUsu` varchar(40) NOT NULL,
  `senhaUsu` varchar(255) NOT NULL,
  `nascimentoUsu` date NOT NULL,
  `telefoneUsu` varchar(15) NOT NULL,
  `cepUsu` varchar(9) NOT NULL,
  `enderecoUsu` varchar(255) NOT NULL,
  `numeroUsu` varchar(6) NOT NULL,
  `cep2Usu` varchar(9) DEFAULT NULL,
  `endereco2Usu` varchar(255) DEFAULT NULL,
  `numero2Usu` varchar(6) DEFAULT NULL,
  `cep3Usu` varchar(9) DEFAULT NULL,
  `endereco3Usu` varchar(255) DEFAULT NULL,
  `numero3Usu` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`idUsu`, `nomeUsu`, `sobrenomeUsu`, `cpfUsu`, `emailUsu`, `senhaUsu`, `nascimentoUsu`, `telefoneUsu`, `cepUsu`, `enderecoUsu`, `numeroUsu`, `cep2Usu`, `endereco2Usu`, `numero2Usu`, `cep3Usu`, `endereco3Usu`, `numero3Usu`) VALUES
(2, 'Eduardo ', 'Noronha', '12345678900', 'eduardo@senac.com', '$2y$10$mPciP.EhEDdVGQc5EH.sfOD1n6mwFlXdZBUHrMYEs0TMYIflfrYQu', '2003-07-03', '51999824440', '90830-530', 'Rua Comandai, Cristal, Porto Alegre - RS', '353', NULL, '', '', NULL, NULL, NULL),
(4, 'Mariana', 'Nunes', '12345678901', 'mariana@senac.com', '$2y$10$NRLvesq3qbAjQBqiFpzDVu87wK0.MJ0ggMy5Zi.hh2e/fg1iIZCze', '2001-11-28', '51999824441', '90660-130', 'Rua Felizardo de Farias, Medianeira, Porto Alegre - RS', '89', NULL, '', '', NULL, NULL, NULL),
(5, 'Maria', 'Silva', '123.456.789-02', 'maria@senac.com', '$2y$10$GHjdozM5xj.wnDrp6pKaBOWBt0CvVnyEAciIxThbylvjmX8ldMC8m', '2001-01-01', '(51) 99982-4442', '90020-020', 'Avenida Borges de Medeiros, Centro Histórico, Porto Alegre-RS', '50', '', '', '', '', '', ''),
(6, 'João', 'Sousa', '123.456.789-03', 'joao@senac.com', '$2y$10$lSgC1HILKUleZ.ehKB3ooeedl8JTAm02vco.2UIMabwGyrs2nHDNW', '2002-02-02', '(51) 99982-4443', '90020-020', 'Avenida Borges de Medeiros, Centro Histórico, Porto Alegre - RS', '60', NULL, '', '', NULL, NULL, NULL),
(10, 'José ', 'Soares', '123.456.789-04', 'jose@senac.com', '$2y$10$Pofk.0fZ/Csp973zXoYoaOhIt9DeFM07VkKwUzKSTBXAkCb6.k9lO', '2003-03-03', '(51) 99982-4444', '90020-020', 'Avenida Borges de Medeiros, Centro Histórico, Porto Alegre - RS', '70', NULL, '', '', NULL, NULL, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `agendamento`
--
ALTER TABLE `agendamento`
  ADD PRIMARY KEY (`idUsu`,`idSer`,`dataAge`),
  ADD KEY `idSer` (`idSer`);

--
-- Índices de tabela `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`nota_fiscalCom`),
  ADD KEY `idUsu` (`idUsu`),
  ADD KEY `idPro` (`idPro`);

--
-- Índices de tabela `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`idFav`),
  ADD KEY `idUsu` (`idUsu`),
  ADD KEY `idPro` (`idPro`);

--
-- Índices de tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`idPro`);

--
-- Índices de tabela `servico`
--
ALTER TABLE `servico`
  ADD PRIMARY KEY (`idSer`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsu`),
  ADD UNIQUE KEY `cpfUsu` (`cpfUsu`),
  ADD UNIQUE KEY `emailUsu` (`emailUsu`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `compra`
--
ALTER TABLE `compra`
  MODIFY `nota_fiscalCom` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `idFav` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `idPro` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `servico`
--
ALTER TABLE `servico`
  MODIFY `idSer` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsu` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `agendamento`
--
ALTER TABLE `agendamento`
  ADD CONSTRAINT `agendamento_ibfk_1` FOREIGN KEY (`idUsu`) REFERENCES `usuario` (`idUsu`),
  ADD CONSTRAINT `agendamento_ibfk_2` FOREIGN KEY (`idSer`) REFERENCES `servico` (`idSer`);

--
-- Restrições para tabelas `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`idUsu`) REFERENCES `usuario` (`idUsu`),
  ADD CONSTRAINT `compra_ibfk_2` FOREIGN KEY (`idPro`) REFERENCES `produto` (`idPro`);

--
-- Restrições para tabelas `favoritos`
--
ALTER TABLE `favoritos`
  ADD CONSTRAINT `favoritos_ibfk_1` FOREIGN KEY (`idUsu`) REFERENCES `usuario` (`idUsu`),
  ADD CONSTRAINT `favoritos_ibfk_2` FOREIGN KEY (`idPro`) REFERENCES `produto` (`idPro`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
