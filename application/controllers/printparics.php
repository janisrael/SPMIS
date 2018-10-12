<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Printparics extends CI_Controller{
    function __construct(){
        parent::__construct();

        // add library of Pdf
        $this->load->library('Pdf');
        $this->load->library('Pdf2');
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

    public function pdfprint($areid){
      if(!$this->session->userdata('sppmo')){
          redirect('error/showError403','refresh');
      }
        // coder for CodeIgniter TCPDF Integration
        // make new advance pdf document
        $tcpdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $tcpdf->SetCreator('SPPMO');
        $tcpdf->SetAuthor('SPPMO');
        $tcpdf->SetSubject('');

        // set default margins
        $tcpdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
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
        $tcpdf->setFontSubsetting(true);


        //Set some substance to print
        $data="";
        $data['equipments']=$this->supplyModel->getEquipments($areid);
        $data['personDetails']=$this->supplyModel->getPersonDetails($areid);
        $data['supplyDetails']=$this->supplyModel->getSupplyDetails($areid);

        if($areid==""){
          $par="No Data";
          $eqptLength=1;
          $qty="No Data";
          $unit="No Data";
          $unitPrice="No Data";
          $desc="No Data";
          $propNo="No Data";
          $amt="No Data";
          $enduser="No Data";
          $position="No Data";
          $office="No Data";
          $dateIssued="No Data";
          $headPPO="No Data";
          $date="";
        }else{
          $par=$data['supplyDetails'][0]['parics'];
          $eqptLength=count($data['equipments']);
          $enduser=strtoupper($data['personDetails'][0]["firstName"]." ".mb_substr($data['personDetails'][0]["middleName"], 0, 1, 'utf-8').". ".$data['personDetails'][0]["surName"]." ".$data['personDetails'][0]["suffixName"]);
          $position=$data['personDetails'][0]['position'];
          $office=$data['personDetails'][0]['officeAcronym'];
          $date=explode("-",$data['supplyDetails'][0]["dateIssued"]);
          $month="";
          switch($date[1]){
            case "01":
              $month="January";
              break;
            case "02":
              $month="February";
              break;
            case "03":
              $month="March";
              break;
            case "04":
              $month="April";
              break;
            case "05":
              $month="May";
              break;
            case "06":
              $month="June";
              break;
            case "07":
              $month="July";
              break;
            case "08":
              $month="August";
              break;
            case "09":
              $month="September";
              break;
            case "10":
              $month="October";
              break;
            case "11":
              $month="November";
              break;
            case "12":
              $month="December";
              break;
          }
          $dateIssued=$month." ".$date[2].", ".$date[0];
          $headPPO=strtoupper($data['supplyDetails'][0]['firstName']." ".mb_substr($data['supplyDetails'][0]["middleName"], 0, 1, 'utf-8').". ".$data['supplyDetails'][0]['surName']." ".$data['supplyDetails'][0]["suffixName"]);
          $PO=$data['supplyDetails'][0]['poNumber'];
          $PR=$data['supplyDetails'][0]['prNumber'];
          $obligation=$data['supplyDetails'][0]['obligation'];
          $supplier="";
          $or="";
          $dateGiven="";
        }

        $isDoneAll=false;
        $equipCounter=0;
        while(!$isDoneAll){
          $tcpdf->AddPage('P','A4');
          $tcpdf->SetFont('times', '', 11, '', true);
          $set_html = '
          <br><br><div style="text-align: center;font-size:14"><b>PROPERTY ACKNOWLEDGEMENT RECEIPT</b></div>
          <div style="text-align: right"><b>PAR No.: '.$par.'</b></div>
          <table cellspacing="0" cellpadding="3" nobr="True">
            <thead>
              <tr style="text-align: center;font-size:12">
                <td width="6%" border="1"><b>Qty</b></td>
                <td width="11%" border="1"><b>Unit</b></td>
                <td width="43%" border="1"><b>Description</b></td>
                <td width="16%" border="1"><b>Unit Price</b></td>
                <td width="24%" border="1"><b>Property No.</b></td>
              </tr>
            </thead>
            <tbody>
            ';
            $equipLineAvail=20;
            while($eqptLength>$equipCounter && $equipLineAvail>0){
              $eid=$data['equipments'][$equipCounter]["equipmentID"];
              $data['specificEqpt']=$this->supplyModel->getSpecificEquipment($eid);
              $qty=(float)$data['specificEqpt'][0]["qty"];
              $unit=$data['specificEqpt'][0]["unit"];
              $unitPrice=(float)$data['specificEqpt'][0]["unitPrice"];
              $desc=$data['specificEqpt'][0]["equipmentDesc"];
              $yr= substr(mb_substr($data['supplyDetails'][0]["dateIssued"], 0, 4),-2);
              $propNo=$data['specificEqpt'][0]["code"].$data['specificEqpt'][0]["subCode"]."-".$data['supplyDetails'][0]["fundCode"]."-<br>".$yr."-".$data['specificEqpt'][0]["officeCode"]."-".$data['specificEqpt'][0]["seq"];
              $amt=number_format(round((($qty*$unitPrice)*100)/100,2),2,'.',',');

              $descChar=mb_strlen($desc, 'utf8');
              $equipLine=(ceil((($descChar/40)*100)/100))+1;
              if($equipLine<4 && $equipLine>0){
                $equipLine=4;
              }
              $equipLineAvail-=$equipLine;
              if($equipLineAvail<0){
                //$equipCounter--;
                continue;
              }
              $equipCounter++;
              $set_html .= '
                <tr height="5%">
                    <td width="6%" style="text-align: center" border="1"><br>'.$qty.'<br><br></td>
                    <td width="11%" style="text-align: center" border="1"><br>'.$unit.'</td>
                    <td width="43%" style="text-align: left" border="1"><br>'.$desc.'</td>
                    <td width="16%" style="text-align: right" border="1"><br>'.number_format(round(($unitPrice*100)/100,2),2,'.',',').'</td>
                    <td width="24%" style="text-align: left" border="1"><br>'.$propNo.'</td>
                </tr>
                <tr>
                    <td colspan="5" border="1"><b> Total Price: P '.$amt.'</b></td>
                </tr>
              ';
              $supplier=$data['supplyDetails'][0]['supplier'];
              $or=$data['supplyDetails'][0]['orNumber'];
              $dateGiven=$data['supplyDetails'][0]['dateGiven'];
            }
            if($eqptLength<=$equipCounter){
              $isDoneAll=true;
            }
            if($equipLineAvail<=0){
              $equipLineAvail+=$equipLine;
            }
            for($k=0;$k<$equipLineAvail;$k++){
                $set_html .= '
                <tr>
                <td style="border-left: 1px solid black"></td>
                <td style="border-left: 1px solid black"></td>
                <td style="border-left: 1px solid black"></td>
                <td style="border-left: 1px solid black"></td>
                <td style="border-left: 1px solid black;border-right: 1px solid black"></td>

              </tr>';
            }
            $set_html .= '
            </tbody>
            <tfoot>
              <tr>
                <td colspan="5" border="1">
                  <table>
                    <tr>
                      <td colspan="1" align="right"><b>Supplier:</b></td>
                      <td colspan="4"> '.$supplier.'</td>
                    </tr>
                    <tr>
                      <td colspan="1" align="right"><b>OR/INVOICE:</b></td>
                      <td colspan="4"> '.$or.'</td>
                    </tr>
                    <tr>
                      <td colspan="1" align="right"><b>Date:</b></td>
                      <td colspan="4"> '.$dateGiven.'</td>
                    </tr>
                    <tr>
                      <td colspan="1" align="right"><b>PO/PR No.:</b></td>
                      <td colspan="4"> '.$PO.'</td>
                    </tr>
                    <tr>
                      <td></td>
                      <td colspan="4"> '.$PR.'</td>
                    </tr>
                    <tr>
                      <td colspan="1" align="right"><b>Obligation:</b></td>
                      <td colspan="4"> '.$obligation.'</td>
                    </tr>
                    <tr>
                      <td colspan="1" align="right"><b>Office/Dept/Center:</b></td>
                      <td colspan="4"> '.$data['specificEqpt'][0]["officeAcronym"].'</td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td colspan="3" style="border-bottom:1px solid black;border-left:1px solid black">Received by:</td>
                <td colspan="2" style="border-bottom:1px solid black;border-right:1px solid black">Received from:</td>
              </tr>
              <tr>
                <td colspan="5" border="1">
                  <table>
                    <tr>
                      <td colspan="2" style="text-align:center">
                        <b><u><br><br>'.$enduser.'</u></b>
                        <br style="font-size: 9">Signature Over Printed Name
                        <u><br>'.$position."/".$office.'</u>
                        <br style="font-size: 9">Position/Office<br>
                        <br style="font-size: 9">Date
                      </td>
                      <td colspan="2" style="text-align:center">
                        <b><u><br><br>'.$headPPO.'</u></b>
                        <br style="font-size: 9">Signature Over Printed Name
                        <u><br>Head/Property Office</u>
                        <br style="font-size: 9">Position/Office
                        <u><br>'.$dateIssued.'</u>
                        <br style="font-size: 9">Date
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </tfoot>
          </table>
          ';
          //Print content utilizing writeHTMLCell()
          //$par=$tcpdf->getNumLines($set_html); //1024 break height
          //$set_html.="$par";
          //$tcpdf->writeHTMLCell(0, 0, '', '', $set_html, 0, 1, 0, true, '', true);
          //$set_html.=$remaining;

          $tcpdf->writeHTML($set_html, true,0,true);
        }
        $remaining=$tcpdf->getPageHeight() - $tcpdf->GetY() - $tcpdf->getBreakMargin();
        //$tcpdf->Write('',$remaining);
        $tcpdf->SetTitle('PAR '.$par);
        // Close and yield PDF record
        // This technique has a few choices, check the source code documentation for more data.
        $tcpdf->Output('par-'.$par.'.pdf', 'I');
                // successfully created CodeIgniter TCPDF Integration
    }

    public function pdfprintS($areid){
      if(!$this->session->userdata('sppmo')){
          redirect('error/showError403','refresh');
      }
        // coder for CodeIgniter TCPDF Integration
        // make new advance pdf document
        $tcpdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $tcpdf->SetCreator('SPPMO');
        $tcpdf->SetAuthor('SPPMO');
        $tcpdf->SetSubject('');

        // set default margins
        $tcpdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
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
        $tcpdf->setFontSubsetting(true);


        //Set some substance to print
        $data="";
        $data['equipments']=$this->supplyModel->getEquipments($areid);
        $data['personDetails']=$this->supplyModel->getPersonDetails($areid);
        $data['supplyDetails']=$this->supplyModel->getSupplyDetails($areid);

        if($areid==""){
          $par="No Data";
          $eqptLength=1;
          $qty="No Data";
          $unit="No Data";
          $unitPrice="No Data";
          $desc="No Data";
          $propNo="No Data";
          $amt="No Data";
          $enduser="No Data";
          $position="No Data";
          $office="No Data";
          $dateIssued="No Data";
          $headPPO="No Data";
          $date="";
        }else{
          $par=$data['supplyDetails'][0]['parics'];
          $eqptLength=count($data['equipments']);
          $enduser=strtoupper($data['personDetails'][0]["firstName"]." ".mb_substr($data['personDetails'][0]["middleName"], 0, 1, 'utf-8').". ".$data['personDetails'][0]["surName"]." ".$data['personDetails'][0]["suffixName"]);
          $position=$data['personDetails'][0]['position'];
          $office=$data['personDetails'][0]['officeAcronym'];
          $date=explode("-",$data['supplyDetails'][0]["dateIssued"]);
          $month="";
          switch($date[1]){
            case "01":
              $month="January";
              break;
            case "02":
              $month="February";
              break;
            case "03":
              $month="March";
              break;
            case "04":
              $month="April";
              break;
            case "05":
              $month="May";
              break;
            case "06":
              $month="June";
              break;
            case "07":
              $month="July";
              break;
            case "08":
              $month="August";
              break;
            case "09":
              $month="September";
              break;
            case "10":
              $month="October";
              break;
            case "11":
              $month="November";
              break;
            case "12":
              $month="December";
              break;
          }
          $dateIssued=$month." ".$date[2].", ".$date[0];
          $headPPO=strtoupper($data['supplyDetails'][0]['firstName']." ".mb_substr($data['supplyDetails'][0]["middleName"], 0, 1, 'utf-8').". ".$data['supplyDetails'][0]['surName']." ".$data['supplyDetails'][0]["suffixName"]);
          $PO=$data['supplyDetails'][0]['poNumber'];
          $PR=$data['supplyDetails'][0]['prNumber'];
          $obligation=$data['supplyDetails'][0]['obligation'];
          $supplier="";
          $or="";
          $dateGiven="";
        }

        $isDoneAll=false;
        $equipCounter=0;
        while(!$isDoneAll){
          $tcpdf->AddPage('P','A4');
          $tcpdf->SetFont('times', '', 11, '', true);
          $set_html = '
          <br><br><div style="text-align: center;font-size:14"><b>PROPERTY ACKNOWLEDGEMENT RECEIPT</b></div>
          <div style="text-align: right"><b>PAR No.: '.$par.'</b></div>
          <table cellspacing="0" cellpadding="3" nobr="True">
            <thead>
              <tr style="text-align: center;font-size:12">
                <td width="6%" border="1"><b>Qty</b></td>
                <td width="11%" border="1"><b>Unit</b></td>
                <td width="43%" border="1"><b>Description</b></td>
                <td width="16%" border="1"><b>Unit Price</b></td>
                <td width="24%" border="1"><b>Property No.</b></td>
              </tr>
            </thead>
            <tbody>
            ';
            $equipLineAvail=20;
            while($eqptLength>$equipCounter && $equipLineAvail>0){
              $eid=$data['equipments'][$equipCounter]["equipmentID"];
              $data['specificEqpt']=$this->supplyModel->getSpecificEquipment($eid);
              $qty=(float)$data['specificEqpt'][0]["qty"];
              $unit=$data['specificEqpt'][0]["unit"];
              $unitPrice=(float)$data['specificEqpt'][0]["unitPrice"];
              $desc=$data['specificEqpt'][0]["equipmentDesc"];
              $yr= substr(mb_substr($data['supplyDetails'][0]["dateIssued"], 0, 4),-2);
              $propNo=$data['specificEqpt'][0]["code"].$data['specificEqpt'][0]["subCode"]."-".$data['supplyDetails'][0]["fundCode"]."-<br>".$yr."-".$data['specificEqpt'][0]["officeCode"]."-".$data['specificEqpt'][0]["seq"];
              $amt=number_format(round((($qty*$unitPrice)*100)/100,2),2,'.',',');

              $descChar=mb_strlen($desc, 'utf8');
              $equipLine=(ceil((($descChar/40)*100)/100))+1;
              if($equipLine<4 && $equipLine>0){
                $equipLine=4;
              }
              $equipLineAvail-=$equipLine;
              if($equipLineAvail<0){
                //$equipCounter--;
                continue;
              }
              $equipCounter++;
              $set_html .= '
                <tr height="5%">
                    <td width="6%" style="text-align: center" border="1"><br>'.$qty.'<br><br></td>
                    <td width="11%" style="text-align: center" border="1"><br>'.$unit.'</td>
                    <td width="43%" style="text-align: left" border="1"><br>'.$desc.'</td>
                    <td width="16%" style="text-align: right" border="1"><br>'.number_format(round(($unitPrice*100)/100,2),2,'.',',').'</td>
                    <td width="24%" style="text-align: left" border="1"><br>'.$propNo.'</td>
                </tr>
                <tr>
                    <td colspan="5" border="1"><b> Total Price: P '.$amt.'</b></td>
                </tr>
              ';
              $supplier=$data['supplyDetails'][0]['supplier'];
              $or=$data['supplyDetails'][0]['orNumber'];
              $dateGiven=$data['supplyDetails'][0]['dateGiven'];
            }
            if($eqptLength<=$equipCounter){
              $isDoneAll=true;
            }
            if($equipLineAvail<=0){
              $equipLineAvail+=$equipLine;
            }
            for($k=0;$k<$equipLineAvail;$k++){
                $set_html .= '
                <tr>
                <td style="border-left: 1px solid black"></td>
                <td style="border-left: 1px solid black"></td>
                <td style="border-left: 1px solid black"></td>
                <td style="border-left: 1px solid black"></td>
                <td style="border-left: 1px solid black;border-right: 1px solid black"></td>

              </tr>';
            }
            $set_html .= '
            </tbody>
            <tfoot>
              <tr>
                <td colspan="5" border="1">
                  <table>
                    <tr>
                      <td colspan="1" align="right"><b>Supplier:</b></td>
                      <td colspan="4"> '.$supplier.'</td>
                    </tr>
                    <tr>
                      <td colspan="1" align="right"><b>OR/INVOICE:</b></td>
                      <td colspan="4"> '.$or.'</td>
                    </tr>
                    <tr>
                      <td colspan="1" align="right"><b>Date:</b></td>
                      <td colspan="4"> '.$dateGiven.'</td>
                    </tr>
                    <tr>
                      <td colspan="1" align="right"><b>PO/PR No.:</b></td>
                      <td colspan="4"> '.$PO.'</td>
                    </tr>
                    <tr>
                      <td></td>
                      <td colspan="4"> '.$PR.'</td>
                    </tr>
                    <tr>
                      <td colspan="1" align="right"><b>Obligation:</b></td>
                      <td colspan="4"> '.$obligation.'</td>
                    </tr>
                    <tr>
                      <td colspan="1" align="right"><b>Office/Dept/Center:</b></td>
                      <td colspan="4"> '.$data['specificEqpt'][0]["officeAcronym"].'</td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td colspan="3" style="border-bottom:1px solid black;border-left:1px solid black">Received by:</td>
                <td colspan="2" style="border-bottom:1px solid black;border-right:1px solid black">Received from:</td>
              </tr>
              <tr>
                <td colspan="5" border="1">
                  <table>
                    <tr>
                      <td colspan="2" style="text-align:center">
                        <b><u><br><br>ALICIA M. FLORES</u></b>
                        <br style="font-size: 9">Signature Over Printed Name
                        <u><br>Head/Property Office</u>
                        <br style="font-size: 9">Position/Office<br>
                        <br style="font-size: 9">Date
                      </td>
                      <td colspan="2" style="text-align:center">
                        <b><u><br><br>JUANCHO M. LAO</u></b>
                        <br style="font-size: 9">Signature Over Printed Name
                        <u><br>Administrative Aide VI/SPPMO</u>
                        <br style="font-size: 9">Position/Office
                        <u><br>'.$dateIssued.'</u>
                        <br style="font-size: 9">Date
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </tfoot>
          </table>
          ';
          //Print content utilizing writeHTMLCell()
          //$par=$tcpdf->getNumLines($set_html); //1024 break height
          //$set_html.="$par";
          //$tcpdf->writeHTMLCell(0, 0, '', '', $set_html, 0, 1, 0, true, '', true);
          //$set_html.=$remaining;

          $tcpdf->writeHTML($set_html, true,0,true);
        }
        $remaining=$tcpdf->getPageHeight() - $tcpdf->GetY() - $tcpdf->getBreakMargin();
        //$tcpdf->Write('',$remaining);
        $tcpdf->SetTitle('PAR '.$par);
        // Close and yield PDF record
        // This technique has a few choices, check the source code documentation for more data.
        $tcpdf->Output('parS-'.$par.'.pdf', 'I');
                // successfully created CodeIgniter TCPDF Integration
    }

    public function pdfprint2($areid){
        // coder for CodeIgniter TCPDF Integration
        // make new advance pdf document
        if(!$this->session->userdata('sppmo')){
            redirect('error/showError403','refresh');
        }
        $tcpdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $tcpdf->SetCreator('SPPMO');
        $tcpdf->SetAuthor('SPPMO');
        $tcpdf->SetSubject('');

        // set default margins
        $tcpdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
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
        $tcpdf->setFontSubsetting(true);


        //Set some substance to print
        $data="";
        $data['equipments']=$this->supplyModel->getEquipments($areid);
        $data['personDetails']=$this->supplyModel->getPersonDetails($areid);
        $data['supplyDetails']=$this->supplyModel->getSupplyDetails($areid);

        if($areid==""){
          $par="No Data";
          $eqptLength=1;
          $qty="No Data";
          $unit="No Data";
          $unitPrice="No Data";
          $desc="No Data";
          $propNo="No Data";
          $amt="No Data";
          $enduser="No Data";
          $position="No Data";
          $office="No Data";
          $dateIssued="No Data";
          $headPPO="No Data";
          $date="";
        }else{
          $par=$data['supplyDetails'][0]['parics'];
          $eqptLength=count($data['equipments']);
          $enduser=strtoupper($data['personDetails'][0]["firstName"]." ".mb_substr($data['personDetails'][0]["middleName"], 0, 1, 'utf-8').". ".$data['personDetails'][0]["surName"]." ".$data['personDetails'][0]["suffixName"]);
          $position=$data['personDetails'][0]['position'];
          $office=$data['personDetails'][0]['officeAcronym'];
          $date=explode("-",$data['supplyDetails'][0]["dateIssued"]);
          $month="";
          switch($date[1]){
            case "01":
              $month="January";
              break;
            case "02":
              $month="February";
              break;
            case "03":
              $month="March";
              break;
            case "04":
              $month="April";
              break;
            case "05":
              $month="May";
              break;
            case "06":
              $month="June";
              break;
            case "07":
              $month="July";
              break;
            case "08":
              $month="August";
              break;
            case "09":
              $month="September";
              break;
            case "10":
              $month="October";
              break;
            case "11":
              $month="November";
              break;
            case "12":
              $month="December";
              break;
          }
          $dateIssued=$month." ".$date[2].", ".$date[0];
          $headPPO=strtoupper($data['supplyDetails'][0]['firstName']." ".mb_substr($data['supplyDetails'][0]["middleName"], 0, 1, 'utf-8').". ".$data['supplyDetails'][0]['surName']." ".$data['supplyDetails'][0]["suffixName"]);
          $PO=$data['supplyDetails'][0]['poNumber'];
          $PR=$data['supplyDetails'][0]['prNumber'];
          $obligation=$data['supplyDetails'][0]['obligation'];
          $supplier="";
          $or="";
          $dateGiven="";
          $life="";
        }

        $isDoneAll=false;
        $equipCounter=0;
        while(!$isDoneAll){
          $tcpdf->SetFont('times', '', 11, '', true);
          $tcpdf->AddPage('P','A4');
          $set_html = '
          <br><br><div style="text-align: center;font-size:14"><b>INVENTORY CUSTODIAN SLIP</b></div>
          <div style="text-align: right"><b>ICS No.: '.$par.'</b></div>
          <table cellspacing="0" cellpadding="1"  nobr="True">
            <thead>
              <tr style="text-align: center;height:25;font-size:12">
                <td width="6%" border="1"><b>Qty</b></td>
                <td width="11%" border="1"><b>Unit</b></td>
                <td width="32%" border="1"><b>Description</b></td>
                <td width="16%" border="1"><b>Unit Price</b></td>
                <td width="24%" border="1"><b>Inventory Item No.</b></td>
                <td width="11%" border="1"><b>Estimated Life</b></td>
              </tr>
            </thead>
            <tbody>
            ';
            $equipLineAvail=20;
            while($eqptLength>$equipCounter && $equipLineAvail>0){
              $eid=$data['equipments'][$equipCounter]["equipmentID"];
              $data['specificEqpt']=$this->supplyModel->getSpecificEquipment($eid);
              $qty=(float)$data['specificEqpt'][0]["qty"];
              $unit=$data['specificEqpt'][0]["unit"];
              $unitPrice=(float)$data['specificEqpt'][0]["unitPrice"];
              $desc=$data['specificEqpt'][0]["equipmentDesc"];
              $yr= substr(mb_substr($data['supplyDetails'][0]["dateIssued"], 0, 4),-2);
              $propNo=$data['specificEqpt'][0]["code"].$data['specificEqpt'][0]["subCode"]."-".$data['supplyDetails'][0]["fundCode"]."- ".$yr."-".$data['specificEqpt'][0]["officeCode"]."-".$data['specificEqpt'][0]["seq"];
              $amt=number_format(round((($qty*$unitPrice)*100)/100,2),2,'.',',');
              $life=$data['specificEqpt'][0]["life"];

              $descChar=mb_strlen($desc, 'utf8');
              $equipLine=(ceil((($descChar/40)*100)/100))+1;
              if($equipLine<4){
                $equipLine=4;
              }
              $equipLineAvail-=$equipLine;
              if($equipLineAvail<0){
                //$equipCounter--;
                continue;
              }
              $equipCounter++;

              $set_html .= '
                <tr>
                    <td width="6%" style="text-align: center" border="1"><br>'.$qty.'<br><br></td>
                    <td width="11%" style="text-align: center" border="1"><br>'.$unit.'</td>
                    <td width="32%" style="text-align: left" border="1"><br>'.$desc.'</td>
                    <td width="16%" style="text-align: right" border="1"><br>'.number_format(round(($unitPrice*100)/100,2),2,'.',',').'</td>
                    <td width="24%" style="text-align: left" border="1"><br>'.$propNo.'</td>
                    <td width="11%" style="text-align: center" border="1"><br>'.$life.'</td>
                </tr>
                <tr>
                    <td colspan="6" border="1"><b> Total Price: P '.$amt.'</b></td>
                </tr>
              ';
              $supplier=$data['supplyDetails'][0]['supplier'];
              $or=$data['supplyDetails'][0]['orNumber'];
              $dateGiven=$data['supplyDetails'][0]['dateGiven'];
            }
            if($eqptLength<=$equipCounter){
              $isDoneAll=true;
            }
            if($equipLineAvail<=0){
              $equipLineAvail+=$equipLine;
            }
            for($k=0;$k<$equipLineAvail;$k++){
                $set_html .= '
                <tr>
                <td style="border-left: 1px solid black"></td>
                <td style="border-left: 1px solid black"></td>
                <td style="border-left: 1px solid black"></td>
                <td style="border-left: 1px solid black"></td>
                <td style="border-left: 1px solid black"></td>
                <td style="border-left: 1px solid black;border-right: 1px solid black"></td>

              </tr>';
            }
            $set_html .= '
            </tbody>
            <tfoot>
              <tr>
                <td colspan="6" border="1">
                  <table>
                    <tr>
                      <td colspan="1" align="right"><b>Supplier:</b></td>
                      <td colspan="4"> '.$supplier.'</td>
                    </tr>
                    <tr>
                      <td colspan="1" align="right"><b>OR/INVOICE:</b></td>
                      <td colspan="4"> '.$or.'</td>
                    </tr>
                    <tr>
                      <td colspan="1" align="right"><b>Date:</b></td>
                      <td colspan="4"> '.$dateGiven.'</td>
                    </tr>
                    <tr>
                      <td colspan="1" align="right"><b>PO/PR No.:</b></td>
                      <td colspan="4"> '.$PO.'</td>
                    </tr>
                    <tr>
                      <td></td>
                      <td colspan="4"> '.$PR.'</td>
                    </tr>
                    <tr>
                      <td colspan="1" align="right"><b>Obligation:</b></td>
                      <td colspan="4"> '.$obligation.'</td>
                    </tr>
                    <tr>
                      <td colspan="1" align="right"><b>Office/Dept/Center:</b></td>
                      <td colspan="4"> '.$data['specificEqpt'][0]["officeAcronym"].'</td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td colspan="3" style="border-bottom:1px solid black;border-left:1px solid black">Received by:</td>
                <td colspan="3" style="border-bottom:1px solid black;border-right:1px solid black">Received from:</td>
              </tr>
              <tr>
                <td colspan="6" border="1">
                  <table>
                    <tr>
                      <td colspan="2" style="text-align:center">
                        <b><u><br><br>'.$enduser.'</u></b>
                        <br style="font-size: 9">Signature Over Printed Name
                        <u><br>'.$position."/".$office.'</u>
                        <br style="font-size: 9">Position/Office<br>
                        <br style="font-size: 9">Date
                      </td>
                      <td colspan="2" style="text-align:center">
                        <b><u><br><br>'.$headPPO.'</u></b>
                        <br style="font-size: 9">Signature Over Printed Name
                        <u><br>Head/Property Office</u>
                        <br style="font-size: 9">Position/Office
                        <u><br>'.$dateIssued.'</u>
                        <br style="font-size: 9">Date
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </tfoot>
          </table>
          ';
          //Print content utilizing writeHTMLCell()
          //$par=$tcpdf->getNumLines($set_html); //1024 break height
          //$set_html.="$par";
          $tcpdf->writeHTMLCell(0, 0, '', '', $set_html, 0, 1, 0, true, '', true);
        }
        $tcpdf->SetTitle('ICS '.$par);
        // Close and yield PDF record
        // This technique has a few choices, check the source code documentation for more data.
        $tcpdf->Output('ICS-'.$par.'.pdf', 'I');
                // successfully created CodeIgniter TCPDF Integration
        }

    public function summaryPrintPAR($eid){
      // coder for CodeIgniter TCPDF Integration
      // make new advance pdf document
      $tcpdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

      // set document information
      $tcpdf->SetCreator('SPPMO');
      $tcpdf->SetAuthor('SPPMO');
      $tcpdf->SetSubject('');

      // set default margins
      $tcpdf->SetMargins("15", PDF_MARGIN_TOP, "10");
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
      $tcpdf->setFontSubsetting(true);


      //Set some substance to print
      /*$data="";
      $data['equipments']=$this->supplyModel->getEquipments($areid);
      $data['personDetails']=$this->supplyModel->getPersonDetails($areid);
      $data['supplyDetails']=$this->supplyModel->getSupplyDetails($areid);
      */
      $data['equipments']=$this->summaryModel->getSummary($eid);
      $data['personDetails']=$this->summaryModel->getPerson($eid);
      $data['head']=$this->summaryModel->getHead();

      //print_r($data["head"]);

      if($eid==""){
        $par="No Data";
        $eqptLength=1;
        $qty="No Data";
        $unit="No Data";
        $unitPrice="No Data";
        $desc="No Data";
        $propNo="No Data";
        $amt="No Data";
        $enduser="No Data";
        $position="No Data";
        $office="No Data";
        $dateIssued="No Data";
        $headPPO="No Data";
        $date="";
      }else{
        $eqptLength=count($data['equipments']);
        $enduser=strtoupper($data['personDetails'][0]["firstName"]." ".mb_substr($data['personDetails'][0]["middleName"], 0, 1, 'utf-8').". ".$data['personDetails'][0]["surName"]." ".$data['personDetails'][0]["suffixName"]);
        $position=$data['personDetails'][0]['position'];
        $office=$data['personDetails'][0]['officeAcronym'];
        $date=explode("-",$data['equipments'][0]["dateIssued"]);
        $month="";
        switch($date[1]){
          case "01":
            $month="January";
            break;
          case "02":
            $month="February";
            break;
          case "03":
            $month="March";
            break;
          case "04":
            $month="April";
            break;
          case "05":
            $month="May";
            break;
          case "06":
            $month="June";
            break;
          case "07":
            $month="July";
            break;
          case "08":
            $month="August";
            break;
          case "09":
            $month="September";
            break;
          case "10":
            $month="October";
            break;
          case "11":
            $month="November";
            break;
          case "12":
            $month="December";
            break;
        }
        $dateIssued=$month." ".$date[2].", ".$date[0];
        $headPPO=strtoupper($data['head'][0]['firstName']." ".mb_substr($data['head'][0]["middleName"], 0, 1, 'utf-8').". ".$data['head'][0]['surName']." ".$data['head'][0]["suffixName"]);
        $supplier="";
        $or="";
        $dateGiven="";
      }

      $isDoneAll=false;
      $equipCounter=0;
      while(!$isDoneAll){
        $tcpdf->AddPage('P','A4');
        $tcpdf->SetFont('times', '', 10, '', true);
        $set_html = '
        <br><br><div style="text-align: center;font-size:15"><b>SUMMARY</b></div>
        <b style="text-align: center;font-size:10">PROPERTY ACKNOWLEDGEMENT RECEIPT</b></div><br>
        <table cellspacing="0" cellpadding="2" nobr="True">
          <thead>
            <tr style="text-align: center;font-size:10">
              <td width="4%" style="border-left:1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;"><b>Qty</b></td>
              <td width="6%" style="border-left:1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;font-size:9"><b>Unit</b></td>
              <td width="29%" style="border-left:1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;"><b>Description</b></td>
              <td width="10%" style="border-left:1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;"><b>Date Acquired</b></td>
              <td width="19%" style="border-left:1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;"><b>Property No.</b></td>
              <td width="11%" style="border-left:1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;"><b>Unit Price</b></td>
              <td width="13%" style="border-left:1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;"><b>Total Amount</b></td>
              <td width="8%" style="border-left:1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;border-right: 1px solid black;"><b>PAR No.</b></td>
            </tr>
          </thead>
          <tbody>
          ';
          $equipLineAvail=26;
          while($eqptLength>$equipCounter && $equipLineAvail>0){
            $qty=(float)$data['equipments'][$equipCounter]["qty"];
            $unit=$data['equipments'][$equipCounter]["unit"];
            $unitPrice=(float)$data['equipments'][$equipCounter]["unitPrice"];
            $desc=$data['equipments'][$equipCounter]["equipmentDesc"];
            $yr= substr(mb_substr($data['equipments'][$equipCounter]["dateIssued"], 0, 4),-2);
            $propNo=$data['equipments'][$equipCounter]["code"].$data['equipments'][$equipCounter]["subCode"]."-".$data['equipments'][$equipCounter]["fundCode"]."-<br>";
            $propNo.=$yr."-".$data['equipments'][$equipCounter]["officeCode"]."-".$data['equipments'][$equipCounter]["seq"];
            $amt=number_format(round((($qty*$unitPrice)*100)/100,2),2,'.',',');

            $descChar=mb_strlen($desc, 'utf8');
            $equipLine=(ceil((($descChar/50)*100)/100));
            if($equipLine<2){
              $equipLine=2;
            }
            $equipLineAvail-=$equipLine;
            if($equipLineAvail<0){
              //$equipCounter--;
              continue;
            }
            $set_html .= '
              <tr height="5%">
                  <td width="4%" style="text-align: center;border-left:1px solid black;">'.$qty.'</td>
                  <td width="6%" style="text-align: center;border-left:1px solid black;">'.$unit.'</td>
                  <td width="29%" style="text-align: left;border-left:1px solid black;">'.$desc.'</td>
                  <td width="10%" style="text-align: center;border-left:1px solid black;">'.$data['equipments'][$equipCounter]["dateGiven"].'</td>
                  <td width="19%" style="text-align: left;border-left:1px solid black;">'.$propNo.'</td>
                  <td width="11%" style="text-align: right;border-left:1px solid black;">'.number_format(round(($unitPrice*100)/100,2),2,'.',',').'</td>
                  <td width="13%" style="text-align: right;border-left:1px solid black;">'.$amt.'</td>
                  <td width="8%" style="text-align: left;border-left:1px solid black;border-right: 1px solid black;">'.$data['equipments'][$equipCounter]["parics"].'</td>
              </tr>
            ';
            $dateGiven=$data['equipments'][0]['dateGiven'];
            $equipCounter++;
          }
            if($eqptLength<=$equipCounter){
              $set_html .= '
                <tr>
                <td style="border-left: 1px solid black;"></td>
                <td style="border-left: 1px solid black;"></td>
                <td style="border-left: 1px solid black;">********nothing follows********</td>
                <td style="border-left: 1px solid black;"></td>
                <td style="border-left: 1px solid black;"></td>
                <td style="border-left: 1px solid black;"></td>
                <td style="border-left: 1px solid black;"></td>
                <td style="border-left: 1px solid black;border-right: 1px solid black"></td>
                </tr>';
              $isDoneAll=true;
            }
            if($equipLineAvail<0){
              $equipLineAvail*=-1;
            }
            for($k=0;$k<$equipLineAvail;$k++){
              $set_html .= '
              <tr>
              <td style="border-left: 1px solid black"></td>
              <td style="border-left: 1px solid black"></td>
              <td style="border-left: 1px solid black"></td>
              <td style="border-left: 1px solid black"></td>
              <td style="border-left: 1px solid black"></td>
              <td style="border-left: 1px solid black"></td>
              <td style="border-left: 1px solid black"></td>
              <td style="border-left: 1px solid black;border-right: 1px solid black"></td>

            </tr>';
          }
          $set_html .= '
          <tr>
            <td colspan="8" style="border-top:1px solid black;border-bottom:1px solid black;border-left:1px solid black;border-right:1px solid black"><b>Summary from January 1, 2015 - '.date('F j, Y').' </b><i>*Temporary - All data are being updated</i></td>
          </tr>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="4" style="border-top:1px solid black;border-bottom:1px solid black;border-left:1px solid black">Received by:</td>
              <td colspan="4" style="border-top:1px solid black;border-bottom:1px solid black;border-right:1px solid black">Received from:</td>
            </tr>
            <tr>
              <td colspan="8" border="1">
                <table>
                  <tr>
                    <td colspan="2" style="text-align:center">
                      <b><u><br><br>'.$enduser.'</u></b>
                      <br style="font-size: 9">Signature Over Printed Name
                      <u><br>'.$position."/".$office.'</u>
                      <br style="font-size: 9">Position/Office<br>
                      <br style="font-size: 9">Date
                    </td>
                    <td colspan="2" style="text-align:center">
                      <b><u><br><br>'.$headPPO.'</u></b>
                      <br style="font-size: 9">Signature Over Printed Name
                      <u><br>Head, Property Office</u>
                      <br style="font-size: 9">Position/Office
                      <u><br>'.$dateIssued.'</u>
                      <br style="font-size: 9">Date
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </tfoot>
        </table>
        ';

        $tcpdf->writeHTML($set_html, true,0,true);
      }
      $remaining=$tcpdf->getPageHeight() - $tcpdf->GetY() - $tcpdf->getBreakMargin();
      $tcpdf->SetTitle('Summary PAR - '.$enduser);
      $tcpdf->Output('Summary PAR - '.$enduser.'.pdf', 'I');
    }

    public function summaryPrintICS($eid){
      // coder for CodeIgniter TCPDF Integration
      // make new advance pdf document
      $tcpdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

      // set document information
      $tcpdf->SetCreator('SPPMO');
      $tcpdf->SetAuthor('SPPMO');
      $tcpdf->SetSubject('');

      // set default margins
      $tcpdf->SetMargins("14", PDF_MARGIN_TOP, "10");
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
      $tcpdf->setFontSubsetting(true);


      //Set some substance to print
      /*$data="";
      $data['equipments']=$this->supplyModel->getEquipments($areid);
      $data['personDetails']=$this->supplyModel->getPersonDetails($areid);
      $data['supplyDetails']=$this->supplyModel->getSupplyDetails($areid);
      */
      $data['equipments']=$this->summaryModel->getSummary2($eid);
      $data['personDetails']=$this->summaryModel->getPerson($eid);
      $data['head']=$this->summaryModel->getHead();

      //print_r($data);

      if($eid==""){
        $par="No Data";
        $eqptLength=1;
        $qty="No Data";
        $unit="No Data";
        $unitPrice="No Data";
        $desc="No Data";
        $propNo="No Data";
        $amt="No Data";
        $enduser="No Data";
        $position="No Data";
        $office="No Data";
        $dateIssued="No Data";
        $headPPO="No Data";
      }else{
        $eqptLength=count($data['equipments']);
        $enduser=strtoupper($data['personDetails'][0]["firstName"]." ".mb_substr($data['personDetails'][0]["middleName"], 0, 1, 'utf-8').". ".$data['personDetails'][0]["surName"]." ".$data['personDetails'][0]["suffixName"]);
        $position=$data['personDetails'][0]['position'];
        $office=$data['personDetails'][0]['officeAcronym'];
        $date=explode("-",$data['equipments'][0]["dateIssued"]);
        $month="";
        switch($date[1]){
          case "01":
            $month="January";
            break;
          case "02":
            $month="February";
            break;
          case "03":
            $month="March";
            break;
          case "04":
            $month="April";
            break;
          case "05":
            $month="May";
            break;
          case "06":
            $month="June";
            break;
          case "07":
            $month="July";
            break;
          case "08":
            $month="August";
            break;
          case "09":
            $month="September";
            break;
          case "10":
            $month="October";
            break;
          case "11":
            $month="November";
            break;
          case "12":
            $month="December";
            break;
        }
        $dateIssued=$month." ".$date[2].", ".$date[0];
        $headPPO=strtoupper($data['head'][0]['firstName']." ".mb_substr($data['head'][0]["middleName"], 0, 1, 'utf-8').". ".$data['head'][0]['surName']." ".$data['head'][0]["suffixName"]);
        $supplier="";
        $or="";
        $dateGiven="";
      }
      $isDoneAll=false;
      $equipCounter=0;
      while(!$isDoneAll){
        $tcpdf->AddPage('P','A4');
        $tcpdf->SetFont('times', '', 10, '', true);
        $set_html = '
        <br><br><div style="text-align: center;font-size:15"><b>SUMMARY</b></div>
        <b style="text-align: center;font-size:10">INVENTORY CUSTODIAN SLIP</b></div><br>
        <table cellspacing="0" cellpadding="2" nobr="True">
          <thead>
            <tr style="text-align: center;font-size:10">
              <td width="4%" style="border-left: 1px solid black;border-top:1px solid black;border-bottom:1px solid black"><b>Qty</b></td>
              <td width="6%" style="border-left: 1px solid black;border-top:1px solid black;border-bottom:1px solid black;font-size:9"><b>Unit</b></td>
              <td width="29%" style="border-left: 1px solid black;border-top:1px solid black;border-bottom:1px solid black"><b>Description</b></td>
              <td width="10%" style="border-left: 1px solid black;border-top:1px solid black;border-bottom:1px solid black"><b>Date Acquired</b></td>
              <td width="19%" style="border-left: 1px solid black;border-top:1px solid black;border-bottom:1px solid black"><b>Inventory Item No.</b></td>
              <td width="11%" style="border-left: 1px solid black;border-top:1px solid black;border-bottom:1px solid black"><b>Unit Price</b></td>
              <td width="13%" style="border-left: 1px solid black;border-top:1px solid black;border-bottom:1px solid black"><b>Total Amount</b></td>
              <td width="8%" style="border-left: 1px solid black;border-top:1px solid black;border-bottom:1px solid black;border-right:1px solid black"><b>ICS No.</b></td>
            </tr>
          </thead>
          <tbody>
          ';
          $equipLineAvail=26;
          while($eqptLength>$equipCounter && $equipLineAvail>0){
            $qty=(float)$data['equipments'][$equipCounter]["qty"];
            $unit=$data['equipments'][$equipCounter]["unit"];
            $unitPrice=(float)$data['equipments'][$equipCounter]["unitPrice"];
            $desc=$data['equipments'][$equipCounter]["equipmentDesc"];
            $yr= substr(mb_substr($data['equipments'][$equipCounter]["dateIssued"], 0, 4),-2);
            $propNo=$data['equipments'][$equipCounter]["code"].$data['equipments'][$equipCounter]["subCode"]."-".$data['equipments'][$equipCounter]["fundCode"]."-<br>";
            $propNo.=$yr."-".$data['equipments'][$equipCounter]["officeCode"]."-".$data['equipments'][$equipCounter]["seq"];
            $amt=number_format(round((($qty*$unitPrice)*100)/100,2),2,'.',',');

            $descChar=mb_strlen($desc, 'utf8');
            $equipLine=(ceil((($descChar/40)*100)/100));
            if($equipLine<2){
              $equipLine=2;
            }
            $equipLineAvail-=$equipLine;
            if($equipLineAvail<0){
              //$equipCounter--;
              continue;
            }

            $set_html .= '
              <tr height="5%">
                  <td width="4%" style="text-align: center;border-left:1px solid black" >'.$qty.'</td>
                  <td width="6%" style="text-align: center;border-left:1px solid black" >'.$unit.'</td>
                  <td width="29%" style="text-align: left;border-left:1px solid black" >'.$desc.'</td>
                  <td width="10%" style="text-align: center;border-left:1px solid black" >'.$data['equipments'][$equipCounter]["dateGiven"].'</td>
                  <td width="19%" style="text-align: left;border-left:1px solid black" >'.$propNo.'</td>
                  <td width="11%" style="text-align: right;border-left:1px solid black" >'.number_format(round(($unitPrice*100)/100,2),2,'.',',').'</td>
                  <td width="13%" style="text-align: right;border-left:1px solid black" >'.$amt.'</td>
                  <td width="8%" style="text-align: left;border-left:1px solid black;border-right:1px solid black" >'.$data['equipments'][$equipCounter]["parics"].'</td>
              </tr>
            ';
            $dateGiven=$data['equipments'][0]['dateGiven'];
            $equipCounter++;
          }
          if($eqptLength<=$equipCounter){
            $set_html .= '
              <tr>
              <td style="border-left: 1px solid black;"></td>
              <td style="border-left: 1px solid black;"></td>
              <td style="border-left: 1px solid black;">********nothing follows********</td>
              <td style="border-left: 1px solid black;"></td>
              <td style="border-left: 1px solid black;"></td>
              <td style="border-left: 1px solid black;"></td>
              <td style="border-left: 1px solid black;"></td>
              <td style="border-left: 1px solid black;border-right: 1px solid black"></td>
            </tr>';
            $isDoneAll=true;
          }
          if($equipLineAvail<0){
            $equipLineAvail*=-1;
          }
          for($k=0;$k<$equipLineAvail;$k++){
              $set_html .= '
              <tr>
              <td style="border-left: 1px solid black"></td>
              <td style="border-left: 1px solid black"></td>
              <td style="border-left: 1px solid black"></td>
              <td style="border-left: 1px solid black"></td>
              <td style="border-left: 1px solid black"></td>
              <td style="border-left: 1px solid black"></td>
              <td style="border-left: 1px solid black"></td>
              <td style="border-left: 1px solid black;border-right: 1px solid black"></td>

            </tr>';
          }
          $set_html .= '
          <tr>
            <td colspan="8" style="border-top:1px solid black;border-bottom:1px solid black;border-left:1px solid black;border-right:1px solid black"><b>Summary from January 1, 2015 - '.date('F j, Y').' </b><i>*Temporary - All data are being updated</i></td>
          </tr>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="4" style="border-top:1px solid black;border-bottom:1px solid black;border-left:1px solid black">Received by:</td>
              <td colspan="4" style="border-top:1px solid black;border-bottom:1px solid black;border-right:1px solid black">Received from:</td>
            </tr>
            <tr>
              <td colspan="8" border="1">
                <table>
                  <tr>
                    <td colspan="2" style="text-align:center">
                      <b><u><br><br>'.$enduser.'</u></b>
                      <br style="font-size: 9">Signature Over Printed Name
                      <u><br>'.$position."/".$office.'</u>
                      <br style="font-size: 9">Position/Office<br>
                      <br style="font-size: 9">Date
                    </td>
                    <td colspan="2" style="text-align:center">
                      <b><u><br><br>'.$headPPO.'</u></b>
                      <br style="font-size: 9">Signature Over Printed Name
                      <u><br>Head/Property Office</u>
                      <br style="font-size: 9">Position/Office
                      <u><br>'.$dateIssued.'</u>
                      <br style="font-size: 9">Date
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </tfoot>
        </table>
        ';
        //Print content utilizing writeHTMLCell()
        //$par=$tcpdf->getNumLines($set_html); //1024 break height
        //$set_html.="$par";
        $tcpdf->writeHTMLCell(0, 0, '', '', $set_html, 0, 1, 0, true, '', true);
      }
      $remaining=$tcpdf->getPageHeight() - $tcpdf->GetY() - $tcpdf->getBreakMargin();
      $tcpdf->SetTitle('Summary ICS - '.$enduser);
      $tcpdf->Output('Summary ICS - '.$enduser.'.pdf', 'I');
    }

    public function summaryPrintAll($eid){
      // coder for CodeIgniter TCPDF Integration
      // make new advance pdf document
      $tcpdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

      // set document information
      $tcpdf->SetCreator('SPPMO');
      $tcpdf->SetAuthor('SPPMO');
      $tcpdf->SetSubject('');

      // set default margins
      $tcpdf->SetMargins("14", PDF_MARGIN_TOP, "10");
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
      $tcpdf->setFontSubsetting(true);


      //Set some substance to print
      /*$data="";
      $data['equipments']=$this->supplyModel->getEquipments($areid);
      $data['personDetails']=$this->supplyModel->getPersonDetails($areid);
      $data['supplyDetails']=$this->supplyModel->getSupplyDetails($areid);
      */
      $data['equipments']=$this->summaryModel->getSummary3($eid);
      $data['personDetails']=$this->summaryModel->getPerson($eid);
      $data['head']=$this->summaryModel->getHead();

      //print_r($data);

      if($eid==""){
        $par="No Data";
        $eqptLength=1;
        $qty="No Data";
        $unit="No Data";
        $unitPrice="No Data";
        $desc="No Data";
        $propNo="No Data";
        $amt="No Data";
        $enduser="No Data";
        $position="No Data";
        $office="No Data";
        $dateIssued="No Data";
        $headPPO="No Data";
      }else{
        $eqptLength=count($data['equipments']);
        $enduser=strtoupper($data['personDetails'][0]["firstName"]." ".mb_substr($data['personDetails'][0]["middleName"], 0, 1, 'utf-8').". ".$data['personDetails'][0]["surName"]." ".$data['personDetails'][0]["suffixName"]);
        $position=$data['personDetails'][0]['position'];
        $office=$data['personDetails'][0]['officeAcronym'];
        $date=explode("-",$data['equipments'][0]["dateIssued"]);
        $month="";
        switch($date[1]){
          case "01":
            $month="January";
            break;
          case "02":
            $month="February";
            break;
          case "03":
            $month="March";
            break;
          case "04":
            $month="April";
            break;
          case "05":
            $month="May";
            break;
          case "06":
            $month="June";
            break;
          case "07":
            $month="July";
            break;
          case "08":
            $month="August";
            break;
          case "09":
            $month="September";
            break;
          case "10":
            $month="October";
            break;
          case "11":
            $month="November";
            break;
          case "12":
            $month="December";
            break;
        }
        $dateIssued=$month." ".$date[2].", ".$date[0];
        $headPPO=strtoupper($data['head'][0]['firstName']." ".mb_substr($data['head'][0]["middleName"], 0, 1, 'utf-8').". ".$data['head'][0]['surName']." ".$data['head'][0]["suffixName"]);
        $supplier="";
        $or="";
        $dateGiven="";
      }
      $isDoneAll=false;
      $equipCounter=0;
      while(!$isDoneAll){
        $tcpdf->AddPage('P','A4');
        $tcpdf->SetFont('times', '', 10, '', true);
        $set_html = '
        <br><br><div style="text-align: center;font-size:15"><b>SUMMARY</b></div><br>
        <table cellspacing="0" cellpadding="2" nobr="True">
          <thead>
            <tr style="text-align: center;font-size:10">
              <td width="4%" style="border-left: 1px solid black;border-top:1px solid black;border-bottom:1px solid black"><b>Qty</b></td>
              <td width="6%" style="border-left: 1px solid black;border-top:1px solid black;border-bottom:1px solid black;font-size:9"><b>Unit</b></td>
              <td width="29%" style="border-left: 1px solid black;border-top:1px solid black;border-bottom:1px solid black"><b>Description</b></td>
              <td width="10%" style="border-left: 1px solid black;border-top:1px solid black;border-bottom:1px solid black"><b>Date Acquired</b></td>
              <td width="19%" style="border-left: 1px solid black;border-top:1px solid black;border-bottom:1px solid black"><b>Inventory Item No.</b></td>
              <td width="11%" style="border-left: 1px solid black;border-top:1px solid black;border-bottom:1px solid black"><b>Unit Price</b></td>
              <td width="13%" style="border-left: 1px solid black;border-top:1px solid black;border-bottom:1px solid black"><b>Total Amount</b></td>
              <td width="8%" style="border-left: 1px solid black;border-top:1px solid black;border-bottom:1px solid black;border-right:1px solid black"><b>ICS No.</b></td>
            </tr>
          </thead>
          <tbody>
          ';
          $equipLineAvail=26;
          while($eqptLength>$equipCounter && $equipLineAvail>0){
            $qty=(float)$data['equipments'][$equipCounter]["qty"];
            $unit=$data['equipments'][$equipCounter]["unit"];
            $unitPrice=(float)$data['equipments'][$equipCounter]["unitPrice"];
            $desc=$data['equipments'][$equipCounter]["equipmentDesc"];
            $yr= substr(mb_substr($data['equipments'][$equipCounter]["dateIssued"], 0, 4),-2);
            $propNo=$data['equipments'][$equipCounter]["code"].$data['equipments'][$equipCounter]["subCode"]."-".$data['equipments'][$equipCounter]["fundCode"]."-<br>";
            $propNo.=$yr."-".$data['equipments'][$equipCounter]["officeCode"]."-".$data['equipments'][$equipCounter]["seq"];
            $amt=number_format(round((($qty*$unitPrice)*100)/100,2),2,'.',',');

            $descChar=mb_strlen($desc, 'utf8');
            $equipLine=(ceil((($descChar/40)*100)/100));
            if($equipLine<2){
              $equipLine=2;
            }
            $equipLineAvail-=$equipLine;
            if($equipLineAvail<0){
              //$equipCounter--;
              continue;
            }

            $set_html .= '
              <tr height="5%">
                  <td width="4%" style="text-align: center;border-left:1px solid black" >'.$qty.'</td>
                  <td width="6%" style="text-align: center;border-left:1px solid black" >'.$unit.'</td>
                  <td width="29%" style="text-align: left;border-left:1px solid black" >'.$desc.'</td>
                  <td width="10%" style="text-align: center;border-left:1px solid black" >'.$data['equipments'][$equipCounter]["dateGiven"].'</td>
                  <td width="19%" style="text-align: left;border-left:1px solid black" >'.$propNo.'</td>
                  <td width="11%" style="text-align: right;border-left:1px solid black" >'.number_format(round(($unitPrice*100)/100,2),2,'.',',').'</td>
                  <td width="13%" style="text-align: right;border-left:1px solid black" >'.$amt.'</td>
                  <td width="8%" style="text-align: left;border-left:1px solid black;border-right:1px solid black" >'.$data['equipments'][$equipCounter]["parics"].'</td>
              </tr>
            ';
            $dateGiven=$data['equipments'][0]['dateGiven'];
            $equipCounter++;
          }
          if($eqptLength<=$equipCounter){
            $set_html .= '
              <tr>
              <td style="border-left: 1px solid black;"></td>
              <td style="border-left: 1px solid black;"></td>
              <td style="border-left: 1px solid black;">********nothing follows********</td>
              <td style="border-left: 1px solid black;"></td>
              <td style="border-left: 1px solid black;"></td>
              <td style="border-left: 1px solid black;"></td>
              <td style="border-left: 1px solid black;"></td>
              <td style="border-left: 1px solid black;border-right: 1px solid black"></td>
            </tr>';
            $isDoneAll=true;
          }
          if($equipLineAvail<0){
            $equipLineAvail*=-1;
          }
          for($k=0;$k<$equipLineAvail;$k++){
              $set_html .= '
              <tr>
              <td style="border-left: 1px solid black"></td>
              <td style="border-left: 1px solid black"></td>
              <td style="border-left: 1px solid black"></td>
              <td style="border-left: 1px solid black"></td>
              <td style="border-left: 1px solid black"></td>
              <td style="border-left: 1px solid black"></td>
              <td style="border-left: 1px solid black"></td>
              <td style="border-left: 1px solid black;border-right: 1px solid black"></td>

            </tr>';
          }
          $set_html .= '
          <tr>
            <td colspan="8" style="border-top:1px solid black;border-bottom:1px solid black;border-left:1px solid black;border-right:1px solid black"><b>Summary from January 1, 2015 - '.date('F j, Y').' </b><i>*Temporary - All data are being updated</i></td>
          </tr>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="4" style="border-top:1px solid black;border-bottom:1px solid black;border-left:1px solid black">Received by:</td>
              <td colspan="4" style="border-top:1px solid black;border-bottom:1px solid black;border-right:1px solid black">Received from:</td>
            </tr>
            <tr>
              <td colspan="8" border="1">
                <table>
                  <tr>
                    <td colspan="2" style="text-align:center">
                      <b><u><br><br>'.$enduser.'</u></b>
                      <br style="font-size: 9">Signature Over Printed Name
                      <u><br>'.$position."/".$office.'</u>
                      <br style="font-size: 9">Position/Office<br>
                      <br style="font-size: 9">Date
                    </td>
                    <td colspan="2" style="text-align:center">
                      <b><u><br><br>'.$headPPO.'</u></b>
                      <br style="font-size: 9">Signature Over Printed Name
                      <u><br>Head/Property Office</u>
                      <br style="font-size: 9">Position/Office
                      <u><br>'.$dateIssued.'</u>
                      <br style="font-size: 9">Date
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </tfoot>
        </table>
        ';
        //Print content utilizing writeHTMLCell()
        //$par=$tcpdf->getNumLines($set_html); //1024 break height
        //$set_html.="$par";
        $tcpdf->writeHTMLCell(0, 0, '', '', $set_html, 0, 1, 0, true, '', true);
      }
      $tcpdf->SetTitle('Summary All - '.$enduser);
      $tcpdf->Output('Summary All - '.$enduser.'.pdf', 'I');
    }

    public function gamPar($areid){
      // coder for CodeIgniter TCPDF Integration
      // make new advance pdf document
      $tcpdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

      // set document information
      $tcpdf->SetCreator('SPPMO');
      $tcpdf->SetAuthor('SPPMO');
      $tcpdf->SetSubject('');

      // set default margins
      $tcpdf->SetMargins("15", PDF_MARGIN_TOP, "10");
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
      $tcpdf->setFontSubsetting(true);


      //Set some substance to print
      $data="";
      $data['equipments']=$this->supplyModel->getEquipments($areid);
      $data['personDetails']=$this->supplyModel->getPersonDetails($areid);
      $data['supplyDetails']=$this->supplyModel->getSupplyDetails($areid);

      if($areid==""){
        $par="No Data";
        $eqptLength=1;
        $qty="No Data";
        $unit="No Data";
        $unitPrice="No Data";
        $desc="No Data";
        $propNo="No Data";
        $amt="No Data";
        $enduser="No Data";
        $position="No Data";
        $office="No Data";
        $dateIssued="No Data";
        $headPPO="No Data";
      }else{
        $par=$data['supplyDetails'][0]['parics'];
        $eqptLength=count($data['equipments']);
        $enduser=strtoupper($data['personDetails'][0]["firstName"]." ".mb_substr($data['personDetails'][0]["middleName"], 0, 1, 'utf-8').". ".$data['personDetails'][0]["surName"]." ".$data['personDetails'][0]["suffixName"]);
        $position=$data['personDetails'][0]['position'];
        $office=$data['personDetails'][0]['officeAcronym'];
        $date=explode("-",$data['supplyDetails'][0]["dateIssued"]);
        $month="";
        switch($date[1]){
          case "01":
            $month="January";
            break;
          case "02":
            $month="February";
            break;
          case "03":
            $month="March";
            break;
          case "04":
            $month="April";
            break;
          case "05":
            $month="May";
            break;
          case "06":
            $month="June";
            break;
          case "07":
            $month="July";
            break;
          case "08":
            $month="August";
            break;
          case "09":
            $month="September";
            break;
          case "10":
            $month="October";
            break;
          case "11":
            $month="November";
            break;
          case "12":
            $month="December";
            break;
        }
        $dateIssued=$month." ".$date[2].", ".$date[0];
        $headPPO=strtoupper($data['supplyDetails'][0]['firstName']." ".mb_substr($data['supplyDetails'][0]["middleName"], 0, 1, 'utf-8').". ".$data['supplyDetails'][0]['surName']." ".$data['supplyDetails'][0]["suffixName"]);
        $PO=$data['supplyDetails'][0]["poNumber"];
        $PR=$data['supplyDetails'][0]["prNumber"];
        $obligation=$data['supplyDetails'][0]["obligation"];
        $supplier="";
        $or="";
        $dateGiven="";
      }
      $isDoneAll=false;
      $equipCounter=0;
      $eid=$data['equipments'][0]["equipmentID"];
      while(!$isDoneAll){
        $tcpdf->AddPage('P','A4');
        $tcpdf->SetFont('times', '', 10, '', true);
        $set_html = '
        <br><br><div style="text-align: center;font-size:14"><b>PROPERTY ACKNOWLEDGEMENT RECEIPT</b></div>
        <br><b>
        <table>
          <tr>
            <td colspan="1" style="width:12%">Entity Name:</td>
            <td colspan="5" style="width:88%"><u>Visayas State University</u></td>
          </tr>
          <tr>
            <td colspan="1" style="width:12%">Fund Cluster: </td>
            <td colspan="4" ><u>'.$data['supplyDetails'][0]["fundCode"].' '.$data['supplyDetails'][0]["fundDesc"].'</u></td>
            <td colspan="1">PAR No: <u>'.$par.'</u></td>
          </tr>
        </table></b>
        <table cellspacing="0" cellpadding="3" nobr="True">
          <thead>
            <tr style="text-align: center;font-size:11">
              <td width="5%" border="1"><b>Qty</b></td>
              <td width="5%" border="1"><b>Unit</b></td>
              <td width="40%" border="1"><b>Description</b></td>
              <td width="22%" border="1"><b>Property Number</b></td>
              <td width="12%" border="1"><b>Date Acquired</b></td>
              <td width="16%" border="1"><b>Amount</b></td>
            </tr>
          </thead>
          <tbody>
          ';
          $equipLineAvail=26;
          while($eqptLength>$equipCounter && $equipLineAvail>0){
            $eid=$data['equipments'][$equipCounter]["equipmentID"];
            $data['specificEqpt']=$this->supplyModel->getSpecificEquipment($eid);
            $qty=(float)$data['specificEqpt'][0]["qty"];
            $unit=$data['specificEqpt'][0]["unit"];
            $unitPrice=(float)$data['specificEqpt'][0]["unitPrice"];
            $desc=$data['specificEqpt'][0]["equipmentDesc"];
            $yr= substr(mb_substr($data['supplyDetails'][0]["dateIssued"], 0, 4),-2);
            $propNo=$data['specificEqpt'][0]["code"].$data['specificEqpt'][0]["subCode"]."-".$data['supplyDetails'][0]["fundCode"]."-<br>".$yr."-".$data['specificEqpt'][0]["officeCode"]."-".$data['specificEqpt'][0]["seq"];
            $amt=number_format(round((($qty*$unitPrice)*100)/100,2),2,'.',',');

            $descChar=mb_strlen($desc, 'utf8');
            $equipLine=(ceil((($descChar/50)*100)/100));
            if($equipLine<2){
              $equipLine=2;
            }
            $equipLineAvail-=$equipLine;
            if($equipLineAvail<=0){
              //$equipCounter--;
              continue;
            }
            $equipCounter++;

            $set_html .= '
              <tr height="5%">
                  <td width="5%" style="text-align: center;border-left: 1px solid black;" ><br>'.$qty.'<br></td>
                  <td width="5%" style="text-align: center;border-left: 1px solid black;" ><br>'.$unit.'</td>
                  <td width="40%" style="text-align: left;border-left: 1px solid black;" ><br>'.$desc.'</td>
                  <td width="22%" style="text-align: left;border-left: 1px solid black;" ><br>'.$propNo.'</td>
                  <td width="12%" style="text-align: left;border-left: 1px solid black;" ><br>'.$data['supplyDetails'][0]["dateGiven"].'</td>
                  <td width="16%" style="text-align: right;border-left: 1px solid black;border-right: 1px solid black;" ><br>'.number_format(round(($unitPrice*100)/100,2),2,'.',',').'</td>
              </tr>
            ';
            $supplier=$data['supplyDetails'][0]['supplier'];
            $or=$data['supplyDetails'][0]['orNumber'];
            $dateGiven=$data['supplyDetails'][0]['dateGiven'];
          }
          if($eqptLength<=$equipCounter){
            $isDoneAll=true;
          }
          if($equipLineAvail<0){
            $equipLineAvail*=-1;
          }
          for($k=0;$k<$equipLineAvail;$k++){
              $set_html .= '
              <tr>
              <td style="border-left: 1px solid black;"></td>
              <td style="border-left: 1px solid black;"></td>
              <td style="border-left: 1px solid black;"></td>
              <td style="border-left: 1px solid black;"></td>
              <td style="border-left: 1px solid black;"></td>
              <td style="border-left: 1px solid black;border-right: 1px solid black;"></td>

            </tr>';
          }
          $set_html .= '
          </tbody>
          <tfoot>
            <tr>
              <td colspan="3" style="border-left:1px solid black;border-top:1px solid black">Received by:</td>
              <td colspan="3" style="border-right:1px solid black;border-top:1px solid black">Received from:</td>
            </tr>
            <tr>
              <td colspan="6" style="border-bottom:1px solid black;border-right:1px solid black;border-left:1px solid black">
                <table>
                  <tr>
                    <td colspan="2" style="text-align:center">
                      <b><u><br><br>'.$enduser.'</u></b>
                      <br style="font-size: 9">Signature Over Printed Name
                      <u><br>'.$position."/".$office.'</u>
                      <br style="font-size: 9">Position/Office<br>
                      <br style="font-size: 9">Date
                    </td>
                    <td colspan="2" style="text-align:center">
                      <b><u><br><br>'.$headPPO.'</u></b>
                      <br style="font-size: 9">Signature Over Printed Name
                      <u><br>Head/Property Office</u>
                      <br style="font-size: 9">Position/Office
                      <u><br>'.$dateIssued.'</u>
                      <br style="font-size: 9">Date
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </tfoot>
        </table>
        ';
        //Print content utilizing writeHTMLCell()
        //$par=$tcpdf->getNumLines($set_html); //1024 break height
        //$set_html.="$par";
        //$tcpdf->writeHTMLCell(0, 0, '', '', $set_html, 0, 1, 0, true, '', true);
        //$set_html.=$remaining;

        $tcpdf->writeHTML($set_html, true,0,true);
      }
      $remaining=$tcpdf->getPageHeight() - $tcpdf->GetY() - $tcpdf->getBreakMargin();
      //$tcpdf->Write('',$remaining);
      $tcpdf->SetTitle('PAR '.$par);
      // Close and yield PDF record
      // This technique has a few choices, check the source code documentation for more data.
      $tcpdf->Output('pargam-'.$par.'.pdf', 'I');
              // successfully created CodeIgniter TCPDF Integration
    }

    public function gamIcs($areid){
      // coder for CodeIgniter TCPDF Integration
      // make new advance pdf document
      $tcpdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

      // set document information
      $tcpdf->SetCreator('SPPMO');
      $tcpdf->SetAuthor('SPPMO');
      $tcpdf->SetSubject('');

      // set default margins
      $tcpdf->SetMargins("15", PDF_MARGIN_TOP, "10");
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
      $tcpdf->setFontSubsetting(true);


      //Set some substance to print
      $data="";
      $data['equipments']=$this->supplyModel->getEquipments($areid);
      $data['personDetails']=$this->supplyModel->getPersonDetails($areid);
      $data['supplyDetails']=$this->supplyModel->getSupplyDetails($areid);

      if($areid==""){
        $par="No Data";
        $eqptLength=1;
        $qty="No Data";
        $unit="No Data";
        $unitPrice="No Data";
        $desc="No Data";
        $propNo="No Data";
        $amt="No Data";
        $enduser="No Data";
        $position="No Data";
        $office="No Data";
        $dateIssued="No Data";
        $headPPO="No Data";
      }else{
        $par=$data['supplyDetails'][0]['parics'];
        $eqptLength=count($data['equipments']);
        $enduser=strtoupper($data['personDetails'][0]["firstName"]." ".mb_substr($data['personDetails'][0]["middleName"], 0, 1, 'utf-8').". ".$data['personDetails'][0]["surName"]." ".$data['personDetails'][0]["suffixName"]);
        $position=$data['personDetails'][0]['position'];
        $office=$data['personDetails'][0]['officeAcronym'];
        $date=explode("-",$data['supplyDetails'][0]["dateIssued"]);
        $month="";
        switch($date[1]){
          case "01":
            $month="January";
            break;
          case "02":
            $month="February";
            break;
          case "03":
            $month="March";
            break;
          case "04":
            $month="April";
            break;
          case "05":
            $month="May";
            break;
          case "06":
            $month="June";
            break;
          case "07":
            $month="July";
            break;
          case "08":
            $month="August";
            break;
          case "09":
            $month="September";
            break;
          case "10":
            $month="October";
            break;
          case "11":
            $month="November";
            break;
          case "12":
            $month="December";
            break;
        }
        $dateIssued=$month." ".$date[2].", ".$date[0];
        $headPPO=strtoupper($data['supplyDetails'][0]['firstName']." ".mb_substr($data['supplyDetails'][0]["middleName"], 0, 1, 'utf-8').". ".$data['supplyDetails'][0]['surName']." ".$data['supplyDetails'][0]["suffixName"]);
        $PO=$data['supplyDetails'][0]['poNumber'];
        $PR=$data['supplyDetails'][0]['prNumber'];
        $obligation=$data['supplyDetails'][0]['obligation'];
        $supplier="";
        $or="";
        $dateGiven="";
      }
      $isDoneAll=false;
      $equipCounter=0;
      $eid=$data['equipments'][0]["equipmentID"];
      while(!$isDoneAll){
        $tcpdf->AddPage('P','A4');
        $tcpdf->SetFont('times', '', 10, '', true);
        $set_html = '
        <br><br><div style="text-align: center;font-size:14"><b>INVENTORY CUSTODIAN SLIP</b></div>
        <br><b>
        <table>
          <tr>
            <td colspan="1" style="width:12%">Entity Name:</td>
            <td colspan="5" style="width:88%"><u>Visayas State University</u></td>
          </tr>
          <tr>
            <td colspan="1" style="width:12%">Fund Cluster: </td>
            <td colspan="4" ><u>'.$data['supplyDetails'][0]["fundCode"].' '.$data['supplyDetails'][0]["fundDesc"].'</u></td>
            <td colspan="1">ICS No: <u>'.$par.'</u></td>
          </tr>
        </table></b>
        <table cellspacing="0" cellpadding="3" nobr="True">
          <thead>
            <tr style="text-align: center;font-size:11">
              <td width="5%" border="1" rowspan="2"><b>Qty</b></td>
              <td width="5%" border="1" rowspan="2"><b>Unit</b></td>
              <td width="24%" border="1" colspan="2"><b>Amount</b></td>
              <td width="35%" border="1" rowspan="2"><b>Description</b></td>
              <td width="20%" border="1" rowspan="2"><b>Inventory Item No.</b></td>
              <td width="11%" border="1" rowspan="2"><b>Estimated Useful Life</b></td>
            </tr>
              <tr style="text-align: center;font-size:11">
                <td width="11%" border="1"><b>Unit Cost</b></td>
                <td width="13%" border="1"><b>Total Cost</b></td>
              </tr>
          </thead>
          <tbody>
          ';
          $equipLineAvail=25;
          while($eqptLength>$equipCounter && $equipLineAvail>0){
            $eid=$data['equipments'][$equipCounter]["equipmentID"];
            $data['specificEqpt']=$this->supplyModel->getSpecificEquipment($eid);
            $qty=(float)$data['specificEqpt'][0]["qty"];
            $unit=$data['specificEqpt'][0]["unit"];
            $unitPrice=(float)$data['specificEqpt'][0]["unitPrice"];
            $desc=$data['specificEqpt'][0]["equipmentDesc"];
            $yr= substr(mb_substr($data['supplyDetails'][0]["dateIssued"], 0, 4),-2);
            $propNo=$data['specificEqpt'][0]["code"].$data['specificEqpt'][0]["subCode"]."-".$data['supplyDetails'][0]["fundCode"]."-<br>".$yr."-".$data['specificEqpt'][0]["officeCode"]."-".$data['specificEqpt'][0]["seq"];
            $amt=number_format(round((($qty*$unitPrice)*100)/100,2),2,'.',',');

            $descChar=mb_strlen($desc, 'utf8');
            $equipLine=(ceil((($descChar/50)*100)/100));
            if($equipLine<2){
              $equipLine=2;
            }
            $equipLineAvail-=$equipLine;
            if($equipLineAvail<=0){
              //$equipCounter--;
              continue;
            }
            $equipCounter++;

            $set_html .= '
              <tr height="5%">
                  <td width="5%" style="text-align: center;border-left:1px solid black"><br>'.$qty.'<br></td>
                  <td width="5%" style="text-align: center;border-left:1px solid black"><br>'.$unit.'</td>
                  <td width="11%" style="text-align: right;border-left:1px solid black"><br>'.number_format(round(($unitPrice*100)/100,2),2,'.',',').'</td>
                  <td width="13%" style="text-align: right;border-left:1px solid black"><br>'.$amt.'</td>
                  <td width="35%" style="text-align: left;border-left:1px solid black"><br>'.$desc.'</td>
                  <td width="20%" style="text-align: left;border-left:1px solid black"><br>'.$propNo.'</td>
                  <td width="11%" style="text-align: right;border-left:1px solid black;border-right:1px solid black"><br>'.$data['specificEqpt'][0]["life"].'</td>
              </tr>
            ';
            $supplier=$data['supplyDetails'][0]['supplier'];
            $or=$data['supplyDetails'][0]['orNumber'];
            $dateGiven=$data['supplyDetails'][0]['dateGiven'];
          }
          if($eqptLength<=$equipCounter){
            $isDoneAll=true;
          }
          if($equipLineAvail<0){
            $equipLineAvail*=-1;
          }
          for($k=0;$k<$equipLineAvail;$k++){
              $set_html .= '
              <tr>
              <td style="border-left: 1px solid black;"></td>
              <td style="border-left: 1px solid black;"></td>
              <td style="border-left: 1px solid black;"></td>
              <td style="border-left: 1px solid black;"></td>
              <td style="border-left: 1px solid black;"></td>
              <td style="border-left: 1px solid black;"></td>
              <td style="border-left: 1px solid black;border-right: 1px solid black;"></td>

            </tr>';
          }
          $set_html .= '
          </tbody>
          <tfoot>
            <tr>
              <td colspan="4" width="55%" style="border-left:1px solid black;border-top:1px solid black">Received by:</td>
              <td colspan="3" width="45%" style="border-right:1px solid black;border-top:1px solid black;text-align:middle" >Received from:</td>
            </tr>
            <tr>
              <td colspan="7" style="border-bottom:1px solid black;border-right:1px solid black;border-left:1px solid black">
                <table>
                  <tr>
                    <td colspan="2" style="text-align:center">
                      <b><u><br><br>'.$enduser.'</u></b>
                      <br style="font-size: 9">Signature Over Printed Name
                      <u><br>'.$position."/".$office.'</u>
                      <br style="font-size: 9">Position/Office<br>
                      <br style="font-size: 9">Date
                    </td>
                    <td colspan="2" style="text-align:center">
                      <b><u><br><br>'.$headPPO.'</u></b>
                      <br style="font-size: 9">Signature Over Printed Name
                      <u><br>Head/Property Office</u>
                      <br style="font-size: 9">Position/Office
                      <u><br>'.$dateIssued.'</u>
                      <br style="font-size: 9">Date
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </tfoot>
        </table>
        ';
        //Print content utilizing writeHTMLCell()
        //$par=$tcpdf->getNumLines($set_html); //1024 break height
        //$set_html.="$par";
        //$tcpdf->writeHTMLCell(0, 0, '', '', $set_html, 0, 1, 0, true, '', true);
        //$set_html.=$remaining;

        $tcpdf->writeHTML($set_html, true,0,true);
      }
      $remaining=$tcpdf->getPageHeight() - $tcpdf->GetY() - $tcpdf->getBreakMargin();
      //$tcpdf->Write('',$remaining);
      $tcpdf->SetTitle('ICS '.$par);
      // Close and yield PDF record
      // This technique has a few choices, check the source code documentation for more data.
      $tcpdf->Output('icsgam-'.$par.'.pdf', 'I');
              // successfully created CodeIgniter TCPDF Integration
    }

    public function transmittal(){
      // coder for CodeIgniter TCPDF Integration
      // make new advance pdf document
      $arr=$this->supplyModel->forTransmit($this->input->post(NULL,TRUE));

      $tcpdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

      // set document information
      $tcpdf->SetCreator('SPPMO');
      $tcpdf->SetAuthor('SPPMO');
      $tcpdf->SetSubject('');

      // set default margins
      $tcpdf->SetMargins("15", PDF_MARGIN_TOP, "10");
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
      $tcpdf->setFontSubsetting(true);

      $tcpdf->AddPage('P','A4');
      $tcpdf->SetFont('times', '', 12, '', true);
      $set_html = '
        <br><br><div style="text-align: center;font-size:14"><b>Document Transmittal</b></div>
        <br><b>
        <table>
          <tr>
            <td colspan="1">CY '.date('Y').'</td>
          </tr>
          <tr>
            <td colspan="1">LIST OF PAR/ICS</td>
          </tr>
          <tr>
            <td colspan="1">For signature of End-user(s)</td>
          </tr>
        </table></b>';
        $pageLimit=(int)(count($arr)/13);
        if(count($arr)%13!=0){
          $pageLimit++;
        }
        $ctr=1;
        $start=0;
        $loopBlank=0;
        $end=0;
        while($ctr<=$pageLimit){
          if(count($arr)<14){
            $end=count($arr);
            $loopBlank=13-count($arr);
          }
          else{
            if(count($arr)%13==0)
              $end=13*$ctr;
            else{
              $start=(13*($ctr-1));
              $end=(13*$ctr)-1;
              if($ctr>1){
                $start=(13*($ctr-1))-1;
                $end=(13*$ctr)-1;
                if($ctr==$pageLimit){
                  $end=count($arr);
                  $loopBlank=(13*$ctr)-count($arr);
                }
              }
            }
          }
          if($ctr>1){
            $set_html='<br><br><br><br>
            <table cellspacing="0" cellpadding="3" nobr="True">
              <thead>
                <tr style="text-align: center">
                  <td width="15%" border="1"><b>Date Prepared</b></td>
                  <td width="15%" border="1"><b>Ref. No.</b></td>
                  <td width="30%" border="1"><b>End-User</b></td>
                  <td width="20%" border="1"><b>Dept./Center</b></td>
                  <td width="20%" border="1"><b>Signature</b></td>
                </tr>
              </thead>
              <tbody>
              ';
            }else{
              $set_html.='
              <table cellspacing="0" cellpadding="3" nobr="True">
                <thead>
                  <tr style="text-align: center">
                    <td width="15%" border="1"><b>Date Prepared</b></td>
                    <td width="15%" border="1"><b>Ref. No.</b></td>
                    <td width="30%" border="1"><b>End-User</b></td>
                    <td width="20%" border="1"><b>Dept./Center</b></td>
                    <td width="20%" border="1"><b>Signature</b></td>
                  </tr>
                </thead>
                <tbody>
                ';
            }
            $ctr++;
            //echo $start."-".$end." ";
            for($i=$start;$i<$end;$i++){
              $set_html .= '
              <tr>
              <td width="15%" style="border-left: 1px solid black;border-bottom: 1px solid black;">'.$arr[$i]['dateIssued'].'<br></td>
              <td width="15%" style="border-left: 1px solid black;border-bottom: 1px solid black;">'.$arr[$i]['parics'].'</td>
              <td width="30%" style="border-left: 1px solid black;border-bottom: 1px solid black;">'.ucwords(strtolower($arr[$i]['firstName'])).' '.ucwords(strtolower($arr[$i]['middleName'])).' '.ucwords(strtolower($arr[$i]['surName'])).' '.ucwords(strtolower($arr[$i]['suffixName'])).'</td>
              <td width="20%" style="border-left: 1px solid black;border-bottom: 1px solid black;">'.$arr[$i]['officeAcronym'].'</td>
              <td width="20%" style="border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;"></td>
              </tr>';
            }
            for($i=0;$i<$loopBlank;$i++){
              $set_html .= '
              <tr>
              <td width="15%" style="border-left: 1px solid black;border-bottom: 1px solid black;"><br><br></td>
              <td width="15%" style="border-left: 1px solid black;border-bottom: 1px solid black;"></td>
              <td width="30%" style="border-left: 1px solid black;border-bottom: 1px solid black;"></td>
              <td width="20%" style="border-left: 1px solid black;border-bottom: 1px solid black;"></td>
              <td width="20%" style="border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;"></td>
              </tr>';
            }
          if($ctr<=$pageLimit){
            $set_html .= '</tbody></table>';
          }else{
            $set_html .= '
            </tbody>
            <tfoot>
              <tr>
                <td colspan="4" width="55%" style="border-left:1px solid black;border-top:1px solid black">Prepared by:</td>
                <td colspan="3" width="45%" style="border-right:1px solid black;border-top:1px solid black;text-align:middle">Distributed by:</td>
              </tr>
              <tr>
                <td colspan="7" style="border-bottom:1px solid black;border-right:1px solid black;border-left:1px solid black">
                  <table>
                    <tr>
                      <td colspan="2" style="text-align:center">
                        <b><u><br><br>SHERYL M. SUYOM</u></b>
                        <br style="font-size: 11">Admin. Aide III
                        <br style="font-size: 11">'.date('m/d/Y').'
                      </td>
                      <td colspan="2" style="text-align:center">
                        <b><u><br><br>LINDON M. FERNANDEZ</u></b>
                        <br style="font-size: 11">Admin. Aide III
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </tfoot>
          </table>
          ';
          }


        $tcpdf->writeHTML($set_html, true,0,true);
        if($ctr<=$pageLimit)
          $tcpdf->AddPage('P','A4');
      }

      $tcpdf->SetTitle('Transmittal');
      // Close and yield PDF record
      // This technique has a few choices, check the source code documentation for more data.
      $tcpdf->Output('transmittal-'.date('m/d/Y').'.pdf', 'I');
              // successfully created CodeIgniter TCPDF Integration
    }

    public function byOffice(){
      // coder for CodeIgniter TCPDF Integration
      // make new advance pdf document
      $tcpdf = new Pdf2(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

      // set document information
      $tcpdf->SetCreator('SPPMO');
      $tcpdf->SetAuthor('SPPMO');
      $tcpdf->SetSubject('');

      // set default margins
      $tcpdf->SetMargins("15", PDF_MARGIN_TOP, "10");
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
      $tcpdf->setFontSubsetting(true);


      //Set some substance to print
      /*$data="";
      $data['equipments']=$this->supplyModel->getEquipments($areid);
      $data['personDetails']=$this->supplyModel->getPersonDetails($areid);
      $data['supplyDetails']=$this->supplyModel->getSupplyDetails($areid);
      */
      $raw=$this->input->post(NULL,TRUE);
      $raw["Code"]=0;
      $data=$this->summaryModel->getEquipOffice($raw);
      //print_r($data);
      //print_r($data["head"]);

      $eqptLength=count($data);
      $supplier="";
      $or="";
      $dateGiven="";
      $titleParics="";
      if($raw["opt"]==1){
        $titleParics="INVENTORY CUSTODIAN SLIP";
      }else if($raw["opt"]==2){
        $titleParics="PROPERTY ACKNOWLEDGEMENT RECEIPT";
      }else{
        $titleParics="";
      }
      $isDoneAll=false;
      $equipCounter=0;
      //print_r($data);
      if($data!=null ){
        while(!$isDoneAll){
          $tcpdf->AddPage('L','A4');
          $tcpdf->SetFont('times', '', 10, '', true);
          $set_html = '
          <br><br><div style="text-align: center;font-size:15"><b>SUMMARY (By Office)</b></div>
          <b style="text-align: center;font-size:10">'.$titleParics.'</b></div><br>
          <b>Office: '.ucwords(strtolower($data[0]["office"])).'</b><br>
          <table cellspacing="0" cellpadding="2" nobr="True">
            <thead>
              <tr style="text-align: center;font-size:10">
                <td width="14%" style="border-left:1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;"><b>End User</b></td>
                <td width="3%" style="border-left:1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;"><b>Qty</b></td>
                <td width="4%" style="border-left:1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;font-size:9"><b>Unit</b></td>
                <td width="27%" style="border-left:1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;"><b>Description</b></td>
                <td width="9%" style="border-left:1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;"><b>Date Acquired</b></td>
                <td width="21%" style="border-left:1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;"><b>Property No.</b></td>
                <td width="8%" style="border-left:1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;"><b>Unit Price</b></td>
                <td width="8%" style="border-left:1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;"><b>Total Amount</b></td>
                <td width="6%" style="border-left:1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;border-right: 1px solid black;"><b>Reference</b></td>
              </tr>
            </thead>
            <tbody>
            ';
            $equipLineAvail=24;
            $ctr=1; //for spaces between equip; every 4 equip 1 space
            while($eqptLength>$equipCounter && $equipLineAvail>0){
              $date=explode("-",$data[$equipCounter]["dateGiven"]);
              if($date[0]==""){
                $date="1111-11-11";
              }
              $month="";
              switch($date[1]){
                case "01":
                  $month="Jan";
                  break;
                case "02":
                  $month="Feb";
                  break;
                case "03":
                  $month="Mar";
                  break;
                case "04":
                  $month="Apr";
                  break;
                case "05":
                  $month="May";
                  break;
                case "06":
                  $month="Jun";
                  break;
                case "07":
                  $month="Jul";
                  break;
                case "08":
                  $month="Aug";
                  break;
                case "09":
                  $month="Sep";
                  break;
                case "10":
                  $month="Oct";
                  break;
                case "11":
                  $month="Nov";
                  break;
                case "12":
                  $month="Dec";
                  break;
              }
              $dateIssued=$month." ".$date[2].", ".$date[0];
              $office=$data[$equipCounter]['officeAcronym'];
              $enduser=ucwords(strtolower($data[$equipCounter]["firstName"]." ".$data[$equipCounter]["surName"]." ".$data[$equipCounter]["suffixName"]));
              $qty=(float)$data[$equipCounter]["qty"];
              $unit=$data[$equipCounter]["unit"];
              $unitPrice=(float)$data[$equipCounter]["unitPrice"];
              $desc=$data[$equipCounter]["equipmentDesc"];
              $yr= substr(mb_substr($data[$equipCounter]["dateIssued"], 0, 4),-2);
              $propNo=$data[$equipCounter]["code"].$data[$equipCounter]["subCode"]."-".$data[$equipCounter]["fundCode"]."-";
              $propNo.=$yr."-".$data[$equipCounter]["officeCode"]."-".$data[$equipCounter]["seq"];
              $amt=number_format(round((($qty*$unitPrice)*100)/100,2),2,'.',',');

              $descChar=mb_strlen($desc, 'utf8');
              $equipLine=(((($descChar/40)*100)/100));
              $decimal=0;
              if($equipLine<1)
                $decimal=$equipLine;
              else
                $decimal=$equipLine - floor($equipLine);
              if(floor($equipLine)==0)
                $equipLine=1;
              else{
                $equipLine=floor($equipLine);
                if($decimal>0.15){
                  $equipLine++;
                }
              }

              if(strstr($desc, "\n")){
                $equipLine++;
              }
              if($ctr%4==0) //for spaces between equip; every 4 equip 1 space
                $equipLineAvail--;

              $ctr++;
              $equipLineAvail-=$equipLine;
              //echo $equipLine."<br>";
              if($equipLineAvail<=0){
                //echo "x<br>";
                //echo $equipLineAvail+$equipLine." ";

                ////$equipCounter--;
                continue;
              }
              $set_html .= '
                <tr height="5%">
                    <td width="14%" style="text-align: center;border-left:1px solid black;">'.$enduser.'</td>
                    <td width="3%" style="text-align: center;border-left:1px solid black;">'.$qty.'</td>
                    <td width="4%" style="text-align: center;border-left:1px solid black;">'.$unit.'</td>
                    <td width="27%" style="text-align: left;border-left:1px solid black;">'.$desc.'</td>
                    <td width="9%" style="text-align: center;border-left:1px solid black;">'.$dateIssued.'</td>
                    <td width="21%" style="text-align: left;border-left:1px solid black;">'.$propNo.'</td>
                    <td width="8%" style="text-align: right;border-left:1px solid black;">'.number_format(round(($unitPrice*100)/100,2),2,'.',',').'</td>
                    <td width="8%" style="text-align: right;border-left:1px solid black;">'.$amt.'</td>
                    <td width="6%" style="text-align: left;border-left:1px solid black;border-right: 1px solid black;">'.$data[$equipCounter]["parics"].'</td>
                </tr>
              ';
              $equipCounter++;
            }
              if($eqptLength<=$equipCounter){
                if($equipLineAvail<0){
                  $equipLineAvail=$equipLineAvail+1;
                }else{
                  $equipLineAvail=$equipLineAvail-1;
                }
                $set_html .= '
                  <tr>
                  <td style="border-left: 1px solid black;"></td>
                  <td style="border-left: 1px solid black;"></td>
                  <td style="border-left: 1px solid black;"></td>
                  <td style="border-left: 1px solid black;">*************nothing follows*************</td>
                  <td style="border-left: 1px solid black;"></td>
                  <td style="border-left: 1px solid black;"></td>
                  <td style="border-left: 1px solid black;"></td>
                  <td style="border-left: 1px solid black;"></td>
                  <td style="border-left: 1px solid black;border-right: 1px solid black"></td>
                  </tr>';
                $isDoneAll=true;
              }
              if($equipLineAvail<=0){
                $equipLineAvail+=$equipLine;
              }
              $equipLineAvail=$equipLineAvail-floor($equipLineAvail/4);
              for($k=0;$k<$equipLineAvail;$k++){
                $set_html .= '
                <tr>
                <td style="border-left: 1px solid black"></td>
                <td style="border-left: 1px solid black"></td>
                <td style="border-left: 1px solid black"></td>
                <td style="border-left: 1px solid black"></td>
                <td style="border-left: 1px solid black"></td>
                <td style="border-left: 1px solid black"></td>
                <td style="border-left: 1px solid black"></td>
                <td style="border-left: 1px solid black"></td>
                <td style="border-left: 1px solid black;border-right: 1px solid black"></td>

                </tr>';
              }

            $set_html .= '
            <tr>
              <td colspan="9" style="border-top:1px solid black;border-bottom:1px solid black;border-left:1px solid black;border-right:1px solid black"><b>Summary from January 1, 2015 - '.date('F j, Y').' </b><i>*Temporary - All data are being updated</i></td>
            </tr>
            </tbody>

            </table>
            ';
            $tcpdf->writeHTML($set_html, true,0,true);
          }
        $tcpdf->SetTitle('Summary - '.$data[0]["office"]);
        $tcpdf->Output('Summary - '.$data[0]["office"].'.pdf', 'I');
      }else{
        $tcpdf->AddPage('L','A4');
        $set_html = "<br><br><br><br><b> NO DATA! </b>";
        $tcpdf->writeHTML($set_html, true,0,true);
        $tcpdf->SetTitle('Summary - ');
        $tcpdf->Output('Summary - '.'.pdf', 'I');
      }
    }


    public function array_by_year(){
      // coder for CodeIgniter TCPDF Integration
      // make new advance pdf document
      $tcpdf = new Pdf2(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

      // set document information
      $tcpdf->SetCreator('SPPMO');
      $tcpdf->SetAuthor('SPPMO');
      $tcpdf->SetSubject('');

      // set default margins
      $tcpdf->SetMargins("5", PDF_MARGIN_TOP, "5");
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
      $tcpdf->setFontSubsetting(true);


      //Set some substance to print
      /*$data="";
      $data['equipments']=$this->supplyModel->getEquipments($areid);
      $data['personDetails']=$this->supplyModel->getPersonDetails($areid);
      $data['supplyDetails']=$this->supplyModel->getSupplyDetails($areid);
      */
      $raw=$this->input->post(NULL,TRUE);
      $raw["Code"]=0;
      $data=$this->summaryModel->getByYear($raw);
      //print_r($data);
      //print_r($data["head"]);


      $eqptLength=count($data);
      $supplier="";
      $or="";
      $dateGiven="";
      $titleParics="";
      if($raw["opt"]==1){
        $titleParics="INVENTORY CUSTODIAN SLIP";
      }else if($raw["opt"]==2){
        $titleParics="PROPERTY ACKNOWLEDGEMENT RECEIPT";
      }else{
        $titleParics="";
      }
      $isDoneAll=false;
      $equipCounter=0;
      //print_r($data);
      if($data!=null ){
        while(!$isDoneAll){
          $tcpdf->AddPage('L','A4');
          $tcpdf->SetFont('times', '', 10, '', true);
          $set_html = '
          <br><br><div style="text-align: center;font-size:15"><b>SUMMARY (By Year)</b></div>
          <b style="text-align: center;font-size:10">'.$titleParics.'</b></div><br>
          
          <table cellspacing="0" cellpadding="2" nobr="True">
            <thead>
              <tr style="text-align: center;font-size:10">
                <td width="14%" style="border-left:1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;"><b>End User</b></td>
                <td width="3%" style="border-left:1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;"><b>Qty</b></td>
                <td width="4%" style="border-left:1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;font-size:9"><b>Unit</b></td>
                <td width="27%" style="border-left:1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;"><b>Description</b></td>
                <td width="9%" style="border-left:1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;"><b>Date Acquired</b></td>
                <td width="21%" style="border-left:1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;"><b>Property No.</b></td>
                <td width="8%" style="border-left:1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;"><b>Unit Price</b></td>
                <td width="8%" style="border-left:1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;"><b>Total Amount</b></td>
                <td width="6%" style="border-left:1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;border-right: 1px solid black;"><b>Reference</b></td>
              </tr>
            </thead>
            <tbody>
            ';
            $equipLineAvail=24;
            $ctr=1; //for spaces between equip; every 4 equip 1 space
            while($eqptLength>$equipCounter && $equipLineAvail>0){
              $date=explode("-",$data[$equipCounter]["dateGiven"]);
              if($date[0]==""){
                $date="1111-11-11";
              }
              $month="";
              switch($date[1]){
                case "01":
                  $month="Jan";
                  break;
                case "02":
                  $month="Feb";
                  break;
                case "03":
                  $month="Mar";
                  break;
                case "04":
                  $month="Apr";
                  break;
                case "05":
                  $month="May";
                  break;
                case "06":
                  $month="Jun";
                  break;
                case "07":
                  $month="Jul";
                  break;
                case "08":
                  $month="Aug";
                  break;
                case "09":
                  $month="Sep";
                  break;
                case "10":
                  $month="Oct";
                  break;
                case "11":
                  $month="Nov";
                  break;
                case "12":
                  $month="Dec";
                  break;
              }
              $dateIssued=$month." ".$date[2].", ".$date[0];
              $office=$data[$equipCounter]['officeAcronym'];
              $enduser=ucwords(strtolower($data[$equipCounter]["firstName"]." ".$data[$equipCounter]["surName"]." ".$data[$equipCounter]["suffixName"]));
              $qty=(float)$data[$equipCounter]["qty"];
              $unit=$data[$equipCounter]["unit"];
              $unitPrice=(float)$data[$equipCounter]["unitPrice"];
              $desc=$data[$equipCounter]["equipmentDesc"];

              $yr= substr(mb_substr($data[$equipCounter]["dateIssued"], 0, 4),-2);
              $propNo=$data[$equipCounter]["code"].$data[$equipCounter]["subCode"]."-".$data[$equipCounter]["fundCode"]."-";
              $propNo.=$yr."-".$data[$equipCounter]["officeCode"]."-".$data[$equipCounter]["seq"];

              $amt=number_format(round((($qty*$unitPrice)*100)/100,2),2,'.',',');

              $descChar=mb_strlen($desc, 'utf8');
              $equipLine=(((($descChar/40)*100)/100));
              $decimal=0;
              if($equipLine<1)
                $decimal=$equipLine;
              else
                $decimal=$equipLine - floor($equipLine);
              if(floor($equipLine)==0)
                $equipLine=1;
              else{
                $equipLine=floor($equipLine);
                if($decimal>0.15){
                  $equipLine++;
                }
              }

              if(strstr($desc, "\n")){
                $equipLine++;
              }
              if($ctr%4==0) //for spaces between equip; every 4 equip 1 space
                $equipLineAvail--;

              $ctr++;
              $equipLineAvail-=$equipLine;
              //echo $equipLine."<br>";
              if($equipLineAvail<=0){
                //echo "x<br>";
                //echo $equipLineAvail+$equipLine." ";

                ////$equipCounter--;
                continue;
              }
              $set_html .= '
                <tr height="5%">
                    <td width="14%" style="text-align: center;border-left:1px solid black;">'.$enduser.'</td>
                    <td width="3%" style="text-align: center;border-left:1px solid black;">'.$qty.'</td>
                    <td width="4%" style="text-align: center;border-left:1px solid black;">'.$unit.'</td>
                    <td width="27%" style="text-align: left;border-left:1px solid black;">'.$desc.'</td>
                    <td width="9%" style="text-align: center;border-left:1px solid black;">'.$dateIssued.'</td>
                    <td width="21%" style="text-align: left;border-left:1px solid black;">'.$propNo.'</td>
                    <td width="8%" style="text-align: right;border-left:1px solid black;">'.number_format(round(($unitPrice*100)/100,2),2,'.',',').'</td>
                    <td width="8%" style="text-align: right;border-left:1px solid black;">'.$amt.'</td>
                    <td width="6%" style="text-align: left;border-left:1px solid black;border-right: 1px solid black;">'.$data[$equipCounter]["parics"].'</td>
                </tr>
              ';
              $equipCounter++;
            }
              if($eqptLength<=$equipCounter){
                if($equipLineAvail<0){
                  $equipLineAvail=$equipLineAvail+1;
                }else{
                  $equipLineAvail=$equipLineAvail-1;
                }
                $set_html .= '
                  <tr>
                  <td style="border-left: 1px solid black;"></td>
                  <td style="border-left: 1px solid black;"></td>
                  <td style="border-left: 1px solid black;"></td>
                  <td style="border-left: 1px solid black;">*************nothing follows*************</td>
                  <td style="border-left: 1px solid black;"></td>
                  <td style="border-left: 1px solid black;"></td>
                  <td style="border-left: 1px solid black;"></td>
                  <td style="border-left: 1px solid black;"></td>
                  <td style="border-left: 1px solid black;border-right: 1px solid black"></td>
                  </tr>';
                $isDoneAll=true;
              }
              if($equipLineAvail<=0){
                $equipLineAvail+=$equipLine;
              }
              $equipLineAvail=$equipLineAvail-floor($equipLineAvail/4);
              for($k=0;$k<$equipLineAvail;$k++){
                $set_html .= '
                <tr>
                <td style="border-left: 1px solid black"></td>
                <td style="border-left: 1px solid black"></td>
                <td style="border-left: 1px solid black"></td>
                <td style="border-left: 1px solid black"></td>
                <td style="border-left: 1px solid black"></td>
                <td style="border-left: 1px solid black"></td>
                <td style="border-left: 1px solid black"></td>
                <td style="border-left: 1px solid black"></td>
                <td style="border-left: 1px solid black;border-right: 1px solid black"></td>

                </tr>';
              }

            $set_html .= '
            <tr>
              <td colspan="9" style="border-top:1px solid black;border-bottom:1px solid black;border-left:1px solid black;border-right:1px solid black"><b>Summary from January 1, 2015 - '.date('F j, Y').' </b><i>*Temporary - All data are being updated</i></td>
            </tr>
            </tbody>

            </table>
            ';
            $tcpdf->writeHTML($set_html, true,0,true);
          }
        $date_filter = $data[0]["dateGiven"];
        $new_date_filter = substr($date_filter, 0, 4);
        $tcpdf->SetTitle('Summary - '.$new_date_filter);
        $tcpdf->Output('Summary - '.$data[0]["office"].'.pdf', 'I');
      }else{
        $tcpdf->AddPage('L','A4');
        $set_html = "<br><br><br><br><b> NO DATA! </b>";
        $tcpdf->writeHTML($set_html, true,0,true);
        $tcpdf->SetTitle('Summary - ');
        $tcpdf->Output('Summary - '.'.pdf', 'I');
      }
    }


    public function array_by_year_csv(){

    // file name
    $doc_type = $this->input->post('opt_csv');

    if($doc_type==1){
      $_fName = "ICS_";
    }elseif($doc_type==2){
      $_fName = "PAR_";
    }else{
      $_fName = "All_";
    }

    $filter_year_csv = $this->input->post('filter_year_csv');


    $filename = $_fName. $filter_year_csv.'.csv';

    header('Content-Encoding: UTF-8');
    header("Content-Type: text/html; charset=utf-8");
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=$filename");
    header("Content-Type: application/csv; "); 

    // get data
    $data=$this->summaryModel->export_csv();
   
    // normalizing special characters
    echo "\xEF\xBB\xBF";
    $file = fopen('php://output', 'w');

    $header = array("End User","Array #","Qty","Unit","Unit Price","Amount","Description","Date Given","Obligation","PO Number","PR Number","OR Number","Supplier","Property Number");

   
    fputcsv($file, $header);

    foreach ($data as $line){
    

      $line=array($line["firstName"]." ".$line["surName"], $line["parics"], $line["qty"], $line["unit"], $line["unitPrice"], $line["amount"], $line["equipmentDesc"], $line["dateGiven"], $line["obligation"], $line["poNumber"], $line["prNumber"], $line["orNumber"],$line["supplier"], $line["code"].$line["subCode"]."-".$line["fundCode"]."-".substr($line["dateIssued"],2,2)."-".$line["officeCode"]."-".$line["seq"]);
     fputcsv($file,$line);
    }

    fclose($file);
    exit;
    
    }

    public function byEquip(){
      // coder for CodeIgniter TCPDF Integration
      // make new advance pdf document
      $tcpdf = new Pdf2(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

      // set document information
      $tcpdf->SetCreator('SPPMO');
      $tcpdf->SetAuthor('SPPMO');
      $tcpdf->SetSubject('');

      // set default margins
      $tcpdf->SetMargins("15", PDF_MARGIN_TOP, "10");
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
      $tcpdf->setFontSubsetting(true);


      //Set some substance to print
      /*$data="";
      $data['equipments']=$this->supplyModel->getEquipments($areid);
      $data['personDetails']=$this->supplyModel->getPersonDetails($areid);
      $data['supplyDetails']=$this->supplyModel->getSupplyDetails($areid);
      */
      $raw=$this->input->post(NULL,TRUE);
      $raw["opt"]=0;
      //print_r($raw);
      $data=$this->summaryModel->getEquipOffice($raw);
      //print_r($data);

      //print_r($data["head"]);

      if($data!=null){
      $yr= substr(mb_substr($data[0]["dateIssued"], 0, 4),-2);
      $eqptLength=count($data);
      $supplier="";
      $or="";
      $dateGiven="";
      $titleParics="";
      if($raw["opt"]==1){
        $titleParics="INVENTORY CUSTODIAN SLIP";
      }else if ($raw["opt"]==2) {
        $titleParics="PROPERTY ACKNOWLEDGEMENT RECEIPT";
      }
      $isDoneAll=false;
      $equipCounter=0;
        while(!$isDoneAll){
          $tcpdf->AddPage('L','A4');
          $tcpdf->SetFont('times', '', 10, '', true);
          $set_html = '
          <br><br><div style="text-align: center;font-size:15"><b>SUMMARY (By Equipment)</b></div>
          <b style="text-align: center;font-size:10">'.$titleParics.'</b></div><br>
          <b>Property No: '.$data[0]["code"].$data[0]["subCode"].'</b><br>
          <table cellspacing="0" cellpadding="2" nobr="True">
            <thead>
              <tr style="text-align: center;font-size:10">
                <td width="14%" style="border-left:1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;"><b>End User</b></td>
                <td width="4%" style="border-left:1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;"><b>Qty</b></td>
                <td width="6%" style="border-left:1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;font-size:9"><b>Unit</b></td>
                <td width="26%" style="border-left:1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;"><b>Description</b></td>
                <td width="11%" style="border-left:1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;"><b>Date Acquired</b></td>
                <td width="16%" style="border-left:1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;"><b>Office</b></td>
                <td width="8%" style="border-left:1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;"><b>Unit Price</b></td>
                <td width="8%" style="border-left:1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;"><b>Total Amount</b></td>
                <td width="7%" style="border-left:1px solid black;border-top: 1px solid black;border-bottom: 1px solid black;border-right: 1px solid black;"><b>PAR No.</b></td>
              </tr>
            </thead>
            <tbody>
            ';
            $ctr=1;
            $equipLineAvail=24;
            while($eqptLength>$equipCounter && $equipLineAvail>0){
              $date=explode("-",$data[$equipCounter]["dateGiven"]);

              if($date[0]==""){
                $date="1111-11-11";
              }
              $month="";
              switch($date[1]){
                case "01":
                  $month="Jan";
                  break;
                case "02":
                  $month="Feb";
                  break;
                case "03":
                  $month="Mar";
                  break;
                case "04":
                  $month="Apr";
                  break;
                case "05":
                  $month="May";
                  break;
                case "06":
                  $month="Jun";
                  break;
                case "07":
                  $month="Jul";
                  break;
                case "08":
                  $month="Aug";
                  break;
                case "09":
                  $month="Sep";
                  break;
                case "10":
                  $month="Oct";
                  break;
                case "11":
                  $month="Nov";
                  break;
                case "12":
                  $month="Dec";
                  break;
              }
              $dateIssued=$month." ".$date[2].", ".$date[0];
              $office=strtoupper($data[$equipCounter]["officeAcronym"]);
              $enduser=ucwords(strtolower($data[$equipCounter]["firstName"]." ".mb_substr($data[$equipCounter]["middleName"], 0, 1, 'utf-8').". ".$data[$equipCounter]["surName"]." ".$data[$equipCounter]["suffixName"]));
              $qty=(float)$data[$equipCounter]["qty"];
              $unit=$data[$equipCounter]["unit"];
              $unitPrice=(float)$data[$equipCounter]["unitPrice"];
              $desc=$data[$equipCounter]["equipmentDesc"];
              $amt=number_format(round((($qty*$unitPrice)*100)/100,2),2,'.',',');

              $descChar=mb_strlen($desc, 'utf8');
              $equipLine=(((($descChar/40)*100)/100));
              $decimal=0;
              if($equipLine<1)
                $decimal=$equipLine;
              else
                $decimal=$equipLine - floor($equipLine);
              if(floor($equipLine)==0)
                $equipLine=1;
              else{
                $equipLine=floor($equipLine);
                if($decimal>0.15){
                  $equipLine++;
                }
              }

              if(strstr($desc, "\n")){
                $equipLine++;
              }
              if($ctr%4==0) //for spaces between equip; every 4 equip 1 space
                $equipLineAvail--;

              $ctr++;
              $equipLineAvail-=$equipLine;
              //echo $equipLine."<br>";
              if($equipLineAvail<=0){
                //echo "x<br>";
                //echo $equipLineAvail+$equipLine." ";

                ////$equipCounter--;
                continue;
              }
              $set_html .= '
                <tr height="5%">
                    <td width="14%" style="text-align: center;border-left:1px solid black;">'.$enduser.'</td>
                    <td width="4%" style="text-align: center;border-left:1px solid black;">'.$qty.'</td>
                    <td width="6%" style="text-align: center;border-left:1px solid black;">'.$unit.'</td>
                    <td width="26%" style="text-align: left;border-left:1px solid black;">'.$desc.'</td>
                    <td width="11%" style="text-align: center;border-left:1px solid black;">'.$dateIssued.'</td>
                    <td width="16%" style="text-align: left;border-left:1px solid black;">'.$office.'</td>
                    <td width="8%" style="text-align: right;border-left:1px solid black;">'.number_format(round(($unitPrice*100)/100,2),2,'.',',').'</td>
                    <td width="8%" style="text-align: right;border-left:1px solid black;">'.$amt.'</td>
                    <td width="7%" style="text-align: left;border-left:1px solid black;border-right: 1px solid black;">'.$data[$equipCounter]["parics"].'</td>
                </tr>
              ';
              $equipCounter++;
            }
              if($eqptLength<=$equipCounter){
                if($equipLineAvail<0){
                  $equipLineAvail=$equipLineAvail+1;
                }else{
                  $equipLineAvail=$equipLineAvail-1;
                }
                $set_html .= '
                  <tr>
                  <td style="border-left: 1px solid black;"></td>
                  <td style="border-left: 1px solid black;"></td>
                  <td style="border-left: 1px solid black;"></td>
                  <td style="border-left: 1px solid black;">********nothing follows********</td>
                  <td style="border-left: 1px solid black;"></td>
                  <td style="border-left: 1px solid black;"></td>
                  <td style="border-left: 1px solid black;"></td>
                  <td style="border-left: 1px solid black;"></td>
                  <td style="border-left: 1px solid black;border-right: 1px solid black"></td>
                  </tr>';
                $isDoneAll=true;
              }
              if($equipLineAvail<=0){
                $equipLineAvail+=$equipLine;
              }
              $equipLineAvail=$equipLineAvail-floor($equipLineAvail/4);
              for($k=0;$k<$equipLineAvail;$k++){
                $set_html .= '
                <tr>
                <td style="border-left: 1px solid black"></td>
                <td style="border-left: 1px solid black"></td>
                <td style="border-left: 1px solid black"></td>
                <td style="border-left: 1px solid black"></td>
                <td style="border-left: 1px solid black"></td>
                <td style="border-left: 1px solid black"></td>
                <td style="border-left: 1px solid black"></td>
                <td style="border-left: 1px solid black"></td>
                <td style="border-left: 1px solid black;border-right: 1px solid black"></td>

              </tr>';
            }
            $set_html .= '
            <tr>
              <td colspan="9" style="border-top:1px solid black;border-bottom:1px solid black;border-left:1px solid black;border-right:1px solid black"><b>Summary from January 1, 2015 - '.date('F j, Y').' </b><i>*Temporary - All data are being updated</i></td>
            </tr>
            </tbody>

            </table>
            ';

            $tcpdf->writeHTML($set_html, true,0,true);
          }
        $tcpdf->SetTitle('Summary - '.$data[0]["code"].$data[0]["dateGiven"]);
        $tcpdf->Output('Summary - '.$data[0]["code"].$data[0]["subCode"].'.pdf', 'I');
      }else{
        $tcpdf->AddPage('L','A4');
        $set_html = "<br><br><br><br><b> NO DATA! </b>";
        $tcpdf->writeHTML($set_html, true,0,true);
        $tcpdf->SetTitle('Summary - ');
        $tcpdf->Output('Summary - '.'.pdf', 'I');
      }
    }
}
/* end tcpdfexample.php file for CodeIgniter TCPDF Integration */
?>
