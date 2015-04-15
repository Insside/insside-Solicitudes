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
$validaciones = new Validaciones();
$transaccion = $validaciones->recibir("transaccion");
$trasmision = $validaciones->recibir("trasmision");
$f = new Formularios($transaccion);
echo($f->apertura());
/** Campos * */
$f->campos['icono'] = "<div id=\"i100x100_requisitos\" style=\"float: left;\"></div>";
$f->campos['info'] = "
  <p>Es requisito para poder dar respuesta formal ya sea interna o públicamente que su usuario sea el creador o 
  responsable inmediato de la solicitud en proceso que se está visualizando, adicional a esta característica deberá 
  tener los permisos necesarios para realizar esta acción.</p><hr/>
  <p>Evaluada la presente situación el sistema se permite informarle que: 
  El usuario con el cual usted ha ingresado al sistema no dispone de los permisos necesarios para dar redacción 
  formal a una respuesta, por tal motivo aun cuando usted posee responsabilidades ante de la presente solicitud, 
  se encuentra imposibilitado para dar respuesta formal a la misma.
Se le recomienda contactar al administrador del sistema y solicitarle que le asigne los permisos pertinentes 
para realizar esta acción. Los cuales a saber son <b>\"SOLICITUDES-RESPONDER\"</b> o <b>\"SOLICITUDES-RESPONDER-PUBLICAMENTE\" </b>
dependiendo de las funciones que su usuario se le deban permitir en el sistema.
</p>
 ";
$f->campos['cancelar'] = $f->button("cancelar" . $f->id, "button", "Continuar");
/** Celdas * */
$f->celdas["icono"] = $f->celda("", $f->campos['icono'], "", "sinfondo");
$f->celdas["info"] = $f->celda("", $f->campos['info'], "", "sinfondo");
/** Filas * */
$f->fila["info"] = $f->fila($f->celdas['icono'] . $f->celdas['info']);
/** Ordenando * */
$f->filas($f->fila['info']);
$f->botones($f->campos['cancelar'], "inferior-derecha");
/** JavaSript * */
$f->eClick("cancelar" . $f->id, "MUI.closeWindow($('" . $f->ventana . "'));");
$f->JavaScript("MUI.titleWindow($('" . ($f->ventana) . "'), \"Ayuda: Responder Solicitud\");");
$f->JavaScript("MUI.resizeWindow($('" . ($f->ventana) . "'), {width: 480, height: 325});");
$f->JavaScript("MUI.centerWindow($('" . $f->ventana . "'));");
echo($f->generar());
echo($f->controles());
echo($f->cierre());
?>