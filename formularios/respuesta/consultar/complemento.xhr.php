<?php
$root = (!isset($root)) ? "../../../../../" : $root;
require_once($root . "modulos/solicitudes/librerias/Configuracion.cnf.php");
require_once($root . "modulos/usuarios/librerias/Usuarios.class.php");
$sesion=new Sesion();
$validaciones=new Validaciones();
$respuestas=new Respuestas();
$usuarios=new Usuarios();
$empleados=new Empleados();
$transaccion=$validaciones->recibir("transaccion");
$trasmision = $validaciones->recibir("trasmision");
$respuesta =$respuestas->consultar($validaciones->recibir("respuesta"));
$usuario=$usuarios->consultar($respuesta['creador']);
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
/** Clases Declaradas E Inicializadas * */
$perfil = $empleados->perfil($usuario['empleado']);
/** Campos * */
$f->campos['respuesta_respuesta'] = $f->campo("respuesta_respuesta", $respuesta['respuesta']);
$f->campos['respuesta_fecha'] = $f->campo("respuesta_fecha", $respuesta['fecha']);
$f->campos['respuesta_hora'] = $f->campo("respuesta_hora", $respuesta['hora']);
$f->celdas["respuesta_respuesta"] = $f->celda("Código Respuesta:", $f->campos['respuesta_respuesta']);
$f->celdas["respuesta_fecha"] = $f->celda("Fecha de Redacción:", $f->campos['respuesta_fecha']);
$f->celdas["respuesta_hora"] = $f->celda("Hora de Publicación:", $f->campos['respuesta_hora']);




$f->campos['empleado'] = $f->campo("empleado", $perfil['empleado']);
$f->campos['nombres'] = $f->campo("nombres", $perfil['nombres']);
$f->campos['apellidos'] = $f->campo("apellidos", $perfil['apellidos']);
$f->campos['direccion'] = $f->campo("direccion", $perfil['direccion']);
$f->campos['telefono'] = $f->campo("telefono", $perfil['telefono']);
$f->campos['correo'] = $f->campo("correo", $perfil['correo']);
$f->campos['sexo'] = $f->campo("sexo", $perfil['sexo']);
$f->campos['creado'] = $f->campo("creado", $perfil['creado']);
$f->campos['actualizado'] = $f->campo("actualizado", $perfil['actualizado']);
$f->campos['creador'] = $f->campo("creador", $perfil['creador']);
$f->campos['foto'] ="<a href=\"#\" onClick=\"MUI.Usuarios_Creador('".$respuesta['creador']."');\"><img src=\"".$perfil['foto']."\" width=\"100%\"/></a>";
$f->campos['cerrar'] = $f->button("cerrar" . $f->id, "button", "Cerrar");
$f->campos['actualizar'] = $f->button("actualizar" . $f->id, "button", "Actualizar");
/** Celdas * */
$f->celdas["empleado"] = $f->celda("Perfil:", $f->campos['empleado']);
$f->celdas["nombres"] = $f->celda("Nombres:", $f->campos['nombres']);
$f->celdas["apellidos"] = $f->celda("Apellidos:", $f->campos['apellidos']);
$f->celdas["direccion"] = $f->celda("Dirección:", $f->campos['direccion']);
$f->celdas["telefono"] = $f->celda("Teléfonos:", $f->campos['telefono']);
$f->celdas["correo"] = $f->celda("Correo Electrónico:", $f->campos['correo']);
$f->celdas["sexo"] = $f->celda("Sexo:", $f->campos['sexo']);
$f->celdas["creado"] = $f->celda("Creado:", $f->campos['creado']);
$f->celdas["actualizado"] = $f->celda("Actualizado:", $f->campos['actualizado']);
$f->celdas["creador"] = $f->celda("Creador:", $f->campos['creador']);

$f->fila['sf1']=$f->fila($f->celdas["empleado"]);
$f->fila['sf2']=$f->fila($f->celdas["nombres"] . $f->celdas["apellidos"]);
$f->fila['sf3']=$f->fila($f->celdas["direccion"]);
$f->fila['sf4']=$f->fila($f->celdas["telefono"]);
$f->fila['sf5']=$f->fila($f->celdas["correo"]);

$f->fila['rf1']=$f->fila($f->celdas["respuesta_respuesta"]);
$f->fila['rf2']=$f->fila($f->celdas["respuesta_fecha"]);
$f->fila['rf3']=$f->fila($f->celdas["respuesta_hora"]);


$f->celdas["foto"] = $f->celda("Responsable", $f->campos['foto'],"","w200");

$f->celdas["datos"] = $f->celda("",$f->fila['sf1'].$f->fila['sf2'].$f->fila['sf3'].$f->fila['sf4'].$f->fila['sf5']);
/** Filas * */
$f->fila["f1"] =$f->fila($f->celdas["foto"]);
//$f->fila["fila1"] = $f->fila($f->celdas["empleado"] . $f->celdas["nombres"] . $f->celdas["apellidos"]);
//$f->fila["fila2"] = $f->fila($f->celdas["direccion"] . $f->celdas["telefono"] . $f->celdas["correo"]);
//$f->fila["fila3"] = $f->fila($f->celdas["sexo"] . $f->celdas["creado"] . $f->celdas["actualizado"]);
//$f->fila["fila4"] = $f->fila($f->celdas["creador"]);
/** Compilando * */
$f->filas($f->fila['f1']);
$f->filas($f->fila['rf1']);
$f->filas($f->fila['rf2']);
$f->filas($f->fila['rf3']);
//$f->filas($f->fila['sf2']);
//$f->filas($f->fila['fila2']);
//$f->filas($f->fila['fila3']);
//$f->filas($f->fila['fila4']);
//$f->botones($f->campos["cerrar"]);
//$f->botones($f->campos["actualizar"]);
//$f->JavaScript("MUI.resizeWindow($('" . ($f->ventana) . "'), {width: 540, height: 295});");
//$f->JavaScript("MUI.centerWindow($('" . $f->ventana . "'));");
echo($f->generar());
echo($f->controles());
echo($f->cierre());
?>