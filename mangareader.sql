-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 30-Jul-2022 às 16:06
-- Versão do servidor: 5.7.36
-- versão do PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
SET FOREIGN_KEY_CHECKS = 0;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `mangareader`
--

CREATE DATABASE IF NOT EXISTS `mangareader`
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `mangareader`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `artista`
--

DROP TABLE IF EXISTS `artista`;
CREATE TABLE IF NOT EXISTS `artista` (
  `id_art` int(11) NOT NULL AUTO_INCREMENT,
  `nome_artist` varchar(45) NOT NULL,
  `slug` varchar(80) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  PRIMARY KEY (`id_art`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `artista`
--

INSERT INTO `artista` (`id_art`, `nome_artist`, `slug`, `descricao`) VALUES
(1, 'Scan Manga Reader', 'scan-manga-reader', 'Grupo de exemplo para organizar os lançamentos do TCC.');

-- --------------------------------------------------------

--
-- Estrutura da tabela `artista_has_obras`
--

DROP TABLE IF EXISTS `artista_has_obras`;
CREATE TABLE IF NOT EXISTS `artista_has_obras` (
  `artista_id_art` int(11) NOT NULL,
  `obras_id_obra` int(11) NOT NULL,
  PRIMARY KEY (`artista_id_art`,`obras_id_obra`),
  KEY `fk_artista_has_obras_artista1_idx` (`artista_id_art`),
  KEY `fk_artista_has_obras_obras1_idx` (`obras_id_obra`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `genero`
--

DROP TABLE IF EXISTS `obra_genero`;
DROP TABLE IF EXISTS `genero`;
CREATE TABLE IF NOT EXISTS `genero` (
  `id_genero` int(11) NOT NULL AUTO_INCREMENT,
  `nome_genero` varchar(100) NOT NULL,
  `slug` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`id_genero`),
  KEY `idx_genero_nome` (`nome_genero`),
  KEY `idx_genero_slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `genero`
--

INSERT INTO `genero` (`nome_genero`, `slug`) VALUES
('+18', '18'),
('Absolute Cinema!!! 🙌', 'absolute-cinema'),
('Academia', 'academia'),
('Ação', 'acao'),
('Aconchegante', 'aconchegante'),
('action', 'action'),
('Adaptação', 'adaptacao'),
('Adult', 'adult'),
('Adultério', 'adulterio'),
('Adulto', 'adulto'),
('Adventure', 'adventure'),
('Agentes', 'agentes'),
('Alta Fantasia', 'alta-fantasia'),
('Amadurecimento', 'amadurecimento'),
('Animais', 'animais'),
('Anti-Herói', 'anti-heroi'),
('Apocalipse', 'apocalipse'),
('Apocalíptico', 'apocaliptico'),
('Arte Marcial', 'arte-marcial'),
('Artes Marciais', 'artes-marciais'),
('Aventura', 'aventura'),
('Bullying', 'bullying'),
('Colorido', 'colorido'),
('Com?dia', 'com-dia'),
('Comédia', 'comedia'),
('Construção', 'construcao'),
('Cotidiano', 'cotidiano'),
('Crime', 'crime'),
('Culinaria', 'culinaria'),
('Cultivação', 'cultivacao'),
('Cultivo', 'cultivo'),
('Dança', 'danca'),
('Deliquentes', 'deliquentes'),
('Dem?nios', 'dem-nios'),
('Demônio', 'demonio'),
('Demônios', 'demonios'),
('Demons', 'demons'),
('Drama', 'drama'),
('Dungeon', 'dungeon'),
('Ecchi', 'ecchi'),
('Escola', 'escola'),
('Escolar', 'escolar'),
('Escritório', 'escritorio'),
('Esporte', 'esporte'),
('Esportes', 'esportes'),
('Familia', 'familia'),
('Fantasia', 'fantasia'),
('Fantasia Sombria', 'fantasia-sombria'),
('Fatia da Vida/Slice of Life', 'fatia-da-vida-slice-of-life'),
('Fazenda', 'fazenda'),
('Ficção Científica', 'ficcao-cientifica'),
('Game Elements', 'game-elements'),
('Gore', 'gore'),
('Guerra', 'guerra'),
('Harém', 'harem'),
('Heterossexual', 'heterossexual'),
('Histórico', 'historico'),
('Horror', 'horror'),
('Isekai', 'isekai'),
('Jogo', 'jogo'),
('Jogos', 'jogos'),
('Josei', 'josei'),
('Linha do Tempo', 'linha-do-tempo'),
('Luta', 'luta'),
('Maduro', 'maduro'),
('máfia', 'mafia'),
('Magia', 'magia'),
('manhua', 'manhua'),
('Manhwa', 'manhwa'),
('martial arts', 'martial-arts'),
('Masmorra', 'masmorra'),
('Mecha', 'mecha'),
('Medieval', 'medieval'),
('Militar', 'militar'),
('Mist?rio', 'mist-rio'),
('Mistério', 'misterio'),
('Moderno', 'moderno'),
('Monstro', 'monstro'),
('Monstros', 'monstros'),
('Murim', 'murim'),
('Musculação', 'musculacao'),
('Necromante', 'necromante'),
('Novel', 'novel'),
('One-shot', 'one-shot'),
('Oneshot', 'oneshot'),
('Overpower', 'overpower'),
('overpowered', 'overpowered'),
('Pets', 'pets'),
('Psicológico', 'psicologico'),
('Psicopata', 'psicopata'),
('Realidade Virtual', 'realidade-virtual'),
('Reencarna??o', 'reencarna-o'),
('Reencarnação', 'reencarnacao'),
('Regressão', 'regressao'),
('regressão de idade', 'regressao-de-idade'),
('Regresso em Busca de Vingança', 'regresso-em-busca-de-vinganca'),
('Retorno', 'retorno'),
('revange', 'revange'),
('Revenge', 'revenge'),
('Revenge Quest', 'revenge-quest'),
('Romance', 'romance'),
('Romance Escolar', 'romance-escolar'),
('Seinen', 'seinen'),
('Shoujo', 'shoujo'),
('Shounen', 'shounen'),
('Shounen Ai', 'shounen-ai'),
('Sistema', 'sistema'),
('Sistema de Jogo', 'sistema-de-jogo'),
('Slice of Life', 'slice-of-life'),
('Sobrenatura', 'sobrenatura'),
('Sobrenatural', 'sobrenatural'),
('Sobrevivência', 'sobrevivencia'),
('Super Poderes', 'super-poderes'),
('SuperPoder', 'superpoder'),
('Suspense', 'suspense'),
('Tela de Sistema', 'tela-de-sistema'),
('Terror', 'terror'),
('teste', 'teste'),
('Thriller', 'thriller'),
('Time Manipulation', 'time-manipulation'),
('Tragédia', 'tragedia'),
('Tragédias', 'tragedias'),
('Transmigração', 'transmigracao'),
('Viagem no Tempo', 'viagem-no-tempo'),
('Vida escolar', 'vida-escolar'),
('Vingança', 'vinganca'),
('Violência', 'violencia'),
('Vizinhos', 'vizinhos'),
('Volta no Tempo', 'volta-no-tempo'),
('Zumbi', 'zumbi');

-- --------------------------------------------------------

--
-- Estrutura da tabela `obra_genero`
--

CREATE TABLE IF NOT EXISTS `obra_genero` (
  `obras_id_obra` int(11) NOT NULL,
  `genero_id_genero` int(11) NOT NULL,
  PRIMARY KEY (`obras_id_obra`,`genero_id_genero`),
  KEY `fk_obra_genero_genero_idx` (`genero_id_genero`),
  KEY `fk_obra_genero_obras_idx` (`obras_id_obra`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `capitulo`
--

DROP TABLE IF EXISTS `capitulo`;
DROP TABLE IF EXISTS `leitura_historico`;
CREATE TABLE IF NOT EXISTS `capitulo` (
  `id_cap` int(11) NOT NULL AUTO_INCREMENT,
  `titulo_cap` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `numero_cap` int(11) NOT NULL,
  `obras_id_obra` int(11) NOT NULL,
  `tipo` varchar(20) NOT NULL DEFAULT 'strip',
  `data_cadastro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_cap`),
  KEY `fk_capitulo_obras1_idx` (`obras_id_obra`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `capitulo`
--

INSERT INTO `capitulo` (`id_cap`, `titulo_cap`, `slug`, `numero_cap`, `obras_id_obra`, `tipo`) VALUES
(1, 'Capítulo de exemplo', 'solo-leveling-capitulo-1', 1, 1, 'strip');

-- --------------------------------------------------------

--
-- Estrutura da tabela `imagem_cap`
--

DROP TABLE IF EXISTS `imagem_cap`;
DROP TABLE IF EXISTS `favorito`;
CREATE TABLE IF NOT EXISTS `imagem_cap` (
  `id_img_cap` int(11) NOT NULL AUTO_INCREMENT,
  `caminho` varchar(255) NOT NULL,
  `capitulo_id_cap` int(11) NOT NULL,
  `ordem` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_img_cap`),
  KEY `fk_imagem_cap_capitulo_idx` (`capitulo_id_cap`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `imagem_cap`
--

INSERT INTO `imagem_cap` (`id_img_cap`, `caminho`, `capitulo_id_cap`, `ordem`) VALUES
(1, 'assets/images/caps/7-copiar.jpg', 1, 1),
(2, 'assets/images/caps/8-copiar.jpg', 1, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `favorito`
--

CREATE TABLE IF NOT EXISTS `favorito` (
  `id_favorito` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id_usuario` int(11) NOT NULL,
  `obras_id_obra` int(11) NOT NULL,
  `data_favorito` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_favorito`),
  UNIQUE KEY `uk_favorito_usuario_obra` (`usuario_id_usuario`,`obras_id_obra`),
  KEY `fk_favorito_usuario_idx` (`usuario_id_usuario`),
  KEY `fk_favorito_obras_idx` (`obras_id_obra`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `leitura_historico`
--

CREATE TABLE IF NOT EXISTS `leitura_historico` (
  `id_historico` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id_usuario` int(11) NOT NULL,
  `obras_id_obra` int(11) NOT NULL,
  `capitulo_id_cap` int(11) NOT NULL,
  `data_leitura` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_historico`),
  UNIQUE KEY `uk_leitura_usuario_capitulo` (`usuario_id_usuario`,`capitulo_id_cap`),
  KEY `fk_leitura_usuario_idx` (`usuario_id_usuario`),
  KEY `fk_leitura_obras_idx` (`obras_id_obra`),
  KEY `fk_leitura_capitulo_idx` (`capitulo_id_cap`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `obras`
--

DROP TABLE IF EXISTS `obras`;
CREATE TABLE IF NOT EXISTS `obras` (
  `id_obra` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) DEFAULT NULL,
  `titulo` varchar(255) NOT NULL,
  `titulo_alt` varchar(255) DEFAULT NULL,
  `autor` varchar(45) NOT NULL,
  `genero` varchar(255) DEFAULT NULL,
  `tipo` varchar(20) NOT NULL DEFAULT 'Manga',
  `ano_lanc` date NOT NULL,
  `status_obra` varchar(45) NOT NULL,
  `raw_status` int(11) NOT NULL DEFAULT 1,
  `scan_status` int(11) NOT NULL DEFAULT 1,
  `sinopse` text NOT NULL,
  `demografia` varchar(45) NOT NULL,
  `capa_obra` varchar(500) DEFAULT NULL,
  `pasta_obra` varchar(255) DEFAULT NULL,
  `data_cadastro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_obra`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `obras`
--

INSERT INTO `obras` (`id_obra`, `titulo`, `autor`, `ano_lanc`, `status_obra`, `sinopse`, `demografia`, `capa_obra`) VALUES
(2, 'Leveling With the Gods', 'Black Aijin', '2021-12-31', 'Em Lançamento', 'Deuses de outro mundo, os Deuses Externos.\r\n\r\n<Desespero que Alcança os Céus>, <Tristeza Presa no Pântano>, <Aquele que não Pôde Nascer>, <Caos Tolo>.\r\n\r\nPessoas normais perdiam suas vidas só de olhar para eles. Esses serem estavam destruindo o mundo… Depois de anos de lutas, os sobreviventes finais chegaram a uma conclusão.\r\n\r\n“Um Interno não pode derrotar um Externo.”\r\n\r\nNaquele momento, Cronos, um ser divino capaz de manipular o tempo, se sacrificou e girou os Mecanismos do Relógio.\r\n\r\n“Não temos como vencer. Por enquanto.”\r\n\r\n“Volte para uma linha do tempo antiga. E recomece.”\r\n\r\nA pessoa escolhida por todos os deuses para voltar ao passado. O último humano a escalar a Torre, mas que conseguiu lutar com os deuses até o fim – Kim Yuwon.\r\n\r\n“Um Interno não pode derrotar um Externo. Sendo assim…”\r\n\r\n“Ainda vencerei no final.”\r\n\r\nSerá que ele poderá recuperar os companheiros que lutaram juntos até o final para liderá-los a uma vitória contra os Deuses Externos?', 'Manhwa', 'assets/images/3be2d598443498d58940278609e4f8fb.jpg'),
(3, 'Doupo Cangqiong', 'Tian Can Tu Dou ', '2015-12-31', 'Em Lançamento', 'Em uma terra onde não há magia, uma terra onde os fortes fazem as leis e os fracos tem que obedecer, uma terra cheia de tesouros fascinantes e de uma beleza indescritível, mas que também está preenchida com perigos inimagináveis.\r\n\r\n Xiao Yan, que mostrou ter um talento nunca visto em décadas, de repente perdeu tudo há 3 anos – seus poderes, sua reputação e a promessa com sua mãe.\r\n\r\n O que o levou a perder todos os seus poderes? E por que a sua noiva de repente apareceu?!', 'Manhua', 'assets/images/57a8cfc48abb41c77cd95eb2717a11f3.jpg'),
(4, 'Omniscient Reader’s Viewpoint', 'Sing Shong', '2021-11-30', 'Em Lançamento', '“Esse é um desenrolar que eu já conheço”.\r\n\r\n No momento em que pensei isso, o mundo foi destruído e um novo universo surgiu.\r\n\r\n A nova vida de um leitor comum começa no mundo de uma novel, a novel que só ele terminou.', 'Manhwa', 'assets/images/eaf3f7ff18e63e900484e336d0e8de72.jpg'),
(1, 'Solo Leveling', 'Chugong', '2018-12-31', 'Finalizada', 'Dez anos atrás, depois do “Portal” que conecta o mundo real com um mundo de monstros se abriu, algumas pessoas comuns receberam o poder de caçar os monstros do portal. Eles são conhecidos como caçadores.\r\n\r\n Porém, nem todos os caçadores são fortes.\r\n\r\n Meu nome é Sung Jin-Woo, um caçador de rank E.\r\n\r\n Eu sou alguém que tem que arriscar a própria vida nas dungeons mais fracas, “O mais fraco do mundo”.\r\n\r\n Sem ter nenhuma habilidade à disposição, eu mal consigo dinheiro nas dungeons de baixo nível… Ao menos até eu encontrar uma dungeon escondida com a maior dificuldade dentro do Rank D! No fim, enquanto aceitava minha morte, eu ganhei um novo poder…', 'Manhwa', 'assets/images/c561c016ecaaa3f519f27b8cdf7ba971.jpg'),
(5, 'The Benning After the End ~ O começo Depois do Fim', 'Brandon Lee (TurtleMe)', '2019-12-31', 'Em Lançamento', 'Grey, um rei solitário, morre envenenado por seus inimigos. Contudo, ele renasce em um mundo com raças e habilidades que jamais antes vira.\r\n\r\n Agora sob o nome de Arthur, almeja ficar forte o bastante para não cometer os mesmos erros que cometera no passado e proteger aqueles que ama.', 'Manhwa', 'assets/images/capas/oc.jpg'),
(6, 'The Book Eating Magiciam', 'Bread Squirrel', '2021-07-31', 'Em Lançamento', 'Elric Melvinger.\r\n\r\nO único herdeiro da prestigiosa família mágica.\r\n\r\nEmbora possuísse talento inato, ele tinha muito talento e, como tal, não conseguia aprender magia. No entanto, ele então recebeu uma bênção deixada por seus ancestrais.\r\n\r\n[Coma demônios.]\r\n[Engula demônios.]\r\n[Beba demônios.]\r\n\r\n[Continue a acumular demônios dentro de você e alcance uma nova magia!]\r\n\r\nVoe alto.\r\n\r\nChegarei em um lugar tão alto que ninguém jamais me alcançará.', 'Manhwa', 'assets/images/capas/te.jpg'),
(7, 'Hunter Academy’s Battle God', 'Pond Man', '2022-01-31', 'Em Lançamento', 'Com uma Característica de rank F, tido como o pior dos piores, Shin Yu-sung de 5 anos foi abandonado pela família Shin-oh, famosa por criar caçadores.\r\n\r\nNo mesmo ano, ele conheceu um dos caçadores mais fortes, o Rei do Punho, no orfanato e foi adotado por ele.\r\n\r\nO Rei do Punho não se tornou o mais forte usando sua Característica ou habilidades – mas sim treinando seu corpo.\r\n\r\nEle foi atraído pelas capacidades físicas de Shin YuSung ao invés da Característica do garoto-\r\n\r\nNove caminhos yin bloqueados.\r\n“Seus caminhos bloqueados lhe dão uma superabundância de mana, uma mente excepcional e beleza divina! Mas você também morre antes de atingir a maioridade…”\r\n\r\nUma abundância de yang corporal.\r\n“Seu corpo está transbordando com a energia que pode curar seus nove caminhos yin bloqueados!”', 'Novel', 'assets/images/8e1d73a889ce932966e4b6bd4a673f24.jpg'),
(8, 'Sword Pilgrim', 'Nangseon', '2021-07-31', 'Em Lançamento', 'Callius von Jervain.\r\n\r\nUm personagem que morre, não importa o que faça. Um personagem que é forçado a uma rota de escolha onde só pode morrer, não importa suas escolhas até aquele momento. Contudo, há uma única rota onde o personagem pode viver e jogar o jogo.\r\n\r\nE preciso construir essa rota de algum jeito.\r\n\r\nPorque me tornei Callius von Jervain no jogo.', 'Novel', 'assets/images/capas/SwordPilgrimCapa.jpg'),
(10, 'Kaijuu 8-gou', 'Matsumoto Naoya', '2020-12-31', 'Em Lançamento', 'Um homem, descontente com o trabalho que teve na vida, está envolvido em um evento inesperado...! Ele se torna um Kaijuu, uma criatura monstruosa, dando-lhe uma nova chance de alcançar o que ele sempre sonhou!', 'Manga', 'assets/images/558b2404e26ed06a218071d97940deb6.jpg'),
(11, 'Black Clover', 'Tabata Yuuki', '2015-12-31', 'Em Lançamento', 'Em um mundo em que a magia reina, alguém com um poder tão limitado não é absolutamente nada! Este é Asta, um jovem que sonha em se tornar o \"Mago Imperador\", o maior de todos os magos.\r\n\r\n Com esforço e trabalho duro, será Asta capaz de alcançar seu sonho e corresponder às expectativas de seu amigo de infância, Yuno?', 'Manga', 'assets/images/ab538a87bc57f225968463a955c8dc17.jpg'),
(12, 'One Punch Man', 'ONE', '2018-12-31', 'Em Lançamento', 'A história segue o dia-a-dia de um herói normal que está infeliz por ser forte o bastante para derrotar todos os seus oponentes com apenas um soco, já que isso não lhe traz mais a sensação de adrenalina ao enfrentar um inimigo poderoso.', 'Manga', 'assets/images/f038b0254ed7b23977469a58af9e222d.jpg'),
(13, 'Boku no Hero Academia', 'Horikoshi Kouhei', '2017-12-31', 'Em Lançamento', 'A história situa-se nos dias atuais, exceto que indivíduos com super-poderes tornaram-se comuns por todo o mundo.\r\n\r\n Um garoto chamado Midoriya Izuku não possui poderes, mas continua a sonhar.', 'Manga', 'assets/images/f26202fd6577e849075db8cf0446e559.jpg'),
(14, 'Tale of Demons and Gods', 'Mad Snail', '2015-12-31', 'Em Lançamento', 'Nie Li, o mais poderoso Espiritualista Demoníaco e estando no topo do mundo marcial, perde sua vida durante a batalha com o Imperador Sábio e as seis bestas de nível divino, e sua alma volta ao passado para quando ele tinha 13 anos.\r\n\r\n Embora ele seja o mais fraco em sua classe, com o talento mais baixo no reino da alma Vermelho – o mais fraco dos reinos – com a ajuda de seu vasto conhecimento acumulado na sua vida passada, cresce mais rápido do que todos.\r\n\r\n Agora, ele irá tentar proteger a cidade que no futuro será invadida pelas bestas e que acabou sendo destruída, assim como sua amada, seus amigos e sua família que morreram pelo ataque das mesmas, e destruir a família Sagrada que abandonaram seus deveres e traíram a cidade em sua vida passada.', 'Manhua', 'assets/images/199f9cac126199bfea4ee1397aadc7cf.jpg'),
(15, 'Ragna Crimson', 'Kobayashi Daiki', '2018-12-31', 'Em Lançamento', 'Ragna é um caçador de dragões junto com sua parceira, a mais forte caçadora de dragões, Leo.\r\n\r\nEle não tinha muito talento para caçar dragões, mas decidiu confiar toda a sua vida a ela.\r\n\r\nNo entanto, foi mostrado a ele a sensação do verdadeiro desespero pelo seu próprio eu do futuro, sobre o que aconteceria se ele permanecesse fraco como ele é agora.\r\n\r\nCom isso, parece que o shinigami dos dragões apareceu mais cedo do que na história original, mas será isso o suficiente para mudar o futuro?', 'Manga', 'assets/images/4261731d514bc59bdc13f14e197e8861.jpg'),
(16, 'Kimetsu no Yaiba', 'Koyoharu Gotouge', '2017-12-31', 'Em Lançamento', 'O cenário é a era Taisho no Japão. Tanjiro é um rapaz de bom coração que vivia pacificamente com sua família como um vendedor de carvão.\r\n\r\nSua vida normal muda completamente quando sua família é morta por demônios. O único outro sobrevivente, sua irmã mais nova Tanjiro Nezuko, tornou-se um demônio feroz.\r\n\r\nPara retornar Nezuko ao normal e se vingar do demônio que matou sua família, os dois partem em uma viagem.\r\n\r\nDe um jovem talento, um conto de aventura de sangue e espadas começa!', 'Manga', 'assets/images/3e79a064125ba38777a05e225dcd3bc8.jpg'),
(17, 'Star Martial God Techniqu', 'Mad Snail', '2016-12-31', 'Em Lançamento', 'No mundo existem doze caminhos para subir a torre de Deus, e contam as lendas que estes doze caminhos levam a lendária estrada da imortalidade.\r\n\r\nNo entanto, esses caminhos da Torre de Deus, são exageradamente longo, sem fim.\r\n\r\nNos tempos antigos haviam muitos tipos de artes marciais mas infelizmente o mundo passou por mudanças horríveis e restaram apenas três: a arte marcial da Chama, do Dragão e da Estrela.\r\n\r\nAs Gerações de especialistas dessas três artes marciais estão a procura da estrada da imortalidade.\r\n\r\nPraticantes das Artes Marciais da Estrela, juntamente com a geração jovem, tentam durante toda sua vida encontrá-la para se tornar o Deus mais forte.', 'Manhua', 'assets/images/763d2a40048aa26d48ed101f2c0d8996.jpg'),
(18, 'Tomb Rider King', 'Redice Studio', '2019-12-31', 'Em Lançamento', 'Tumbas divinas começaram a surgir ao redor do mundo inteiro, por causa das relíquias contidas nas tumbas, muitas pessoas conseguiram esses poderes lendários.\r\n\r\nEntretanto, um ladrão de tumbas aparece com o propósito de roubar essas relíquias, o Tomb Raider King.\r\n\r\n \"O que vocês têm pertence a mim e o que eu tenho, definitivamente pertence a mim também.\" \r\n\r\nEssa é a história de um ladrão de tumbas que renasceu e que irá fazer tudo o que puder para ter todas as tumbas e relíquias sob seu poder.', 'Manhwa', 'assets/images/9e6d9ad03a55ef57543caac80e9d65f1.jpg'),
(19, 'Becoming the Villains Family', 'SOL Leesu', '2021-12-31', 'Em Lançamento', 'Sirens: o nome derivado de uma criatura antiga, usado para descrever aqueles que podem encantar, atrair, controlar e curar os outros cantando.\r\n\r\nSujeita a viver a vida de uma Siren, Aria experimentou, viu e ouviu coisas horríveis. Ferida demais para ser curada, Aria se resignou à morte, quando, de repente…\r\n\r\nO grão-duque, Lloyd Cardence Valentine, chegou e sussurrou: “Devo matar todos eles?”\r\n\r\n“Chame-me caso precise de mim. Sua canção pode chegar a qualquer lugar.”\r\n\r\nNo fim, Aria chamou o demônio, trazendo a morte a todos os presentes, incluindo ela.\r\n\r\n“Vamos para o inferno juntos.”\r\n\r\nE com isso, Aria deu seu último suspiro e morreu… Somente para retornar para os seus dez anos.\r\n\r\nAgora que ela tem uma segunda chance em sua vida, Aria está determinada a mudar seu destino, assim como o destino cruel de seu salvador, o grão-duque Valentine.\r\n\r\nEntão… Aria propôs a ele um contrato de casamento.\r\n\r\nEla vendeu sua alma para o demônio e jurou protegê-lo.\r\n\r\n[Case comigo.]\r\n\r\nAria estendeu a mão e deu-lhe o contrato.\r\n\r\n[Vamos nos divorciar em dez anos…]\r\n\r\nO jovem duque tirou o contrato de sua mão.\r\n\r\n“Então, onde devo carimbar o selo?”\r\n\r\n***\r\n\r\n“Você disse que se divorciaria de mim em dez anos.”\r\n\r\nO agora crescido grão-duque inclinou-se, beijando-a.\r\n\r\n“Agora que somos adultos, devemos assinar outro contrato.”', 'Manhwa', 'assets/images/6389e7f2184a93234bdbad1db2898a4d.png'),
(24, 'Magika no Kenshi to Bashireusu', 'Mihara Mitsuki', '2014-12-31', 'Em Lançamento', '15 anos antes da história em que se passa o mangá, o mundo descobriu a magia, assim como também seres que antes só existiam em lendas; em uma outra dimensão; a humanidade aprende a invocar estes seres mitológicos perigosos, e também a usar a força deles em troca de bons resultados. Sete países fizeram contratos com esses \"deuses\", conquistando assim, a confiança deles. Esses deuses escolherão seus invocadores quando eles fizerem 14 anos de idade, dando a eles um enigma. E como resultado, escolas foram fundadas para treinar invocadores de espadachins mágicos (que servirão como guarda-costas dos invocadores, para que possam invocar seus feitiços).', 'Mangá', 'assets/images/9e4533fb4c19107c9bfca7c6143409d1.jpg'),
(25, 'Douyara Boku no Hanayome wa Onna Kishidan na you de', 'Nori Itsurou', '2021-12-31', 'Em Lançamento', 'Aventuras de um cara que tem um harém cheio de cavaleiras mágicas! Ele será capaz de escolher a noiva perfeita para ele? Vamos descobrir!', 'Mangá', 'assets/images/b56bd1ff58a9673a2b98df51420407a1.jpg');

UPDATE `obras` SET `slug` = CONCAT('obra-', `id_obra`) WHERE `slug` IS NULL;
UPDATE `obras` SET `pasta_obra` = CONCAT('assets/images/obras/', `slug`) WHERE `pasta_obra` IS NULL;
INSERT IGNORE INTO `obra_genero` (`obras_id_obra`, `genero_id_genero`)
SELECT o.`id_obra`, g.`id_genero`
FROM `obras` o
INNER JOIN `genero` g ON LOWER(g.`nome_genero`) = LOWER(o.`demografia`);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `sts` varchar(1) NOT NULL,
  `permissao` varchar(1) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome`, `email`, `senha`, `sts`, `permissao`) VALUES
(3, 'Miguelsdsdsd', 'sadsd@fsdf', '1234', 'A', 'A'),
(2, 'miugel', 'miguel@miguel', '1234', 'A', 'A');

INSERT INTO `favorito` (`usuario_id_usuario`, `obras_id_obra`) VALUES
(2, 1),
(2, 2),
(2, 4);

INSERT INTO `leitura_historico` (`usuario_id_usuario`, `obras_id_obra`, `capitulo_id_cap`) VALUES
(2, 1, 1);
SET FOREIGN_KEY_CHECKS = 1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
