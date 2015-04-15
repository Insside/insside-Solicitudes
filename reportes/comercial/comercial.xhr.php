<?php
$root = (!isset($root)) ? "../../../../" : $root;
require_once($root . "modulos/solicitudes/librerias/Configuracion.cnf.php");
$sesion = new Sesion();
$fechas=new Fechas();
$cadenas=new Cadenas();
$validaciones = new Validaciones();
$usuarios = new Usuarios();
$respuestas=new Respuestas();
$notificaciones=new Notificaciones();
$traslados=new Traslados();
$transaccion = $validaciones->recibir("transaccion");
$trasmision = $validaciones->recibir("trasmision");
$inicio = $validaciones->recibir("inicio");
$final = $validaciones->recibir("final");
$usuario = $validaciones->recibir("uid");

/*
 * Copyright (c) 2014, Alexis
 * All rights reserved.
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 * Redistributions of source code must retain the above copyright notice, this
 * list of conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice,
 * this list of conditions and the following disclaimer in the documentation
 * and/or other materials provided with the distribution.
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
 * POSSIBILITY OF SUCH DAMAGE
 */
$fecha=explode("-",$fechas->hoy());
$inicio_alternativo=$fecha[0]."-".$fecha[1]."-01";
$final_alternativo=$fecha[0]."-".$fecha[1]."-31";

$inicio=empty($inicio) ? $inicio_alternativo :$inicio;
$final=empty($final) ? $final_alternativo :$final;


echo("<style>");
require_once($root . "modulos/solicitudes/estilos/estilos.css");
echo("</style>");

$db = new MySQL();
$sql = "SELECT * "
        . "FROM `solicitudes_solicitudes` "
        . "WHERE((`radicacion` BETWEEN '".$inicio."' AND '".$final."')"
        . "AND(`creador`='".$usuario."' OR `responsable`='".$usuario."'))"
        . "ORDER BY `radicacion` ASC;";

$consulta = $db->sql_query($sql);

echo("<div class=\"tdatos\">");
echo("<table>");
echo("
 <tr height=\"170\">
 <td align=\"center\" valign=\"bottom\"><img src=\"imagenes/tablas/codigodane.png\"/></td>
 <td align=\"center\" valign=\"bottom\"><img src=\"imagenes/tablas/nombredelsolicitante.png\"/></td>
 <td align=\"center\" valign=\"bottom\"><img src=\"imagenes/tablas/direccion.png\"/></td>
 <td align=\"center\" valign=\"bottom\"><img src=\"imagenes/tablas/telefono.png\"/></td>
 <td align=\"center\" valign=\"bottom\"><img src=\"imagenes/tablas/servicio.png\"/></td>
 <td align=\"center\" valign=\"bottom\"><img src=\"imagenes/tablas/radicadoderecibido.png\"/></td>
 <td align=\"center\" valign=\"bottom\"><img src=\"imagenes/tablas/fechaderadicacion.png\"/></td>
 <td align=\"center\" valign=\"bottom\"><img src=\"imagenes/tablas/tipodetramite.png\"/></td>
 <td align=\"center\" valign=\"bottom\"><img src=\"imagenes/tablas/codigodelacausal.png\"/></td>
 <td align=\"center\" valign=\"bottom\"><img src=\"imagenes/tablas/detalledelacausalotros.png\"/></td>
 <td align=\"center\" valign=\"bottom\"><img src=\"imagenes/tablas/numerodecuenta.png\"/></td>
 <td align=\"center\" valign=\"bottom\"><img src=\"imagenes/tablas/numeroidentificadordelafactura.png\"/></td>
 <td align=\"center\" valign=\"bottom\"><img src=\"imagenes/tablas/tiporespuesta.png\"/></td>
 <td align=\"center\" valign=\"bottom\"><img src=\"imagenes/tablas/fecharespuesta.png\"/></td>
 <td align=\"center\" valign=\"bottom\"><img src=\"imagenes/tablas/radicadoderespuesta.png\"/></td>
 <td align=\"center\" valign=\"bottom\"><img src=\"imagenes/tablas/fechadenotificaciondeejecucion.png\"/></td>
 <td align=\"center\" valign=\"bottom\"><img src=\"imagenes/tablas/tipodenotificacion.png\"/></td>
 <td align=\"center\" valign=\"bottom\"><img src=\"imagenes/tablas/fechadetrasladoasspd.png\"/></td>
 </tr>");

while ($fila = $db->sql_fetchrow($consulta)) {
  $respuesta=$respuestas->publica($fila['solicitud']);
  $notificacion=$notificaciones->notificacion_final($fila['solicitud']);
  $traslado=$traslados->solicitud($fila['solicitud']);
  $fila['respuesta']=$respuesta['respuesta'];
  $fila['contestacion']=$respuesta['fecha'];
  $fila['factura'] =!empty($fila['factura'] )?$fila['factura']:"N";
  $fila['telefono'] =!empty($fila['telefono'] )?$fila['telefono']:"N";
  /** Evaluo Las Fechas de Respuesta **/
  if(strtotime($respuesta['fecha'])>=strtotime($fila['radicacion'])){
    
  }else{
    $respuesta['fecha']="<span style=\"background-color:#FF0000;color:#FFFFFF;padding: 4px;font-weight:bold;\">".$respuesta['fecha']."</span>";
  }
   /** Evaluo Las Fechas de Notificación **/
    if(strtotime($notificacion['fecha'])>=strtotime($respuesta['radicacion'])){
    
  }else{
    $notificacion['fecha']="<span style=\"background-color:#FF0000;color:#FFFFFF;padding: 4px;font-weight:bold;\">".$notificacion['fecha']."</span>";
  }
  
  /** Evaluando Trasldo a SSPD **/
  if(empty($traslado['fecha'])){
    if($fila['categoria']=="3"&&$respuesta['tipo']=="4"){
      $traslado['fecha']="<span style=\"background-color:#FF0000;color:#FFFFFF;padding: 4px;font-weight:bold;\">ERROR</span>";
    }
  }else{
    $traslado['fecha']=$fechas->dmy($traslado['fecha']);
  }
   echo("<tr>");
  echo("<td nowrap>" . $fila['dane'] . "</td>");
  echo("<td nowrap>" . $cadenas->capitalizar($fila['nombres'] . " " . $fila['apellidos']). "</td>");
  echo("<td nowrap>" . $cadenas->capitalizar($fila['direccion']). "</td>");
  echo("<td nowrap>" . $fila['telefono'] . "</td>");
  echo("<td nowrap>" . $fila['servicio'] . "</td>");
  echo("<td nowrap>" . strtoupper($fila['radicado']) . "</td>");
  echo("<td nowrap>" . $fechas->dmy($fila['radicacion']) . "</td>");
  echo("<td nowrap>" . $fila['categoria'] . "</td>");
  echo("<td nowrap>" . $fila['causal'] . "</td>");
  echo("<td nowrap>" . $cadenas->capitalizar($fila['detalle']). "</td>");
  echo("<td nowrap>" . $fila['suscriptor'] . "</td>");
  echo("<td nowrap>" . $fila['factura'] . "</td>");
  echo("<td nowrap>" . $respuesta['tipo'] . "</td>");
  echo("<td nowrap>" . $fechas->dmy($respuesta['fecha']). "</td>");
  echo("<td nowrap>" . strtoupper($respuesta['radicado']). "</td>");
  echo("<td nowrap>" . $fechas->dmy($notificacion['fecha']). "</td>");
  echo("<td nowrap>" . $notificacion['tipo']. "</td>");
  echo("<td nowrap>" . $traslado['fecha']. "</td>");
  echo("</tr>");
}

echo("</table>");
echo("</div>");
$db->sql_close();

?>