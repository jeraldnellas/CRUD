<?php
require('pdf_gen/fpdf.php');
include_once "db/db_con.php";

$select = "SELECT * FROM `data entry`";
$result = mysqli_query($con, $select);


$pdf = new FPDF('P', 'mm', "Letter");
$pdf->AddPage();
$pdf->SetFont('Arial','',11);
$pdf->Image('img/mori 2022 letterhead.png', 40, 10, -300);

$pdf-> Ln(30).

$pdf->Cell(25,6,'TO :',0, 0,'L');
$pdf->SetFont('Arial','B',11);
$pdf->Cell(40,6,'HAIF COMPANY ',0, 0,'L');
$pdf->SetFont('Arial','',11);
// DATE
$pdf->Cell(40,6,'',0, 0,'C');
$pdf->Cell(15,6,'DATE :',0, 0,'L');
$pdf->Cell(60,6,'Aug 6, 2023',0, 1,'L');
// ATTN
$pdf->Cell(25,6,'ATTN :',0, 0,'L');
$pdf->Cell(40,6,'MR. ALINOR HADJIZAMAN ',0, 0,'L');
// ATTN EMAIL
$pdf->Cell(40,6,'',0, 0,'C');
$pdf->Cell(15,6,'Email :',0, 0,'L');
$pdf->Cell(40,6,'Alinor.Hadjizaman@haifcompany.com',0, 1,'L');
// ATTN EMAIL
$pdf->Cell(25,6,'',0, 0,'L');
$pdf->Cell(40,6,'Executive Assistant',0, 0,'L');


$pdf->Cell(40,6,'',0, 0,'C');
$pdf->Cell(15,6,'Email :',0, 0,'L');
$pdf->Cell(40,6,'Alinor.Hadjizaman@haifcompany.com',0, 1,'L');
// CC
$pdf->Cell(25,6,'CC :',0, 0,'L');
$pdf->Cell(40,6,'MR. SAEED SAUD ALKAHTANI',0, 0,'L');

$pdf->Cell(40,6,'',0, 0,'C');
$pdf->Cell(15,6,'Email :',0, 0,'L');
$pdf->Cell(40,6,'Alinor.Hadjizaman@haifcompany.com',0, 1,'L');

$pdf->Cell(25,6,'',0, 0,'L');
$pdf->Cell(40,6,'CEO-DA',0, 1,'L');

$pdf->Cell(25,6,'SUBJECT :',0, 0,'L');
$pdf->Cell(40,6,'CVS FOR TRANSMISSION',0, 0,'L');

$pdf->Cell(40,6,'',0, 0,'C');
$pdf->Cell(15,6,'REF :',0, 0,'L');
$pdf->Cell(40,6,'JMN-08-2023-09-E',0, 1,'L');

$pdf-> Ln(2).
// line
$pdf->Cell(195,0,'',1, 1,'R');
$pdf-> Ln(5).

$pdf->Cell(195, 0, 'Dear Mr. Alinor,',0, 1,'L');
$pdf-> Ln(5).
$pdf->MultiCell(195, 5, 'We are forwarding to you today August 16, 2023 thru e-mail shortlisted, CVs of the following applicants w/ relevant exp. for your review, evaluation, and final selection, to wit.',0,'J', false);
// CV's transmission

$pdf-> Ln(5).
$pdf->SetFont('Arial','B',11);

$pdf->Cell(10,14,'SN',1,0,'C');
$pdf->Cell(50,14,'Name',1,0,'C');
$pdf->Cell(10,14,'Age',1,0,'C');
$pdf->Cell(30,14,'Position',1,0,'C');
$pdf->Cell(40,7,'Experience',1,0,'C');
$pdf->Cell(15,14,'PPT',1,0,'C');
$pdf->Cell(30,14,'Asking Salary',1,0,'C');
$pdf->Cell(10,7,'',0,1,'C');
$pdf->Cell(100,7,'',0,0,'C');
$pdf->Cell(20,7,'Local',1,0,'C');
$pdf->Cell(20,7,'Abroad',1,1,'C');

$count = 1;
while($row = mysqli_fetch_assoc($result)){
$count;
$pdf->Cell(10,8,$count,1,0,'C');
$pdf->Cell(50,8,$row['name'],1,0,'C');
$pdf->Cell(10,8,$row['age'],1,0,'C');
$pdf->Cell(30,8,$row['position'],1,0,'C');
$pdf->Cell(20,8,$row['local'],1,0,'C');
$pdf->Cell(20,8,$row['abroad'],1,0,'C');
$pdf->Cell(15,8,$row['passport'],1,0,'C');
$pdf->MultiCell(30,8,'SR'.$row['salary'],1,'C');
$count++;
}
$pdf-> Ln(10).
$pdf->SetFont('Arial','',11);
$pdf->MultiCell(195, 5, 'Additional Shortlisted CVs to follow soon, after evaluation of candidates, qualifications & the confirmation of the candidates availability and willingness to accept job assignment.',0,'J', false);

$pdf-> Ln(3).
$pdf->MultiCell(195, 5, 'Please acknowledge receipt thereof and advise result of your evaluation thru return e mail.',0,'J', false);
$pdf-> Ln(3).
$pdf->MultiCell(195, 5, 'Please do not delay your selection, because we have no control over their mobility, from agency-to-agency.',0,'J', false);

$pdf-> Ln(3).

$pdf->MultiCell(195, 5, 'Thank you and best regards.                                                         ',0,'J', false);

$pdf-> Ln(15).
$pdf->SetFont('Arial', 'B', 11);
// $pdf->SetLineWidth(1);
$pdf->Cell(80,8,'JERALD M. NELLAS',0,0,'C');

$pdf->Cell(140,10,'Ding Carola',0,1,'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(80, 5, 'IT Staff',0,0,'C');
$pdf->Cell(140, 5, 'CEO/ President',0,1,'C');




$pdf->Output();
?>