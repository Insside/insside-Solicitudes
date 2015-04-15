<?php
$root = (!isset($root)) ? "../../../" : $root;
require_once($root . "modulos/solicitudes/librerias/Configuracion.cnf.php");

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
$validaciones=new Validaciones();
$transaccion=$validaciones->recibir("transaccion");
$trasmision = $validaciones->recibir("trasmision");
$f = new Formularios($transaccion);
echo($f->apertura());
/** Campos * */
$f->campos['icono']="<div id=\"i100x100_ayuda\" style=\"float: left;\"></div>";
$f->campos['info']="<h2>Radicado Recibido</h2><p>Corresponde a una cadena alfanumérica de 
  máximo 20 caracteres, con el que se identifica el radicado de recepción asignado por la empresa a la reclamación o petición
recibida de forma verbal, escrita o por cualquier otro medio. Incluye las reclamaciones y peticiones
recibidas de terceros por traslado de competencia.</p><br>
<p>Cuando se presente una reclamación o petición de un mismo suscriptor que acumule varias
causales, se deben registrar una a una con el mismo número de radicado recibido. Si la misma
reclamación o petición versa sobre varios servicios, la empresa deberá ingresar la misma
información por cada servicio.
</p>";
$f->campos['cancelar'] = $f->button("cancelar" . $f->id, "button", "Continuar");
/** Celdas * */
$f->celdas["icono"] = $f->celda("", $f->campos['icono'], "", "sinfondo");
$f->celdas["info"] = $f->celda("", $f->campos['info'], "", "sinfondo");
/** Filas * */
$f->fila["info"] = $f->fila($f->celdas['icono'].$f->celdas['info']);
/** Ordenando **/
$f->filas($f->fila['info']);
$f->botones($f->campos['cancelar'],"inferior-derecha");
/** JavaSript **/
$f->eClick("cancelar" . $f->id, "MUI.closeWindow($('" . $f->ventana . "'));");
$f->JavaScript("MUI.titleWindow($('" . ($f->ventana) . "'), \"Ayuda: Radicado De Recibido\");");
$f->JavaScript("MUI.resizeWindow($('" . ($f->ventana) . "'), {width: 480, height: 270});");
$f->JavaScript("MUI.centerWindow($('" . $f->ventana . "'));");
echo($f->generar());
echo($f->controles());
echo($f->cierre());
?>