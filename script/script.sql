-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 19/05/2023 às 20:23
-- Versão do servidor: 8.0.30
-- Versão do PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cbc`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `clube`
--

CREATE TABLE `clube` (
  `id` int NOT NULL,
  `clube` varchar(250) NOT NULL,
  `saldo_disponivel` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- --------------------------------------------------------

--
-- Estrutura para tabela `recurso`
--

CREATE TABLE `recurso` (
  `id` int NOT NULL,
  `recurso` varchar(250) NOT NULL,
  `saldo_disponivel` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `recurso`
--

INSERT INTO `recurso` (`id`, `recurso`, `saldo_disponivel`) VALUES
(1, 'Recurso para passagens', 9500.00),
(2, 'Recurso para hospedagens ', 10000.00);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `clube`
--
ALTER TABLE `clube`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `recurso`
--
ALTER TABLE `recurso`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clube`
--
ALTER TABLE `clube`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `recurso`
--
ALTER TABLE `recurso`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;
