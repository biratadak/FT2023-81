<?php

session_start();

require '../vendor/autoload.php';
/**
 * Creates PDF as per given parameters.
 * 
 * @method Header()
 *  Creates header of the PDF.
 *  
 * @method Footer()
 *  Creates footer of the PDF.
 * 
 * @method setDetails()
 *  Sets details of the user in the PDF.
 * 
 */
class PDF extends FPDF
{
    public $name;
    public $mailId;
    public $marks;
    public $mobileNo;

    // Page header section.
    function Header()
    {
        // Logo
        $this->SetFillColor(193, 231, 255);
        $this->SetFont('Arial', '', 20);
        $this->SetTextColor(255, 121, 0);
        $this->Cell(95, 20, 'INNO', 0, 0, 'R', TRUE);
        $this->SetFont('Arial', 'B', 20);
        $this->SetTextColor(0, 51, 82);
        $this->Cell(95, 20, 'RAFT', 0, 0, 'L', TRUE);
        // Line break
        $this->Ln(20);
    }

    // Page footer section.
    function Footer()
    {
        // Position at 1.5 cm from bottom.
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Page number show
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    // Setting PDF details.
    function setDetails($name = "N/A", $mailId = "N/A", $marks = array(array("N/A", 0)), $mobileNo = "N/A")
    {
        $this->name = $name;
        $this->mailId = $mailId;
        $this->marks = $marks;
        $this->mobileNo = $mobileNo;
    }

}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->setDetails($_SESSION['name'], $_SESSION['mailId'], $_SESSION['marks'], $_SESSION['phoneNo']);

$pdf->Ln(10);
$pdf->Image('../uploaded_Images/' . $_SESSION['imagePath'], 165, 35, 35, 35);
// $pdf->Cell(25, 10,'../uploaded_Images/'.$_SESSION['imagePath'] );
$pdf->SetFont('Times', '', 12);
$pdf->Cell(25, 10, 'Name:' . $pdf->name, 0, 1, '');
$pdf->Cell(29, 10, 'Mail ID: ' . $pdf->mailId, 0, 1, '');
$pdf->Cell(34, 10, 'Mobile No: ' . $pdf->mobileNo, 0, 1, '');
$pdf->Ln(10);

$pdf->SetFillColor(194, 330, 230);
$pdf->Cell(95, 10, 'Subject', 1, 0, 'C', TRUE);
$pdf->Cell(95, 10, 'Marks', 1, 1, 'C', TRUE);
foreach ($_SESSION['marks'] as $m) {
    $pdf->Cell(95, 10, $m[0], 1, 0, 'C');
    $pdf->Cell(95, 10, $m[1], 1, 1, 'C');

}

$pdf->Output('D',"marksheet.pdf");
$pdf->Output('F',"../uploaded_PDFs/marksheet.pdf");

?>
