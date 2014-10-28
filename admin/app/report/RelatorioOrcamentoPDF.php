<?php

date_default_timezone_set("America/Sao_Paulo");

require_once('Util.php');
require_once('RelatorioOrcamento.php');

class RelatorioOrcamentoPDF extends FPDFTable
{
  public $rel;
  public $id;
	
  function RelatorioOrcamentoPDF( $id ) {
    $this->rel = new RelatorioOrcamento( $id );
	$this->id = $id;
	
    $this->FPDF('P');
    $this->AliasNbPages();
    $this->AddPage();
    $this->show();
  }

  function Header() 
  {
	
	// linha 1
    $this->SetFont('Arial','BI',12);
	$this->Cell(30,6, utf8_decode(' '),0,0,'L');
	$this->Cell(130,6, utf8_decode('Relatorio de Orçamento - Esquadria JBS'),0,0,'C');
    $this->Cell(30,6, utf8_decode('(46) 9999-1212'),0,1,'L');
	
	$this->SetFont('Arial','',8);
    $this->Cell(40,6, utf8_decode(''),0,0,'C');
	$this->Cell(120,6, utf8_decode("Rua: Avelino Giasson, 15 - Parque do Som"),0,0,'C');
	$this->SetFont('Arial','BI',12);
	$this->Cell(30,6, utf8_decode('(46) 9999-0000'),0,1,'C');
	
	$this->SetFont('Arial','',8);
    $this->Cell(40,6, utf8_decode(''),0,0,'C');
	$this->Cell(108,6, utf8_decode("Pedido de Venda - " . Utils::addZeros($this->id, 5)),0,0,'L');
	$this->Cell(21,6, utf8_decode("Data: ".date('d/m/Y'). ","),0,0,'C');
	$this->Cell(21,6, utf8_decode("Hora: ".date('H:i:s')),0,1,'R');
	// $this->Line(10, 29, 200, 29);
	
	$cab = $this->rel->cabecalho(); 
	
	$this->SetFont('Arial','',8);
    $this->Cell(0,6, utf8_decode('Funcionário(a): ' . $cab['NOME'] . ' - Email: ' . $cab['EMAIL'] .' - Celular: '. $cab['CELULAR']),'T',1,'L');
    
	// informacoes do cliente
    $this->Cell(80,7, 'Cliente: ' . $cab['CLIENTE'],'T',0,'L');
    $this->Cell(30,7, 'Telefone: ' . $cab['CLIENTE_TELEFONE'], 'T',0,'R');
	$this->Cell(30,7, 'Celular: ' . $cab['CLIENTE_CELULAR'], 'T',0,'R');
    $this->Cell(50,7, 'Email:'. $cab['CLIENTE_EMAIL'], 'T',1,'R');
    
    $this->Cell(40,7, 'CPF/CNPJ: ' . $cab['CPF_CNPJ'],'B',0,'L');
    $this->Cell(110,7, utf8_decode('Endereço: ') . $cab['RUA'].', '.$cab['NUMERO'].' - '.$cab['BAIRRO'],'B',0,'L');
    $this->Cell(40,7, 'Localidadde: ' . $cab['CIDADE'], 'B',1,'L');
    
	// itens do orcamento

    $this->SetTextColor(0,0,0);
    $this->SetFillColor(255,255,255);
    
    $this->SetFont('Arial','BI',10);
    $this->Cell(0,6, utf8_decode('Itens do Orçamento'),0,1,'C');
  
    $this->SetFont('Arial','',10);
    $this->Cell(10,7, utf8_decode('Cód.'),'BT',0,'R');
    $this->Cell(80,7, 'Esquadria','BT',0,'C');
    $this->Cell(20,7, 'Qtde','BT',0,'R');
    $this->Cell(20,7, 'Altura','BT',0,'R');
    $this->Cell(20,7, 'Largura','BT',0,'R');
    $this->Cell(40,7, 'Valor','BT',1,'R');
	
  	$this->Image(FPDF . DS . 'logo.png', 10, 12, 40);
  }

  function Footer()
  {
    $this->SetY(-15);
    $this->SetFont('Arial','I',8);
    $this->Cell(70,10,'Impresso em: ' . date('d/m/Y H:i:s'),0,0,'L');
    $this->Cell(50,10,$this->PageNo().' / {nb}',0,0,'C');
    $this->Cell(70,10,'Metalurgica vs 0.0.1',0,1,'R');
  }

  public function show()
  {
  	$qtd= 0;
	$vlr= 0;
    foreach($this->rel->itensOrcamentos() as $key => $values) {
		$this->Cell(10,7, Utils::addZeros($values['CODIGO'], 4),'',0,'R');
		$this->Cell(80,7, $values['DESCRICAO'],'',0,'C');
		$this->Cell(20,7,  Utils::formatCurrencyBr($values['QUANTIDADE']),'',0,'R');
		$this->Cell(20,7,  Utils::formatCurrencyBr($values['ALTURA']),'',0,'R');
		$this->Cell(20,7,  Utils::formatCurrencyBr($values['LARGURA']),'',0,'R');
		$this->Cell(40,7, 'R$ ' . Utils::formatCurrencyBr($values['VALOR_UNITARIO']),'',1,'R');
		
		$qtd += $values['QUANTIDADE'];
		$vlr += $values['VALOR_UNITARIO'];
    }
	
	$this->Cell(10,7, utf8_decode(''),'BT',0,'R');
    $this->Cell(80,7, '','BT',0,'C');
    $this->Cell(20,7, Utils::formatCurrencyBr($qtd),'BT',0,'R');
    $this->Cell(20,7, '','BT',0,'R');
    $this->Cell(20,7, '','BT',0,'R');
    $this->Cell(40,7,'R$ '. Utils::formatCurrencyBr($vlr),'BT',1,'R');
	
	$this->Ln(20);
	
	$this->Cell(30,6, utf8_decode(''),'',0,'C');
	$this->Cell(50,6, utf8_decode("Visto do Cliente"),'T',0,'C');
	$this->Cell(30,6, utf8_decode(''),'',0,'C');
	$this->Cell(50,6, utf8_decode("Visto do Funcionário"),'T',0,'C');
	$this->Cell(30,6, utf8_decode(''),'',1,'C');

  }
}
