<?php
App::import('Vendor','tcpdf/tcpdf');

class XTCPDF  extends TCPDF {

    var $xheadertext  = 'Future Store';
    var $xheadercolor = array(0,0,200);
    var $xfootertext  = 'Copyright Â© %d XXXXXXXXXXX. All rights reserved.';
    var $xfooterfont  = PDF_FONT_NAME_MAIN ;
    var $xfooterfontsize = 8 ;


    /**
     * Overwrites the default header
     * set the text in the view using
     *    $fpdf->xheadertext = 'YOUR ORGANIZATION';
     * set the fill color in the view using
     *    $fpdf->xheadercolor = array(0,0,100); (r, g, b)
     * set the font in the view using
     *    $fpdf->setHeaderFont(array('YourFont','',fontsize));
     */
    //Page header
    public function Header() {
        // Logo
        $this->Image('http://i.imgur.com/7nXSwKo.png', 0, 0, 220, 35, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        // Title
        //$this->Cell(0, 15, $this->xheadertext, 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    function Footer() {
        $year = date('Y');
        $footertext = sprintf($this->xfootertext, $year);
        $this->SetY(-20);
        $this->SetTextColor(0, 0, 0);
        $this->SetFont('helvetica','',15);
        $this->Cell(0,8, $footertext,'T',1,'C');
    }
}
?>
