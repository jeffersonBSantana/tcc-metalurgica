SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `JBS_METALURGICA` DEFAULT CHARACTER SET latin1 ;
USE `JBS_METALURGICA` ;

-- -----------------------------------------------------
-- Table `JBS_METALURGICA`.`localidade`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `JBS_METALURGICA`.`LOCALIDADE` (
  `ID_LOCALIDADE` INT(11) NOT NULL AUTO_INCREMENT ,
  `CIDADE` VARCHAR(30) NOT NULL ,
  `ESTADO` VARCHAR(30) NOT NULL ,
  `SIGLA` VARCHAR(4) NOT NULL ,
  PRIMARY KEY (`ID_LOCALIDADE`) )
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `JBS_METALURGICA`.`cliente`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `JBS_METALURGICA`.`CLIENTE` (
  `ID_CLIENTE` INT(11) NOT NULL AUTO_INCREMENT ,
  `NOME` VARCHAR(60) NOT NULL ,
  `CPF_CNPJ` VARCHAR(16) NOT NULL ,
  `EMAIL` VARCHAR(50) NULL DEFAULT NULL ,
  `TELEFONE` VARCHAR(16) NULL DEFAULT NULL ,
  `CELULAR` VARCHAR(16) NOT NULL ,
  `RUA` VARCHAR(60) NOT NULL ,
  `NUMERO` INT(6) NULL DEFAULT NULL ,
  `BAIRRO` VARCHAR(60) NOT NULL ,
  `CEP` VARCHAR(20) NOT NULL ,
  `ID_LOCALIDADE` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`ID_CLIENTE`) ,
  INDEX `ID_LOCALIDADE` (`ID_LOCALIDADE` ASC) ,
  CONSTRAINT `FK_CLIENTE_LOCALIDADE`
    FOREIGN KEY (`ID_LOCALIDADE` )
    REFERENCES `JBS_METALURGICA`.`LOCALIDADE` (`ID_LOCALIDADE` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `JBS_METALURGICA`.`esquadria`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `JBS_METALURGICA`.`ESQUADRIA` (
  `ID_ESQUADRIA` INT(11) NOT NULL AUTO_INCREMENT ,
  `DESCRICAO` VARCHAR(80) NULL DEFAULT NULL ,
  `COLOCACAO` VARCHAR(10) NULL DEFAULT NULL ,
	`ID_PERFIL` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`ID_ESQUADRIA`) ,
  INDEX `ID_PERFIL` (`ID_PERFIL` ASC) ,
  CONSTRAINT `FK_ESQUADRIA_PERFIL`
    FOREIGN KEY (`ID_PERFIL` )
    REFERENCES `JBS_METALURGICA`.`PERFIL` (`ID_PERFIL` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;



-- -----------------------------------------------------
-- Table `JBS_METALURGICA`.`funcionario`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `JBS_METALURGICA`.`FUNCIONARIO` (
  `ID_FUNCIONARIO` INT(11) NOT NULL AUTO_INCREMENT ,
  `NOME` VARCHAR(60) NOT NULL ,
  `CPF` VARCHAR(16) NOT NULL ,
  `EMAIL` VARCHAR(50) NULL DEFAULT NULL ,
  `CELULAR` VARCHAR(16) NOT NULL ,
  `RUA` VARCHAR(60) NOT NULL ,
  `NUMERO` INT(6) NULL DEFAULT NULL ,
  `BAIRRO` VARCHAR(60) NOT NULL ,
  `CEP` VARCHAR(12) NOT NULL ,
  `ID_LOCAL` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`ID_FUNCIONARIO`) ,
  INDEX `ID_LOCAL` (`ID_LOCAL` ASC) ,
  CONSTRAINT `FK_FUNCIONARIO_LOCALIDADE`
    FOREIGN KEY (`ID_LOCAL` )
    REFERENCES `JBS_METALURGICA`.`LOCALIDADE` (`ID_LOCALIDADE` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `JBS_METALURGICA`.`orcamento`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `JBS_METALURGICA`.`ORCAMENTO` (
  `ID_ORCAMENTO` INT(11) NOT NULL AUTO_INCREMENT ,
  `DATA_ORCAMENTO` DATE NULL DEFAULT NULL ,
  `CONFIRMADO` CHAR(3) NOT NULL ,
  `ID_FUNCIONARIO` INT(11) NULL DEFAULT NULL ,
  `ID_CLIENTE` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`ID_ORCAMENTO`) ,
  INDEX `ID_FUNCIONARIO` (`ID_FUNCIONARIO` ASC) ,
  INDEX `ID_CLIENTE` (`ID_CLIENTE` ASC) ,
  CONSTRAINT `FK_ORCAMENTO_CLIENTE`
    FOREIGN KEY (`ID_CLIENTE` )
    REFERENCES `JBS_METALURGICA`.`CLIENTE` (`ID_CLIENTE` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_ORCAMENTO_FUNCIONARIO`
    FOREIGN KEY (`ID_FUNCIONARIO` )
    REFERENCES `JBS_METALURGICA`.`FUNCIONARIO` (`ID_FUNCIONARIO` ))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `JBS_METALURGICA`.`item_orcamento`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `JBS_METALURGICA`.`ITEM_ORCAMENTO` (
  `ID_ITEM_ORCAMENTO` INT(11) NOT NULL AUTO_INCREMENT ,
  `QUANTIDADE` INT(10) NULL DEFAULT NULL ,
  `ALTURA` FLOAT NULL DEFAULT NULL ,
  `LARGURA` FLOAT NULL DEFAULT NULL ,
  `VALOR_UNITARIO` FLOAT NULL DEFAULT NULL ,
  `COR` VARCHAR(25) NOT NULL ,
  `ID_ORCAMENTO` INT(11) NULL DEFAULT NULL ,
  `ID_ESQUADRIA` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`ID_ITEM_ORCAMENTO`) ,
  INDEX `ID_ORCAMENTO` (`ID_ORCAMENTO` ASC) ,
  INDEX `ID_ESQUADRIA` (`ID_ESQUADRIA` ASC) ,
  CONSTRAINT `FK_ITEM_ORCAMENTO_ESQUADRIA`
    FOREIGN KEY (`ID_ESQUADRIA` )
    REFERENCES `JBS_METALURGICA`.`ESQUADRIA` (`ID_ESQUADRIA` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_ITEM_ORCAMENTO_ORCAMENTO`
    FOREIGN KEY (`ID_ORCAMENTO` )
    REFERENCES `JBS_METALURGICA`.`ORCAMENTO` (`ID_ORCAMENTO` ))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `JBS_METALURGICA`.`perfil`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `JBS_METALURGICA`.`PERFIL` (
  `ID_PERFIL` INT(11) NOT NULL AUTO_INCREMENT ,
  `DESCRICAO` VARCHAR(80) NULL DEFAULT NULL ,
  `PESO_POR_METRO` FLOAT NULL DEFAULT NULL ,
  PRIMARY KEY (`ID_PERFIL`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `JBS_METALURGICA`.`medida`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `JBS_METALURGICA`.`PRODUTO` (
  `ID_PRODUTO` INT(11) NOT NULL AUTO_INCREMENT ,
  `VALOR` FLOAT NULL DEFAULT NULL ,
  `ID_ESQUADRIA` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`ID_PRODUTO`) ,
  INDEX `ID_ESQUADRIA` (`ID_ESQUADRIA` ASC) ,
  CONSTRAINT `FK_PRODUTO_ESQUADRIA`
    FOREIGN KEY (`ID_ESQUADRIA` )
    REFERENCES `JBS_METALURGICA`.`ESQUADRIA` (`ID_ESQUADRIA` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `JBS_METALURGICA`.`usuarios`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `JBS_METALURGICA`.`USUARIOS` (
  `ID_USUARIOS` INT(11) NOT NULL AUTO_INCREMENT ,
  `LOGIN` VARCHAR(60) NOT NULL ,
  `SENHA` VARCHAR(16) NOT NULL ,
  `NIVEL_ACESSO` INT(2) NULL DEFAULT NULL ,
  `ATIVO` INT(2) NULL DEFAULT NULL ,
  `ID_FUNCIONARIO` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`ID_USUARIOS`) ,
  INDEX `ID_FUNCIONARIO` (`ID_FUNCIONARIO` ASC) ,
  CONSTRAINT `FK_USUARIOS_FUNCIONARIO`
    FOREIGN KEY (`ID_FUNCIONARIO` )
    REFERENCES `JBS_METALURGICA`.`FUNCIONARIO` (`ID_FUNCIONARIO` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 17
DEFAULT CHARACTER SET = latin1;

USE `JBS_METALURGICA` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;