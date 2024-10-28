<?php
require('fpdf/fpdf.php');
$page = $_GET['page'];
// echo $page; exit;

if ($page == 'candidates'){
$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('times','B',10);
$pdf->Cell(48,7,"Candidate Name");
$pdf->Cell(64,7,"Club");
$pdf->Cell(65,7,"Position");
$pdf->Cell(30,7,"Total Votes");
$pdf->Ln();
$pdf->Cell(594,7,"----------------------------------------------------------------------------------------------------------------------------------------------------------------------");
$pdf->Ln();

        include ('../includes/all-select-data.php');
        while($result=mysqli_fetch_assoc($can_data))
        {
            $cand_name = $result['cname'];
            $Club = ucwords($result['club']);
            // $Photo = $result['photo'];
            $Position = $result['position_name'];
            $tvotes = $result['tvote'];
            // $email = $rows[5];
            $pdf->Cell(48,7,$cand_name);
            $pdf->Cell(64,7,$Club);
            $pdf->Cell(65,7,$Position);
            $pdf->Cell(30,7,$tvotes);
            $pdf->Ln(); 
        }
$pdf->Output();
}


if ($page == 'clubs'){
$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('times','B',10);
$pdf->Cell(48,7,"Club Name");
$pdf->Cell(65,7,"Position");
$pdf->Cell(30,7,"Total Votes");
$pdf->Ln();
$pdf->Cell(566,7,"----------------------------------------------------------------------------------------------------------------------------------------------------------------------");
$pdf->Ln();

        include ('../includes/all-select-data.php');
        while($result=mysqli_fetch_assoc($club_data))
        {
            $cand_name = $result['club_name'];
            // $Photo = $result['photo'];
            $Position = $result['position_name'];
            $tvotes = $result['tvote'];
            // $email = $rows[5];
            $pdf->Cell(48,7,$cand_name);
            $pdf->Cell(65,7,$Position);
            $pdf->Cell(30,7,$tvotes);
            $pdf->Ln(); 
        }
$pdf->Output();
}
?>