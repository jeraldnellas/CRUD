<?php
require('pdf_gen/fpdf.php');
include_once "db/db_con.php";


$select = "SELECT * FROM `pricing item`";
$result = mysqli_query($con, $select);
// $row = mysqli_fetch_assoc($result);

$pdf = new FPDF('P', 'mm', "A4");
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
// $pdf->Cell(40,10,'Hello World! Hi');

$pdf->Cell(190,6,'Hello World!',0, 0,'C');
$pdf->Cell(50,10,'',0,1);

$pdf->SetFont('Arial','B',10);
// heading
$pdf->Cell(10,6,'SI',1,0,'C');
$pdf->Cell(90,6,'Description',1,0,'C');
$pdf->Cell(30,6,'QTY',1,0,'C');
$pdf->Cell(30,6,'Unit Price',1,0,'C');
$pdf->Cell(30,6,'Total',1,1,'C');

$pdf->SetFont('Arial', '', 10);


$count = 1;
while($row = mysqli_fetch_assoc($result)){
$qty = $row['qty'];
$price = $row['price'];
$total = $qty * $price;
$pdf->Cell(10,6, $count, 1,0, 'C');
$pdf->Cell(90,6, $row['items'],1,0, 'C');
$pdf->Cell(30,6, $row['qty'],1,0,'C');
$pdf->Cell(30,6, $row['price'],1,0,'C');
$pdf->Cell(30,6, $total,1,1, 'C');
$count++;
}


$pdf->SetFont('Arial', '', 10);



// $pdf->SetFont('Arial','B',11);
// // heading
// $pdf->Cell(10,10,'SN',1,0,'C');
// $pdf->Cell(50,10,'Name',1,0,'C');
// $pdf->Cell(20,10,'Gender',1,0,'C');
// $pdf->Cell(40,10,'Position',1,0,'C');
// $pdf->Cell(35,10,'Mobile Nos.',1,0,'C');
// $pdf->Cell(35,10,'Remarks',1,1,'C');


// $count = 1;
// while ($row = mysqli_fetch_assoc($result)){
// $pdf->Cell(10,10,$count,1,0,'C');
// $pdf->Cell(50,10,$row['name'],1,0,'C');
// $pdf->Cell(20,10,$row['gender'],1,0,'C');
// $pdf->Cell(40,10,$row['position'],1,0,'C');
// $pdf->Cell(35,10,$row['mobile_nos'],1,0,'C');
// $pdf->Cell(35,10,$row['remarks'],1,1,'C');
// $count++;
// }
// $pdf-> Ln().
// $pdf-> Ln().

// $pdf->SetFont('Arial', 'B', 11);
// // $pdf->SetLineWidth(1);
// $pdf->Cell(80,8,'JERALD M. NELLAS',0,0,'C');

// $pdf->Cell(140,10,'Ding Carola',0,1,'C');
// $pdf->SetFont('Arial', '', 10);
// $pdf->Cell(80, 5, 'IT Staff',0,0,'C');
// $pdf->Cell(140, 5, 'CEO/ President',0,1,'C');

$pdf->Output();
?>