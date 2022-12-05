<?php
require('../librerias/fpdf/fpdf.php');

include_once '../configuraciones/bd.php';
$conexionBD=BD::crearInstancia();

function agregarTexto($pdf,$texto,$x,$y,$align='L',$fuente,$size=10,$r=0,$g=0,$b=0){
    $pdf->setFont($fuente,"",$size);
    $pdf->setXY($x,$y);
    $pdf->setTextColor($r,$g,$b);
    $pdf->Cell(0,10,$texto,0,0,$align);
}
function agregarImagen($pdf,$imagen,$x,$y){
    $pdf->Image($imagen,$x,$y,0);
}

$idproductividad=isset($_GET['idproductividad'])?$_GET['idproductividad']:'';
$idgerente=isset($_GET['idgerente'])?$_GET['idgerente']:'';

$sql="SELECT gerente.nombre, gerente.apellido,productividad.nombre_Productividad 
FROM gerente, productividad WHERE gerente.id=:idgerente AND productividad.id=:idproductividad";
$consulta=$conexionBD->prepare($sql);
$consulta->bindParam(':idgerente',$idgerente);
$consulta->bindParam(':idproductividad',$idproductividad);
$consulta->execute();
$gerente=$consulta->fetch(PDO::FETCH_ASSOC);


$pdf=new FPDF("L","mm",array(254,194));
$pdf->AddPage();
$pdf->setFont("Arial","B",16);
agregarImagen($pdf,"../src/extracto3.jpg",0,0);
agregarTexto($pdf,ucwords(utf8_decode($gerente['nombre']." ".$gerente['apellido'])),60,70,'L',"Helvetica",30,0,84,115);
agregarTexto($pdf,$gerente['nombre_Productividad'],-250,115,'C',"Helvetica",20,0,84,115);
agregarTexto($pdf,date("d/m/Y"),-350,115,'C',"Helvetica",11,0,84,115);
$pdf->Output();





?>