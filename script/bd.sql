SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `db_metalurgica` DEFAULT CHARACTER SET latin1 ;
USE `db_metalurgica` ;

-- -----------------------------------------------------
-- Table `db_metalurgica`.`localidade`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `db_metalurgica`.`localidade` (
  `ID_localidade` INT(11) NOT NULL AUTO_INCREMENT ,
  `Cidade` VARCHAR(30) NOT NULL ,
  `Estado` VARCHAR(30) NOT NULL ,
  `Sigla` VARCHAR(4) NOT NULL ,
  PRIMARY KEY (`ID_localidade`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `db_metalurgica`.`cliente`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `db_metalurgica`.`cliente` (
  `ID_cliente` INT(11) NOT NULL AUTO_INCREMENT ,
  `Nome` VARCHAR(60) NOT NULL ,
  `CPF_CNPJ` VARCHAR(16) NOT NULL ,
  `Email` VARCHAR(50) NULL DEFAULT NULL ,
  `Telefone` VARCHAR(16) NULL DEFAULT NULL ,
  `Celular` VARCHAR(16) NOT NULL ,
  `Rua` VARCHAR(60) NOT NULL ,
  `Numero` INT(6) NULL DEFAULT NULL ,
  `Bairro` VARCHAR(60) NOT NULL ,
  `CEP` VARCHAR(12) NOT NULL ,
  `ID_localidade` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`ID_cliente`) ,
  INDEX `ID_localidade` (`ID_localidade` ASC) ,
  CONSTRAINT `fk_cliente_localidade`
    FOREIGN KEY (`ID_localidade` )
    REFERENCES `db_metalurgica`.`localidade` (`ID_localidade` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `db_metalurgica`.`esquadria`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `db_metalurgica`.`esquadria` (
  `ID_esquadria` INT(11) NOT NULL AUTO_INCREMENT ,
  `descricao` VARCHAR(80) NULL DEFAULT NULL ,
  `colocacao` VARCHAR(10) NULL DEFAULT NULL ,
  PRIMARY KEY (`ID_esquadria`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `db_metalurgica`.`Perfil`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `db_metalurgica`.`Perfil` (
  `ID_perfil` INT(11) NOT NULL AUTO_INCREMENT ,
  `descricao` FLOAT NULL ,
  `peso` INT(10) NULL DEFAULT NULL ,
  PRIMARY KEY (`ID_perfil`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `db_metalurgica`.`medida`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `db_metalurgica`.`medida` (
  `ID_medida` INT(11) NOT NULL AUTO_INCREMENT ,
  `Quantidade` INT(10) NULL DEFAULT NULL ,
  `Diminuir` FLOAT NULL DEFAULT NULL ,
  `Aumentar` FLOAT NULL DEFAULT NULL ,
  `Dividir` FLOAT NULL DEFAULT NULL ,
  `Medida_Referencia` VARCHAR(10) NOT NULL ,
  `Perfil_ID_perfil` INT(11) NOT NULL ,
  `esquadria_ID_esquadria` INT(11) NOT NULL ,
  PRIMARY KEY (`ID_medida`) ,
  INDEX `fk_medida_Perfil1_idx` (`Perfil_ID_perfil` ASC) ,
  INDEX `fk_medida_esquadria1_idx` (`esquadria_ID_esquadria` ASC) ,
  CONSTRAINT `fk_medida_Perfil1`
    FOREIGN KEY (`Perfil_ID_perfil` )
    REFERENCES `db_metalurgica`.`Perfil` (`ID_perfil` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_medida_esquadria1`
    FOREIGN KEY (`esquadria_ID_esquadria` )
    REFERENCES `db_metalurgica`.`esquadria` (`ID_esquadria` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `db_metalurgica`.`perfil`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `db_metalurgica`.`perfil` (
  `ID_perfil` INT(11) NOT NULL AUTO_INCREMENT ,
  `descricao` VARCHAR(80) NULL DEFAULT NULL ,
  `Peso_Por_Metro` FLOAT NULL DEFAULT NULL ,
  `Id_Medida` INT(11) NULL DEFAULT NULL ,
  `Id_Esquadria` INT(11) NULL DEFAULT NULL ,
  `Id_Falta` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`ID_perfil`) ,
  INDEX `Id_Falta_idx` (`Id_Falta` ASC) ,
  INDEX `Id_Esquadria_idx` (`Id_Esquadria` ASC) ,
  INDEX `Id_Medida_idx` (`Id_Medida` ASC) ,
  CONSTRAINT `fk_Perfil_esquadria`
    FOREIGN KEY (`Id_Esquadria` )
    REFERENCES `db_metalurgica`.`esquadria` (`ID_esquadria` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Perfil_medida`
    FOREIGN KEY (`Id_Medida` )
    REFERENCES `db_metalurgica`.`medida` (`ID_medida` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `Id_Falta`
    FOREIGN KEY (`Id_Falta` )
    REFERENCES `db_metalurgica`.`falta` (`ID_falta` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `db_metalurgica`.`falta`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `db_metalurgica`.`falta` (
  `ID_falta` INT(11) NOT NULL AUTO_INCREMENT ,
  `Tam_Falta` FLOAT NULL DEFAULT NULL ,
  `ID_Perfil` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`ID_falta`) ,
  INDEX `ID_Perfil` (`ID_Perfil` ASC) ,
  CONSTRAINT `fk_falta_perfil`
    FOREIGN KEY (`ID_Perfil` )
    REFERENCES `db_metalurgica`.`perfil` (`ID_perfil` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `db_metalurgica`.`fornecedor`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `db_metalurgica`.`fornecedor` (
  `ID_fornecedor` INT(11) NOT NULL AUTO_INCREMENT ,
  `Nome` VARCHAR(60) NOT NULL ,
  `Pessoa_Contato` VARCHAR(16) NOT NULL ,
  `Email` VARCHAR(50) NULL DEFAULT NULL ,
  `Celular` VARCHAR(16) NOT NULL ,
  `Rua` VARCHAR(60) NOT NULL ,
  `Numero` INT(6) NULL DEFAULT NULL ,
  `Bairro` VARCHAR(60) NOT NULL ,
  `CEP` VARCHAR(12) NOT NULL ,
  `ID_local` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`ID_fornecedor`) ,
  INDEX `ID_local` (`ID_local` ASC) ,
  CONSTRAINT `fk_fornecedor_localidade`
    FOREIGN KEY (`ID_local` )
    REFERENCES `db_metalurgica`.`localidade` (`ID_localidade` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `db_metalurgica`.`funcionario`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `db_metalurgica`.`funcionario` (
  `ID_funcionario` INT(11) NOT NULL AUTO_INCREMENT ,
  `Nome` VARCHAR(60) NOT NULL ,
  `CPF` VARCHAR(16) NOT NULL ,
  `Email` VARCHAR(50) NULL DEFAULT NULL ,
  `Celular` VARCHAR(16) NOT NULL ,
  `Rua` VARCHAR(60) NOT NULL ,
  `Numero` INT(6) NULL DEFAULT NULL ,
  `Bairro` VARCHAR(60) NOT NULL ,
  `CEP` VARCHAR(12) NOT NULL ,
  `ID_local` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`ID_funcionario`) ,
  INDEX `ID_local` (`ID_local` ASC) ,
  CONSTRAINT `fk_funcionario_localidade`
    FOREIGN KEY (`ID_local` )
    REFERENCES `db_metalurgica`.`localidade` (`ID_localidade` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `db_metalurgica`.`orcamento`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `db_metalurgica`.`orcamento` (
  `ID_orcamento` INT(11) NOT NULL AUTO_INCREMENT ,
  `Data_Orcamento` DATE NULL DEFAULT NULL ,
  `Confirmado` CHAR(3) NOT NULL ,
  `ID_Funcionario` INT(11) NULL DEFAULT NULL ,
  `ID_Cliente` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`ID_orcamento`) ,
  INDEX `ID_Funcionario` (`ID_Funcionario` ASC) ,
  INDEX `ID_Cliente` (`ID_Cliente` ASC) ,
  CONSTRAINT `fk_orcamento_cliente`
    FOREIGN KEY (`ID_Cliente` )
    REFERENCES `db_metalurgica`.`cliente` (`ID_cliente` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_orcamento_funcionario`
    FOREIGN KEY (`ID_Funcionario` )
    REFERENCES `db_metalurgica`.`funcionario` (`ID_funcionario` ))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `db_metalurgica`.`item_orcamento`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `db_metalurgica`.`item_orcamento` (
  `ID_Item_Orcamento` INT(11) NOT NULL AUTO_INCREMENT ,
  `Quantidade` INT(10) NULL DEFAULT NULL ,
  `Altura` FLOAT NULL DEFAULT NULL ,
  `Largura` FLOAT NULL DEFAULT NULL ,
  `Valor_Unitario` FLOAT NULL DEFAULT NULL ,
  `Cor_Aluminio` VARCHAR(25) NOT NULL ,
  `orcamento_ID_orcamento` INT(11) NOT NULL ,
  `esquadria_ID_esquadria` INT(11) NOT NULL ,
  PRIMARY KEY (`ID_Item_Orcamento`) ,
  INDEX `fk_item_orcamento_orcamento1_idx` (`orcamento_ID_orcamento` ASC) ,
  INDEX `fk_item_orcamento_esquadria1_idx` (`esquadria_ID_esquadria` ASC) ,
  CONSTRAINT `fk_item_orcamento_orcamento1`
    FOREIGN KEY (`orcamento_ID_orcamento` )
    REFERENCES `db_metalurgica`.`orcamento` (`ID_orcamento` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_item_orcamento_esquadria1`
    FOREIGN KEY (`esquadria_ID_esquadria` )
    REFERENCES `db_metalurgica`.`esquadria` (`ID_esquadria` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `db_metalurgica`.`pedido_esquadria`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `db_metalurgica`.`pedido_esquadria` (
  `ID_Pedido_Esquadria` INT(11) NOT NULL AUTO_INCREMENT ,
  `Altura` FLOAT NULL DEFAULT NULL ,
  `Largura` FLOAT NULL DEFAULT NULL ,
  `Peso_Unitario` FLOAT NULL DEFAULT NULL ,
  `ID_Esquadria` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`ID_Pedido_Esquadria`) ,
  INDEX `ID_Esquadria` (`ID_Esquadria` ASC) ,
  CONSTRAINT `fk_Pedido_Esquadria_esquadria`
    FOREIGN KEY (`ID_Esquadria` )
    REFERENCES `db_metalurgica`.`esquadria` (`ID_esquadria` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `db_metalurgica`.`perfil_unitario`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `db_metalurgica`.`perfil_unitario` (
  `ID_Perfil_Unitario` INT(11) NOT NULL AUTO_INCREMENT ,
  `Tamanho` FLOAT NULL DEFAULT NULL ,
  `Quantidade` INT(10) NULL DEFAULT NULL ,
  `Id_Cont_Estoque` INT(11) NULL DEFAULT NULL ,
  `ID_Perfil` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`ID_Perfil_Unitario`) ,
  INDEX `ID_Perfil` (`ID_Perfil` ASC) ,
  CONSTRAINT `fk_Perfil_unitario_Perfil`
    FOREIGN KEY (`ID_Perfil` )
    REFERENCES `db_metalurgica`.`perfil` (`ID_perfil` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `db_metalurgica`.`perfil_utilizar`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `db_metalurgica`.`perfil_utilizar` (
  `ID_Perfil_Utilizar` INT(11) NOT NULL AUTO_INCREMENT ,
  `Tam_Utilizado` FLOAT NULL DEFAULT NULL ,
  `Peso_Utilizado` FLOAT NULL DEFAULT NULL ,
  `Qtd_Utilizada` INT(10) NULL DEFAULT NULL ,
  `ID_Pedido_esquadria` INT(11) NULL DEFAULT NULL ,
  `ID_Perfil` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`ID_Perfil_Utilizar`) ,
  INDEX `ID_Pedido_esquadria` (`ID_Pedido_esquadria` ASC) ,
  INDEX `ID_Perfil` (`ID_Perfil` ASC) ,
  CONSTRAINT `fk_Perfil_Utilizar_Ped_Esquadria`
    FOREIGN KEY (`ID_Pedido_esquadria` )
    REFERENCES `db_metalurgica`.`pedido_esquadria` (`ID_Pedido_Esquadria` ),
  CONSTRAINT `fk_Perfil_Utilizar_Perfil`
    FOREIGN KEY (`ID_Perfil` )
    REFERENCES `db_metalurgica`.`perfil` (`ID_perfil` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `db_metalurgica`.`usuarios`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `db_metalurgica`.`usuarios` (
  `ID_usuarios` INT(11) NOT NULL AUTO_INCREMENT ,
  `Login` VARCHAR(60) NOT NULL ,
  `Senha` VARCHAR(16) NOT NULL ,
  `Nivel_Acesso` INT(2) NULL DEFAULT NULL ,
  `Ativo` INT(2) NULL DEFAULT NULL ,
  `ID_Funcionario` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`ID_usuarios`) ,
  INDEX `ID_Funcionario` (`ID_Funcionario` ASC) ,
  CONSTRAINT `fk_usuarios_funcionario`
    FOREIGN KEY (`ID_Funcionario` )
    REFERENCES `db_metalurgica`.`funcionario` (`ID_funcionario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = latin1;

USE `db_metalurgica` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
