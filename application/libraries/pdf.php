<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Ferdynand
 * Date: 3/18/18
 * Time: 11:09 PM
 */

require_once APPPATH."third_party/fpdf181/fpdf.php";
class pdf extends FPDF
{
    public function __construct($orientation = 'P', $unit = 'mm', $size = 'A4')
    {
        parent::__construct($orientation, $unit, $size);
    }

    public function Header(){
        //$this->Image(base_url().'assets/imagenes/logo.png',10,8,22);
        $this->SetFont('Arial','B',13);
        $this->Cell(30);
        $this->Cell(120,10,'ESCUELA X',0,0,'C');
        $this->Ln('5');
        $this->SetFont('Arial','B',8);
        $this->Cell(30);
        $this->Cell(120,10,'INFORMACION DE CONTACTO',0,0,'C');
        $this->Ln(20);
    }
    // El pie del pdf
    public function Footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }

}