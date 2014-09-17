SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `db_metalurgica` DEFAULT CHARACTER SET latin1 ;
USE `db_metalurgica` ;

-- -----------------------------------------------------
-- Table `db_metalurgica`.`localidade`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `db_metalurgica`.`localidade` (
  `ID_LOCALIDADE` INT(11) NOT NULL AUTO_INCREMENT ,
  `CIDADE` VARCHAR(30) NOT NULL ,
  `ESTADO` VARCHAR(30) NOT NULL ,
  `SIGLA` VARCHAR(4) NOT NULL ,
  PRIMARY KEY (`ID_LOCALIDADE`) )
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `db_metalurgica`.`cliente`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `db_metalurgica`.`cliente` (
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
  INDEX `ID_localidade` (`ID_LOCALIDADE` ASC) ,
  CONSTRAINT `fk_cliente_localidade`
    FOREIGN KEY (`ID_LOCALIDADE` )
    REFERENCES `db_metalurgica`.`localidade` (`ID_LOCALIDADE` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `db_metalurgica`.`esquadria`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `db_metalurgica`.`esquadria` (
  `ID_ESQUADRIA` INT(11) NOT NULL AUTO_INCREMENT ,
  `DESCRICAO` VARCHAR(80) NULL DEFAULT NULL ,
  `COLOCACAO` VARCHAR(10) NULL DEFAULT NULL ,
  PRIMARY KEY (`ID_ESQUADRIA`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `db_metalurgica`.`funcionario`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `db_metalurgica`.`funcionario` (
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
  INDEX `ID_local` (`ID_LOCAL` ASC) ,
  CONSTRAINT `fk_funcionario_localidade`
    FOREIGN KEY (`ID_LOCAL` )
    REFERENCES `db_metalurgica`.`localidade` (`ID_LOCALIDADE` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `db_metalurgica`.`orcamento`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `db_metalurgica`.`orcamento` (
  `ID_ORCAMENTO` INT(11) NOT NULL AUTO_INCREMENT ,
  `DATA_ORCAMENTO` DATE NULL DEFAULT NULL ,
  `CONFIRMADO` CHAR(3) NOT NULL ,
  `ID_FUNCIONARIO` INT(11) NULL DEFAULT NULL ,
  `ID_CLIENTE` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`ID_ORCAMENTO`) ,
  INDEX `ID_Funcionario` (`ID_FUNCIONARIO` ASC) ,
  INDEX `ID_Cliente` (`ID_CLIENTE` ASC) ,
  CONSTRAINT `fk_orcamento_cliente`
    FOREIGN KEY (`ID_CLIENTE` )
    REFERENCES `db_metalurgica`.`cliente` (`ID_CLIENTE` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_orcamento_funcionario`
    FOREIGN KEY (`ID_FUNCIONARIO` )
    REFERENCES `db_metalurgica`.`funcionario` (`ID_FUNCIONARIO` ))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `db_metalurgica`.`item_orcamento`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `db_metalurgica`.`item_orcamento` (
  `ID_ITEM_ORCAMENTO` INT(11) NOT NULL AUTO_INCREMENT ,
  `QUANTIDADE` INT(10) NULL DEFAULT NULL ,
  `ALTURA` FLOAT NULL DEFAULT NULL ,
  `LARGURA` FLOAT NULL DEFAULT NULL ,
  `VALOR_UNITARIO` FLOAT NULL DEFAULT NULL ,
  `COR` VARCHAR(25) NOT NULL ,
  `ID_ORCAMENTO` INT(11) NULL DEFAULT NULL ,
  `ID_ESQUADRIA` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`ID_ITEM_ORCAMENTO`) ,
  INDEX `ID_orcamento` (`ID_ORCAMENTO` ASC) ,
  INDEX `ID_esquadria` (`ID_ESQUADRIA` ASC) ,
  CONSTRAINT `fk_Item_Orcamento_esquadria`
    FOREIGN KEY (`ID_ESQUADRIA` )
    REFERENCES `db_metalurgica`.`esquadria` (`ID_ESQUADRIA` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Item_Orcamento_orcamento`
    FOREIGN KEY (`ID_ORCAMENTO` )
    REFERENCES `db_metalurgica`.`orcamento` (`ID_ORCAMENTO` ))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `db_metalurgica`.`perfil`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `db_metalurgica`.`perfil` (
  `ID_PERFIL` INT(11) NOT NULL AUTO_INCREMENT ,
  `DESCRICAO` VARCHAR(80) NULL DEFAULT NULL ,
  `PESO_POR_METRO` FLOAT NULL DEFAULT NULL ,
  PRIMARY KEY (`ID_PERFIL`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `db_metalurgica`.`medida`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `db_metalurgica`.`medida` (
  `ID_MEDIDA` INT(11) NOT NULL AUTO_INCREMENT ,
  `QUANTIDADE` INT(10) NULL DEFAULT NULL ,
  `DIMINUIR` FLOAT NULL DEFAULT NULL ,
  `AUMENTAR` FLOAT NULL DEFAULT NULL ,
  `DIVIDIR` FLOAT NULL DEFAULT NULL ,
  `MEDIDA_REFERENCIA` VARCHAR(10) NOT NULL ,
  `ID_ESQUADRIA` INT(11) NULL DEFAULT NULL ,
  `ID_PERFIL` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`ID_MEDIDA`) ,
  INDEX `ID_Esquadria` (`ID_ESQUADRIA` ASC) ,
  INDEX `ID_Perfil` (`ID_PERFIL` ASC) ,
  CONSTRAINT `fk_medida_esquadria`
    FOREIGN KEY (`ID_ESQUADRIA` )
    REFERENCES `db_metalurgica`.`esquadria` (`ID_ESQUADRIA` ),
  CONSTRAINT `fk_medida_perfil`
    FOREIGN KEY (`ID_PERFIL` )
    REFERENCES `db_metalurgica`.`perfil` (`ID_PERFIL` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `db_metalurgica`.`usuarios`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `db_metalurgica`.`usuarios` (
  `ID_USUARIOS` INT(11) NOT NULL AUTO_INCREMENT ,
  `LOGIN` VARCHAR(60) NOT NULL ,
  `SENHA` VARCHAR(16) NOT NULL ,
  `NIVEL_ACESSO` INT(2) NULL DEFAULT NULL ,
  `ATIVO` INT(2) NULL DEFAULT NULL ,
  `ID_FUNCIONARIO` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`ID_USUARIOS`) ,
  INDEX `ID_Funcionario` (`ID_FUNCIONARIO` ASC) ,
  CONSTRAINT `fk_usuarios_funcionario`
    FOREIGN KEY (`ID_FUNCIONARIO` )
    REFERENCES `db_metalurgica`.`funcionario` (`ID_FUNCIONARIO` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 17
DEFAULT CHARACTER SET = latin1;

USE `db_metalurgica` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
