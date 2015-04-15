<?php
$root = (!isset($root)) ? "../../../../" : $root;
require_once($root . "librerias/Configuracion.cnf.php");
require_once($root . "librerias/pdf/fpdf.php");
require_once($root . "librerias/pdf/fpdi.php");
require_once($root . "modulos/solicitudes/librerias/Configuracion.cnf.php");
$v=new Validaciones();
$codigos=new Codigos();
// Hoja Completa
//$pdf = new FPDI();
//$pdf->AddPage();
//$pdf->setSourceFile($root . "modulos/solicitudes/formularios/constancia/constancia.pdf");
//$tid = $pdf->importPage(1);
//$size = $pdf->getTemplateSize($tid);
//$pdf->useTemplate($tid, 10, 10, 190);
//$pdf->SetFont('Arial','B',40);
//$pdf->SetTextColor(0, 0, 0);
//$pdf->SetXY(85, 95);
//$pdf->Write(0,$v->recibir("solicitud"));
//$pdf->Output();

// Codigo QR
$solicitud=$v->recibir("solicitud");
$codigo_qr = $codigos->generar("http://www.aguasdebuga.net/?res=". $solicitud);
$imagen=$root."librerias/".$codigo_qr;
// Hoja tamaño del modelo
$pdf = new FPDI();
$pdf->setSourceFile($root . "modulos/solicitudes/formularios/constancia/constancia.pdf");
$tid = $pdf -> importPage(1);
$size = $pdf->getTemplateSize($tid);
$pdf -> AddPage();
//$pdf ->useTemplate($tplIdx, null, null, $size['w'], $size['h'], true);
$pdf->useTemplate($tid, 10, 10, 190);
$pdf->SetFont('Arial','B',47);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY(82, 96);
$pdf->Write(0,$solicitud);
$pdf->Image($imagen,143,23);
$pdf -> Output();


//$root = (!isset($root)) ? "../../../../" : $root;
//require_once($root . "modulos/solicitudes/librerias/Configuracion.cnf.php");
///*
// * Copyright (c) 2014, Alexis
// * All rights reserved.
// *
// * Redistribution and use in source and binary forms, with or without
// * modification, are permitted provided that the following conditions are met:
// *
// * * Redistributions of source code must retain the above copyright notice, this
// *   list of conditions and the following disclaimer.
// * * Redistributions in binary form must reproduce the above copyright notice,
// *   this list of conditions and the following disclaimer in the documentation
// *   and/or other materials provided with the distribution.
// *
// * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
// * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
// * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
// * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
// * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
// * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
// * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
// * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
// * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
// * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
// * POSSIBILITY OF SUCH DAMAGE.
// */
//
//$validaciones=new Validaciones();
//$transaccion=$validaciones->recibir("transaccion");
//$trasmision = $validaciones->recibir("trasmision");
//$url['formulario']=$root . "modulos/solicitudes/formularios/constancia/formulario.inc.php";
//$url['procesador']=$root . "modulos/solicitudes/formularios/constancia/procesador.inc.php";
//
//$f = new Formularios($transaccion);
//echo($f->apertura());
//if (empty($trasmision)) {
//  require_once($url['formulario']);
//} else {
//  require_once($url['procesador']);
//}
//echo($f->generar());
//echo($f->controles());
//echo($f->cierre());
?>

