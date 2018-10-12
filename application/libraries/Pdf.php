<?php
/*
* Author: onlinecode.org
* start Pdf.php file
* Location: ./application/libraries/Pdf.php
*/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';
class Pdf extends TCPDF{
    function __construct(){
        parent::__construct();
    }

    //Page header
    public function Header() {
        $image_file = K_PATH_IMAGES.'llogo.jpg';
        $this->Image($image_file, 36, 10, 64, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $this->SetFont('times', '', 8);
        $html = '<b>SUPPLY, PROCUREMENT AND PROPERTY<br>MANAGEMENT OFFICE (SPPMO)</b><br>Visca, Visayas State University<br>Visca, Baybay City, Leyte PHILIPPINES<br>Phone/Fax: +63 53 563-7190
        ';

        $this->writeHTMLCell(60, 0, 125, '', $html, 0, 1, 0, true, '', true);

        $complex_cell_border = array(
           'B' => array('width' => 0.3, 'color' => 'black', 'line' => 4)
        );

        $this->Cell(0,0,"", $complex_cell_border);
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
}
/* end Pdf.php file */
