-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15-Jun-2023 às 18:57
-- Versão do servidor: 10.4.28-MariaDB
-- versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `pap`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacao`
--

CREATE TABLE `avaliacao` (
  `id_user` int(11) NOT NULL,
  `id_roupa` int(11) NOT NULL,
  `estrelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `avaliacao`
--

INSERT INTO `avaliacao` (`id_user`, `id_roupa`, `estrelas`) VALUES
(11, 266, 2),
(11, 269, 1),
(45, 269, 5),
(41, 269, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `id_carro` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_roupa` int(11) NOT NULL,
  `id_tamanhos` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cor`
--

CREATE TABLE `cor` (
  `id_cor` int(11) NOT NULL,
  `cores` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `cor`
--

INSERT INTO `cor` (`id_cor`, `cores`) VALUES
(1, 'Vermelho'),
(2, 'Castanho'),
(3, 'Preto'),
(4, 'Branco'),
(5, 'Verde'),
(6, 'Amarelo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `encomenda`
--

CREATE TABLE `encomenda` (
  `id_encomenda` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_roupa` int(11) NOT NULL,
  `id_tamanhos` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `num_contri` int(30) NOT NULL,
  `telemovel` int(30) NOT NULL,
  `morada` varchar(30) NOT NULL,
  `morada2` int(11) NOT NULL,
  `codigo_postal` int(30) NOT NULL,
  `cidade` varchar(30) NOT NULL,
  `data` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `genero`
--

CREATE TABLE `genero` (
  `id_genero` int(11) NOT NULL,
  `genero` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `genero`
--

INSERT INTO `genero` (`id_genero`, `genero`) VALUES
(1, 'Feminino '),
(2, 'Masculino');

-- --------------------------------------------------------

--
-- Estrutura da tabela `imagens`
--

CREATE TABLE `imagens` (
  `id_imagens` int(11) NOT NULL,
  `imagens` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `imagens`
--

INSERT INTO `imagens` (`id_imagens`, `imagens`) VALUES
(278, '/PAP/db_fotos/p.jpg'),
(279, '/PAP/db_fotos/p.jpg'),
(283, '/PAP/db_fotos/p.jpg'),
(285, '/PAP/db_fotos/p.jpg'),
(332, '/PAP/candidaturas/leonardo_cv.'),
(335, '/PAP/db_fotos/adidas.jpg'),
(336, '/PAP/candidaturas/Joana_cv.pdf'),
(337, '/PAP/candidaturas/leonardo_cv.'),
(339, '/PAP/db_fotos/SapNike.jpg'),
(341, '/PAP/db_fotos/calçasAdidas.jpg'),
(342, '/PAP/db_fotos/SweatPuma.jpg'),
(343, '/PAP/db_fotos/SaptMulh.jpg'),
(344, '/PAP/db_fotos/mulhCalc.jpg'),
(345, '/PAP/db_fotos/MulheCasac.jpg'),
(346, '/PAP/db_fotos/tshirtMulh.jpg'),
(349, '/PAP/db_fotos/tshSanta.jpg'),
(350, '/PAP/db_fotos/mulhsweat.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `juntar_equipa`
--

CREATE TABLE `juntar_equipa` (
  `id_Cand` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_imagem` int(11) NOT NULL,
  `DataCand` date NOT NULL,
  `cargos` enum('Pendente','Estagiario','','') NOT NULL,
  `estado` enum('Aberto','Fechado','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `juntar_equipa`
--

INSERT INTO `juntar_equipa` (`id_Cand`, `id_user`, `id_imagem`, `DataCand`, `cargos`, `estado`) VALUES
(23, 11, 337, '2023-06-15', 'Estagiario', 'Fechado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `locali`
--

CREATE TABLE `locali` (
  `id_loca` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `latitude` decimal(9,6) NOT NULL,
  `longitude` decimal(9,6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `locali`
--

INSERT INTO `locali` (`id_loca`, `nome`, `latitude`, `longitude`) VALUES
(1, 'Sao joao da Madeira', 40.902400, -8.489500),
(2, 'Lisboa', 38.707100, -9.135490);

-- --------------------------------------------------------

--
-- Estrutura da tabela `marca`
--

CREATE TABLE `marca` (
  `id_marcas` int(11) NOT NULL,
  `marcas` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `marca`
--

INSERT INTO `marca` (`id_marcas`, `marcas`) VALUES
(1, 'Nike'),
(2, 'Adidas'),
(3, 'Jordan'),
(4, 'Santa Cruz'),
(5, 'Element'),
(6, 'Puma');

-- --------------------------------------------------------

--
-- Estrutura da tabela `roupa`
--

CREATE TABLE `roupa` (
  `id_roupa` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `preco` varchar(30) NOT NULL,
  `promocao` int(11) NOT NULL,
  `DataLanc` date NOT NULL DEFAULT current_timestamp(),
  `id_cor` int(11) NOT NULL,
  `id_marca` int(11) NOT NULL,
  `id_genero` int(11) NOT NULL,
  `id_tipoRoupa` int(11) NOT NULL,
  `descricao` varchar(1000) NOT NULL,
  `id_imagens` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `roupa`
--

INSERT INTO `roupa` (`id_roupa`, `nome`, `preco`, `promocao`, `DataLanc`, `id_cor`, `id_marca`, `id_genero`, `id_tipoRoupa`, `descricao`, `id_imagens`) VALUES
(258, 'SST TT', '80', 0, '2023-06-15', 1, 2, 2, 5, 'Prepara o teu look mais arrojado com o/a Casaco adidas Originals SST TT que está agora disponível na Global Clothes.\r\n', 335),
(259, 'COURT VISION MID NEXT NATURE', '90', 0, '2023-06-15', 4, 1, 2, 1, 'As NIKE Court Vision Mid Next Nature já estão disponíveis na Global Clothes. Se gostas de andar sempre bem calçado, estas sapatilhas são para ti.', 339),
(261, 'BECKENBAUER TP', '70', 0, '2023-06-15', 3, 2, 2, 4, 'Prepara o teu look mais arrojado com o/a Calças adidas Originals Beckenbauer TP que está agora disponível na Global Clothes.\r\n', 341),
(262, 'MINECRAFT HOODIE', '80', 0, '2023-06-15', 3, 6, 2, 3, 'Prepara o teu look mais arrojado com o/a Sweat PUMA Minecraft Hoodie que está agora disponível na Global Clothes.\r\n', 342),
(263, 'W COURT VISION LOW NEXT NATURE', '80', 0, '2023-06-15', 4, 1, 1, 1, 'As NIKE W Court Vision Low Next Nature já estão disponíveis na Global Clothes. Se gostas de andar sempre bem calçado, estas sapatilhas são para ti.', 343),
(264, 'TRACKPANT', '65', 0, '2023-06-15', 3, 2, 1, 4, 'Prepara o teu look mais arrojado com o/a Calças adidas Originals Trackpant que está agora disponível na Global Clothes.\r\n', 344),
(265, 'SST CLASSIC TT', '80', 0, '2023-06-15', 3, 2, 1, 5, 'Prepara o teu look mais arrojado com o/a Casaco adidas Originals SST Classic TT que está agora disponível na Global Clothes.\r\n', 345),
(266, 'NSW TEE ESSNTL CRP ICN', '25', 0, '2023-06-15', 4, 1, 1, 2, 'Prepara o teu look mais arrojado com o/a T-Shirt NIKE Nsw Tee Essntl Crp Icn que está agora disponível na Global Clothes.\r\n', 346),
(269, 'CLASSIC CIRCLE FLAG TEE', '20', 0, '2023-06-15', 4, 4, 2, 2, 'Prepara o teu look mais arrojado com o/a T-shirt TOMMY JEANS Classic Circle Flag Tee que está agora disponível na Global Clothes.\r\n', 349),
(270, 'TREFOIL HOODIE', '80', 0, '2023-06-15', 4, 2, 1, 3, 'Prepara-te para o fit check: a sweat Adidas Originals Trefoil Hoodie em bege para mulher é infalível e está agora disponível na Global Clothes!', 350);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tamanhos`
--

CREATE TABLE `tamanhos` (
  `id_tamanhos` int(11) NOT NULL,
  `tamanhos` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tamanhos`
--

INSERT INTO `tamanhos` (`id_tamanhos`, `tamanhos`) VALUES
(1, '36'),
(2, '37'),
(3, '38'),
(4, '39'),
(5, '40'),
(6, '41'),
(7, '42'),
(8, '43'),
(9, '44'),
(10, '45'),
(11, '46'),
(12, 'XS'),
(13, 'S'),
(14, 'M'),
(15, 'L'),
(16, 'XL'),
(17, 'XXL');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tamanhos_roupa`
--

CREATE TABLE `tamanhos_roupa` (
  `id_roupa` int(11) NOT NULL,
  `id_tamanhos` int(11) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tamanhos_roupa`
--

INSERT INTO `tamanhos_roupa` (`id_roupa`, `id_tamanhos`, `stock`) VALUES
(258, 12, 10),
(258, 13, 4),
(258, 14, 2),
(258, 15, 7),
(258, 16, 8),
(258, 17, 3),
(259, 1, 2),
(259, 2, 4),
(259, 3, 3),
(259, 4, 4),
(259, 5, 7),
(259, 6, 5),
(259, 7, 7),
(259, 8, 5),
(259, 9, 4),
(259, 10, 5),
(259, 11, 7),
(261, 12, 4),
(261, 13, 5),
(261, 14, 7),
(261, 15, 5),
(261, 16, 2),
(261, 17, 4),
(262, 12, 4),
(262, 13, 1),
(262, 14, 5),
(262, 15, 4),
(262, 16, 2),
(262, 17, 4),
(263, 1, 4),
(263, 2, 5),
(263, 3, 6),
(263, 4, 4),
(263, 5, 5),
(263, 6, 6),
(263, 7, 4),
(263, 8, 5),
(263, 9, 10),
(263, 10, 10),
(263, 11, 10),
(264, 12, 4),
(264, 13, 5),
(264, 14, 4),
(264, 15, 10),
(264, 16, 4),
(264, 17, 4),
(265, 12, 4),
(265, 13, 1),
(265, 14, 4),
(265, 15, 4),
(265, 16, 4),
(265, 17, 5),
(266, 12, 4),
(266, 13, 4),
(266, 14, 4),
(266, 15, 5),
(266, 16, 7),
(266, 17, 10),
(269, 12, 4),
(269, 13, 5),
(269, 14, 4),
(269, 15, 5),
(269, 16, 10),
(269, 17, 5),
(270, 12, 4),
(270, 13, 5),
(270, 14, 4),
(270, 15, 1),
(270, 16, 5),
(270, 17, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tiporoupa`
--

CREATE TABLE `tiporoupa` (
  `id_tipoRoupas` int(11) NOT NULL,
  `TipoRoupa` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tiporoupa`
--

INSERT INTO `tiporoupa` (`id_tipoRoupas`, `TipoRoupa`) VALUES
(1, 'Sapatilhas'),
(2, 'Tshirts'),
(3, 'SweatShirts'),
(4, 'Calcas'),
(5, 'Casacos');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `apelido` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `cargo` enum('admin','user','','') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `username`, `apelido`, `email`, `password`, `cargo`) VALUES
(10, 'admin', '', 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', 'admin'),
(11, 'leonardo', '', 'leo@gmail.com', '698d51a19d8a121ce581499d7b701668', 'user'),
(41, 'Joana', 'Gomes', 'joana123@gmail.com', '202cb962ac59075b964b07152d234b70', 'user'),
(45, 'joao', 'carlos', 'joaocarlos55@gmail.com', '202cb962ac59075b964b07152d234b70', 'user');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD KEY `id_roupa` (`id_roupa`),
  ADD KEY `id_user` (`id_user`);

--
-- Índices para tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`id_carro`),
  ADD KEY `id_roupa` (`id_roupa`),
  ADD KEY `id_tamanhos` (`id_tamanhos`),
  ADD KEY `id_user` (`id_user`);

--
-- Índices para tabela `cor`
--
ALTER TABLE `cor`
  ADD PRIMARY KEY (`id_cor`);

--
-- Índices para tabela `encomenda`
--
ALTER TABLE `encomenda`
  ADD PRIMARY KEY (`id_encomenda`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `encomenda_ibfk_1` (`id_roupa`),
  ADD KEY `id_tamanhos` (`id_tamanhos`);

--
-- Índices para tabela `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`id_genero`);

--
-- Índices para tabela `imagens`
--
ALTER TABLE `imagens`
  ADD PRIMARY KEY (`id_imagens`);

--
-- Índices para tabela `juntar_equipa`
--
ALTER TABLE `juntar_equipa`
  ADD PRIMARY KEY (`id_Cand`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_imagem` (`id_imagem`);

--
-- Índices para tabela `locali`
--
ALTER TABLE `locali`
  ADD PRIMARY KEY (`id_loca`);

--
-- Índices para tabela `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id_marcas`);

--
-- Índices para tabela `roupa`
--
ALTER TABLE `roupa`
  ADD PRIMARY KEY (`id_roupa`),
  ADD KEY `id_cor` (`id_cor`),
  ADD KEY `id_genero` (`id_genero`),
  ADD KEY `id_marca` (`id_marca`),
  ADD KEY `id_tipoRoupa` (`id_tipoRoupa`),
  ADD KEY `id_imagens` (`id_imagens`);

--
-- Índices para tabela `tamanhos`
--
ALTER TABLE `tamanhos`
  ADD PRIMARY KEY (`id_tamanhos`);

--
-- Índices para tabela `tamanhos_roupa`
--
ALTER TABLE `tamanhos_roupa`
  ADD KEY `id_roupa` (`id_roupa`),
  ADD KEY `id_tamanhos` (`id_tamanhos`);

--
-- Índices para tabela `tiporoupa`
--
ALTER TABLE `tiporoupa`
  ADD PRIMARY KEY (`id_tipoRoupas`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `id_carro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;

--
-- AUTO_INCREMENT de tabela `cor`
--
ALTER TABLE `cor`
  MODIFY `id_cor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `encomenda`
--
ALTER TABLE `encomenda`
  MODIFY `id_encomenda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT de tabela `genero`
--
ALTER TABLE `genero`
  MODIFY `id_genero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `imagens`
--
ALTER TABLE `imagens`
  MODIFY `id_imagens` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=351;

--
-- AUTO_INCREMENT de tabela `juntar_equipa`
--
ALTER TABLE `juntar_equipa`
  MODIFY `id_Cand` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `locali`
--
ALTER TABLE `locali`
  MODIFY `id_loca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `marca`
--
ALTER TABLE `marca`
  MODIFY `id_marcas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `roupa`
--
ALTER TABLE `roupa`
  MODIFY `id_roupa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=271;

--
-- AUTO_INCREMENT de tabela `tamanhos`
--
ALTER TABLE `tamanhos`
  MODIFY `id_tamanhos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `tiporoupa`
--
ALTER TABLE `tiporoupa`
  MODIFY `id_tipoRoupas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD CONSTRAINT `avaliacao_ibfk_1` FOREIGN KEY (`id_roupa`) REFERENCES `roupa` (`id_roupa`),
  ADD CONSTRAINT `avaliacao_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD CONSTRAINT `carrinho_ibfk_1` FOREIGN KEY (`id_roupa`) REFERENCES `roupa` (`id_roupa`),
  ADD CONSTRAINT `carrinho_ibfk_2` FOREIGN KEY (`id_tamanhos`) REFERENCES `tamanhos` (`id_tamanhos`),
  ADD CONSTRAINT `carrinho_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `encomenda`
--
ALTER TABLE `encomenda`
  ADD CONSTRAINT `encomenda_ibfk_1` FOREIGN KEY (`id_roupa`) REFERENCES `roupa` (`id_roupa`),
  ADD CONSTRAINT `encomenda_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `encomenda_ibfk_3` FOREIGN KEY (`id_tamanhos`) REFERENCES `tamanhos` (`id_tamanhos`);

--
-- Limitadores para a tabela `roupa`
--
ALTER TABLE `roupa`
  ADD CONSTRAINT `roupa_ibfk_1` FOREIGN KEY (`id_cor`) REFERENCES `cor` (`id_cor`),
  ADD CONSTRAINT `roupa_ibfk_5` FOREIGN KEY (`id_genero`) REFERENCES `genero` (`id_genero`),
  ADD CONSTRAINT `roupa_ibfk_6` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id_marcas`),
  ADD CONSTRAINT `roupa_ibfk_8` FOREIGN KEY (`id_tipoRoupa`) REFERENCES `tiporoupa` (`id_tipoRoupas`),
  ADD CONSTRAINT `roupa_ibfk_9` FOREIGN KEY (`id_imagens`) REFERENCES `imagens` (`id_imagens`);

--
-- Limitadores para a tabela `tamanhos_roupa`
--
ALTER TABLE `tamanhos_roupa`
  ADD CONSTRAINT `tamanhos_roupa_ibfk_1` FOREIGN KEY (`id_roupa`) REFERENCES `roupa` (`id_roupa`),
  ADD CONSTRAINT `tamanhos_roupa_ibfk_2` FOREIGN KEY (`id_tamanhos`) REFERENCES `tamanhos` (`id_tamanhos`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
