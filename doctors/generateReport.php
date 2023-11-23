<?php

require '../fpdf/fpdf.php';
require '../vendor/autoload.php';
include('../connection.php');
use Carbon\Carbon;


session_start();    

$dateNow = Carbon::now('Asia/Kolkata');


class PDF extends FPDF
{
    function Header()
    {
        $this->setFont('Arial','B',12);
        $this->SetTextColor(0, 100, 0);
        $this->Cell(50);
        $this->Cell(30, 10, 'RHU Tigaon', 0, 0, 'C');
        $this->Ln(5);
        $this->SetTextColor(0, 0, 0);
        $this->setFont('Arial','I',8);
        $this->Cell(50);    
        $this->Cell(30, 10, 'Rural Health Center', 0, 0, 'C');
        $this->Ln(10);
        $this->setFont('Arial','B',10);
        $this->Cell(30, 10, 'Caraycayon', 0, 0, 'L');
        $this->Ln(5);
        $this->Cell(40, 10, 'Tigaon, Camarines Sur', 0, 0, 'L');
        $this->setFont('Arial','B',10);
        $this->Cell(90, 10, 'GLOBE #: 099-888 9533', 0, 0, 'R');
        $this->Ln(5);
        $this->Cell(40, 10, 'SMART # : 0949-186 7344', 0, 0, 'L');
        $this->Cell(90, 10, 'LANDLINE GLOBE #: 0917-104 4106', 0, 0, 'R');
        $this->SetLineWidth(1.0);
        $this->Line('10', '45', '140', '45');
        $this->Line('10', '45', '140', '45');
        $this->Line('10', '45', '140', '45');
        $this->Ln(10);
        //border bottom for header

    }

    function Footer(){
        $this->SetY(-27);
        $this->setFont('Arial','B',10);
        $dr = utf8_decode('Dr. Peñafrancia Villanueva');
        $this->Cell(0,10,$dr,0,0,'R');
        $this->Ln(5);
        $this->setX(93);
        $this->Cell(50,10,'Lic. No. 0041638',0,0,'L');
        $this->Ln(5);
        $this->setX(93);
        $this->Cell(50,10,'PTR No. ',0,0,'L');

    }
}

if($_GET){
    $appointment_id = $_GET['prescription_id'];
    //get patient, appointments, records table
    $patient = $database->query("SELECT * FROM prescription INNER JOIN patient ON patient.pid = prescription.patient_id WHERE prescription_id = '$appointment_id'"); 
    $patient = $patient->fetch_assoc();
    $age = (isset($patient['page']) ? $patient['page'] : ' ');
    $appointmentTime = date('h:i A', strtotime($patient['created_at']));
    $sex = (isset($patient['psex']) ? $patient['psex'] : ' ');
    $pdf = new PDF('P','mm','A5');
    $pdf->AddPage();
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(70,10,'Name: '.$patient['f_name'].' '.$patient['l_name']);
    //create underline the name
    $pdf->SetLineWidth(0.5);
    $pdf->Line('23', '52', '80', '52');
    $pdf->Cell(40,10,'Age: '.$age);
    $pdf->SetLineWidth(0.5);
    $pdf->Line('90', '52', '120', '52');
    $pdf->Cell(40,10,'Sex: '.ucfirst($sex));
    $pdf->SetLineWidth(0.5);
    $pdf->Line('130', '52', '140', '52');
    $pdf->Ln(8);
    $pdf->Cell(40,10,'Date: '.date('M d, Y', $dateNow->timestamp));
    $pdf->SetLineWidth(0.5);
    $pdf->Line('20', '60', '45', '60');
    $pdf->Cell(40,10,'Prescription ID: '.$patient['prescription_id']);
    $pdf->SetLineWidth(0.5);
    $pdf->Line('76', '60', '90', '60');
    $pdf->Ln(10);
    //insert image of rx for prescription
    $pdf->Image('../assets/img/R.png', 10, 65, 25);
    $pdf->Ln(30);
    $prescription = explode("\n",$patient['note']);
    foreach($prescription as $pres){
        $pdf->Ln(5);
        $pdf->Cell(40,10,$pres);
        
    }
    $pdf->Output('D', $patient['f_name'].'-'.$patient['l_name'].'-'.$dateNow.'.pdf');
}

?>
