<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Property extends CI_Controller{
    function __construct(){
        parent::__construct();

        // add library of Pdf
        $this->load->library('Pdf3');
        //$this->load->library('PdfICS');
        /*if(!$this->session->userdata('sppmo')){
            redirect('error/showError403');
        }*/
    }
    function index(){
                // coder for CodeIgniter TCPDF Integration
        $tcpdf = new Pdf('L', 'mm', 'A4', true, 'UTF-8', false);
        // Set Title
        $tcpdf->SetTitle('Pdf Example onlinecode');
        // Set Header Margin
        $tcpdf->SetHeaderMargin(30);
        // Set Top Margin
        $tcpdf->SetTopMargin(20);
        // set Footer Margin
        $tcpdf->setFooterMargin(20);
        // Set Auto Page Break
        $tcpdf->SetAutoPageBreak(true);
        // Set Author
        $tcpdf->SetAuthor('onlinecode');
        // Set Display Mode
        $tcpdf->SetDisplayMode('real', 'default');
        // Set Write text
        $tcpdf->Write(5, 'CodeIgniter TCPDF Integration - onlinecode');
        // Set Output and file name
        $tcpdf->Output('tcpdfexample-onlinecode.pdf', 'I');
    }

    public function printProp(){
        // coder for CodeIgniter TCPDF Integration
        // make new advance pdf document
        $tcpdf = new Pdf3(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $tcpdf->SetCreator('SPPMO');
        $tcpdf->SetAuthor('SPPMO');
        $tcpdf->SetSubject('');

        // set default margins
        $tcpdf->SetMargins('3', '20', '3');
        // Set Header Margin
        $tcpdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        // Set Footer Margin
        $tcpdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto for page breaks
        $tcpdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image for scale factor
        $tcpdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // it is optional :: set some language-dependent strings
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')){
            // optional
            require_once(dirname(__FILE__).'/lang/eng.php');
            // optional
            $tcpdf->setLanguageArray($l);
        }
        // set default font for subsetting mode
        $data=$this->supplyModel->forProp($this->input->post(NULL,TRUE));
        for($i=0;$i<count($data);$i++){
          $tcpdf->setFontSubsetting(true);
          $tcpdf->SetAutoPageBreak(TRUE, 0);
          $tcpdf->AddPage('L',array('200','127'));
          $tcpdf->SetFont('times', '', 8, '', true);
          $unitPrice=(float)$data[$i]['unitPrice'];
          $enduser=strtolower($data[$i]["firstName"]." ".mb_substr($data[$i]["middleName"], 0, 1, 'utf-8').". ".$data[$i]["surName"]." ".$data[$i]["suffixName"]);
          $yr= substr(mb_substr($data[$i]["dateIssued"], 0, 4),-2);
          $propNo=$data[$i]["code"].$data[$i]["subCode"]."-".$data[$i]["fundCode"]."-".$yr."-".$data[$i]["officeCode"]."-".$data[$i]["seq"];
          $desc = (strlen($data[$i]["equipmentDesc"]) > 70) ? substr($data[$i]["equipmentDesc"], 0, 70) . '...' : $data[$i]["equipmentDesc"];
          $set_html = '
          <br><br><div style="text-align: center;font-size:10"><b>PROPERTY CARD</b></div><br>
          <table>
            <tr>
              <td colspan="6" width="75%"><b>Entity Name:</b> <u>Visayas State University</u></td>
              <td colspan="2" width="25%"><b>Fund Cluster:</b> <u>'.$data[$i]["fundCode"].' '.$data[$i]["fundDesc"].'</u></td>
            </tr>
          </table>
          <table cellspacing="0" cellpadding="2" border="1" nobr="True">
            <thead>
              <tr rowspan="2">
                <td colspan="6" width="75%"><b>Property, Plant and Equipment:</b> '.$data[$i]["subDesc"].'</td>
                <td colspan="2" rowspan="2" width="25%"><b>Property Number:</b><div style="text-align: center">'.$propNo.'</div></td>
              </tr>
              <tr>
                <td colspan="6"><b>Description:</b> '.$desc.'</td>
              </tr>
              <tr>
                <td rowspan="2" width="8%"><b style="text-align: center">Date</b></td>
                <td rowspan="2" width="12%"><b style="text-align: center">Reference/<br>PAR No.</b></td>
                <td width="10%"><b style="text-align: center">Receipt</b></td>
                <td colspan="2" width="40%"><b style="text-align: center">Issue/Transfer/Disposal</b></td>
                <td width="10%"><b style="text-align: center">Balance</b></td>
                <td rowspan="2" width="10%"><b style="text-align: center">Amount</b></td>
                <td rowspan="2" width="10%"><b style="text-align: center">Remarks</b></td>
              </tr>
              <tr>
                <td width="10%"><b style="text-align: center">Qty.</b></td>
                <td width="10%"><b style="text-align: center">Qty.</b></td>
                <td width="30%"><b style="text-align: center">Office/Officer</b></td>
                <td width="10%"><b style="text-align: center">Qty.</b></td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td width="8%" style="text-align: center">'.$data[$i]['dateIssued'].'<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></td>
                <td width="12%" style="text-align: center">'.$data[$i]['parics'].'</td>
                <td width="10%" style="text-align: center">'.$data[$i]['qty'].'</td>
                <td width="10%" style="text-align: center">'.$data[$i]['qty'].'</td>
                <td width="30%" style="text-align: center">'.$data[$i]['officeAcronym']." ".ucwords($enduser).'</td>
                <td width="10%"></td>
                <td width="10%" style="text-align: center">'.number_format(round(($unitPrice*100)/100,2),2,'.',',').'</td>
                <td width="10%"></td>
              </tr>
            </tbody>
          </table>
          ';
          $tcpdf->writeHTMLCell(0, 0, '', '', $set_html, 0, 1, 0, true, '', true);
        }
        $tcpdf->SetTitle('Property Card ');
        // Close and yield PDF record
        // This technique has a few choices, check the source code documentation for more data.
        $tcpdf->Output('PC-'.$yr.'.pdf', 'I');
                // successfully created CodeIgniter TCPDF Integration
    }
  }
