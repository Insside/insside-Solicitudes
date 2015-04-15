<?php
$cadenas = new Cadenas();
$fechas = new Fechas();
$paises = new Paises();
$regiones = new Regiones();
$ciudades = new Ciudades();
$sectores = new Sectores();
$validaciones = new Validaciones();
$respuestas=new Respuestas();
$solicitudes=new Solicitudes();
$suscriptores=new Suscriptores();
$formatos=new Formatos();
$empleados = new Empleados();
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

/** Variables **/
$respuesta=$respuestas->consultar($validaciones->recibir("respuesta"));
$solicitud=$solicitudes->consultar($respuesta['solicitud']);
$suscriptor=$suscriptores->consultar($solicitud['suscriptor']);

/** Valores **/
$valores=$respuesta;
$usuario=$usuarios->consultar($valores['creador']);
$empleado = $empleados->perfil($usuario['empleado']);
/** Campos 1*/
$f->campos['solicitud']=$f->text("solicitud",$valores['solicitud'], "10","required codigo", true);
$f->campos['solicitud-suscriptor']=$f->campo("solicitud_suscriptor",$solicitud['suscriptor'],"");
$f->campos['solicitud-radicado']=$f->campo("solicitud_radicacion",$solicitud['radicado'],"");
$f->campos['solicitud-radicacion']=$f->campo("solicitud_radicacion",$solicitud['radicacion'],"");
$f->campos['suscriptor-nombre']=$f->campo("suscriptor_nombre",$cadenas->capitalizar($suscriptor['nombres']." ".$suscriptor['apellidos']),"");
$f->campos['suscriptor-direccion']=$f->campo("suscriptor_direccion",$cadenas->capitalizar($suscriptor['direccion']." ".$suscriptor['referencia']),"");
/** Campos 2*/
$f->campos['respuesta']=$f->text("respuesta",$valores['respuesta'], "10","required codigo", true);
$f->campos['tipo'] = $respuestas->tipos("tipo", $valores['tipo']);
$f->campos['formato'] = $formatos->combo("formato","");
$f->campos['radicado']=$f->text("radicado",$valores['radicado'], "20","required", false);
$f->campos['fecha']=$f->calendario("fecha",$valores['fecha'],"0","1");
$f->campos['hora']=$f->text("hora",$valores['hora'], "8","required automatico", true);
$f->campos['creador']=$f->text("creador",$valores['creador'], "10","required", true,true);
$f->campos['categoria'] = $respuestas->categorias($valores['categoria'],"w100");
$f->campos['estado']=$f->text("estado",$valores['estado'], "128","", true);
$f->campos['ayuda'] = $f->button("ayuda" . $f->id, "button","Ayuda");
$f->campos['cancelar'] = $f->button("cancelar" . $f->id, "button","Cancelar");
$f->campos['continuar'] = $f->button("continuar" . $f->id, "submit","Modificar");
$f->campos['detalle'] = $f->iTextAreaEditor("detalle" . $f->id, urldecode($valores['detalle']), "h150");
/** Campos Responsable*/
$f->campos['creador']=$f->text("creador",$valores['creador'], "10","required", true,true);
$f->campos['creador-nombre'] = $f->campo("nombres", $empleado['nombres']." ".$empleado['apellidos']);
$f->campos['creador-direccion'] = $f->campo("direccion", $empleado['direccion']);
$f->campos['creador-telefono'] = $f->campo("telefono", $empleado['telefono']);
$f->campos['creador-correo'] = $f->campo("correo", $empleado['correo']);
$f->campos['creador-sexo'] = $f->campo("sexo", $empleado['sexo']);
$f->campos['creador-foto'] ="<img src=\"".$empleado['foto']."?".time()."\" width=\"200\" height=\"267\"/>";
/** Celdas 1**/
$f->celdas["solicitud"] = $f->celda("Código de Solicitud:", $f->campos['solicitud'],"","w150");
$f->celdas["solicitud-radicado"] = $f->celda("Radicado:", $f->campos['solicitud-radicado'],"","");
$f->celdas["solicitud-radicacion"] = $f->celda("Fecha / Radicación:", $f->campos['solicitud-radicacion'],"","w120");
$f->celdas["solicitud-suscriptor"] = $f->celda("Suscriptor:", $f->campos['solicitud-suscriptor'],"","w100");
$f->celdas["suscriptor-nombre"] = $f->celda("Nombre Completo:", $f->campos['suscriptor-nombre'],"","");
$f->celdas["suscriptor-direccion"] = $f->celda("Dirección del Predio:", $f->campos['suscriptor-direccion'],"","");
/** Celdas 2**/
$f->celdas["respuesta"] = $f->celda("Código de Respuesta:", $f->campos['respuesta'],"","w150");
$f->celdas["tipo"] = $f->celda("Tipo:", $f->campos['tipo']);
$f->celdas["formato"] = $f->celda("Formato:", $f->campos['formato']);
$f->celdas["radicado"] = $f->celda("Radicado:", $f->campos['radicado']);
$f->celdas["detalle"] = $f->celda("Detalle:", $f->campos['detalle']);
$f->celdas["fecha"] = $f->celda("Fecha / Radicación:", $f->campos['fecha'],"","w120");
$f->celdas["hora"] = $f->celda("Hora:", $f->campos['hora'],"","w100");
$f->celdas["categoria"] = $f->celda("Categoria:", $f->campos['categoria']);
$f->celdas["estado"] = $f->celda("Estado:", $f->campos['estado']);
/** Celdas 3**/
$f->celdas["detalle"] = $f->celda("Contenido Textual:", urldecode($f->campos['detalle']),"","w150");
/** Celdas Responsable**/
$f->celdas["creador"] = $f->celda("Creador:", $f->campos['creador']);
$f->celdas["creador-nombre"] = $f->celda("Nombre:", $f->campos['creador-nombre']);
$f->celdas["creador-direccion"] = $f->celda("Dirección:", $f->campos['creador-direccion']);
$f->celdas["creador-telefono"] = $f->celda("Teléfonos:", $f->campos['creador-telefono']);
$f->celdas["creador-correo"] = $f->celda("Correo Electrónico:", $f->campos['creador-correo']);
$f->celdas["creador-sexo"] = $f->celda("Sexo:", $f->campos['creador-sexo']);
$f->celdas["creador-texto"] = $f->celda("","<p>Para todos los efectos que este formato implica, se aclara que la responsabilidad legal recae sobre la versión final del mismo que se imprime o exhibe públicamente en internet o en medio físico con la respectiva firma del jefe del área. La versión accesible  vía internet se define como un elemento público de contenido textual o de referente al adjunto digitalizado de la respuesta física emitida. Donde ya sea el adjunto digitalizado de la respuesta o la respuesta textual poseen una validez legal.</p>");
$f->celdas["bloque-a"] = $f->celda("", $f->campos['creador-foto'],"","w200");

/** Filas **/
$f->fila["titulo_solicitud"]="<h2>1. Datos de la Solicitud Relacionada.</h2>";
$f->fila["s1"] = $f->fila($f->celdas["solicitud"].$f->celdas["solicitud-radicado"].$f->celdas["solicitud-radicacion"]);
$f->fila["s2"] = $f->fila($f->celdas["solicitud-suscriptor"].$f->celdas["suscriptor-nombre"].$f->celdas["suscriptor-direccion"]);
$f->fila["titulo_suscriptor"]="<h2>1. Datos de la Solicitud Relacionada.</h2>";
$f->fila["titulo_respuesta"]="<h2>2. Datos de la Respuesta Generada</h2>";
$f->fila["fila2"] = $f->fila($f->celdas["respuesta"].$f->celdas["radicado"].$f->celdas["fecha"].$f->celdas["hora"]);
$f->fila["fila3"] = $f->fila($f->celdas["formato"].$f->celdas["tipo"].$f->celdas["categoria"]);
$f->fila["r1"] = $f->fila($f->celdas["creador"]);
/** Filas Creador **/
$f->fila['creador-t1']="<h2>4. Responsable de la Redacción.</h2>";
$f->fila['creador-f1']=$f->fila($f->celdas["creador"].$f->celdas["creador-nombre"].$f->celdas["creador-sexo"]);
$f->fila['creador-f2']=$f->fila($f->celdas["creador-direccion"]);
$f->fila['creador-f3']=$f->fila($f->celdas["creador-telefono"]);
$f->fila['creador-f4']=$f->fila($f->celdas["creador-correo"]);
$f->fila['creador-t2']="<h2>5. Responsable Legal.</h2>";
$f->fila['creador-f5']=$f->fila($f->celdas["creador-texto"]); 
$f->celdas["bloque-b"] = $f->celda("",$f->fila['creador-t1'].$f->fila['creador-f1'].$f->fila['creador-f2'].$f->fila['creador-f3'].$f->fila['creador-f4'].$f->fila['creador-t2'].$f->fila['creador-f5']);

 
/** Tab Contenido **/
$f->fila["contenido_titulo"]="<h2>3. Contenido Textual Solicitud.</h2>";
$f->fila["contenido_detalle"] = $f->fila($f->celdas["detalle"]);
/** Tab Responsable **/
$f->fila["creador-f0"] =$f->fila($f->celdas["bloque-a"].$f->celdas["bloque-b"]);



/** Compilando **/
$f->fila["datos"]=$f->fila["titulo_solicitud"].$f->fila['s1'].$f->fila['s2'].$f->fila["titulo_respuesta"].$f->fila['fila2'].$f->fila['fila3'];
$f->fila["contenido"]=$f->fila["contenido_titulo"].$f->fila["contenido_detalle"];
$f->fila["responsable"]=$f->fila['creador-f0'];


$f->fila["tabs"]=""
        . "<ul id=\"tabs\">"
        . "<li><a class=\"tab\" href=\"#\" id=\"one\">Información</a></li>"
        . "<li><a class=\"tab\" href=\"#\" id=\"two\">Contenido</a></li>"
        ."<li><a class=\"tab\" href=\"#\" id=\"one\">Responsable</a></li>"
        ."</ul>";
$f->fila["home"]=""
        . "<div id=\"home\">"
        . "<div class=\"feature\">".$f->fila["datos"]."</div>"
        . "<div class=\"feature\">".$f->fila["contenido"]."</div>"
        . "<div class=\"feature\">".$f->fila["responsable"]."</div>"
        ."</div>";
/** Compilando **/
$f->filas($f->fila['tabs']);
$f->filas($f->fila['home']);
/** Botones **/
$f->botones($f->campos['ayuda'], "inferior-izquierda");
$f->botones($f->campos['cancelar'], "inferior-derecha");
$f->botones($f->campos['continuar'], "inferior-derecha"); 
/** JavaScripts **/
$f->JavaScript("MUI.titleWindow($('" . ($f->ventana) . "'), \"<b>Modificar Respuesta</b> v1.5 Revisión 20150223\");");
$f->JavaScript("MUI.resizeWindow($('" . ($f->ventana) . "'), {width: 750, height:450});");
$f->JavaScript("MUI.centerWindow($('" . $f->ventana . "'));");
$f->eClick("cancelar" . $f->id, "MUI.closeWindow($('" . $f->ventana . "'));");
//$f->eClick("georeferencia" . $f->id, "MUI.Medidores_Georeferencia_Crear('" . $relacion['suscriptor'] . "');");
?>
<script type="text/javascript">
var tabs = new iTabs('.tab','.feature',{
autoplay: false,
transitionDuration:500,
slideInterval:3000,
hover:true
});
</script>