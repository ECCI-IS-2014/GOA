<?php 

App::import('Vendor','xtcpdf');
App::import('Vendor','tcpdf/tcpdf');


// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        //$image_file = 'C:\xampp\htdocs\GOA\Sof\tiendaPrueba\app\Vendor\tcpdf\examples\images\logo_header.jpg';
        $this->Image('http://i.imgur.com/7nXSwKo.png', 0, 0, 220, 35, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        // Title
        //$this->Cell(0, 15, 'Future Store', 0, false, 'C', 0, '', 0, false, 'M', 'M');
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

$tcpdf = new MYPDF();
$textfont = 'freesans'; // looks better, finer, and more condensed than 'dejavusans'

$tcpdf->SetAuthor("Future Store");
$tcpdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$tcpdf->setHeaderFont(array($textfont,'',40));

//$tcpdf->xheadercolor = array(150,0,0);
//$tcpdf->xheadertext = 'Future Store';
$tcpdf->xfootertext = 'Copyright Â© %d Future Store. All rights reserved.';


// Now you position and print your page content
$tcpdf->SetTextColor(0, 0, 0);
$tcpdf->SetFont($textfont,'B',20);
$tcpdf->setPrintHeader(true);

// set margins
$tcpdf->SetMargins(PDF_MARGIN_LEFT, 46.5, PDF_MARGIN_RIGHT);
$tcpdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$tcpdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// add a page (required with recent versions of tcpdf)
$tcpdf->AddPage();

// set image scale factor
$tcpdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set the text font and size
$tcpdf->SetFont('times','',18);

// set some text to print
$txt = <<<EOD
Date: $created
Bill Number:  $factura_id

User:  $user_id

Delivery Information:
    San Jose, Costa Rica
    8 Street, 13 Avenue Garden's S.A
    3 floor, Dep 12

Payment Method: $method_payment_id

Products:
EOD;
//¢ $ € //los simbolos se pueden usar cuando lo de el cambio de  modena funcione bien
// print a block of text using Write()
$tcpdf->Write(10, $txt, '', 0, 'L', true, 3, false, false, 0);

for($i=0;$i<sizeof($vprod);$i++){
    $pname=$vprod[$i]['Product']['name'];
    $pprice=$vprod[$i]['Product']['price'];
$txt1 = <<<EOD
    $pname  $pprice

EOD;
$tcpdf->Write(10, $txt1, '', 0, 'L', true, 3, false, false, 0);
}

$txt2 = <<<EOD
SubTotal: $subtotal

Tax: $tax

Frequenly Costumer Discount: $frequenly_costumer_discount

Total: $total
EOD;

$tcpdf->Write(10, $txt2, '', 0, 'L', true, 3, false, false, 0);


// reset pointer to the last page
$tcpdf->lastPage();

echo $tcpdf->Output('bill.pdf', 'D');

?>