<?php

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
$avance = $f->avance("consultar");
$segmentos = "modulos/solicitudes/formularios/solicitud/crear/segmentos/";
switch ($avance) {
  case "suscriptor":
    $f->avance("establecer", "solicitante");
    require_once($root . $segmentos . "suscriptor.inc.php");
    break;
  case "solicitante":
    $f->avance("establecer", "solicitud");
    require_once($root . $segmentos . "solicitante.inc.php");
    break;
  case "solicitud":
    $f->avance("establecer", "verificacion");
    require_once($root . $segmentos . "solicitud.inc.php");
    break;
  case "verificacion":
    $f->avance("establecer", "radicacion");
    require_once($root . $segmentos . "verificacion.inc.php");
    break;
  case "radicacion":
    $f->avance("establecer", "");
    require_once($root . $segmentos . "radicacion.inc.php");
    break;
  default :
    $f->avance("establecer", "solicitante");
    require_once($root . $segmentos . "suscriptor.inc.php");
    break;
}
?>