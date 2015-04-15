<?php
$validaciones=new validaciones();
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
/** Valores * */
$valores['solicitud']=$validaciones->recibir("solicitud");
$valores['nombres']=$validaciones->recibir("_nombres");
$valores['apellidos']=$validaciones->recibir("_apellidos");
$valores['direccion']=$validaciones->recibir("_direccion");
$valores['detalle']=$validaciones->recibir("detalle");

$error = false;
$mensaje["mensaje"] = "";
$mensaje[1] = "Ingrese el nombre o nombres de quien radica la solicitud. En el paso 1/3<br>";
$mensaje[2] = "Ingrese los apellidos de quien radica la solicitud. En el paso 1/3<br>";
$mensaje[3] = "El <b>Correo Electrónico</b> ingresado es incorrecto. En el paso 1/3, Este campo es opcional pero si se ingresa una dirección esta debe de ser valida para proceder con la radicación de la solicitud.<br>";
$mensaje[4] = "Ingrese la dirección de quien radica la solicitud. En el paso 1/3<br>";
$mensaje[5] = "Por favor ingrese el <b>Contenido De La Solicitud</b> que desea radicar. Debe proporcionar esta información para poder proceder con el proceso de radicación. En el paso 2/3<br>";
$mensaje['ok']=""
        . "<h2>Confirmación Radicación</h2>"
        . "<p style=\"font-size:14px; line-height:12px;text-align:justify;\">Tras realizar las verificaciones pertinentes su solicitud se "
        . "encuentra lista para ser radicada, una vez concluido el proceso será posible consultar el estado de la solicitud "
        . "digitando el código de radicación de la misma el cual visualizamos a continuación. Si desea modificar o "
        . "verificar los datos puede hacerlo presionando el botón “Anterior” adjunto al botón “Radicar” con el cual "
        . "podrá finalizar este proceso.</p><br>"
        . ""; 
$mensaje['error']=""
        . "<h2>Verifique Los Datos</h2>"
        . "<p style=\"font-size:14px; line-height:12px;\">Tras realizar las verificaciones pertinentes en la solicitud se "
        . "ha determinado que faltan datos para proceder a la radicación, una vez concluido el proceso revisión "
        . "podra radicar la solicitud en el sistema. Para ingresar o verificar los datos puede hacerlo presionando "
        . "el botón “Anterior”. A continuación se le ofrece una descripción de la información faltante.</p>"
        . ""; 
$mensaje['radicar']=""
        . "<p style=\"font-size:34px; line-height:12px; text-align:center; padding:15px;\">IMIS-RE-".$valores['solicitud']."</p>"
        . ""; 



if (empty($valores['nombres'])) {
$mensaje["mensaje"]  = $mensaje[1];
} elseif (empty($valores['apellidos'])) {
$mensaje["mensaje"]= $mensaje[2];
} elseif (empty($valores['direccion'])) {
$mensaje["mensaje"]= $mensaje[4];
} elseif (empty($valores['detalle'])) {
$mensaje["mensaje"] = $mensaje[5];
}

if (!empty($mensaje["mensaje"] )) {
  $error = true;
} 
/** Campos * */
if($error){
  $f->campos['info']=$mensaje["error"] ;
  $f->campos['mensaje']=$mensaje["mensaje"];
}else{
  $f->campos['info']=$mensaje["ok"] ;
  $f->campos['mensaje']=$mensaje["radicar"];
}
$f->campos['anterior'] = $f->button("anterior" . $f->id, "submit", "Anterior");
$f->campos['continuar'] = $f->button("continuar" . $f->id, "submit", "Radicar");
/** Celdas * */
$f->celdas["info"]=$f->celda("", $f->campos['info'],"","sinfondo");
$f->celdas["mensaje"]=$f->celda("", $f->campos['mensaje']);
/** Filas * */
$f->fila["fila1"] = $f->fila($f->celdas["info"]);
$f->fila["fila2"] = $f->fila($f->celdas["mensaje"]);
/** Compilando * */
$f->filas($f->fila['fila1']);
$f->filas($f->fila['fila2']); 
$f->botones($f->campos['anterior'], "inferior-derecha");
$f->botones($f->campos['continuar'], "inferior-derecha");
/** JavaScripts * */
$f->JavaScript("MUI.titleWindow($('" . ($f->ventana) . "'), \"Publicar / Compartir\");");
$f->JavaScript("MUI.resizeWindow($('" . ($f->ventana) . "'), {width: 400, height:305});");
$f->JavaScript("MUI.centerWindow($('" . $f->ventana . "'));");
$f->eClick("anterior" . $f->id,"$('avance".$f->id."').value = 'solicitud';");
?>