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
/** Definicion De Variables * */
$solicitudes = new Solicitudes();
$cadenas = new Cadenas();
$categorias = new Categorias();
$componentes = new Componentes();
$suscriptores = new Suscriptores();
$permisos=new Permisos();
$usuarios=new Usuarios();
$paises = new Paises();
$regiones = new Regiones();
$ciudades = new Ciudades();
$sectores = new Sectores();
/** Inicialización De Valores * */
$solicitud = $solicitudes->consultar(@$_REQUEST['solicitud']);
$servicio = $servicios->consultar($solicitud['servicio']);
$categoria = $categorias->consultar($solicitud['categoria']);
$causal = $causales->consultar($solicitud['servicio'], $solicitud['causal']);
$asunto = $asuntos->consultar($solicitud['asunto']);
$suscriptor = $suscriptores->consultar($solicitud['suscriptor']);
/** Asignación De Valores * */
$valores = $solicitud;
/** Campos **/
/** Se debe evaluar si quien esta visualizando la solicitud dispone de los suficientes privilegios para generar una
 * respuesta, y si dependiendo de estos privilegios la respuesta que podra generar es de naturaleza publica o privada
 * en cualquiera de los dos casos se visualizara la opción para poder acceder al formato de respuesta pero este
 * formato otorgara la la visibilidad publica o privada de la respuesta segun la existencia de uno u ambos permisos.
 * los cales a saber son "SOLICITUDES-RESPONDER" y "SOLICITUDES-RESPONDER-PUBLICAMENTE", aun asi es
 * posible responder si y solo si se es el CREADOR o el RESPONSABLE de la solicitud, donde la responsabilidad
 * puede ser permanente o trasferible.
 */

$usuario=$sesion->usuario();
if(($usuario['usuario']==$solicitud['creador'])||($usuario['usuario']==$solicitud['responsable'])){
  if($usuarios->permiso("SOLICITUDES-RESPONDER")||$usuarios->permiso("SOLICITUDES-RESPONDER-PUBLICAMENTE")){
  $link["responder"]="[ <a href=\"#\" onClick=\"MUI.Solicitudes_Respuesta_Crear('".$s['solicitud']."');\">Responder</a> ]";
  }else{
      $link["responder"]="<a href=\"#\" onClick=\"MUI.Solicitudes_Ayuda('responder-permisos');\"><img src=\"imagenes/16x16/ayuda-16x16.png\"/></a>";
  }
}else{
  $link["responder"]="<a href=\"#\" onClick=\"MUI.Solicitudes_Ayuda('responder-creadoryoresponsable');\"><img src=\"imagenes/16x16/ayuda-16x16.png\"/></a>";
}


$f->campos['info4']="<p>El presente listado corresponde a las respuestas internas y externas, generadas por los "
        . "miembros de los diferentes equipos de trabajo que intervienen en proceso respuesta formal y operativa "
        . "a los diferentes aspectos de la solicitud PQR. El presente formato admite múltiples respuestas internas y "
        . "una sola respuesta de naturaleza pública, la cual es generada por el responsable explícito de generar "
        . "la misma.</p>";
/** Celdas **/
$f->celdas["respuestas-info"] = $f->celda("", $f->campos['info4']);
$f->celdas["respuestas-tabla"] = $f->celda("", $respuestas->tabla($s['solicitud']),"","tdatos");
/** Filas **/
$f->fila['respuestas-titulo']=$f->titulo("3. Procedimientos & Respuesta. ".$link['responder']);
$f->fila["respuestas-info"]=$f->fila($f->celdas['respuestas-info']);
$f->fila['respuestas-tabla']=$f->fila($f->celdas["respuestas-tabla"] );
/** Compilando * */
$f->filas($f->fila['respuestas-titulo']);
$f->filas($f->fila['respuestas-info']);
$f->filas($f->fila['respuestas-tabla']);
?>