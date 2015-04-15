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
$url['formulario']=$root . "modulos/solicitudes/consultas/solicitud/formulario.inc.php";
$url['procesador']=$root . "modulos/solicitudes/consultas/solicitud/procesador.inc.php";

$f = new Formularios($transaccion);
echo($f->apertura());
/** Campos * */
$f->campos['icono']="<div id=\"i100x100_ayuda\" style=\"float: left;\"></div>";
$f->campos['info']="<h2>Servicio</h2><p>Entendemos por Servicios Públicos, las actividades,
  entidades u órganos públicos o privados con personalidad jurídica creados por Constitución 
  o por ley, para dar satisfacción en forma regular y continua a cierta categoría de necesidades 
  de interés general, bien en forma directa, mediante concesionario o a través de cualquier otro 
  medio legal con sujeción a un régimen de Derecho Público o Privado, según corresponda. </p><br>
  <p>Los servicios sujetos de reclamación o petición estan clasificados en: Acueducto (01) y 
  Alcantarillado (02).
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
$f->JavaScript("MUI.titleWindow($('" . ($f->ventana) . "'), \"Ayuda: Servicio\");");
$f->JavaScript("MUI.resizeWindow($('" . ($f->ventana) . "'), {width: 480, height: 260});");
$f->JavaScript("MUI.centerWindow($('" . $f->ventana . "'));");
echo($f->generar());
echo($f->controles());
echo($f->cierre());
?>