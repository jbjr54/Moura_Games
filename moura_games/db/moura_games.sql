-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12/09/2024 às 15:58
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `moura_games`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_clientes`
--

CREATE TABLE `tb_clientes` (
  `ID` int(11) NOT NULL,
  `USERNAME` varchar(50) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `STATUS` enum('online','offline') DEFAULT 'offline',
  `CREATED _AT` timestamp NOT NULL DEFAULT current_timestamp(),
  `AVATAR` varchar(255) DEFAULT 'default-avatar.png',
  `PROFILE_PICTURE` varchar(255) DEFAULT 'default-avatar.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_clientes`
--

INSERT INTO `tb_clientes` (`ID`, `USERNAME`, `EMAIL`, `PASSWORD`, `STATUS`, `CREATED _AT`, `AVATAR`, `PROFILE_PICTURE`) VALUES
(12, 'moura', 'matheus.santos123moura@gmail.com', '$2y$10$3eXfJxM31.MxLViEhVmsienEG4aNrDzKMobPVGAJdu4AxenmQGYyi', 'offline', '2024-08-15 13:36:17', 'default-avatar.png', '1723728977-a873f3f357e4fe348fb8100ce31d62be.jpg'),
(13, 'Paz', 'paz@gmail.com', '$2y$10$6RSb6LQX5q1ZVuxAvHaSR.Z25t2bf97.QDBopnRbKLYkX0AWw4BZS', 'offline', '2024-08-15 13:38:10', 'default-avatar.png', 'img.jpg'),
(14, 'Sanji', 'joycethais496@gmail.com', '$2y$10$bq/vN.pUo2aOgap0DMH1Y.pPEVXWIoqzKHK5sQZDY5PlesF5bTeSm', 'offline', '2024-08-19 12:27:19', 'default-avatar.png', '1724070439-img.jpg'),
(15, 'Jackson', 'xKauuanBR@outlook.com', '$2y$10$e3Xwnz.PIB5U7TM84TfMBOkvYfYzfiBzBoUtczVlXRn6UPh4cQBhq', 'offline', '2024-08-19 13:13:20', 'default-avatar.png', '1724073200-a873f3f357e4fe348fb8100ce31d62be.jpg'),
(19, 'Matheus Henrique', 'matheus.santos321henrique@gmail.com.br', '$2y$10$lDflynQTSV.YpcMwlp.W.eU5AJA5CZwU99sFj06aW9EyEeu6ZqsTy', 'offline', '2024-09-11 14:07:53', 'default-avatar.png', 'moura.jpeg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_produtos`
--

CREATE TABLE `tb_produtos` (
  `ID` int(10) NOT NULL,
  `PRODUTO` varchar(150) NOT NULL,
  `TIPO` char(50) NOT NULL,
  `PLATAFORMA` char(40) NOT NULL,
  `DESCRICAO` varchar(500) NOT NULL,
  `FOTO` char(150) NOT NULL,
  `VALOR` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_produtos`
--

INSERT INTO `tb_produtos` (`ID`, `PRODUTO`, `TIPO`, `PLATAFORMA`, `DESCRICAO`, `FOTO`, `VALOR`) VALUES
(53, 'Knack 2', 'GAME', 'PSN', 'Knack 2 é um jogo de ação e aventura desenvolvido pela Japan Studio e publicado pela Sony Interactive Entertainment. Lançado para PlayStation 4, é a sequência do título original Knack. O jogo segue as aventuras de Knack, um herói composto por peças de relíquias antigas, enquanto ele enfrenta novas ameaças e desafios.', 'knack 2.jpg', 92),
(54, 'Watch Dogs 2', 'GAME', 'PSN', '\"Watch Dogs 2\" é um jogo de ação e aventura desenvolvido pela Ubisoft, situado na vibrante cidade de São Francisco. O título segue Marcus Holloway, um jovem hacker que se une ao grupo DedSec para combater um sistema de vigilância opressivo e uma corporação corrupta. Utilizando suas habilidades de hacking, Marcus pode manipular a infraestrutura da cidade, desativar sistemas de segurança e até mesmo controlar veículos e dispositivos eletrônicos.', 'Watch Dogs 2.jpg', 100),
(55, 'Gear of War Triple Pack', 'GAME', 'XBOX', '\"Gears of War\" é uma série de jogos de tiro em terceira pessoa desenvolvida pela Epic Games e The Coalition. A trama se passa em um futuro pós-apocalíptico onde a humanidade luta pela sobrevivência contra criaturas monstruosas chamadas Locust, que emergem do subsolo. Os jogadores assumem o papel de soldados de elite chamados Gears, equipados com armas avançadas e armaduras pesadas.', 'Gear_of_War.jpg', 130),
(56, 'Uncharted 4', 'GAME', 'PSN', 'Uncharted 4: A Thief’s End é um jogo de ação e aventura desenvolvido pela Naughty Dog e lançado para PlayStation 4. Nesta sequência da popular série, você acompanha Nathan Drake, um caçador de tesouros aposentado, que é puxado de volta à ação quando seu antigo parceiro, Sam Drake, aparece com uma nova missão. A trama leva Nathan a locais exóticos ao redor do mundo, onde ele enfrenta desafios e inimigos em busca de um lendário tesouro pirata.', 'uncharted 4.png', 69),
(57, 'Marvel Spider-Man 2', 'GAME', 'PSN', 'Marvel’s Spider-Man 2 é um emocionante jogo de ação e aventura desenvolvido pela Insomniac Games para PlayStation 5. Continuando a história dos aclamados jogos anteriores, você assume o papel de Peter Parker e Miles Morales, ambos com suas habilidades únicas de teia e combate. A trama segue uma nova ameaça para Nova York, com a chegada de vilões icônicos como Venom e o Lagarto. ', 'Miranha2.jpg', 349),
(58, 'Street Fighter 6', 'GAME', 'PSN', 'Street Fighter 6 é a mais recente adição à icônica série de jogos de luta desenvolvida pela Capcom. Lançado para PlayStation 5, PlayStation 4, Xbox Series X/S e PC, o jogo traz uma série de inovações ao clássico estilo de combate. Com um elenco diversificado de lutadores, incluindo retornos de personagens favoritos dos fãs e novos rostos, Street Fighter 6 apresenta um sistema de combate refinado, que combina mecânicas tradicionais com novas funcionalidades, como o “Drive System”, que introduz ha', 'briga6.jpg', 279),
(59, 'Resident Evil Village', 'GAME', 'PSN', 'Resident Evil Village (ou Resident Evil 8), desenvolvido pela Capcom, é um emocionante jogo de survival horror e a oitava principal entrada na série. Lançado em 2021, o jogo continua a história de Ethan Winters, que agora busca sua filha sequestrada em uma misteriosa vila europeia. O cenário sombrio é repleto de monstros e criaturas aterrorizantes, incluindo a icônica Lady Dimitrescu e seus filhos. Resident Evil Village combina elementos de horror psicológico e ação intensa, oferecendo uma exper', 'residencia do mal.jpg', 228),
(60, 'Far Cry 3', 'GAME', 'XBOX', '\"Far Cry 3\" é um jogo de ação e aventura em primeira pessoa lançado pela Ubisoft. Ambientado em uma ilha tropical cheia de perigos, o jogo segue a história de Jason Brody, um jovem que busca resgatar seus amigos sequestrados por piratas e mercenários. Ao explorar a vasta e exuberante paisagem da ilha, Jason enfrenta inimigos variados, desenvolve habilidades de combate e usa uma variedade de armas e ferramentas.', 'Far_Cry.jpg', 79),
(61, 'Tomb Raider - Underworld', 'GAME', 'XBOX', '\"Tomb Raider: Underworld\" é um jogo de ação e aventura desenvolvido pela Crystal Dynamics e lançado em 2008. É a nona entrada na série \"Tomb Raider\" e segue as aventuras da icônica arqueóloga Lara Croft. No jogo, Lara está em uma missão para descobrir o segredo da deusa nórdica Idunn e encontrar sua mãe, que desapareceu misteriosamente.\r\n\r\nO jogo apresenta um mundo expansivo e rico em ambientes variados, desde cavernas subaquáticas até ruínas antigas. Lara utiliza uma variedade de habilidades, c', 'tomb_raider.jpg', 379),
(62, 'Call Of Duty - Black Ops', 'GAME', 'XBOX', 'Call of Duty: Black Ops\" é um jogo de tiro em primeira pessoa desenvolvido pela Treyarch e lançado em 2010. Situado durante a Guerra Fria, o jogo segue a história do soldado Mason, que se encontra envolvido em uma complexa trama de espionagem e conspiração.\r\n\r\nO jogo é conhecido por seu enredo envolvente e pela introdução de uma narrativa não linear, que mistura elementos de ação com mistério e intriga.', 'chamado.jpg', 149),
(63, 'Minecraft - Xbox 360 Edition', 'GAME', 'XBOX', 'Minecraft: Xbox 360 Edition oferece uma experiência de construção e exploração em um mundo aberto gerado proceduralmente, onde os jogadores podem explorar, minerar e construir estruturas usando blocos de diferentes materiais. A versão para Xbox 360 mantém a jogabilidade central do \"Minecraft\" original, mas é adaptada para o controle do console, com uma interface e mecânicas ajustadas para uma experiência mais fluida no console.', 'minecraft.jpg', 74),
(64, 'Halo 4', 'GAME', 'XBOX', '\"Halo 4\" continua a história do Master Chief, o icônico supersoldado, e seu fiel companheiro de inteligência artificial, Cortana. A trama se passa quatro anos após os eventos de \"Halo 3\" e segue a dupla enquanto eles enfrentam uma nova ameaça: os Forerunners, uma antiga e poderosa raça alienígena. A história explora a profundidade do relacionamento entre Master Chief e Cortana, além de introduzir novos personagens e elementos ao universo \"Halo\".', 'anel4.jpg', 139),
(65, 'Super Mario Sunshine ', 'GAME', 'NINTENDO', 'Em \"Super Mario Sunshine\", Mario viaja para o tropical Isle Delfino para uma merecida férias. No entanto, ao chegar, ele descobre que a ilha está coberta de sujeira e poluição, e ele é erroneamente acusado de ser o responsável pelo caos. Para limpar seu nome e restaurar a beleza da ilha, Mario recebe um novo dispositivo chamado FLUDD (Flash Liquidizer Ultra Dousing Device), que usa água para limpar a sujeira e combater inimigos.', 'piscina.jpg', 42),
(66, 'Animal Crossing - New Horizons ', 'GAME', 'NINTENDO', 'Animal Crossing: New Horizons é um popular jogo de simulação de vida desenvolvido pela Nintendo para o Nintendo Switch, lançado em 20 de março de 2020. No jogo, os jogadores começam sua jornada em uma ilha deserta, com a liberdade de moldar e personalizar o ambiente ao seu estilo. Desde a construção e decoração de casas até o design de paisagens e criação de áreas temáticas, cada aspecto da ilha pode ser ajustado conforme a preferência do jogador. Além das atividades de personalização, os jogado', 'animais.jpg', 128),
(67, 'The Legend of Zelda - Skyward Sword HD', 'GAME', 'NINTENDO', 'The Legend of Zelda: Skyward Sword HD é uma versão aprimorada do jogo original lançado para Wii. Disponível para Nintendo Switch desde 16 de julho de 2021, esta remasterização traz gráficos em alta definição e melhorias na jogabilidade. O jogo segue Link em uma jornada épica para resgatar Zelda e enfrentar o mal, explorando a origem da Triforce e do universo de Zelda. Com controles ajustados e uma experiência visual renovada, Skyward Sword HD oferece uma nova maneira de vivenciar esta aventura c', 'zelda.jpg', 299),
(68, 'Pokemon X', 'GAME', 'NINTENDO', 'Pokémon X é um jogo de RPG desenvolvido pela Game Freak e lançado para o Nintendo 3DS em 12 de outubro de 2013. Situado na região de Kalos, inspirada na França, o jogo introduz a sexta geração de Pokémon e a mecânica de Mega Evolução. Os jogadores assumem o papel de um jovem treinador que embarca em uma jornada para se tornar o campeão da Liga Pokémon, capturando e treinando uma variedade de Pokémon, enquanto enfrenta a equipe vilã e descobre os mistérios da nova região. Com gráficos em 3D e uma', 'pokemonX.jpg', 140),
(69, 'Kirby Star Allies ', 'GAME', 'NINTENDO', 'Kirby Star Allies é um jogo de plataforma para o Nintendo Switch onde Kirby ganha o poder de formar alianças com outros personagens para enfrentar inimigos e explorar mundos coloridos. Os jogadores podem recrutar até três aliados para ajudar em batalhas e resolver quebra-cabeças, aproveitando uma variedade de habilidades especiais. O jogo é conhecido por seu estilo visual vibrante, jogabilidade cooperativa e modo multiplayer que permite a diversão com amigos e familiares.', 'kirby.jpg', 38),
(70, 'Luigi Mansion 2 - Dark Moon', 'GAME', 'NINTENDO', 'Luigi Mansion é um jogo de aventura e ação para o Nintendo GameCube, e também disponível em versões posteriores para outros consoles. No jogo, Luigi, o irmão de Mario, assume o papel de um caçador de fantasmas em uma mansão assombrada. Equipado com a potente Poltergust, um aspirador de fantasmas, Luigi deve capturar espíritos, resolver quebra-cabeças e enfrentar diversos desafios para resgatar Mario e explorar os mistérios da mansão. O jogo é conhecido por seu ambiente atmosférico e uma mistura ', 'mansao.png', 23);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_vendas`
--

CREATE TABLE `tb_vendas` (
  `ID` int(11) NOT NULL,
  `FK_ID_CLI` int(250) NOT NULL,
  `FK_ID_PROD` int(11) NOT NULL,
  `DATA` date NOT NULL,
  `COD_VENDA` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_vendas`
--

INSERT INTO `tb_vendas` (`ID`, `FK_ID_CLI`, `FK_ID_PROD`, `DATA`, `COD_VENDA`) VALUES
(1, 17, 1, '2024-08-01', 1),
(2, 20, 1, '2024-08-01', 2),
(3, 19, 1, '2024-08-01', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tb_clientes`
--
ALTER TABLE `tb_clientes`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `username` (`USERNAME`),
  ADD UNIQUE KEY `email` (`EMAIL`);

--
-- Índices de tabela `tb_produtos`
--
ALTER TABLE `tb_produtos`
  ADD PRIMARY KEY (`ID`);

--
-- Índices de tabela `tb_vendas`
--
ALTER TABLE `tb_vendas`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_ID_CLI` (`FK_ID_CLI`),
  ADD KEY `FK_ID_PROD` (`FK_ID_PROD`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_clientes`
--
ALTER TABLE `tb_clientes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `tb_produtos`
--
ALTER TABLE `tb_produtos`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de tabela `tb_vendas`
--
ALTER TABLE `tb_vendas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
