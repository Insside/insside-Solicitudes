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
$solicitudes = new Solicitudes();
$usuarios = new Usuarios();
$suscriptores = new Suscriptores();
$usuario =Sesion::usuario();

$valor['solicitud'] = @$_REQUEST["_solicitud"];
$valor['dane'] = "0076111000";
$valor['servicio'] = isset($_REQUEST['_servicio' . $f->id]) ? $_REQUEST['_servicio' . $f->id] : "04";
$valor['radicado'] = isset($_REQUEST['_radicado']) ? $_REQUEST['_radicado'] : $_REQUEST['_solicitud'];
$valor['radicacion'] = isset($_REQUEST['_radicacion']) ? $_REQUEST['_radicacion'] : $fechas->hoy();
$valor['categoria'] = isset($_REQUEST['_categoria' . $f->id]) ? $_REQUEST['_categoria' . $f->id] : "01";
$valor['causal'] = isset($_REQUEST['_causal'. $f->id]) ? $_REQUEST['_causal'. $f->id] : "";
$valor['asunto'] = @$_REQUEST["_asunto"];
$valor['detalle'] = @$_REQUEST["_detalle"];
$valor['suscriptor'] = @$_REQUEST["_suscriptor"];
$valor['factura'] = @$_REQUEST["_factura"];
$valor['respuesta'] = @$_REQUEST["_respuesta"];
$valor['contestacion'] = @$_REQUEST["_contestacion"];
$valor['radicada'] = @$_REQUEST["_radicada"];
$valor['notificado'] = @$_REQUEST["_notificado"];
$valor['notificacion'] = @$_REQUEST["_notificacion"];
$valor['sspd'] = @$_REQUEST["_sspd"];
$valor['ejecucion'] = @$_REQUEST["_ejecucion"];
$valor['orden'] = @$_REQUEST["_orden"];
$valor['fecha'] = @$_REQUEST["_fecha"];
$valor['documentos'] = isset($_REQUEST['_documentos']) ? $_REQUEST['_documentos'] : "CC";
$valor['identificacion'] = @$_REQUEST["_identificacion"];
$valor['nombres'] = @$_REQUEST["_nombres"];
$valor['apellidos'] = @$_REQUEST["_apellidos"];
$valor['sexo'] = @$_REQUEST["_sexo"];
$valor['nacimiento'] = @$_REQUEST["_nacimiento"];
$valor['telefono'] = @$_REQUEST["_telefono"];
$valor['movil'] = @$_REQUEST["_movil"];
$valor['correo'] = @$_REQUEST["_correo"];
$valor['pais'] = isset($_REQUEST['_pais']) ? $_REQUEST['_pais'] : "CO";
$valor['region'] = isset($_REQUEST['_region']) ? $_REQUEST['_region'] : "076";
$valor['ciudad'] = isset($_REQUEST['_ciudads']) ? $_REQUEST['_ciudad'] : "76111";
$valor['sector'] = @$_REQUEST["_sector"];
$valor['direccion'] = @$_REQUEST["_direccion"];
$valor['referencia'] = @$_REQUEST["_referencia"];
//$valor['expiracion'] = @$_REQUEST["_expiracion"];
$valor['instalacion'] = @$_REQUEST["_instalacion"];
$valor['instalacionsector'] = @$_REQUEST["_instalacionsector"];
$valor['estrato'] = @$_REQUEST["_estrato"];
$valor['diametro'] = @$_REQUEST["_diametro"];
$valor['legalizado'] = @$_REQUEST["_legalizado"];
$valor['matricula'] = @$_REQUEST["_matricula"];
$valor['tipoderespuesta'] = @$_REQUEST["_tipoderespuesta"];
$valor['ordenservicio'] = @$_REQUEST["_ordenservicio"];
$valor['ordencobro'] = @$_REQUEST["_ordencobro"];
$valor['creador'] = $usuario['usuario'];
$valor['responsable'] = $usuario['usuario'];
$valor['origen'] = "INTERNO";
$valor['equipo'] = $usuario['equipo'];

$solicitudes->solicitudes_crear($valor['solicitud']);
$numero = count($valor);
$tags = array_keys($valor);
$valores = array_values($valor);
for ($i = 0; $i < $numero; $i++) {
  $solicitudes->actualizar($valor['solicitud'], $tags[$i], $valores[$i]);
}
/** JavaScript **/
$f->JavaScript("MUI.closeWindow($('" . ($f->ventana) . "'));");
$f->JavaScript("MUI.Solicitudes_Recibidas();");
?>