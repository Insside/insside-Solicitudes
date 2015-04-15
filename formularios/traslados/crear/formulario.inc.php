<?php
$root = (!isset($root)) ? "../../../../../" : $root;
require_once($root . "modulos/solicitudes/librerias/Configuracion.cnf.php");
$solicitudes=new Solicitudes();
$traslados=new Traslados();
$fechas=new Fechas();
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

$solicitud=$validaciones->recibir("solicitud");
$solicitud=$solicitudes->consultar($solicitud);
$traslado=$traslados->consultar($solicitud['solicitud']);
/** Valores **/
$valores['info']=""
        . "<img src=\"imagenes/logo-sspd.png\" align=\"left\"><p>Este formulario permite establecer el traslado de la solicitud y su consecuente respuesta a la SSPD "
        . "ingrese la fecha en que el prestador envía por correo o radica en la Superintendencia de Servicios Públicos, "
        . "según el caso, el expediente para el trámite del Recurso de Apelación. El diligenciamiento de este campo "
        . "es obligatorio cuando el “Tipo de Trámite” es igual a 3 (Recurso de Reposición en subsidio de Apelación) "
        . "y la empresa confirma su decisión inicial, de lo contrario no se debe diligenciar el presente formato.</p>";
$valores['solicitud']=$solicitud['solicitud'];
if(!empty($traslado['fecha'])){
  $valores['fecha']=$traslado['fecha'];
}else{
  $valores['fecha']=$fechas->hoy();
}

/** Campos **/
$f->campos['info'] = $valores['info'];
$f->campos['solicitud'] = $f->text("solicitud", $valores['solicitud'], "10", "required codigo", true);
$f->campos['trasferido'] = $f->calendario("fecha", $valores['fecha'],"0","1");
$f->campos['ayuda'] = $f->button("ayuda" . $f->id, "button", "Ayuda");
$f->campos['cancelar'] = $f->button("cancelar" . $f->id, "button", "Cancelar");
$f->campos['anular'] = $f->button("anular" . $f->id, "button", "Anular");
$f->campos['continuar'] = $f->button("continuar" . $f->id, "submit", "Trasladar");
/** Celdas **/
$f->celdas["info"] = $f->celda("", $f->campos['info']);
$f->celdas["solicitud"] = $f->celda("Solicitud:", $f->campos['solicitud']);
$f->celdas["trasferido"] = $f->celda("Fecha de Traslado:", $f->campos['trasferido']);
/** Filas **/
$f->fila["fila1"] = $f->fila($f->celdas["info"]);
$f->fila["fila2"] = $f->fila($f->celdas["solicitud"].$f->celdas["trasferido"]);
/** Compilando **/
$f->filas($f->fila['fila1']);
$f->filas($f->fila['fila2']);
/** Botones **/
$f->botones($f->campos['ayuda'], "inferior-izquierda");
$f->botones($f->campos['cancelar'], "inferior-derecha");
$f->botones($f->campos['anular'], "inferior-derecha");
$f->botones($f->campos['continuar'], "inferior-derecha");
/** JavaScript **/
$f->JavaScript("MUI.titleWindow($('" . ($f->ventana) . "'), \"Traslado a SSPD v0.1 de 20150123\");");
$f->JavaScript("MUI.resizeWindow($('" . ($f->ventana) . "'), {width: 410, height: 300});");
$f->JavaScript("MUI.centerWindow($('" . $f->ventana . "'));");
$f->eClick("cancelar" . $f->id, "MUI.closeWindow($('" . $f->ventana . "'));");
$f->eClick("anular" . $f->id, "MUI.closeWindow($('" . $f->ventana . "'));MUI.Solicitudes_SSPD_Traslado_Anular('".$valores['solicitud']."');");
?>