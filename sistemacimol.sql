-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 27-Maio-2019 às 12:21
-- Versão do servidor: 5.7.24
-- versão do PHP: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistemacimol`
--
CREATE DATABASE IF NOT EXISTS `sistemacimol` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `sistemacimol`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `administrador`
--

DROP TABLE IF EXISTS `administrador`;
CREATE TABLE IF NOT EXISTS `administrador` (
  `pessoa_id` int(10) UNSIGNED NOT NULL,
  `status` enum('ativo','inativo') NOT NULL DEFAULT 'ativo',
  PRIMARY KEY (`pessoa_id`),
  KEY `fk_administrador_pessoa1_idx` (`pessoa_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `administrador`
--

INSERT INTO `administrador` (`pessoa_id`, `status`) VALUES
(1, 'ativo'),
(4, 'ativo'),
(14, 'ativo'),
(124, 'ativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

DROP TABLE IF EXISTS `aluno`;
CREATE TABLE IF NOT EXISTS `aluno` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `status` enum('ativo','inativo') NOT NULL DEFAULT 'ativo',
  `pessoa_id` int(10) UNSIGNED NOT NULL,
  `situacao` enum('matriculado','transferido') NOT NULL DEFAULT 'matriculado',
  `id_mec` varchar(20) DEFAULT NULL,
  `periodo` enum('1','2','3','4','5','6') NOT NULL DEFAULT '1',
  `numero` int(11) DEFAULT NULL,
  `curso_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idaluno_UNIQUE` (`id`),
  KEY `fk_aluno_pessoa1_idx` (`pessoa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`id`, `status`, `pessoa_id`, `situacao`, `id_mec`, `periodo`, `numero`, `curso_id`) VALUES
(1, 'ativo', 16, 'matriculado', '114293614507', '1', NULL, NULL),
(2, 'ativo', 17, '', NULL, '1', NULL, NULL),
(3, 'ativo', 18, 'matriculado', NULL, '1', NULL, NULL),
(4, 'ativo', 19, '', NULL, '1', NULL, NULL),
(5, 'inativo', 24, '', NULL, '1', NULL, NULL),
(6, 'inativo', 25, '', NULL, '1', NULL, NULL),
(7, 'inativo', 26, '', NULL, '1', NULL, NULL),
(8, 'ativo', 27, '', NULL, '1', NULL, NULL),
(9, 'inativo', 28, '', NULL, '1', NULL, NULL),
(10, 'ativo', 29, '', NULL, '1', NULL, NULL),
(11, 'inativo', 30, '', NULL, '1', NULL, NULL),
(12, 'ativo', 31, '', NULL, '1', NULL, NULL),
(13, 'inativo', 32, '', NULL, '1', NULL, NULL),
(14, 'inativo', 33, '', NULL, '1', NULL, NULL),
(15, 'inativo', 34, '', NULL, '1', NULL, NULL),
(16, 'ativo', 35, '', NULL, '1', NULL, NULL),
(17, 'ativo', 77, 'matriculado', NULL, '1', NULL, NULL),
(18, 'ativo', 78, 'matriculado', NULL, '1', NULL, NULL),
(19, 'ativo', 79, 'matriculado', NULL, '1', NULL, NULL),
(20, 'ativo', 84, 'matriculado', NULL, '1', NULL, NULL),
(21, 'ativo', 85, 'matriculado', NULL, '1', NULL, NULL),
(22, 'ativo', 86, 'matriculado', NULL, '1', NULL, NULL),
(54, 'ativo', 124, 'matriculado', NULL, '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `armario`
--

DROP TABLE IF EXISTS `armario`;
CREATE TABLE IF NOT EXISTS `armario` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `numero` varchar(45) NOT NULL,
  `curso_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_armario_curso1_idx` (`curso_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `armario`
--

INSERT INTO `armario` (`id`, `numero`, `curso_id`) VALUES
(1, '1', 16);

-- --------------------------------------------------------

--
-- Estrutura da tabela `armario_aluno`
--

DROP TABLE IF EXISTS `armario_aluno`;
CREATE TABLE IF NOT EXISTS `armario_aluno` (
  `armario_id` int(10) UNSIGNED NOT NULL,
  `aluno_id` int(10) UNSIGNED NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  `data_entrega` date DEFAULT NULL,
  PRIMARY KEY (`armario_id`,`aluno_id`),
  KEY `fk_armario_has_aluno_aluno1_idx` (`aluno_id`),
  KEY `fk_armario_has_aluno_armario1_idx` (`armario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `armario_aluno`
--

INSERT INTO `armario_aluno` (`armario_id`, `aluno_id`, `data_inicio`, `data_fim`, `data_entrega`) VALUES
(1, 54, '2019-05-20', '2019-05-30', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `biblioteca`
--

DROP TABLE IF EXISTS `biblioteca`;
CREATE TABLE IF NOT EXISTS `biblioteca` (
  `pessoa_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`pessoa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `biblioteca`
--

INSERT INTO `biblioteca` (`pessoa_id`) VALUES
(1),
(2),
(3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `biblioteca_autor`
--

DROP TABLE IF EXISTS `biblioteca_autor`;
CREATE TABLE IF NOT EXISTS `biblioteca_autor` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `biblioteca_autor_obra`
--

DROP TABLE IF EXISTS `biblioteca_autor_obra`;
CREATE TABLE IF NOT EXISTS `biblioteca_autor_obra` (
  `autor_id` int(10) UNSIGNED NOT NULL,
  `Obra_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`autor_id`,`Obra_id`),
  KEY `fk_autor_has_Obra_Obra1_idx` (`Obra_id`),
  KEY `fk_autor_has_Obra_autor1_idx` (`autor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `biblioteca_categoria`
--

DROP TABLE IF EXISTS `biblioteca_categoria`;
CREATE TABLE IF NOT EXISTS `biblioteca_categoria` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `categoria_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_categoria_categoria_idx` (`categoria_id`)
) ENGINE=InnoDB DEFAULT CHARSET=ascii;

-- --------------------------------------------------------

--
-- Estrutura da tabela `biblioteca_editora`
--

DROP TABLE IF EXISTS `biblioteca_editora`;
CREATE TABLE IF NOT EXISTS `biblioteca_editora` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `biblioteca_emprestimo`
--

DROP TABLE IF EXISTS `biblioteca_emprestimo`;
CREATE TABLE IF NOT EXISTS `biblioteca_emprestimo` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `data_emprestimo` date NOT NULL,
  `data_prev_dev` date NOT NULL,
  `data_dev` date DEFAULT NULL,
  `num_renov` int(11) NOT NULL DEFAULT '0',
  `obra_id` int(10) UNSIGNED NOT NULL,
  `pessoa_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_emprestimo_obra1_idx` (`obra_id`),
  KEY `fk_biblioteca_emprestimo_pessoa1_idx` (`pessoa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `biblioteca_obra`
--

DROP TABLE IF EXISTS `biblioteca_obra`;
CREATE TABLE IF NOT EXISTS `biblioteca_obra` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `titulo` varchar(60) NOT NULL,
  `resumo` varchar(140) DEFAULT NULL,
  `edicao` decimal(10,0) DEFAULT NULL,
  `isbn` varchar(60) DEFAULT NULL,
  `categoria_id` int(10) UNSIGNED NOT NULL,
  `editora_id` int(10) UNSIGNED NOT NULL,
  `quantidade` int(11) NOT NULL,
  `locacao` tinyint(1) DEFAULT NULL,
  `formato` enum('fisico','eletronico') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_Obra_categoria1_idx` (`categoria_id`),
  KEY `fk_Obra_editora1_idx` (`editora_id`)
) ENGINE=InnoDB DEFAULT CHARSET=ucs2;

-- --------------------------------------------------------

--
-- Estrutura da tabela `biblioteca_obra_eletronica`
--

DROP TABLE IF EXISTS `biblioteca_obra_eletronica`;
CREATE TABLE IF NOT EXISTS `biblioteca_obra_eletronica` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `url_caminho` varchar(45) NOT NULL,
  `obra_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_biblioteca_obra_digiital_biblioteca_obra1_idx` (`obra_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `biblioteca_reserva`
--

DROP TABLE IF EXISTS `biblioteca_reserva`;
CREATE TABLE IF NOT EXISTS `biblioteca_reserva` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `data_reserv` date DEFAULT NULL,
  `obra_id` int(10) UNSIGNED NOT NULL,
  `pessoa_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_reserva_obra1_idx` (`obra_id`),
  KEY `fk_biblioteca_reserva_pessoa1_idx` (`pessoa_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `coordenador_curso`
--

DROP TABLE IF EXISTS `coordenador_curso`;
CREATE TABLE IF NOT EXISTS `coordenador_curso` (
  `professor_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `curso_id` int(10) UNSIGNED NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date DEFAULT NULL,
  `status` enum('ativo','inativo') NOT NULL DEFAULT 'ativo',
  `ip` varchar(20) NOT NULL,
  `usuario_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`professor_id`,`curso_id`),
  KEY `fk_professor_has_curso_curso1_idx` (`curso_id`),
  KEY `fk_professor_has_curso_professor1_idx` (`professor_id`),
  KEY `fk_coordenador_curso_1_idx` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `coordenador_curso`
--

INSERT INTO `coordenador_curso` (`professor_id`, `curso_id`, `data_inicio`, `data_fim`, `status`, `ip`, `usuario_id`) VALUES
(1, 16, '2015-11-25', NULL, 'ativo', '', 1),
(3, 10, '2017-05-31', NULL, 'ativo', '127.0.0.1', 1),
(5, 11, '2015-11-25', NULL, 'ativo', '', 1),
(5, 24, '2016-08-23', NULL, 'ativo', '127.0.0.1', 1),
(6, 12, '2015-11-25', NULL, 'ativo', '', 1),
(6, 19, '2016-07-25', NULL, 'ativo', '127.0.0.1', 1),
(6, 22, '2016-08-08', NULL, 'ativo', '127.0.0.1', 1),
(6, 23, '2016-08-08', NULL, 'ativo', '127.0.0.1', 1),
(7, 13, '2015-11-25', NULL, 'ativo', '', 1),
(8, 14, '2015-11-25', NULL, 'ativo', '', 1),
(11, 18, '2016-07-25', NULL, 'ativo', '127.0.0.1', 1),
(21, 15, '2015-11-25', NULL, 'ativo', '', 1),
(23, 25, '2017-06-13', NULL, 'ativo', '127.0.0.1', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

DROP TABLE IF EXISTS `curso`;
CREATE TABLE IF NOT EXISTS `curso` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) DEFAULT NULL,
  `descricao` text,
  `ip` varchar(20) NOT NULL,
  `usuario_id` int(10) UNSIGNED NOT NULL,
  `status` enum('ativo','inativo') NOT NULL DEFAULT 'inativo',
  `logo` varchar(90) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_curso_1_idx` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `curso`
--

INSERT INTO `curso` (`id`, `titulo`, `descricao`, `ip`, `usuario_id`, `status`, `logo`) VALUES
(10, 'Eletrônica', 'A Eletrônica  é editado uma das áreas que mais cresce no país.  O objetivo do Curso Técnico em Eletrônica é formar profissionais capacitados a realizar desde o desenvolvimento e implantação de projetos até a instalação e manutenção de equipamentos eletrônicos, microcomputadores e terminais de telecomunicação, bem como trabalhar com automação e programação.\\r\\nO Curso dispõe de laboratórios de informática e eletrônica, com instrumentos, como osciloscópios digitais, geradores de sinais, fontes; além de estrutura para a confecção de placas de circuitos eletrônicos. ', '127.0.0.1', 1, 'ativo', 'public/images/logo/01-05-2016_11-05-21.png'),
(11, 'Eletrotécnica', 'O Curso de Eletrotécnica visa fornecer ao educando acesso a instrumentos capazes de torna-los profissionais aptos para atuar elaborando projetos e executando instalações elétricas residenciais e industriais.\nNeste Curso o aluno estuda formas de trabalhar com motores, contatoras, cercas elétricas, instalação de equipamentos, CLP - para automação de processos e telecomunicação, com fio, sem fio e com centrais telefônicas analógicas, digitais e, infra-estrutura de redes.', '127.0.0.1', 1, 'ativo', 'public/images/logo/01-05-2016_11-05-42.png'),
(12, 'Móveis', 'O curso Técnico em Móveis visa proporcionar e a produtividade de manufaturas, incentivando a reengenharia, buscando melhorar a eficiência e a lucratividade nos negócios, qualificando equipes de trabalho e capacitando-as a atuar na instalação, produção e manutenção fabril.<br/>\nNesta curso o aluno estuda formas de executar móveis e ambiente planejados utilizando materiais tendências no mercado de trabalho.', '177.203.74.149', 3, 'ativo', 'public/images/logo/01-05-2016_11-06-09.png'),
(13, 'Mecânica', 'O objetivo do Curso de Mecânica é a especialização do educando na área da tecnologia industrial mecânica, proporcionando  e ela a capacitação através da interpretação, avaliação, coordenação e controle de parâmetros de medidas, projetos de dispositivos, máquinas e equipamentos, com o uso de instrumental de oficina e laboratório de qualidade. O CIMOL possui, além de diversos tornos frezza, torno CNC, com a mesma tecnologia que é encontrada no mercado de trabalho.  Também possui oficinas de usinagem e solda, proporcionando o ambiente propício para a preparação do aluno.', '189.72.37.157', 3, 'ativo', 'public/images/logo/01-05-2016_09-43-09.png'),
(14, 'Design de Móveis', 'Neste curso o aluno aprende a projetar móveis e ambientes internos com inovação estética, funcional e tecnológica, considerando aspectos relativos a tendências mundiais e à conservação ambiental.', '127.0.0.1', 1, 'ativo', 'public/images/logo/01-05-2016_09-43-25.png'),
(15, 'Química', 'O Técnico em Química está apto a atuar no planejamento, coordenação, operação e controle dos processos industriais e equipamentos nos processos produtivos.  Pode ainda planejar e coordenar processos laboratoriais, realizar amostragens, análises químicas, físico-químicas e microbiológicas.<br/>\r\nO profissional Técnico em Química pode realizar vendas e assistência técnica na aplicação de equipamentos e produtos químicos e participar do no desenvolvimento de produtos e na validação de métodos.', '127.0.0.1', 1, 'ativo', 'public/images/logo/01-05-2016_09-43-42.png'),
(16, 'Informática', ' O Curso Técnico em Informática capacita o aluno para o planejamento  e execução dos processos de manutenção de computadores e para operação de redes locais de computadores. Capacita também para o desenvolvimento de aplicativos computacionais, adotando normas técnicas.  Desenvolve-se ainda o trabalho em equipe, e as relações interpessoais construtivas, para que haja a compreensão do contexto em que está inserido, desenvolvendo capacidade propositiva e criativa. ', '127.0.0.1', 1, 'ativo', 'public/images/logo/01-05-2016_09-43-59.png'),
(17, 'Meio Ambiente', 'O profissional da área de meio ambiente tem como objetivo produzir mais usando menos, reduzindo a emissão de gases e a produção de resíduos. Como todas as indústrias devem ter um plano de gestão ambiental, precisam de pessoal especializado, e isso torna o campo de trabalho nesta área bastante grande e promissor. O profissional também pode atar no poder público, em secretarias e órgãos municipais, estaduais ou federais, que fiscalizam e desenvolvem programas de prevenção e educação ambiental, encontrando soluções sustentáveis. Aqui no Cimol, os alunos do Curso de Meio Ambiente realizam diversas visitas técnicas,para que possam estudar, analisar e catalogar minérios, vegetais e várias outras amostras coletadas.', '189.72.37.157', 3, 'ativo', 'public/images/logo/01-05-2016_09-50-54.png'),
(18, 'tESTE TES', 'NVK\\SKLDVAKS', '127.0.0.1', 1, 'inativo', 'public/images/logo/07-25-2016_13-41-03.jpg'),
(19, 'Testekshgksjfgk', 'svhklasdkfvasjg', '127.0.0.1', 1, 'inativo', 'public/images/logo/07-25-2016_14-11-53.jpg'),
(20, 'Curso teste', 'Descrição curso teste', '127.0.0.1', 1, 'inativo', 'public/images/logo/08-08-2016_11-19-34.jpg'),
(21, 'Curso teste', 'Descrição curso teste', '127.0.0.1', 1, 'inativo', 'public/images/logo/08-08-2016_11-19-34.jpg'),
(22, 'Curso teste', 'Descrição curso teste', '127.0.0.1', 1, 'inativo', 'public/images/logo/08-08-2016_11-19-34.jpg'),
(23, 'Curso teste', 'Descrição curso teste', '127.0.0.1', 1, 'inativo', 'public/images/logo/08-08-2016_11-19-34.jpg'),
(24, 'Curso de teste', 'sçgmal fgl fakdl falçj adflçjgd', '127.0.0.1', 1, 'inativo', 'public/images/logo/08-23-2016_10-09-38.jpg'),
(25, 'fghgksdfjgçPPP', 'fjgçdzfjgzçdfjgsdklg', '127.0.0.1', 1, 'inativo', 'public/images/logo/06-13-2017_09-59-39.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `email`
--

DROP TABLE IF EXISTS `email`;
CREATE TABLE IF NOT EXISTS `email` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(45) NOT NULL,
  `pessoa_id` int(10) UNSIGNED NOT NULL,
  `ip` varchar(20) NOT NULL,
  `hash_validar` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_table1_pessoa1_idx` (`pessoa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `email`
--

INSERT INTO `email` (`id`, `email`, `pessoa_id`, `ip`, `hash_validar`) VALUES
(2, 'jady98muller@gmail.com', 2, '', NULL),
(5, 'brunaroberta.azevedo@gmail.com', 24, '', NULL),
(16, 'brenda@gmail.com', 35, '', NULL),
(17, 'gwagner@gmail.com', 31, '', NULL),
(21, 'erai@faccat.br', 36, '', NULL),
(30, 'tiago.ulrich@gmail.com', 46, '', NULL),
(31, 'evaldo@hotmail.com', 47, '', NULL),
(56, 'luziaespinossa@gmail.com', 72, '', NULL),
(64, 'cdcfarias@gmail.com', 1, '', NULL),
(65, 'cdsfdgkls@gmail.com', 80, '', NULL),
(66, 'cdsfdgkls@gmail.com', 81, '', NULL),
(67, 'cdsfasgf@gmail.com', 82, '', NULL),
(68, 'cdsfasgf@gmail.com', 83, '', NULL),
(71, 'messssias@hotmail.com', 86, '', NULL),
(72, 'cdsfasgf@gmail.com', 87, '', NULL),
(73, 'richardfogaca.rf@gmail.com', 14, '', NULL),
(80, 'eduardohenriquepisoni@gmail.com', 124, 'xxx-xxx', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

DROP TABLE IF EXISTS `endereco`;
CREATE TABLE IF NOT EXISTS `endereco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logradouro` varchar(60) DEFAULT NULL,
  `tipo` enum('av','rua','rod','beco','alam','serv') DEFAULT NULL,
  `numero` varchar(20) DEFAULT NULL,
  `complemento` varchar(60) DEFAULT NULL,
  `bairro` varchar(60) DEFAULT NULL,
  `pessoa_id` int(10) UNSIGNED NOT NULL,
  `ip` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_endereco_pessoa1_idx` (`pessoa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`id`, `logradouro`, `tipo`, `numero`, `complemento`, `bairro`, `pessoa_id`, `ip`) VALUES
(1, 'Bento Gonçalves', 'rua', '2807', 'Ap202', 'Centro', 1, ''),
(3, 'Coronel Diniz', 'rua', '502', 'casa', 'petropolis', 124, 'xxx-xxx');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcao`
--

DROP TABLE IF EXISTS `funcao`;
CREATE TABLE IF NOT EXISTS `funcao` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `funcao` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `funcao`
--

INSERT INTO `funcao` (`id`, `funcao`) VALUES
(1, 'Servente'),
(2, 'Secretaria'),
(3, 'Monitor'),
(4, 'Biblioteca');

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissao`
--

DROP TABLE IF EXISTS `permissao`;
CREATE TABLE IF NOT EXISTS `permissao` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `permissao` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `permissao_UNIQUE` (`permissao`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `permissao`
--

INSERT INTO `permissao` (`id`, `permissao`) VALUES
(4, 'agenda'),
(5, 'aluno'),
(3, 'evento'),
(2, 'noticia'),
(6, 'professor'),
(1, 'total');

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissao_admin`
--

DROP TABLE IF EXISTS `permissao_admin`;
CREATE TABLE IF NOT EXISTS `permissao_admin` (
  `admin_id` int(11) NOT NULL,
  `permissao_id` varchar(45) NOT NULL,
  PRIMARY KEY (`admin_id`,`permissao_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `permissao_admin`
--

INSERT INTO `permissao_admin` (`admin_id`, `permissao_id`) VALUES
(1, '1'),
(4, '2'),
(4, '3'),
(14, '2'),
(14, '3'),
(124, '2'),
(124, '3');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

DROP TABLE IF EXISTS `pessoa`;
CREATE TABLE IF NOT EXISTS `pessoa` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  `rg` varchar(20) DEFAULT NULL,
  `cpf` varchar(15) DEFAULT NULL,
  `ip` varchar(20) NOT NULL,
  `status` enum('ativo','inativo') NOT NULL,
  `foto` varchar(90) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pessoa`
--

INSERT INTO `pessoa` (`id`, `nome`, `rg`, `cpf`, `ip`, `status`, `foto`) VALUES
(1, 'Cândido Luciano de Faria', '1053174817', 'undefined', '', 'ativo', 'public/images/logo/10-12-2016_15-17-04.jpg'),
(2, 'Jady Beatriz Müller', 'undefined', 'undefined', '', 'ativo', NULL),
(3, 'Bruna Roberta de Azevedo', '', '', '', 'ativo', NULL),
(4, 'Priscila Fabiane Kasper', 'null', 'null', '', 'ativo', 'public/images/logo/10-13-2016_16-48-20.jpg'),
(6, 'Marlon Lazzaretti', 'null', 'null', '', 'ativo', NULL),
(7, 'Marlon Lazzaretti', NULL, NULL, '', 'ativo', 'public/images/logo/10-12-2016_15-19-12.jpg'),
(8, ' Marcos E. Frozza', NULL, NULL, '', 'ativo', NULL),
(9, 'Juçana Candemil', NULL, NULL, '', 'ativo', NULL),
(11, 'Tiago Espinosa de Oliveira', NULL, NULL, '', 'ativo', NULL),
(12, 'Cimol', '999999', '9999999', '', 'ativo', NULL),
(14, 'Richard Fogaça', NULL, NULL, '', 'ativo', NULL),
(15, 'Gerson Carneiro de Souza', NULL, NULL, '', 'ativo', NULL),
(16, 'Aline Correia', 'undefined', 'undefined', '', 'ativo', 'public/images/logo/10-12-2016_14-56-06.jpg'),
(17, 'Ana Carolina Magalhães dos Santos', 'undefined', 'undefined', '', 'ativo', 'public/images/logo/10-12-2016_14-56-49.jpg'),
(18, 'Angelo Gabriel de Quadros Villas Boas', 'undefined', 'undefined', '', 'ativo', 'public/images/logo/10-12-2016_14-58-09.jpg'),
(19, 'Augusto de Souza Corrêa', 'undefined', 'undefined', '', 'ativo', 'public/images/logo/10-12-2016_14-59-14.jpg'),
(20, 'Brenda Filmann', NULL, NULL, '', 'ativo', NULL),
(21, 'Bruno Finimundi Port', NULL, NULL, '', 'ativo', NULL),
(22, 'Cátia Elizabete Nunes Silveira', NULL, NULL, '', 'ativo', NULL),
(23, 'Daiana da Silva Hahn', NULL, NULL, '', 'ativo', NULL),
(24, 'Karmem  Lúcia da Silva', '2153689745', '123.987.456-58', '', 'ativo', ''),
(25, 'Karmem  Lúcia da Silva', '2153689745', '123.987.456-58', '', 'ativo', ''),
(26, 'Karmem  Lúcia da Silva', '2153689745', '123.987.456-58', '', 'ativo', ''),
(27, 'Filomena Correia', 'undefined', 'undefined', '', 'ativo', 'public/images/logo/10-12-2016_14-59-57.jpg'),
(28, 'Jonas Aires', 'undefined', 'undefined', '', 'ativo', 'public/images/logo/10-12-2016_11-45-11.jpg'),
(29, 'Karmem  Lúcia da Silva', 'undefined', 'undefined', '', 'ativo', 'public/images/logo/10-12-2016_12-31-57.jpg'),
(30, 'Jonas Aires', 'undefined', 'undefined', '', 'ativo', 'public/images/logo/10-12-2016_11-43-50.jpg'),
(31, 'Gabriel Henrique Wagner', '7895641258', '753.159.741-96', '', 'ativo', 'public/images/logo/10-12-2016_12-32-52.jpg'),
(32, 'Jonas Aires', 'undefined', 'undefined', '', 'ativo', 'public/images/logo/10-12-2016_11-45-11.jpg'),
(33, 'Jonas Aires', 'undefined', 'undefined', '', 'ativo', 'public/images/logo/10-12-2016_11-45-11.jpg'),
(34, 'Jonas Aires', 'undefined', 'undefined', '', 'ativo', 'public/images/logo/10-12-2016_11-45-11.jpg'),
(35, 'Brenda Galas do Amaral', '2578965485', '895.876.652-98', '', 'ativo', 'public/images/logo/10-12-2016_12-34-31.jpg'),
(36, 'Erai de Souza Jr', '159863247', '426.684.842-65', '', 'ativo', 'public/images/logo/10-13-2016_15-59-40.jpg'),
(37, 'Almerinda de Souza', 'null', 'null', '', 'ativo', 'public/images/logo/10-13-2016_16-20-57.jpg'),
(38, 'Odete Roitmann', 'null', 'null', '', 'ativo', 'public/images/logo/10-13-2016_16-31-42.jpg'),
(39, 'Eleninha Vergara', 'null', 'null', '', 'ativo', 'public/images/logo/10-13-2016_16-34-43.jpg'),
(40, 'Priscila Fabiane Kasperr', 'null', 'null', '', 'ativo', NULL),
(41, 'Priscila Fabiane Kasperr', 'null', 'null', '', 'ativo', 'public/images/logo/10-13-2016_16-40-06.jpg'),
(42, 'Priscila Fabiane Kasperr', 'null', 'null', '', 'ativo', NULL),
(43, 'Priscila Fabiane Kasper', 'null', 'null', '', 'ativo', NULL),
(44, 'Afroncio de Albuquerque', '1585963247', '154.563.254-85', '', 'ativo', 'public/images/logo/10-13-2016_17-10-56.jpg'),
(45, 'Maria Leonora  de Poli Bersano', '', '', '', 'ativo', NULL),
(46, 'Tiago Urich', '00000000', '00000000000', '', 'ativo', 'public/images/logo/12-10-2016_10-04-11.jpg'),
(47, 'Luís Evaldo', '00000000', '00000000000', '', 'ativo', ''),
(48, 'Gustavo Lauck', '00000000', '00000000000', '', 'ativo', ''),
(49, 'Cassiano Kaiser', '00000000', '00000000000', '', 'ativo', ''),
(50, 'Paulo Mossmann', '00000000', '00000000000', '', 'ativo', ''),
(51, 'Camila Martins', '00000000', '00000000000', '', 'ativo', ''),
(52, 'Carina Souza', '00000000', '00000000000', '', 'ativo', ''),
(53, 'Fabiana Thiel', '00000000', '00000000000', '', 'ativo', ''),
(54, 'Ana Paula', '00000000', '00000000000', '', 'ativo', ''),
(55, 'Fabiano Hollweg', '00000000', '00000000000', '', 'ativo', ''),
(56, 'Vivian', '00000000', '00000000000', '', 'ativo', ''),
(57, 'Maicon Bandeira', '00000000', '00000000000', '', 'ativo', ''),
(58, 'Marcuse Guazina', '00000000', '00000000000', '', 'ativo', 'public/images/logo/'),
(59, 'Jeane', '00000000', '00000000000', '', 'ativo', 'public/images/logo/'),
(60, 'Tiago Mossmann', '00000000', '00000000000', '', 'ativo', 'public/images/logo/'),
(61, 'Alexandre', '00000000', '00000000000', '', 'ativo', ''),
(62, 'Rory Mikalauscas', '00000000', '00000000000', '', 'ativo', ''),
(63, 'Márcia Cattani Moura', '00000000', '00000000000', '', 'ativo', ''),
(64, 'Gislaine dos Reis', '00000000', '00000000000', '', 'ativo', ''),
(65, 'Ariel Espinosa', '00000000', '00000000000', '', 'ativo', ''),
(66, 'Kamila ', '00000000', '00000000000', '', 'ativo', ''),
(67, 'Guilherme Lauck', '00000000', '00000000000', '', 'ativo', ''),
(68, 'Simone', '00000000', '00000000000', '', 'ativo', ''),
(69, 'Virgínia', '00000000', '00000000000', '', 'ativo', ''),
(70, 'Aline', '00000000', '00000000000', '', 'ativo', ''),
(71, 'Magda Kontz', '00000000', '00000000000', '', 'ativo', ''),
(72, 'Maria Luzia Espinossa', '00000000000', '00000000000', '', 'ativo', ''),
(73, 'hdfhdfh', '123', '123', '', 'ativo', ''),
(74, 'hdfghdg', '54', '5454', '', 'ativo', ''),
(75, 'zdjgoçaglk', '14654', '3132', '', 'ativo', ''),
(76, 'Rhdgfkjskldg sdfgsd', '456', '456', '', 'ativo', ''),
(77, 'Aluno teste', '5546464', '31', '', 'ativo', ''),
(78, 'Aluno teste', '5546464', '3123', '', 'ativo', ''),
(79, 'Aluno teste', '3523', '53245', '', 'ativo', 'public/images/logo/05-18-2017_19-50-11.jpg'),
(80, 'sfkhfskhksfdçksfd', '00', '00', '', 'ativo', ''),
(81, 'sfkhfskhksfdçksfd', '00', '00', '', 'ativo', ''),
(82, 'fdjgçlsdfg', '445', '154', '', 'ativo', ''),
(83, 'gsgsdfgsd', '43', '34', '', 'ativo', ''),
(84, 'Marcia Fischer', '00', '00', '', 'ativo', ''),
(85, 'Marcia Fischer', '00', '00', '', 'ativo', ''),
(86, 'Regis da silva Souza', '00', '00', '', 'ativo', ''),
(87, 'cb zxbzvcb', '00', '00', '', 'ativo', 'public/images/logo/06-18-2017_11-10-47.png'),
(124, 'Eduardo Pisoni', '3656365965', '1232907', 'xxx-xxx', 'ativo', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor`
--

DROP TABLE IF EXISTS `professor`;
CREATE TABLE IF NOT EXISTS `professor` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `carga_horaria` int(11) DEFAULT NULL,
  `pessoa_id` int(10) UNSIGNED NOT NULL,
  `ip` varchar(20) NOT NULL,
  `status` enum('ativo','inativo') NOT NULL DEFAULT 'ativo',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_professor_pessoa1_idx` (`pessoa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `professor`
--

INSERT INTO `professor` (`id`, `carga_horaria`, `pessoa_id`, `ip`, `status`) VALUES
(1, 60, 1, '', 'ativo'),
(3, 60, 4, '', 'ativo'),
(5, 200, 6, '', 'inativo'),
(6, 200, 7, '', 'ativo'),
(7, 200, 8, '', 'ativo'),
(8, 200, 9, '', 'ativo'),
(11, 200, 11, '', 'ativo'),
(12, 40, 36, '', 'ativo'),
(13, 60, 37, '', 'ativo'),
(14, 200, 38, '', 'ativo'),
(15, 60, 39, '', 'ativo'),
(16, 60, 40, '', 'inativo'),
(17, 60, 41, '', 'inativo'),
(18, 60, 42, '', 'inativo'),
(19, 200, 43, '', 'inativo'),
(20, 20, 44, '', 'ativo'),
(21, 40, 45, '', 'ativo'),
(22, 40, 46, '', 'ativo'),
(23, 40, 47, '', 'ativo'),
(24, 80, 48, '', 'ativo'),
(25, 40, 49, '', 'ativo'),
(26, 80, 50, '', 'ativo'),
(27, 40, 51, '', 'ativo'),
(28, 120, 52, '', 'ativo'),
(29, 80, 53, '', 'ativo'),
(30, 160, 54, '', 'ativo'),
(31, 40, 55, '', 'ativo'),
(32, 40, 56, '', 'ativo'),
(33, 40, 57, '', 'ativo'),
(34, 40, 58, '', 'ativo'),
(35, 60, 59, '', 'ativo'),
(36, 40, 60, '', 'ativo'),
(37, 200, 61, '', 'ativo'),
(38, 200, 62, '', 'ativo'),
(39, 80, 63, '', 'ativo'),
(40, 40, 64, '', 'ativo'),
(41, 200, 65, '', 'ativo'),
(42, 200, 66, '', 'inativo'),
(43, 60, 67, '', 'ativo'),
(44, 40, 68, '', 'ativo'),
(45, 200, 69, '', 'ativo'),
(46, 60, 70, '', 'ativo'),
(47, 40, 71, '', 'ativo'),
(48, 40, 72, '', 'ativo'),
(49, 52, 73, '', 'inativo'),
(50, 45, 74, '', 'inativo'),
(51, 52, 75, '', 'inativo'),
(52, 36, 76, '', 'inativo'),
(53, 45, 82, '', 'inativo'),
(54, 45, 83, '', 'ativo'),
(55, 20, 87, '', 'inativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `servidor`
--

DROP TABLE IF EXISTS `servidor`;
CREATE TABLE IF NOT EXISTS `servidor` (
  `funcao_id` int(100) NOT NULL,
  `pessoa_id` int(100) NOT NULL,
  PRIMARY KEY (`funcao_id`,`pessoa_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `servidor`
--

INSERT INTO `servidor` (`funcao_id`, `pessoa_id`) VALUES
(1, 124),
(2, 3),
(3, 124);

-- --------------------------------------------------------

--
-- Estrutura da tabela `serv_chamado`
--

DROP TABLE IF EXISTS `serv_chamado`;
CREATE TABLE IF NOT EXISTS `serv_chamado` (
  `id_equipamento` int(11) DEFAULT NULL,
  `data_abertura` date NOT NULL,
  `data_atendimento` date DEFAULT NULL,
  `data_solucao` date DEFAULT NULL,
  `defeito` varchar(255) NOT NULL,
  `solucao` varchar(255) DEFAULT NULL,
  `status` enum('Pendente','Aguardando peça','Aguardando orçamento','Finalizado') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `serv_chamado`
--

INSERT INTO `serv_chamado` (`id_equipamento`, `data_abertura`, `data_atendimento`, `data_solucao`, `defeito`, `solucao`, `status`) VALUES
(1, '2019-05-27', NULL, NULL, 'bug', 'debugar o bug', 'Pendente'),
(1, '2019-05-27', NULL, NULL, 'bug', 'debugar o bug', 'Pendente');

-- --------------------------------------------------------

--
-- Estrutura da tabela `serv_equipamento`
--

DROP TABLE IF EXISTS `serv_equipamento`;
CREATE TABLE IF NOT EXISTS `serv_equipamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(50) DEFAULT NULL,
  `num_serie` varchar(50) DEFAULT NULL,
  `nome` varchar(50) NOT NULL,
  `local_id` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `serv_equipamento`
--

INSERT INTO `serv_equipamento` (`id`, `codigo`, `num_serie`, `nome`, `local_id`) VALUES
(1, '21351', '2528656223', 'equipamentoTeste', '8'),
(2, '21351', '2528656223', 'equipamentoTeste', '8');

-- --------------------------------------------------------

--
-- Estrutura da tabela `serv_item_patrimonio`
--

DROP TABLE IF EXISTS `serv_item_patrimonio`;
CREATE TABLE IF NOT EXISTS `serv_item_patrimonio` (
  `id_item` int(11) NOT NULL AUTO_INCREMENT,
  `numero_serie` varchar(45) NOT NULL,
  `codigo` varchar(45) NOT NULL,
  `serv_patrimonio_id_patrimonio` int(11) NOT NULL,
  `serv_local_id` int(11) NOT NULL,
  PRIMARY KEY (`id_item`),
  KEY `fk_serv_item_patrimonio_serv_patrimonio1_idx` (`serv_patrimonio_id_patrimonio`),
  KEY `fk_serv_item_patrimonio_serv_local1_idx` (`serv_local_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `serv_item_patrimonio`
--

INSERT INTO `serv_item_patrimonio` (`id_item`, `numero_serie`, `codigo`, `serv_patrimonio_id_patrimonio`, `serv_local_id`) VALUES
(33, '88889888', 'info001', 19, 31),
(35, '5646548941', 'info002', 21, 33),
(36, '5166516165151', 'eletro0002', 22, 34);

-- --------------------------------------------------------

--
-- Estrutura da tabela `serv_local`
--

DROP TABLE IF EXISTS `serv_local`;
CREATE TABLE IF NOT EXISTS `serv_local` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `serv_local`
--

INSERT INTO `serv_local` (`id`, `descricao`) VALUES
(29, 'coordenacao Informática'),
(30, 'coordenacao Informática'),
(31, 'coordenacao Informática'),
(32, 'coordenacao'),
(33, 'Sala Coordenação Informática'),
(34, 'sala c303');

-- --------------------------------------------------------

--
-- Estrutura da tabela `serv_movimento`
--

DROP TABLE IF EXISTS `serv_movimento`;
CREATE TABLE IF NOT EXISTS `serv_movimento` (
  `id_movimento` int(11) NOT NULL AUTO_INCREMENT,
  `data_movimento` date DEFAULT NULL,
  `descricao` varchar(80) NOT NULL,
  `serv_item_patrimonio_id_item` int(11) NOT NULL,
  PRIMARY KEY (`id_movimento`),
  KEY `fk_serv_movimento_serv_item_patrimonio1_idx` (`serv_item_patrimonio_id_item`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `serv_movimento`
--

INSERT INTO `serv_movimento` (`id_movimento`, `data_movimento`, `descricao`, `serv_item_patrimonio_id_item`) VALUES
(18, '2019-03-30', '3', 33),
(20, '2019-03-30', '3', 35),
(21, '2019-04-02', '3', 36);

-- --------------------------------------------------------

--
-- Estrutura da tabela `serv_patrimonio`
--

DROP TABLE IF EXISTS `serv_patrimonio`;
CREATE TABLE IF NOT EXISTS `serv_patrimonio` (
  `id_patrimonio` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id_patrimonio`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `serv_patrimonio`
--

INSERT INTO `serv_patrimonio` (`id_patrimonio`, `nome`) VALUES
(19, 'Estabilizador 1500w'),
(21, 'Impressora'),
(22, 'alicate osciloscopio');

-- --------------------------------------------------------

--
-- Estrutura da tabela `telefone`
--

DROP TABLE IF EXISTS `telefone`;
CREATE TABLE IF NOT EXISTS `telefone` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ddd` varchar(45) NOT NULL,
  `numero` varchar(45) NOT NULL,
  `tipo` enum('res','com','cel') NOT NULL DEFAULT 'cel',
  `pessoa_id` int(10) UNSIGNED NOT NULL,
  `ip` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_telefone_pessoa1_idx` (`pessoa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `telefone`
--

INSERT INTO `telefone` (`id`, `ddd`, `numero`, `tipo`, `pessoa_id`, `ip`) VALUES
(5, '51', '98456211', '', 24, ''),
(6, '51', '98456211', '', 25, ''),
(7, '51', '98456211', '', 26, ''),
(13, '', '', '', 33, ''),
(14, '', '', '', 34, ''),
(15, '51', '98456211', '', 29, ''),
(16, '51', '99887766', '', 31, ''),
(17, '51', '98526314', '', 27, ''),
(21, '51', '9988 2211', '', 36, ''),
(25, '', '', '', 40, ''),
(26, '', '', '', 41, ''),
(27, '', '', '', 42, ''),
(28, '', '', '', 43, ''),
(29, '', '', '', 44, ''),
(30, '51', '982760231', '', 46, ''),
(31, '51', '000000000', '', 47, ''),
(32, '', '', '', 48, ''),
(33, '', '', '', 49, ''),
(34, '', '', '', 50, ''),
(35, '', '', '', 51, ''),
(36, '', '', '', 52, ''),
(37, '', '', '', 53, ''),
(38, '', '', '', 54, ''),
(39, '', '', '', 55, ''),
(40, '', '', '', 56, ''),
(41, '', '', '', 57, ''),
(42, '', '', '', 58, ''),
(43, '', '', '', 59, ''),
(44, '', '', '', 60, ''),
(45, '', '', '', 61, ''),
(46, '', '', '', 62, ''),
(47, '', '', '', 63, ''),
(49, '', '', '', 65, ''),
(50, '', '', '', 66, ''),
(51, '', '', '', 67, ''),
(52, '', '', '', 68, ''),
(53, '', '', '', 69, ''),
(54, '', '', '', 70, ''),
(55, '', '', '', 71, ''),
(56, '', '', '', 72, ''),
(57, '51', '99874551', '', 73, ''),
(58, '51', '465465465', '', 74, ''),
(59, '51', '15165', '', 75, ''),
(60, '51', '987456', '', 76, ''),
(61, '51', '997143142', '', 1, ''),
(62, '51', '35411805', '', 1, ''),
(63, '51', '651565', '', 82, ''),
(64, '51', '4565', '', 83, ''),
(65, '51', '156165156', '', 83, ''),
(66, '51', '151651651561', '', 83, ''),
(67, '51', '35422725', '', 84, ''),
(68, '51', '35422725', '', 85, ''),
(69, '51', '35411315', '', 86, ''),
(70, '51', '984385805', '', 86, ''),
(71, '51', '4654646', '', 87, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `senha` varchar(60) NOT NULL,
  `pessoa_id` int(10) UNSIGNED NOT NULL,
  `session_id` varchar(30) NOT NULL,
  `status` enum('ativo','inativo') DEFAULT 'ativo',
  `ip` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_usuario_pessoa1_idx` (`pessoa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `senha`, `pessoa_id`, `session_id`, `status`, `ip`) VALUES
(1, '8e665638d106886c63b6d1795e0925c2', 1, 're9537g9ur9r1ajtr0s4sm8vs7', 'ativo', ''),
(2, 'e10adc3949ba59abbe56e057f20f883e', 2, '', 'ativo', ''),
(3, 'e10adc3949ba59abbe56e057f20f883e', 3, '', 'ativo', ''),
(4, 'e643a956151011f8b1bb5331c9bbf0c4', 14, '', 'ativo', ''),
(12, 'e9064b74d28acc053231170bb8c858b3', 124, 'testes2', 'ativo', 'xxx-xxx');

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `fk_aluno_pessoa1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `armario`
--
ALTER TABLE `armario`
  ADD CONSTRAINT `fk_armario_curso1` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `armario_aluno`
--
ALTER TABLE `armario_aluno`
  ADD CONSTRAINT `fk_armario_has_aluno_aluno1` FOREIGN KEY (`aluno_id`) REFERENCES `aluno` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_armario_has_aluno_armario1` FOREIGN KEY (`armario_id`) REFERENCES `armario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `biblioteca`
--
ALTER TABLE `biblioteca`
  ADD CONSTRAINT `fk_biblioteca_pessoa1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `biblioteca_autor_obra`
--
ALTER TABLE `biblioteca_autor_obra`
  ADD CONSTRAINT `fk_autor_has_Obra_Obra1` FOREIGN KEY (`Obra_id`) REFERENCES `biblioteca_obra` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_autor_has_Obra_autor1` FOREIGN KEY (`autor_id`) REFERENCES `biblioteca_autor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `biblioteca_categoria`
--
ALTER TABLE `biblioteca_categoria`
  ADD CONSTRAINT `fk_categoria_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `biblioteca_categoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `biblioteca_emprestimo`
--
ALTER TABLE `biblioteca_emprestimo`
  ADD CONSTRAINT `fk_biblioteca_emprestimo_pessoa1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_emprestimo_obra1` FOREIGN KEY (`obra_id`) REFERENCES `biblioteca_obra` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `biblioteca_obra`
--
ALTER TABLE `biblioteca_obra`
  ADD CONSTRAINT `fk_Obra_categoria1` FOREIGN KEY (`categoria_id`) REFERENCES `biblioteca_categoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Obra_editora1` FOREIGN KEY (`editora_id`) REFERENCES `biblioteca_editora` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `biblioteca_obra_eletronica`
--
ALTER TABLE `biblioteca_obra_eletronica`
  ADD CONSTRAINT `fk_biblioteca_obra_digiital_biblioteca_obra1` FOREIGN KEY (`obra_id`) REFERENCES `biblioteca_obra` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `biblioteca_reserva`
--
ALTER TABLE `biblioteca_reserva`
  ADD CONSTRAINT `fk_biblioteca_reserva_pessoa1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reserva_obra1` FOREIGN KEY (`obra_id`) REFERENCES `biblioteca_obra` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `coordenador_curso`
--
ALTER TABLE `coordenador_curso`
  ADD CONSTRAINT `fk_coordenador_curso_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_professor_has_curso_curso1` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_professor_has_curso_professor1` FOREIGN KEY (`professor_id`) REFERENCES `professor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `fk_curso_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `email`
--
ALTER TABLE `email`
  ADD CONSTRAINT `fk_table1_pessoa1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `fk_endereco_pessoa1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `professor`
--
ALTER TABLE `professor`
  ADD CONSTRAINT `fk_professor_pessoa1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `serv_item_patrimonio`
--
ALTER TABLE `serv_item_patrimonio`
  ADD CONSTRAINT `fk_serv_item_patrimonio_serv_local1` FOREIGN KEY (`serv_local_id`) REFERENCES `serv_local` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_serv_item_patrimonio_serv_patrimonio1` FOREIGN KEY (`serv_patrimonio_id_patrimonio`) REFERENCES `serv_patrimonio` (`id_patrimonio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `serv_movimento`
--
ALTER TABLE `serv_movimento`
  ADD CONSTRAINT `fk_serv_movimento_serv_item_patrimonio1` FOREIGN KEY (`serv_item_patrimonio_id_item`) REFERENCES `serv_item_patrimonio` (`id_item`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `telefone`
--
ALTER TABLE `telefone`
  ADD CONSTRAINT `fk_telefone_pessoa1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_pessoa1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
