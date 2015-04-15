<?php
$root = (!isset($root)) ? "../../../../" : $root;
require_once($root . "modulos/solicitudes/librerias/Configuracion.cnf.php");
$sesion=new Sesion();
$validaciones=new Validaciones();
$transaccion=$validaciones->recibir("transaccion");
$trasmision = $validaciones->recibir("trasmision");
$solicitud=$validaciones->recibir("solicitud");
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

$f = new Formularios($transaccion);
echo($f->apertura());
$etiquetas = array("Expediente");
$valores = array("responsable");
$ruta = "modulos/solicitudes/consultas/solicitud/";
$urls[0] = $ruta . "formulario.xhr.php?transaccion=" . $transaccion . "&solicitud=".$solicitud;
//$urls[1] = $ruta . "historial.xhr.php?transaccion=" . $transaccion . "&solicitud=" . $solicitud;
//$urls[2] = $ruta . "observaciones.xhr.php?transaccion=" . $transaccion . "&solicitud=" . $solicitud;
echo($f->Tabs("solicitudes", $etiquetas, $valores, $urls,"central"));
echo("<div id=\"xcontenedor\" style=\" border-style:solid;border-width:1px;border-color:#cccccc;padding:10px;\">");
$url['formulario']=$root . "modulos/solicitudes/consultas/solicitud/formulario.inc.php";
$url['procesador']=$root . "modulos/solicitudes/consultas/solicitud/procesador.inc.php";
if (empty($trasmision)) {
  require_once($url['formulario']);
} else {
  require_once($url['procesador']);
}
echo($f->generar());
echo($f->controles());
echo("</div>");
echo($f->cierre());
?>
