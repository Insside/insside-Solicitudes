<?php
$root = (!isset($root)) ? "../../../../../" : $root;
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
?>
<div class="toolbox divider">
  <?php if($usuarios->permiso('SOLICITUDES-RESPUESTAS-ACTUALIZAR-TODAS')||($usuarios->permiso('SOLICITUDES-RESPUESTAS-ACTUALIZAR')&&($usuario['usuario']==$respuesta['creador']))){?>
  <a href="#" onClick="MUI.Solicitudes_Respuesta_Modificar('<?php echo($respuesta['respuesta']);?>');"><img src="imagenes/16x16/editar.png" class="icon16"/></a>
  <?php }?>
  
  <a href="#" onClick="MUI.Imprimir($('impresion'));"><img src="imagenes/16x16/impresora.png" class="icon16"/></a>
  <a href="#" onClick="MUI.Solicitudes_Solicitud_Consultar('<?php echo($respuesta['solicitud']); ?>');"><img src="imagenes/16x16/retroceder.png" class="icon16"/></a>
  <a href="#" onClick="MUI.Solicitudes_Respuesta_Consultar('<?php echo($respuesta['respuesta']); ?>');"><img src="imagenes/16x16/actualizar.png" class="icon16"/></a>
</div>
