<?php
$cadenas = new Cadenas();
$fechas = new Fechas();
$paises = new Paises();
$regiones = new Regiones();
$ciudades = new Ciudades();
$sectores = new Sectores();
$validaciones = new Validaciones();
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
/** Variables **/

/** Valores **/
$valores['suscriptor']=$validaciones->recibir("suscriptor".$f->id);
/** Campos **/
$f->campos['info']="<div id=\"i100x100_notificacion\" style=\"float: left;\"></div><div><p><b>Ingrese el código del suscriptor en relación al cual se realizara la solicitud.</b></p><p><b>Nota</b>:El código del suscriptor debe ser digitado tal cual aparece en la factura comercial. Si el suscriptor visualizado tras presionar “consultar” no corresponde al suscriptor deseado reingrese el código del suscriptor eh inténtelo nuevamente.</p><br></div>";
$f->campos['suscriptor']=$f->text("suscriptor".$f->id,$valores['suscriptor'], "10","required", false);
$f->campos['error']="<p id=\"msjadvertencia\"><div id=\"i100x100_advertencia\" style=\"float: left;\"></div>No se ha encontrado un suscriptor que este matriculado en el sistema con el código ingresado, por favor verifique el código ingresado e inténtelo nuevamente. Si desconoce el número de matrícula del suscriptor diríase al componente suscriptores en el presente modulo y realice una búsqueda detallada.</p>";
$f->campos['ayuda'] = $f->button("ayuda" . $f->id, "button","Ayuda");
$f->campos['cancelar'] = $f->button("cancelar" . $f->id, "button","Cancelar");
$f->campos['consultar'] = $f->button("consultar" . $f->id, "button","Consultar");
$f->campos['continuar'] = $f->button("continuar" . $f->id, "submit","Continuar");
/** Celdas **/
$f->celdas["info"] = $f->celda("", $f->campos['info'],"","sinfondo");
$f->celdas["suscriptor"] = $f->celda("Suscriptor:", $f->campos['suscriptor'],"divsucriptor".$f->id);
$f->celdas["datos"] = $f->celda("","","datos".$f->id,"sinfondo");
/** Filas **/
$f->fila["fila1"] = $f->fila($f->celdas["info"]);
$f->fila["fila2"] = $f->fila($f->celdas["suscriptor"]);
$f->fila["fila3"] = $f->fila($f->celdas["datos"]);
/** Compilando **/
$f->filas($f->fila['fila1']);
$f->filas($f->fila['fila2']);
$f->filas($f->fila['fila3']);
/** Botones **/
$f->botones($f->campos['ayuda'], "inferior-izquierda");
$f->botones($f->campos['cancelar'], "inferior-derecha");
$f->botones($f->campos['consultar'], "inferior-derecha");
$f->botones($f->campos['continuar'], "inferior-derecha");
/** JavaScript **/
$f->JavaScript("\$('continuar".$f->id."').setStyle('display', 'none');");
$f->JavaScript("MUI.titleWindow($('" . ($f->ventana) . "'), \"Radicar Solicitud (PQRS)\");");
$f->JavaScript("MUI.resizeWindow($('" . ($f->ventana) . "'), {width: 400, height: 320});");
$f->JavaScript("MUI.centerWindow($('" . $f->ventana . "'));");
//$f->JavaScript("  var txtSuscriptor = new MUI.iTextBox({container: 'divsuscriptor".$f->id."', id: 'suscriptor".$f->id."', maskType: 'regexp.codigo', autoTab: true, hasTitle: false});");
$f->eClick("cancelar" . $f->id, "MUI.closeWindow($('" . $f->ventana . "'));");
$f->eClick("consultar" . $f->id, "MUI.Solicitudes_Solicitud_Preconsulta('".$f->id."');");

 ?>