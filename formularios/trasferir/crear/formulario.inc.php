<?php
$root = (!isset($root)) ? "../../../../../" : $root;
require_once($root . "modulos/solicitudes/librerias/Configuracion.cnf.php");
$solicitudes=new Solicitudes();
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
/** Valores **/
$valores['info']=""
        . "<p>Este formulario permite trasferir una solicitud al reporte del mes consecutivo siguiente, "
        . "específicamente se utiliza para las solicitudes no resueltas y que por términos en la presentación del "
        . "reporte ante la SUI deben figurar con respuesta tipo 9 (Pendiente de respuesta) en el reporte del mes de "
        . "origen en tanto su resolución y datos de respuesta finales se especificaran en el reporte correspondiente "
        . "al mes donde fueron trasferidos. Esta acción no altera los datos y estado original de la petición, pero si "
        . "causa su aparición en dos reportes consecutivos correspondientes a su periodo de origen y periodo de "
        . "finalización.</p>";
$valores['solicitud']=$solicitud['solicitud'];
$valores['trasferido']=$solicitud['trasferido'];
/** Campos **/
$f->campos['info'] = $valores['info'];
$f->campos['solicitud'] = $f->text("solicitud", $valores['solicitud'], "10", "", true);
$f->campos['trasferido'] = $f->calendario("trasferido", $valores['trasferido'],"0","1");
$f->campos['ayuda'] = $f->button("ayuda" . $f->id, "button", "Ayuda");
$f->campos['cancelar'] = $f->button("cancelar" . $f->id, "button", "Cancelar");
$f->campos['continuar'] = $f->button("continuar" . $f->id, "submit", "Trasferir");
/** Celdas **/
$f->celdas["info"] = $f->celda("", $f->campos['info']);
$f->celdas["solicitud"] = $f->celda("Solicitud a Trasferir", $f->campos['solicitud']);
$f->celdas["trasferido"] = $f->celda("Fecha a Trasferir", $f->campos['trasferido']);
/** Filas **/
$f->fila["fila1"] = $f->fila($f->celdas["info"]);
$f->fila["fila2"] = $f->fila($f->celdas["solicitud"]);
$f->fila["fila3"] = $f->fila($f->celdas["trasferido"]);
/** Compilando **/
$f->filas($f->fila['fila1']);
$f->filas($f->fila['fila2']);
$f->filas($f->fila['fila3']);
/** Botones **/
$f->botones($f->campos['ayuda'], "inferior-izquierda");
$f->botones($f->campos['cancelar'], "inferior-derecha");
$f->botones($f->campos['continuar'], "inferior-derecha");
/** JavaScript **/
$f->JavaScript("MUI.titleWindow($('" . ($f->ventana) . "'), \"Trasferencia de Periodo\");");
$f->JavaScript("MUI.resizeWindow($('" . ($f->ventana) . "'), {width: 390, height: 330});");
$f->JavaScript("MUI.centerWindow($('" . $f->ventana . "'));");
$f->eClick("cancelar" . $f->id, "MUI.closeWindow($('" . $f->ventana . "'));");
?>