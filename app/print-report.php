<?php
include('include/config.php');
require('fpdf/fpdf.php');
$page = $_GET['page'];
// echo $page; exit;
if ($page == 'donation'){
$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('times','B',10);
$pdf->Cell(50,7,"Project");
$pdf->Cell(40,7,"Name");
$pdf->Cell(15,7,"Amount");
$pdf->Cell(30,7,"Phone");
$pdf->Cell(35,7,"Payment Ref");
$pdf->Cell(10,7,"Date");
$pdf->Ln();
$pdf->Cell(400,7,  "----------------------------------------------------------------------------------------------------------------------------------------------------------------------");
$pdf->Ln();

$query = "SELECT * from tbldonations d JOIN tblcoreprojects cp ON cp.coreprojectID = d.coreprojectID";
// echo $query; exit;
$donationssql = mysqli_query($con, $query);

        while($result=mysqli_fetch_array($donationssql))
        {
            $projectTitle = $result['projectTitle'];
            $fullName = ucwords($result['fullName']);
            // $Photo = $result['photo'];
            $amount = $result['amount'];
            $phone = $result['phone'];
            $paymentRef = $result['paymentRef'];
            $dateUpdated = $result['dateUpdated'];
            // $email = $rows[5];
            $pdf->Cell(50,7,$projectTitle);
            $pdf->Cell(40,7,$fullName);
            $pdf->Cell(15,7,$amount);
            $pdf->Cell(30,7,$phone);
            $pdf->Cell(35,7,$paymentRef);
            $pdf->Cell(10,7,$dateUpdated);
            $pdf->Ln(); 
        }
$pdf->Output();
}

if ($page == 'event-register'){

    
    $pdf=new FPDF();
    // $newL=7; 
$pdf->AddPage('L', 'A4');
$pdf->SetFont('Arial','B',10);
$pdf->Ln();
$pdf->Ln();
$pdf->SetTextColor('times','B',10);

$pdf->cell(65, 7, "Event");
// $pdf->SetXY(0,0);
$pdf->Cell(50,7,"Name");
$pdf->Cell(20,7,"Category");
$pdf->Cell(40,7,"Club");
$pdf->Cell(15,7,"Amount");
$pdf->Cell(25,7,"Phone");
$pdf->Cell(25,7,"Payment Ref");
$pdf->Cell(30,7,"Date Paid");
$pdf->Ln();
$pdf->Cell(150,7,"----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------");
$pdf->Ln();
                $query = "SELECT * from tbleventregister r JOIN tblevents e ON e.eventID  = r.eventID ";
					// echo $query; exit;
					$sql = mysqli_query($con, $query);
        while($result=mysqli_fetch_assoc($sql))
        {
            $eventTitle = $result['eventTitle'];
            // $Photo = $result['photo'];
            $fullName = $result['fullName'];
            $regsterCategory = $result['regsterCategory'];
            $clubName = $result['clubName'];
            $amount = $result['amount'];
            $phoneNo = $result['phoneNo'];
            $paymentRef = $result['paymentRef'];
            $datePaid = Date('d-m-Y', strtotime($result['datePaid']));
            // $email = $rows[5];
            $pdf->cell(65, 7, $eventTitle);
            // $pdf->SetY(25);
            $pdf->cell(50, 7,$fullName);
            $pdf->cell(20,7,$regsterCategory);
            $pdf->Cell(40,7,$clubName);
            $pdf->Cell(15,7,$amount);
            $pdf->Cell(25,7,$phoneNo);
            $pdf->Cell(25,7,$paymentRef);
            $pdf->Cell(30,7,$datePaid);
            $pdf->Ln(); 
        }
$pdf->Output();
}
?>