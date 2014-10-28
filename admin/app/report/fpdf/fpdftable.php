<?php

defined('DS')
	|| define('DS', DIRECTORY_SEPARATOR);

defined('ROOT')
	|| define('ROOT', realpath(dirname(__FILE__)));

defined('FPDF')
	|| define('FPDF', realpath(ROOT . DS . "fpdf"));

require_once( FPDF . DS . 'fpdf.php' );

class FPDFTable extends FPDF
{
	var $widths;
	var $aligns;

	function SetWidths($w)
	{
		//Set the array of column widths
		$this->widths=$w;
	}

	function SetAligns($a)
	{
		//Set the array of column alignments
		$this->aligns=$a;
	}

	function LinhaEspecial($data)
	{
		//Calculate the height of the row
		$nb=0;
		for($i=0;$i<count($data);$i++)
			$nb=max($nb, $this->NbLines($this->widths[$i], $data[$i]));
		$h=(5*$nb)+5;
		//Issue a page break first if needed
		$this->CheckPageBreak($h);
		//Draw the cells of the row
		for($i=0;$i<count($data);$i++)
		{
			$w=$this->widths[$i];
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			//Save the current position
			$x=$this->GetX();
			$y=$this->GetY();
			//if ( !empty($data[$i]) ) {
				//Draw the border
			//	$this->Rect($x, $y-5, $w, $h);
			//}
			if ( $i == 0 || $i == 4 )
				$this->Line($x, $y-5, $x, $h+$y-5);
			if ( $i == 2 || $i == 6 )
				$this->Line($x+5, $y-5, $x+5, $h+$y-5);
			if ( $i == 1 || $i == 5 )
				$this->Line($x-5, $y+$h-5, $w+$x+5, $y+$h-5);

			//Print the text
			$this->MultiCell($w, 5, $data[$i], 0, $a);
			//Put the position to the right of the cell
			$this->SetXY($x+$w, $y);
		}
		//Go to the next line
		$this->Ln($h-5);
	}

	function Row($data)
	{
		//Calculate the height of the row
		$nb=0;
		for($i=0;$i<count($data);$i++)
			$nb=max($nb, $this->NbLines($this->widths[$i], $data[$i]));
		$h=(5*$nb)+5;
		//Issue a page break first if needed
		$this->CheckPageBreak($h);
		//Draw the cells of the row
		for($i=0;$i<count($data);$i++)
		{
			$w=$this->widths[$i];
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			//Save the current position
			$x=$this->GetX();
			$y=$this->GetY();
			if ( !empty($data[$i]) ) {
				//Draw the border
				$this->Rect($x, $y-5, $w, $h);
			}
			//Print the text
			$this->MultiCell($w, 5, $data[$i], 0, $a);
			//Put the position to the right of the cell
			$this->SetXY($x+$w, $y);
		}
		//Go to the next line
		$this->Ln($h-5);
	}


	function Detalhes($data, $title)
	{
		//Calculate the height of the row
		$nb=0;
		for($i=0;$i<count($data);$i++)
			$nb=max($nb, $this->NbLines($this->widths[$i], $data[$i]));
		$h=(5*$nb)+5;

		if ( $h < 20 ) { $h += 5; }

		//Issue a page break first if needed
		$this->CheckPageBreak($h);

		$this->SetFont('Arial','B',9);
		$this->Cell(020,5, '' ,0,0,'C');
		$this->Cell(126,5, $title,'LRB',0,'L', 'true');
		$this->Cell(030,5, '',0,0,'C');
		$this->Cell(030,5, '',0,1,'C');

		//Draw the cells of the row
		for($i=0;$i<count($data);$i++)
		{
			$w=$this->widths[$i];
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			//Save the current position
			$x=$this->GetX();
			$y=$this->GetY();
			if ( !empty($data[$i]) ) {
				//Draw the border
				$this->Rect($x, $y-5, $w, $h);
			}
			$this->SetFont('Arial','',10);
			if ( $i == 1 ) {
				$this->SetFont('Arial','',9);
			}

			$str = $data[$i];
			//if ( $h > 20 )
			//	$str = trim(preg_replace('/\s\s+/', ' ', $data[$i]));

			//Print the text
			$this->MultiCell($w, 5, $str, 0, $a);
			//Put the position to the right of the cell
			$this->SetXY($x+$w, $y);
		}
		//Go to the next line
		$this->Ln($h-5);
	}

	function DetalhesA($data, $title, $cortesia)
	{
		//Calculate the height of the row
		$nb=0;
		for($i=0;$i<count($data);$i++)
			$nb=max($nb, $this->NbLines($this->widths[$i], $data[$i]));
		$h=(5*$nb)+5;
		//Issue a page break first if needed
		$this->CheckPageBreak($h);

		$this->SetFont('Arial','B',9);
		if ( $cortesia == '1' ) {
			$this->Cell(020,5, '' ,0,0,'C');
			$this->Cell(154,5, $title,'LB',0,'L', 'true');
			$this->Cell(024,5, '',0,1,'C', 'true');
		} else {
			$this->Cell(020,5, '' ,0,0,'C');
			$this->Cell(174,5, $title,'LRB',1,'L', 'true');
		}

		// $this->Cell(030,5, '',0,1,'C');

		//Draw the cells of the row
		for($i=0;$i<count($data);$i++)
		{
			$w=$this->widths[$i];
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			//Save the current position
			$x=$this->GetX();
			$y=$this->GetY();

			if ( $cortesia != '1' ) {
				$this->Rect($x, $y-5, $w, $h);
			} else {
				if ( $i == 0 ) {
					$this->Rect($x, $y-5, $w, $h);
				} else if ( $i == 2 ) {
					$this->Line($x+$w, $y-5, $x+$w, $y+$h-5);
				}
			}
			$this->SetFont('Arial','',10);
			if ( $i == 1 ) {
				$this->SetFont('Arial','',9);
			}
			//Print the text
			$this->MultiCell($w, 5, $data[$i], 0, $a);
			//Put the position to the right of the cell
			$this->SetXY($x+$w, $y);
		}
		//Go to the next line
		$this->Ln($h-5);
	}

	function Valores($data)
	{
		//Calculate the height of the row
		$nb=0;
		for($i=0;$i<count($data);$i++)
			$nb=max($nb, $this->NbLines($this->widths[$i], $data[$i]));
		$h=(5*$nb);
		//Issue a page break first if needed
		$this->CheckPageBreak($h);
		//Draw the cells of the row
		for($i=0;$i<count($data);$i++)
		{
			$w=$this->widths[$i];
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			//Save the current position
			$x=$this->GetX();
			$y=$this->GetY();
			if ( !empty($data[$i]) ) {
				$this->Rect($x, $y, $w, $h-5);
			}
			$this->SetFont('Arial','',8);
			$str = $data[$i];
			//Print the text
			$this->MultiCell($w, 5, $str, 0, $a);
			//Put the position to the right of the cell
			$this->SetXY($x+$w, $y);
		}
		//Go to the next line
		$this->Ln($h);
	}

	function Notas($data)
	{
		$nb=0;
		for($i=0;$i<count($data);$i++)
			$nb=max($nb, $this->NbLines($this->widths[$i], $data[$i]));
		$h=(5*$nb);

		$this->CheckPageBreak($h);

		for($i=0;$i<count($data);$i++)
		{
			$w=$this->widths[$i];
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';

			$x=$this->GetX();
			$y=$this->GetY();

			$this->Rect($x, $y, $w, $h);

			$this->SetFont('Arial','',8);
			$this->MultiCell($w, 5, $data[$i], 0, $a);
			$this->SetXY($x+$w, $y);
		}
		$this->Ln($h);
	}

	function CheckPageBreak($h)
	{
		//If the height h would cause an overflow, add a new page immediately
		if($this->GetY()+$h>$this->PageBreakTrigger)
			$this->AddPage($this->CurOrientation);
	}

	function NbLines($w, $txt)
	{
		//Computes the number of lines a MultiCell of width w will take
		$cw=&$this->CurrentFont['cw'];
		if($w==0)
			$w=$this->w-$this->rMargin-$this->x;
		$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
		$s=str_replace("\r", '', $txt);
		$nb=strlen($s);
		if($nb>0 and $s[$nb-1]=="\n")
			$nb--;
		$sep=-1;
		$i=0;
		$j=0;
		$l=0;
		$nl=1;
		while($i<$nb)
		{
			$c=$s[$i];
			if($c=="\n")
			{
				$i++;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
				continue;
			}
			if($c==' ')
				$sep=$i;
			$l+=$cw[$c];
			if($l>$wmax)
			{
				if($sep==-1)
				{
					if($i==$j)
						$i++;
				}
				else
					$i=$sep+1;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
			}
			else
				$i++;
		}
		return $nl;
	}
}
