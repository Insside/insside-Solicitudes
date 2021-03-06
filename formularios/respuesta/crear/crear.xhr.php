<?php

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

$root = (!isset($root)) ? "../../../../../" : $root;
require_once($root . "modulos/solicitudes/librerias/Configuracion.cnf.php");
$suscriptores = new Suscriptores();
//\\//\\//\\//\\ Variables Generadas //\\//\\//\\//\\
$sesion = new Sesion();
$transaccion = @$_REQUEST['transaccion'];
$accion = @$_REQUEST['accion'];
$f = new Formularios($transaccion);
echo($f->apertura());
if (!isset($_REQUEST['trasmision'])) {
  require_once($root . "modulos/solicitudes/formularios/respuesta/crear/formulario.inc.php");
} else {
  $avance = $f->avance("consultar");
  if ($avance == "detalles") {
    require_once($root . "modulos/solicitudes/formularios/respuesta/crear/detalles.inc.php");
  } elseif ($avance == "procesador") {
    require_once($root . "modulos/solicitudes/formularios/respuesta/crear/procesador.inc.php");
  }
}
echo($f->generar());
echo($f->controles());
echo($f->cierre());
?>