<?php
$root = (!isset($root)) ? "../../../../" : $root;
require_once($root . "modulos/comercial/librerias/Configuracion.cnf.php");
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

/** Variables * */
$cadenas = new Cadenas();
$fechas = new Fechas();
$paises = new Paises();
$regiones = new Regiones();
$ciudades = new Ciudades();
$sectores = new Sectores();
$solicitudes = new Solicitudes();
$respuestas = new Respuestas();
$formatos=new Formatos();
$solicitud = $solicitudes->consultar($_REQUEST['solicitud']);
/** Valores * */
$valores['respuesta'] = time();
$valores['solicitud'] = $solicitud['solicitud'];
$valores['tipo'] = @$_REQUEST["_tipo"];
$valores['categorias'] = @$_REQUEST["_categorias"];
$valores['radicado'] = "IMIS-RER-" . $valores['respuesta'];
$valores['detalle'] = @$_REQUEST["_detalle"];
$valores['fecha'] = $fechas->hoy();
$valores['hora'] = $fechas->ahora();
$valores['creador'] = $sesion->consultar("usuario");
/** Avance * */
$f->avance("establecer", "detalles");
/** Campos * */
$f->campos['respuesta'] = $f->text("respuesta", $valores['respuesta'], "10", "required codigo", true);
$f->campos['solicitud'] = $f->text("solicitud", $valores['solicitud'], "10", "required codigo", true);
$f->campos['solicitud_radicado'] = $f->campo("solicitud", $solicitud['radicado']);
$f->campos['solicitud_radicacion'] = $f->campo("solicitud", $solicitud['radicacion']);
$f->campos['tipo'] = $respuestas->tipos("tipo", $valores['tipo']);
$f->campos['categoria'] = $respuestas->categorias($valores['categorias']);
$f->campos['formato'] = $formatos->combo("formato","");
$f->campos['radicado'] = $f->text("radicado", $valores['radicado'], "16", "automatico", false);
$f->campos['detalle'] = $f->textarea("detalle", $valores['detalle'], "h150");
$f->campos['fecha']=$f->calendario("fecha",$fechas->hoy(),"0","1");
$f->campos['hora'] = $f->text("hora", $valores['hora'], "8", "required automatico", false);
$f->campos['creador'] = $f->text("creador", $valores['creador'], "10", "required automatico", true);
$f->campos['cancelar'] = $f->button("cancelar" . $f->id, "button", "Cancelar");
$f->campos['continuar'] = $f->button("continuar" . $f->id, "submit", "Continuar");
/** Celdas * */
$f->celdas["info"]=$f->celda("<div style=\"line-height: 13px !important; font-size: 13px !important;\"><div id=\"i100x100_advertencia\" style=\"float: left;\"></div>El presente asistente le permitirá dar respuesta a la solicitud (PQRS) seleccionada, proporcione el número de radicado de la respuesta si esta tuvo una contestación mediante un documento físico, completados los datos solicitados en esta instancia (Paso 1) por favor digite o deposite el contenido textual de la respuesta en formato correspondiente (Paso 2). Recuerde que la información proporcionada automáticamente será accesible al suscriptor correspondiente mediante el portal corporativo de la entidad, por tal motivo <u>se le recuerda la responsabilidad legal</u> que implica diligenciar el presente formulario.</div>","","","");
$f->celdas["respuesta"] = $f->celda("Respuesta:", $f->campos['respuesta'], "", "w100");
$f->celdas["solicitud"] = $f->celda("Solicitud:", $f->campos['solicitud'], "", "w100");
$f->celdas["solicitud_radicado"] = $f->celda("Radicado:", $f->campos['solicitud_radicado'], "", "");
$f->celdas["solicitud_radicacion"] = $f->celda("Fecha de Radicación:", $f->campos['solicitud_radicacion'], "", "");
$f->celdas["tipo"] = $f->celda("Tipo de Respuesta:", $f->campos['tipo']);
$f->celdas["categoria"] = $f->celda("Categoría de la Respuesta:", $f->campos['categoria']);
$f->celdas["formato"] = $f->celda("Formato:", $f->campos['formato']);
$f->celdas["radicado"] = $f->celda("Radicado:", $f->campos['radicado'], "", "w200");
$f->celdas["detalle"] = $f->celda("Detalle:", $f->campos['detalle']);
$f->celdas["fecha"] = $f->celda("Fecha:", $f->campos['fecha']);
$f->celdas["hora"] = $f->celda("Hora:", $f->campos['hora']);
$f->celdas["creador"] = $f->celda("Creador:", $f->campos['creador']);
/** Filas * */
$f->fila["info"] =$f->fila($f->celdas["info"]);
$f->fila["solicitud1"] = $f->fila($f->celdas["solicitud"] . $f->celdas["solicitud_radicado"] . $f->celdas["solicitud_radicacion"]);
$f->fila["fila1"] = $f->fila($f->celdas["respuesta"] . $f->celdas["radicado"] . $f->celdas["fecha"] . $f->celdas["hora"]);
$f->fila["fila2"] = $f->fila($f->celdas["tipo"] .$f->celdas["categoria"]. $f->celdas["creador"]);
$f->fila["fila3"] = $f->fila($f->celdas["formato"]);
/** Compilando * */
$f->filas($f->fila["info"]);
$f->filas($f->titulo("Datos de la solicitud."));
$f->filas($f->fila['solicitud1']);
$f->filas($f->titulo("Información de respuesta."));
$f->filas($f->fila['fila1']);
$f->filas($f->fila['fila2']);
$f->filas($f->fila['fila3']);
$f->botones($f->campos['cancelar']);
$f->botones($f->campos['continuar']);
$f->JavaScript("MUI.titleWindow($('" . ($f->ventana) . "'), \"Radicar Respuestas \");");
?>
<script type="text/javascript">
  
  MUI.resizeWindow($('<?php echo($f->ventana); ?>'), {width: 640, height: 420, top: 0, left: 0});
  MUI.centerWindow($('<?php echo($f->ventana); ?>'));
  if ($('cancelar<?php echo($f->id); ?>')) {
    $('cancelar<?php echo($f->id); ?>').addEvent('click', function(e) {
      MUI.closeWindow($('<?php echo($f->ventana); ?>'));
    });
  }
</script>
