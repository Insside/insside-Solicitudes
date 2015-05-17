<?php
$root = (!isset($root)) ? "../../../../../../../" : $root;
require_once($root . "modulos/solicitudes/librerias/Configuracion.cnf.php");
/** Clases **/
$sesion=new Sesion();
$solicitudes=new Solicitudes();
$validaciones=new Validaciones();
/*
 * Este archivo XHR retorna las estadisticas asociadas a las solicitudes procesadas por un usuario
 * del sistema las cuales a saber estan distribuidas como recibidas, procesadas y pendientes.
 * La información se proporsiona en cifras y prorcentajes exactos. 
 * 
 * Copyright (c) 2015, Jose Alexis Correa Valencia
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
$usuario=Sesion::usuario();
$inicio=$validaciones->recibir('inicio');
$final=$validaciones->recibir('final');
/** 
 * Evaluacion: Los datos visualizados pueden filtrarse al utilizar un rango de fechas asociado a la
 * consulta, si dicho rango de fechas es inexistente se tomara como fecha inicial la fecha mas antigua
 * en la cual el usuario halla registrado una solicitud (primera solicitud) y por fecha final la fecha de
 * la ultima solicitud ingresada al sistema.
 **/
$inicio = empty($inicio) ? $solicitudes->fecha_mas_antigua($usuario['usuario']) : $inicio;
$final = empty($final) ? $solicitudes->fecha_mas_reciente($usuario['usuario']) : $final;
/**
 * $sr: Corresponde al numero total de "solicitudes recibidas" por el usuario.
 * $ss: Corresponde al numero total de "solicitudes solucionadas" por el usuario.
 * $sp: Corresponde al numeto total de "solicitudes pendientes" de ser atendidas por el usuario.
 */
$sr=$solicitudes->estadistica_solicitudes_usuario_total($inicio,$final, $usuario['usuario']);
$ss=$solicitudes->estadistica_solicitudes_usuario_solucionadas($inicio,$final, $usuario['usuario']); 
$sp=$sr-$ss;

if($sr>0){
$spp=round(((int) $sp * 100 / $sr), 2);
$ssp=round(((int)$ss * 100 / $sr), 2); 
}else{
  $spp=100;
  $ssp=100;
}
?>

<h2>Solicitudes Pendientes</h2>
<p class="critico"><?php echo($sp); ?></p>
<div class="criticoporcentual"><a href="#" onClick="MUI.Solicitudes_Propias_Pendientes();return(false);">FILTRAR <?php echo($spp); ?>%</a> </div>
<br>
<h2>Solicitudes Resueltas</h2>
<p class="numero"><?php echo($ss); ?></p>
<p class="numero_porcentual"><?php echo($ssp); ?>%</p>
<br>
<h2>Total Visualizadas</h2>
<p class="numero"><?php echo($sr); ?></p>
<p class="numero_porcentual">100%</p> 
<p class="nota">
  Las solicitudes visualizadas corresponden a las que han sido creadas por usted mismo, le han sido asignadas o le pertenecen a su equipo de trabajo.
  <br>
  Las presentes estadísticas corresponden a la labor registrada por el usuario activo, por lo tanto se aclara no
  representan la totalidad de las solicitudes registradas en el sistema. 
</p>