-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03-Maio-2021 às 23:40
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
-- Banco de dados: `receituario`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `farmacias`
--

CREATE TABLE `farmacias` (
  `id` int(11) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `telefone` varchar(30) NOT NULL,
  `cnpj` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `farmacias`
--

INSERT INTO `farmacias` (`id`, `nome`, `email`, `telefone`, `cnpj`) VALUES
(1, 'Drogasil', 'drogasil@gmail.com', '19988991122', '787586857868');

-- --------------------------------------------------------

--
-- Estrutura da tabela `medicamentos`
--

CREATE TABLE `medicamentos` (
  `id` int(11) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `formato` enum('Comprimidos','Gotas','Cápsulas','Injeção','Liquido') NOT NULL,
  `tamanho` varchar(20) NOT NULL,
  `funcao` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `medicamentos`
--

INSERT INTO `medicamentos` (`id`, `nome`, `formato`, `tamanho`, `funcao`) VALUES
(6, 'Dipirona', 'Gotas', '10ml', 'Analgésico'),
(7, 'Glifage', 'Comprimidos', '500mg', 'Antidiabético'),
(8, 'Diamicron MR', 'Comprimidos', '60mg', 'Antidiabético'),
(9, 'Miorrelax', 'Comprimidos', '100mg', 'Analgésico e relaxante muscular'),
(10, 'Lisador DIP', 'Comprimidos', '1g', 'Analgésico'),
(11, 'Paracetamol', 'Comprimidos', '750mg', 'Analgésico'),
(12, 'Engov', 'Comprimidos', '365mg', 'Anti-histamínico');

-- --------------------------------------------------------

--
-- Estrutura da tabela `medicos`
--

CREATE TABLE `medicos` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(40) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `crm` int(11) NOT NULL,
  `especialidade` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `medicos`
--

INSERT INTO `medicos` (`id`, `nome`, `email`, `telefone`, `crm`, `especialidade`) VALUES
(1, 'Pompeu Pompilho Pomposo', 'pp@gmail.com', '19974214443', 3245, 'Pediatra');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pacientes`
--

CREATE TABLE `pacientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(40) NOT NULL,
  `telefone` varchar(30) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `endereco` varchar(50) NOT NULL,
  `convenio` varchar(30) NOT NULL,
  `carteirinha` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pacientes`
--

INSERT INTO `pacientes` (`id`, `nome`, `email`, `telefone`, `cpf`, `endereco`, `convenio`, `carteirinha`) VALUES
(8, 'Antonio Eduardo K de Melo', 'edu@gmail.com', '(19) 97421-4443', '225.419.288-40', 'Rua Moysés Lucarelli, 75', 'Unimed', '123456'),
(9, 'Roberta Callegari', 'ro.callegari@gmail.com', '(19) 97414-1389', '335.642.288-02', 'Rua Moyses Lucarelli, 75, Campinas SP', 'Unimed', '784638746'),
(10, 'Gustavo Lima', 'gulima@gmail.com', '(11) 99999-9999', '475.647.647-55', 'Rua 1, nº1', 'Bradesco', '67676');

-- --------------------------------------------------------

--
-- Estrutura da tabela `receitados`
--

CREATE TABLE `receitados` (
  `id` int(11) NOT NULL,
  `idreceita` int(11) NOT NULL,
  `idmedicamento` int(11) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `modouso` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `receitados`
--

INSERT INTO `receitados` (`id`, `idreceita`, `idmedicamento`, `nome`, `modouso`) VALUES
(96, 174, 7, 'Glifage', '1 comprimido\\dia após refeições'),
(97, 174, 8, 'Diamicron MR', '1 comprimido\\dia após refeições'),
(98, 177, 7, 'Glifage', '2 comprimidos ao dia após as refeições'),
(99, 178, 7, 'Glifage', '2 comprimidos ao dia após as refeições'),
(100, 178, 8, 'Diamicron MR', '1 comprimido ao dia em jejum');

-- --------------------------------------------------------

--
-- Estrutura da tabela `receitas`
--

CREATE TABLE `receitas` (
  `id` int(11) NOT NULL,
  `idpaciente` int(11) NOT NULL,
  `idmedico` int(11) NOT NULL,
  `data` date NOT NULL,
  `validade` date NOT NULL,
  `tiporeceita` varchar(30) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `receitas`
--

INSERT INTO `receitas` (`id`, `idpaciente`, `idmedico`, `data`, `validade`, `tiporeceita`, `status`) VALUES
(174, 8, 1, '2021-04-26', '2021-10-26', 'Renovavel', 'Ativa'),
(178, 8, 1, '2021-05-03', '2021-11-03', 'Renovavel', 'Ativa');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usoreceitas`
--

CREATE TABLE `usoreceitas` (
  `id` int(11) NOT NULL,
  `idreceita` int(11) NOT NULL,
  `farmacia` varchar(40) NOT NULL,
  `datauso` date NOT NULL,
  `proximouso` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usoreceitas`
--

INSERT INTO `usoreceitas` (`id`, `idreceita`, `farmacia`, `datauso`, `proximouso`) VALUES
(15, 178, 'Drogasil', '2021-05-03', '2021-06-03');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(40) NOT NULL,
  `senha` varchar(30) NOT NULL,
  `nivel` enum('Medico','Paciente','Farmacia') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `nivel`) VALUES
(4, 'Pompeu Pompilho Pomposo', 'pp@gmail.com', '123456', 'Medico'),
(5, 'Antonio Eduardo K de Melo', 'edu@gmail.com', '123', 'Paciente'),
(6, 'Drogasil', 'drogasil@gmail.com', '123', 'Farmacia'),
(7, 'Roberta Callegari', 'ro.callegari@gmail.com', '123', 'Paciente'),
(8, 'Gustavo Lima', 'gulima@gmail.com', '123', 'Paciente');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `farmacias`
--
ALTER TABLE `farmacias`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `medicamentos`
--
ALTER TABLE `medicamentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `medicos`
--
ALTER TABLE `medicos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `receitados`
--
ALTER TABLE `receitados`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `receitas`
--
ALTER TABLE `receitas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usoreceitas`
--
ALTER TABLE `usoreceitas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `farmacias`
--
ALTER TABLE `farmacias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `medicamentos`
--
ALTER TABLE `medicamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `medicos`
--
ALTER TABLE `medicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `receitados`
--
ALTER TABLE `receitados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT de tabela `receitas`
--
ALTER TABLE `receitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=179;

--
-- AUTO_INCREMENT de tabela `usoreceitas`
--
ALTER TABLE `usoreceitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
