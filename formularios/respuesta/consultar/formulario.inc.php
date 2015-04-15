<?php
$root = (!isset($root)) ? "../../../../" : $root;
require_once($root . "modulos/solicitudes/librerias/Configuracion.cnf.php");
$sesion = new Sesion();
$validaciones = new Validaciones();
$respuestas=new Respuestas();
$usuarios=new Usuarios();
$usuario=$sesion->usuario();

$respuesta =$respuestas->consultar($validaciones->recibir("respuesta"));
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
/** Valores **/
$valores=$respuesta;
$html='<table cellspacing="0" cellpadding="0" border="0" width="100%" align="center"> '
        . '<tbody> <tr> <td style="padding:27px 20px 40px 20px;background-color:#f5f5f5;max-width:700px">'
        . '<table cellspacing="0" cellpadding="0" border="0" width="700" align="center" style="margin:0 auto"> <tbody> <tr> <td width="100%">'
        . '<div id="impresion">'
        . '<table cellspacing="0" cellpadding="0" border="0" width="100%" align="left" style="margin:0 auto;border:1px solid #ffffff;border-radius:5px"> <tbody> <tr> <td width="100%" height="21" bgcolor="#ffffff" style="border-top-left-radius:5px;border-top-right-radius:5px"></td> </tr> <tr> <td bgcolor="#ffffff" align="right" style="padding:0 19px 0 21px">'
        . '<table cellspacing="0" cellpadding="0" border="0" width="100%"> <tbody> <tr> <td height="27" bgcolor="#ffffff" align="right" style="display:block">'
        . '<img width="100%" style="left:-30px; top:0px;" src="imagenes/logos/membrete.png"></td> </tr> </tbody> </table></td> </tr> <tr> <td width="100%" height="12" bgcolor="#ffffff"></td> </tr> <tr> <td bgcolor="#ffffff" style="padding:0 50px 0px;border-bottom-right-radius:5px;border-bottom-left-radius:5px"><table> <tbody> <tr> <td bgcolor="#ffffff" style="border-bottom-right-radius:5px;border-bottom-left-radius:5px"><table cellspacing="0" cellpadding="0" border="0" width="100%" align="center"> <tbody> <tr> <td width="100%" valign="top"><table cellspacing="0" cellpadding="0" border="0" width="100%" style="table-layout:fixed"> <tbody> <tr> <td style="padding:4px 0 19px;margin:0;font-family:Helvetica Neue,Helvetica,Arial,Verdana,sans-serif;color:#797979;font-size:14px;line-height:1.6em;word-wrap:break-word">'
        . urldecode($valores['detalle'])
        . '</td> </tr> </tbody> </table></td> </tr> </tbody> </table></td> </tr> </tbody> </table>'
        . '</td> </tr> <tr><td> '
        . '<table cellspacing="0" cellpadding="40" border="0" width="100%"> <tbody> <tr> '
        . '<td bgcolor="#ffffff" align="center" style="display: block; padding-left: 30px; padding-right: 30px; padding-bottom: 30px;">'
        . '<img width="100%" src="imagenes/logos/pie.png"></td> </tr> </tbody> </table>'
        . '</div> '
        . '</td></tr> </tbody> </table></td> </tr> </tbody> </table></td> </tr> </tbody> </table>';




//$html="<div id=\"contenido_respuesta\" style=\" padding:20px; background-color:#FFF\">";
//$html.="<img src=\"imagenes/logos/membrete.png\" width=\"100%\" style=\"left:-30px; top:0px;\"/> <br />";
//$html.="<div id=\"contenido\" style=\"margin-left:30px; margin-right:30px\">";
//$html.=urldecode($valores['detalle']);
//$html.="</div>";
//$html.="<img src=\"imagenes/logos/pie.png\" width=\"100%\" />";
//$html.="</div>";
/** Campos **/
$f->campos['respuesta']=$f->campo("respuesta",$valores['respuesta']);
$f->campos['solicitud']=$f->campo("solicitud",$valores['solicitud']);
$f->campos['tipo']=$f->campo("tipo",$valores['tipo']);
$f->campos['formato']=$f->campo("formato",$valores['formato']);
$f->campos['radicado']=$f->campo("radicado",$valores['radicado']);
$f->campos['detalle'] =$f->iTextAreaVisor("detalle" .$f->id,$html, "h150");
$f->campos['fecha']=$f->campo("fecha",$valores['fecha']);
$f->campos['hora']=$f->campo("hora",$valores['hora']);
$f->campos['creador']=$f->campo("creador",$valores['creador']);
$f->campos['categoria']=$f->campo("categoria",$valores['categoria']);
$f->campos['estado']=$f->campo("estado",$valores['estado']);
$f->campos['imprimir']=$f->button("imprimir".$f->id,"button","Imprimir");
$f->campos['actualizar']=$f->button("actualizar".$f->id,"button","Modificar");
/** Celdas **/
$f->celdas["respuesta"] = $f->celda("Respuesta:", $f->campos['respuesta']);
$f->celdas["solicitud"] = $f->celda("Solicitud:", $f->campos['solicitud']);
$f->celdas["tipo"] = $f->celda("Tipo:", $f->campos['tipo']);
$f->celdas["formato"] = $f->celda("Formato:", $f->campos['formato']);
$f->celdas["radicado"] = $f->celda("Radicado:", $f->campos['radicado']);
$f->celdas["detalle"] = $f->celda("Detalle:", $f->campos['detalle']);
$f->celdas["fecha"] = $f->celda("Fecha:", $f->campos['fecha']);
$f->celdas["hora"] = $f->celda("Hora:", $f->campos['hora']);
$f->celdas["creador"] = $f->celda("Creador:", $f->campos['creador']);
$f->celdas["categoria"] = $f->celda("Categoria:", $f->campos['categoria']);
$f->celdas["estado"] = $f->celda("Estado:", $f->campos['estado']);
/** HTML **/
$html=$f->campos['detalle'];
/** Filas **/
$f->fila["f0"] = $html;
//$f->fila["fila1"] = $f->fila($f->celdas["respuesta"].$f->celdas["solicitud"].$f->celdas["tipo"]);
//$f->fila["fila2"] = $f->fila($f->celdas["formato"].$f->celdas["radicado"].$f->celdas["detalle"]);
//$f->fila["fila3"] = $f->fila($f->celdas["fecha"].$f->celdas["hora"].$f->celdas["creador"]);
//$f->fila["fila4"] = $f->fila($f->celdas["categoria"].$f->celdas["estado"]);
/** Compilando **/
$f->filas($f->fila['f0']);
//$f->filas($f->fila['fila1']);
//$f->filas($f->fila['fila2']);
//$f->filas($f->fila['fila3']); 
//$f->filas($f->fila['fila4']);

//$f->botones($f->campos["imprimir"]);
//if($usuarios->permiso('SOLICITUDES-RESPUESTAS-ACTUALIZAR-TODAS')){
//  $f->botones($f->campos["actualizar"]);
//}elseif($usuarios->permiso('SOLICITUDES-RESPUESTAS-ACTUALIZAR')&&($usuario['usuario']==$respuesta['creador'])){
//  $f->botones($f->campos["actualizar"]);
//}




//$f->botones($f->campos["actualizar"]);
/** JavaScripts **/
?>