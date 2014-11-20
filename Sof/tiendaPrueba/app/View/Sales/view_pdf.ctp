<?php 

App::import('Vendor','xtcpdf');

$tcpdf = new XTCPDF();
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
$tcpdf->SetFont('times','',15);

    $brand = $credit[0]['CreditCard']['brand'];
    $last_number=substr($card, 12, 4);

// set some text to print
$txt = <<<EOD
Date: $created
Bill Number:  $factura_id

User:  $user_name $user_last_name

Delivery Information:

    $state, $country
    $city, $street

Payment Method:  $brand  ****-****-****-$last_number

Products:
EOD;

// print a block of text using Write()
$tcpdf->Write(10, $txt, '', 0, 'L', true, 0, false, false);

for($i=0;$i<sizeof($vprod);$i++){
    $pname = $vprod[$i]['Product']['name'];
    $pprice = $vprod[$i]['Product']['price'] - ($vprod[$i]['Product']['price']*$vprod[$i]['Product']['discount'])/100;;
    $pquantity = $quantity[$i]['ProductSale']['quantity'];

if($pquantity>1){
    $punit='units';
}else{
    $punit='unit';
}

$txt1 = <<<EOD
  *  $pname:
          $pquantity  $punit
          $currency$pprice  p/u.

EOD;
$tcpdf->Write(10, $txt1, '', 0, 'L', true, 0, false, false);
}

$txt2 = <<<EOD
SubTotal: $currency$subtotal

Tax: $currency$tax

Shipping: $currency$shipping

Frequenly Costumer Discount: $currency$frequenly_costumer_discount

Total: $currency$total
EOD;

$tcpdf->Write(10, $txt2, '', 0, 'L', true, 0, false, false);


// reset pointer to the last page
$tcpdf->lastPage();

echo $tcpdf->Output('Bill_FutureStore.pdf', 'D');

?>