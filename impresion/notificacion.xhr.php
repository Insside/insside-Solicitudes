<?php

$root = (!isset($root)) ? "../../../" : $root;
require_once($root . "modulos/solicitudes/librerias/Configuracion.cnf.php");
require_once($root . "librerias/pdf/fpdf.php");
require_once($root . "librerias/pdf/fpdi.php");
require_once($root . "librerias/pdf/PDF_WriteTag.class.php");
require_once($root . "librerias/pdf/PDF_HTML.class.php");

$impresion = new Impresion($root);
$notificaciones = new Notificaciones();
$validaciones = new Validaciones();
$cadenas=new Cadenas();
/*
 * Copyright (c) 2014, Alexis
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * * Redistributions of source code must retain the above copyright notice, this
 *   list of conditions and the following disclaimer.
 * * Redistributions in binary form must reproduce the above copyright notice,
 *   this list of conditions and the following disclaimer in the documentation
 *   and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 */
$notificacion = $notificaciones->consultar($validaciones->recibir("notificacion"));
$solicitud=$solicitudes->consultar($notificacion['solicitud']);

$notificacion['consecutivo']="540-".$notificacion['notificacion'];
$notificacion['fecha-textual']="Guadalajara de Buga, ".$cadenas->capitalizar($fechas->textual($notificacion['fecha']));
$notificador['nombre']="Maria Idaly Cifuentes";
$notificador['cargo']="Jefe Comercial";
$notificado['nombre']=$cadenas->capitalizar($solicitud['nombres']." ".$solicitud['apellidos']);
$notificado['identificacion']=$solicitud['identificacion'];

$pdf=new PDF_HTML('P','mm','letter');
$pdf->AddPage();
$pdf->setSourceFile($root . "librerias/pdf/formato.pdf");
$tplIdx = $pdf->importPage(1);
$pdf->useTemplate($tplIdx, 0, 0, 207, 300, false);
$pdf->SetFont('Arial');
$pdf->SetTextColor(0, 0, 0);
$pdf->SetLeftMargin(30);
$pdf->SetRightMargin(20);
$pdf->SetY(60);
$texto=urldecode($notificacion['contenido']);
$buscar= array("&ntilde;","&Ntilde;","&aacute;","&eacute;","&iacute;","&oacute;","&uacute;","&Aacute;","&Eacute;","&Iacute;","&Oacute;","&Uacute;","&nbsp;","</br>");
$poner= array("ñ","Ñ","á","é","í","ó","ú","Á","É","Í","Ó","Ú"," ","\n");
$texto= str_replace($buscar, $poner, $texto);

if($notificacion['tipo']=="02"){
  $pdf->SetFont('Arial','B',16);
  $pdf->Ln(5);
  $pdf->Cell(0,10,utf8_decode('ACTA DE NOTIFICACIÓN PERSONAL'),0,0,'C');
  $pdf->Ln(7);
  $pdf->SetFont('Arial','',14);
  $pdf->WriteHTML(utf8_decode($texto));
  $pdf->SetXY(40,-140);$pdf->Cell(70,5,'El Notificado',0,0,'L');
  $pdf->SetXY(110,-140);$pdf->Cell(70,5,'El Notificador',0,0,'L');
  $pdf->SetXY(40,-120);$pdf->Cell(70,5,$notificado['nombre'],0,0,'L');
  $pdf->SetXY(110,-120);$pdf->Cell(70,5,$notificador['nombre'],0,0,'L');
  $pdf->SetXY(40,-115);$pdf->Cell(70,5,"c.c. ".$notificado['identificacion'],0,0,'L');
  $pdf->SetXY(110,-115);$pdf->Cell(70,5,$notificador['cargo'],0,0,'L');
}elseif($notificacion['tipo']=="03"){
  $pdf->SetXY(30,60);$pdf->SetFont('Arial','',14);$pdf->Cell(0,10,utf8_decode($notificacion['consecutivo']),0,0,'R');
  $pdf->SetXY(30,60);$pdf->SetFont('Arial','',14);$pdf->Cell(0,10,utf8_decode($notificacion['fecha-textual']),0,0,'L');
  $pdf->Ln(15);$pdf->SetFont('Arial','B',16);$pdf->Cell(0,10,utf8_decode('EL JEFE COMERCIAL DE AGUAS DE BUGA S.A. E.S.P'),0,0,'C');
  $pdf->Ln(5);$pdf->SetFont('Arial','B',18);$pdf->Cell(0,10,utf8_decode('AVISA'),0,0,'C');
  $pdf->Ln(7);$pdf->SetFont('Arial','',12);
  $pdf->WriteHTML(utf8_decode($texto));
}elseif($notificacion['tipo']=="04"){
  $pdf->SetXY(30,50);$pdf->SetFont('Arial','',14);$pdf->Cell(0,10,utf8_decode($notificacion['consecutivo']),0,0,'R');
  $pdf->SetXY(30,50);$pdf->SetFont('Arial','',14);$pdf->Cell(0,10,utf8_decode($notificacion['fecha-textual']),0,0,'L');
  $pdf->Ln(15);$pdf->SetFont('Arial','B',20);$pdf->Cell(0,10,utf8_decode('EDICTO'),0,0,'C');
  $pdf->Ln(6);$pdf->SetFont('Arial','B',18);$pdf->Cell(0,10,utf8_decode('CONSTANCIA DE FIJACIÓN'),0,0,'C');
  $pdf->Ln(7);$pdf->SetFont('Arial','',12);
  $pdf->WriteHTML(utf8_decode($texto));
}elseif($notificacion['tipo']=="05"){
  $pdf->SetXY(30,50);$pdf->SetFont('Arial','',14);$pdf->Cell(0,10,utf8_decode($notificacion['consecutivo']),0,0,'R');
  $pdf->SetXY(30,50);$pdf->SetFont('Arial','',14);$pdf->Cell(0,10,utf8_decode($notificacion['fecha-textual']),0,0,'L');
  $pdf->Ln(15);$pdf->SetFont('Arial','B',20);$pdf->Cell(0,10,utf8_decode('EDICTO'),0,0,'C');
  $pdf->Ln(6);$pdf->SetFont('Arial','B',18);$pdf->Cell(0,10,utf8_decode('CONSTANCIA DE DESFIJACIÓN'),0,0,'C');
  $pdf->Ln(7);$pdf->SetFont('Arial','',12);
  $pdf->WriteHTML(utf8_decode($texto));
}else{
$pdf->WriteHTML(utf8_decode($texto));
}
$pdf->SetAuthor("Jose Alexis Correa Valencia",false);
$pdf->Output();
exit;























//$pdf = new PDF_WriteTag();
//$pdf->AddPage();
//$pdf->setSourceFile($root . "librerias/pdf/formato.pdf");
//$tplIdx = $pdf->importPage(1);
//$pdf->useTemplate($tplIdx, 0, 0, 207, 300, false);
//$pdf->SetFont('Arial');
//$pdf->SetTextColor(0, 0, 0);
//$pdf->SetXY(25, 60);
////$pdf->Write(0,$notificacion['contenido']);
//$pdf->MultiCell(0,5,urldecode($notificacion['contenido']));
//for($i=1;$i<=40;$i++){
//    $pdf->Cell(0,10,'Printing line number '.$i,0,1);
//}    
//$pdf->SetY(-15);
//$pdf->SetFont('Arial','I',8);
//$pdf->Cell(0,10,'Pagina '.$pdf->PageNo().'/{nb}',0,0,'C');
//$pdf->Output();



//$pdf=new PDF_WriteTag();
//$pdf->SetMargins(30,15,25);
//$pdf->SetFont('Arial','',12);
//$pdf->AddPage();
//$pdf->setSourceFile($root . "librerias/pdf/formato.pdf");
//$tplIdx = $pdf->importPage(1);
//$pdf->useTemplate($tplIdx, 0, 0, 207, 300, false);
//// Stylesheet
//$pdf->SetStyle("p","Arial","N",12,"10,100,250",15);
//$pdf->SetStyle("b","Arial","N",12,"10,100,250",15);
//$pdf->SetStyle("br","Arial","N",12,"10,100,250",15);
//$pdf->SetStyle("h1","Arial","N",18,"102,0,102",0);
//$pdf->SetStyle("a","Arial","BU",9,"0,0,255");
//$pdf->SetStyle("pers","Arial","I",0,"255,0,0");
//$pdf->SetStyle("place","Arial","U",0,"153,0,0");
//$pdf->SetStyle("vb","Arial","B",0,"102,153,153");
//// Text
//$txt=urldecode($notificacion['contenido']);
//$pdf->SetXY(25, 60);
//$pdf->SetLineWidth(0.0);
//$pdf->SetFillColor(255,255,204);
//$pdf->SetDrawColor(102,0,102);
//$pdf->WriteTag(0,10,$txt,1,"J",0,7);
//$pdf->Ln(5);
//// Signature
//$txt="<a href='http://www.pascal-morin.net'>Done by Pascal MORIN</a>";
//$pdf->WriteTag(0,10,$txt,0,"R");
//$pdf->Output();
