-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Nov 04, 2014 as 10:48 AM
-- Versão do Servidor: 5.0.51
-- Versão do PHP: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Banco de Dados: `jbs_metalurgica`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `ID_CLIENTE` int(11) NOT NULL auto_increment,
  `NOME` varchar(60) NOT NULL,
  `CPF_CNPJ` varchar(16) NOT NULL,
  `EMAIL` varchar(50) default NULL,
  `TELEFONE` varchar(16) default NULL,
  `CELULAR` varchar(16) NOT NULL,
  `RUA` varchar(60) NOT NULL,
  `NUMERO` int(6) default NULL,
  `BAIRRO` varchar(60) NOT NULL,
  `CEP` varchar(20) NOT NULL,
  `ID_LOCALIDADE` int(11) default NULL,
  PRIMARY KEY  (`ID_CLIENTE`),
  KEY `ID_LOCALIDADE` (`ID_LOCALIDADE`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`ID_CLIENTE`, `NOME`, `CPF_CNPJ`, `EMAIL`, `TELEFONE`, `CELULAR`, `RUA`, `NUMERO`, `BAIRRO`, `CEP`, `ID_LOCALIDADE`) VALUES
(1, 'CLIENTE 1', '999.999.999-99', 'CLIENTE1@BOL.COM.BR', '(99) 9999 - 9999', '(99) 9999 - 9999', 'RUA TESTE', 999, 'CENTRO', '85.501-000', 1),
(2, 'CARLOS DANIEL', '999.999.999-99', 'TESTE@BOL.COM.BR', '(99) 9999 - 9999', '(99) 9999 - 9999', 'RUA TESTE', 999, 'CENTRO', '85.501-000', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `esquadria`
--

CREATE TABLE IF NOT EXISTS `esquadria` (
  `ID_ESQUADRIA` int(11) NOT NULL auto_increment,
  `DESCRICAO` varchar(80) default NULL,
  `COLOCACAO` varchar(10) default NULL,
  `ID_PERFIL` int(11) default NULL,
  PRIMARY KEY  (`ID_ESQUADRIA`),
  KEY `ID_PERFIL` (`ID_PERFIL`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `esquadria`
--

INSERT INTO `esquadria` (`ID_ESQUADRIA`, `DESCRICAO`, `COLOCACAO`, `ID_PERFIL`) VALUES
(1, 'ESQUADRIA 1', 'CHUMBADO', 1),
(2, 'ESQUADRIA 2', 'CHUMBADO 2', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE IF NOT EXISTS `funcionario` (
  `ID_FUNCIONARIO` int(11) NOT NULL auto_increment,
  `NOME` varchar(60) NOT NULL,
  `CPF` varchar(16) NOT NULL,
  `EMAIL` varchar(50) default NULL,
  `CELULAR` varchar(16) NOT NULL,
  `RUA` varchar(60) NOT NULL,
  `NUMERO` int(6) default NULL,
  `BAIRRO` varchar(60) NOT NULL,
  `CEP` varchar(12) NOT NULL,
  `ID_LOCAL` int(11) default NULL,
  PRIMARY KEY  (`ID_FUNCIONARIO`),
  KEY `ID_LOCAL` (`ID_LOCAL`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`ID_FUNCIONARIO`, `NOME`, `CPF`, `EMAIL`, `CELULAR`, `RUA`, `NUMERO`, `BAIRRO`, `CEP`, `ID_LOCAL`) VALUES
(1, 'TESTE', '000.000.000-00', 'TESTE@BOL.COM.BR', '(00) 0000 - 0000', 'RUA TESTE', 999, 'CENTRO', '85.501-000', 1),
(2, 'TESTE 2', '999.999.999-99', 'TESTE2@BOL.COM.BR', '(99) 9999 - 9999', 'RUA TESTE', 999, 'CENTRO', '85.501-000', 2),
(3, 'TESTE 3', '888.888.888-88', 'TESTE3@BOL.COM.BR', '(77) 7777 - 7777', 'RUA TESTE', 999, 'CENTRO', '85.501-000', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `item_orcamento`
--

CREATE TABLE IF NOT EXISTS `item_orcamento` (
  `ID_ITEM_ORCAMENTO` int(11) NOT NULL auto_increment,
  `QUANTIDADE` int(10) default NULL,
  `ALTURA` float default NULL,
  `LARGURA` float default NULL,
  `VALOR_UNITARIO` float default NULL,
  `COR` int(11) NOT NULL,
  `ID_ORCAMENTO` int(11) default NULL,
  `ID_ESQUADRIA` int(11) default NULL,
  PRIMARY KEY  (`ID_ITEM_ORCAMENTO`),
  KEY `ID_ORCAMENTO` (`ID_ORCAMENTO`),
  KEY `ID_ESQUADRIA` (`ID_ESQUADRIA`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `item_orcamento`
--

INSERT INTO `item_orcamento` (`ID_ITEM_ORCAMENTO`, `QUANTIDADE`, `ALTURA`, `LARGURA`, `VALOR_UNITARIO`, `COR`, `ID_ORCAMENTO`, `ID_ESQUADRIA`) VALUES
(1, 10, 2, 1, 200, 1, 1, 1),
(2, 12, 2, 1, 480, 1, 1, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `localidade`
--

CREATE TABLE IF NOT EXISTS `localidade` (
  `ID_LOCALIDADE` int(11) NOT NULL auto_increment,
  `CIDADE` varchar(30) NOT NULL,
  `ESTADO` varchar(30) NOT NULL,
  `SIGLA` varchar(4) NOT NULL,
  PRIMARY KEY  (`ID_LOCALIDADE`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `localidade`
--

INSERT INTO `localidade` (`ID_LOCALIDADE`, `CIDADE`, `ESTADO`, `SIGLA`) VALUES
(1, 'PATO BRANCO', 'PARANÁ', 'PR'),
(2, 'CURITIBA', 'PARANÁ', 'PR'),
(3, 'CHOPINZINHO', 'PARANÁ', 'PR');

-- --------------------------------------------------------

--
-- Estrutura da tabela `orcamento`
--

CREATE TABLE IF NOT EXISTS `orcamento` (
  `ID_ORCAMENTO` int(11) NOT NULL auto_increment,
  `DATA_ORCAMENTO` date default NULL,
  `CONFIRMADO` char(3) NOT NULL,
  `ID_FUNCIONARIO` int(11) default NULL,
  `ID_CLIENTE` int(11) default NULL,
  PRIMARY KEY  (`ID_ORCAMENTO`),
  KEY `ID_FUNCIONARIO` (`ID_FUNCIONARIO`),
  KEY `ID_CLIENTE` (`ID_CLIENTE`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `orcamento`
--

INSERT INTO `orcamento` (`ID_ORCAMENTO`, `DATA_ORCAMENTO`, `CONFIRMADO`, `ID_FUNCIONARIO`, `ID_CLIENTE`) VALUES
(1, '2014-11-04', '0', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfil`
--

CREATE TABLE IF NOT EXISTS `perfil` (
  `ID_PERFIL` int(11) NOT NULL auto_increment,
  `DESCRICAO` varchar(80) default NULL,
  `PESO_POR_METRO` float default NULL,
  PRIMARY KEY  (`ID_PERFIL`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `perfil`
--

INSERT INTO `perfil` (`ID_PERFIL`, `DESCRICAO`, `PESO_POR_METRO`) VALUES
(1, 'PERFIL 1', 10),
(2, 'PERFIL 2', 20);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE IF NOT EXISTS `produto` (
  `ID_PRODUTO` int(11) NOT NULL auto_increment,
  `VALOR` float default NULL,
  `ID_ESQUADRIA` int(11) default NULL,
  PRIMARY KEY  (`ID_PRODUTO`),
  KEY `ID_ESQUADRIA` (`ID_ESQUADRIA`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`ID_PRODUTO`, `VALOR`, `ID_ESQUADRIA`) VALUES
(1, 10, 1),
(2, 20, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `ID_USUARIOS` int(11) NOT NULL auto_increment,
  `LOGIN` varchar(60) NOT NULL,
  `SENHA` varchar(16) NOT NULL,
  `NIVEL_ACESSO` int(2) default NULL,
  `ATIVO` int(2) default NULL,
  `ID_FUNCIONARIO` int(11) default NULL,
  PRIMARY KEY  (`ID_USUARIOS`),
  KEY `ID_FUNCIONARIO` (`ID_FUNCIONARIO`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`ID_USUARIOS`, `LOGIN`, `SENHA`, `NIVEL_ACESSO`, `ATIVO`, `ID_FUNCIONARIO`) VALUES
(1, 'AA', 'AA', 0, 1, 1),
(2, 'BB', 'BB', 1, 1, 2),
(3, 'CC', 'CC', 2, 1, 3);
