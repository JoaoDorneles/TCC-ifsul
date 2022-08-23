-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29-Abr-2022 às 19:30
-- Versão do servidor: 10.4.18-MariaDB
-- versão do PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `atividadesbd`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `id_aluno` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_curso_curriculo` int(11) DEFAULT NULL,
  `matricula` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `atividade_comp`
--

CREATE TABLE `atividade_comp` (
  `id_atividade_comp` int(11) NOT NULL,
  `id_tipo_atividade` int(11) DEFAULT NULL,
  `doc_compro` varchar(255) DEFAULT NULL,
  `nome_arquivo` varchar(255) NOT NULL,
  `carga_hor_comp` int(11) DEFAULT NULL,
  `desc_atividade` varchar(255) DEFAULT NULL,
  `avaliacao` varchar(20) DEFAULT NULL,
  `mecanismo` varchar(255) DEFAULT NULL,
  `comentario` varchar(500) DEFAULT NULL,
  `id_aluno` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `atividade_comp_usuario`
--

CREATE TABLE `atividade_comp_usuario` (
  `id_atividade_comp_usuario` int(11) NOT NULL,
  `id_atividade_comp` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `data_hora` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE `curso` (
  `id_curso` int(11) NOT NULL,
  `nome_curso` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso_curriculo`
--

CREATE TABLE `curso_curriculo` (
  `id_curso_curriculo` int(11) NOT NULL,
  `id_curso` int(11) DEFAULT NULL,
  `curriculo` varchar(255) DEFAULT NULL,
  `data_ingresso` date DEFAULT NULL,
  `data_termino` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfil`
--

CREATE TABLE `perfil` (
  `id_perfil` int(11) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  `secretaria` tinyint(1) DEFAULT NULL,
  `coordenador` tinyint(1) DEFAULT NULL,
  `aluno` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `perfil`
--

INSERT INTO `perfil` (`id_perfil`, `descricao`, `admin`, `secretaria`, `coordenador`, `aluno`) VALUES
(1, 'admin', 1, 0, 0, 0),
(2, 'coordenador', 0, 0, 1, 0),
(3, 'secretaria', 0, 1, 0, 0),
(4, 'aluno', 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_atividade`
--

CREATE TABLE `tipo_atividade` (
  `id_tipo_atividade` int(11) NOT NULL,
  `tipo_atividade` varchar(255) DEFAULT NULL,
  `hora_max` int(11) DEFAULT NULL,
  `hora_min` int(11) DEFAULT NULL,
  `id_curso_curriculo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `usuario`, `senha`, `nome`) VALUES
(71, 'admin@admin.com', '$2y$10$jN5Wc5/odvMOh2Y8BmyI2ezLCFX9HEE1uOLwsEPs5wJEhyaN0vWmS', 'All_Done');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_perfil`
--

CREATE TABLE `usuario_perfil` (
  `id_usuario` int(11) NOT NULL,
  `id_perfil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario_perfil`
--

INSERT INTO `usuario_perfil` (`id_usuario`, `id_perfil`) VALUES
(71, 1);

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `view_usuario_perfis`
-- (Veja abaixo para a view atual)
--
CREATE TABLE `view_usuario_perfis` (
`id_usuario` int(11)
,`aluno` bigint(1)
,`cordenador` bigint(1)
,`secretaria` bigint(1)
,`adm` bigint(1)
);

-- --------------------------------------------------------

--
-- Estrutura para vista `view_usuario_perfis`
--
DROP TABLE IF EXISTS `view_usuario_perfis`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_usuario_perfis`  AS SELECT `up`.`id_usuario` AS `id_usuario`, max(case when `aluno`.`id_perfil` is null then 0 else 1 end) AS `aluno`, max(case when `coordenador`.`id_perfil` is null then 0 else 1 end) AS `cordenador`, max(case when `secretaria`.`id_perfil` is null then 0 else 1 end) AS `secretaria`, max(case when `adm`.`id_perfil` is null then 0 else 1 end) AS `adm` FROM ((((`usuario_perfil` `up` left join `perfil` `aluno` on(`up`.`id_perfil` = `aluno`.`id_perfil` and `aluno`.`aluno` = 1)) left join `perfil` `coordenador` on(`up`.`id_perfil` = `coordenador`.`id_perfil` and `coordenador`.`coordenador` = 1)) left join `perfil` `secretaria` on(`up`.`id_perfil` = `secretaria`.`id_perfil` and `secretaria`.`secretaria` = 1)) left join `perfil` `adm` on(`up`.`id_perfil` = `adm`.`id_perfil` and `adm`.`admin` = 1)) GROUP BY `up`.`id_usuario` ;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`id_aluno`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_curso_curriculo` (`id_curso_curriculo`);

--
-- Índices para tabela `atividade_comp`
--
ALTER TABLE `atividade_comp`
  ADD PRIMARY KEY (`id_atividade_comp`),
  ADD KEY `id_tipo_atividade` (`id_tipo_atividade`),
  ADD KEY `id_aluno` (`id_aluno`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices para tabela `atividade_comp_usuario`
--
ALTER TABLE `atividade_comp_usuario`
  ADD PRIMARY KEY (`id_atividade_comp_usuario`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `atividade_comp` (`id_atividade_comp`);

--
-- Índices para tabela `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id_curso`);

--
-- Índices para tabela `curso_curriculo`
--
ALTER TABLE `curso_curriculo`
  ADD PRIMARY KEY (`id_curso_curriculo`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Índices para tabela `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id_perfil`);

--
-- Índices para tabela `tipo_atividade`
--
ALTER TABLE `tipo_atividade`
  ADD PRIMARY KEY (`id_tipo_atividade`),
  ADD KEY `id_curso_curriculo` (`id_curso_curriculo`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- Índices para tabela `usuario_perfil`
--
ALTER TABLE `usuario_perfil`
  ADD PRIMARY KEY (`id_usuario`,`id_perfil`),
  ADD KEY `FK_usuario_perfil3` (`id_perfil`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aluno`
--
ALTER TABLE `aluno`
  MODIFY `id_aluno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de tabela `atividade_comp`
--
ALTER TABLE `atividade_comp`
  MODIFY `id_atividade_comp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT de tabela `atividade_comp_usuario`
--
ALTER TABLE `atividade_comp_usuario`
  MODIFY `id_atividade_comp_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=389;

--
-- AUTO_INCREMENT de tabela `curso`
--
ALTER TABLE `curso`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `curso_curriculo`
--
ALTER TABLE `curso_curriculo`
  MODIFY `id_curso_curriculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `tipo_atividade`
--
ALTER TABLE `tipo_atividade`
  MODIFY `id_tipo_atividade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `aluno_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `aluno_ibfk_2` FOREIGN KEY (`id_curso_curriculo`) REFERENCES `curso_curriculo` (`id_curso_curriculo`);

--
-- Limitadores para a tabela `atividade_comp`
--
ALTER TABLE `atividade_comp`
  ADD CONSTRAINT `atividade_comp_ibfk_1` FOREIGN KEY (`id_tipo_atividade`) REFERENCES `tipo_atividade` (`id_tipo_atividade`),
  ADD CONSTRAINT `atividade_comp_ibfk_2` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`id_aluno`),
  ADD CONSTRAINT `atividade_comp_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Limitadores para a tabela `atividade_comp_usuario`
--
ALTER TABLE `atividade_comp_usuario`
  ADD CONSTRAINT `atividade_comp` FOREIGN KEY (`id_atividade_comp`) REFERENCES `atividade_comp` (`id_atividade_comp`),
  ADD CONSTRAINT `atividade_comp_usuario` FOREIGN KEY (`id_atividade_comp`) REFERENCES `atividade_comp` (`id_atividade_comp`),
  ADD CONSTRAINT `atividade_comp_usuario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `atividade_comp_usuario_ibfk_2` FOREIGN KEY (`id_atividade_comp`) REFERENCES `atividade_comp` (`id_atividade_comp`),
  ADD CONSTRAINT `atividades_comp_usuario_ibfk_2` FOREIGN KEY (`id_atividade_comp`) REFERENCES `atividade_comp` (`id_atividade_comp`);

--
-- Limitadores para a tabela `curso_curriculo`
--
ALTER TABLE `curso_curriculo`
  ADD CONSTRAINT `curso_curriculo_ibfk_2` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`);

--
-- Limitadores para a tabela `tipo_atividade`
--
ALTER TABLE `tipo_atividade`
  ADD CONSTRAINT `tipo_atividade_ibfk_1` FOREIGN KEY (`id_curso_curriculo`) REFERENCES `curso_curriculo` (`id_curso_curriculo`);

--
-- Limitadores para a tabela `usuario_perfil`
--
ALTER TABLE `usuario_perfil`
  ADD CONSTRAINT `FK_usuario_perfil2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `FK_usuario_perfil3` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id_perfil`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
