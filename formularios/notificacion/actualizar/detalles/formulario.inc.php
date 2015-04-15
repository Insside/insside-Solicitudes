<?php
$cadenas = new Cadenas();
$fechas = new Fechas();
$notificaciones = new Notificaciones();
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
$notificaciones = new Notificaciones();
$notificacion = $notificaciones->consultar($validaciones->recibir("notificacion"));
/** Valores * */
$valores = $notificacion;
/** Campos * */
$f->oculto("notificacion" . $f->id, $valores['notificacion']);
$f->campos['notificacion'] = $f->text("notificacion", $valores['notificacion'], "10", "required codigo", true);
$f->campos['solicitud'] = $f->text("solicitud", $valores['solicitud'], "10", "required codigo", true);
$f->campos['respuesta'] = $f->text("respuesta", $valores['respuesta'], "10", "required", false);
$f->campos['radicacion'] = $f->text("radicacion", $valores['radicacion'], "32", "required", false);
$f->campos['tipo'] = $notificaciones->tipos("tipo", "");
$f->campos['formato'] = $notificaciones->formatos("formato", "");
$f->campos['contenido'] = $f->text("contenido", $valores['contenido'], "ex", "", true);
$f->campos['fecha'] = $f->calendario("fecha", $valores['fecha'], "0", "1");
$f->campos['hora'] = $f->text("hora", $valores['hora'], "8", "", true, true);
$f->campos['creador'] = $f->text("creador", $valores['creador'], "10", "", true, true);
$f->campos['estado'] = $f->text("estado", $valores['estado'], "128", "", true);
$f->campos['ayuda'] = $f->button("ayuda" . $f->id, "button", "Ayuda");
$f->campos['cancelar'] = $f->button("cancelar" . $f->id, "button", "Cancelar");
$f->campos['continuar'] = $f->button("continuar" . $f->id, "button", "Guardar", "", "detalles_envio" . $f->id . "();");
/** Celdas * */
$f->celdas["notificacion"] = $f->celda("Código  de Notificacion:", $f->campos['notificacion']);
$f->celdas["solicitud"] = $f->celda("Código de Solicitud:", $f->campos['solicitud']);
$f->celdas["respuesta"] = $f->celda("Código  de Respuesta:", $f->campos['respuesta']);
$f->celdas["radicacion"] = $f->celda("Radicación (Documento Fisico):", $f->campos['radicacion']);
$f->celdas["tipo"] = $f->celda("Tipo de Notificación:", $f->campos['tipo']);
$f->celdas["formato"] = $f->celda("Formato de Documento Aplicado:", $f->campos['formato']);
$f->celdas["contenido"] = $f->celda("Contenido:", $f->campos['contenido']);
$f->celdas["fecha"] = $f->celda("Fecha de Creación:", $f->campos['fecha']);
$f->celdas["hora"] = $f->celda("Hora de Registro:", $f->campos['hora']);
$f->celdas["creador"] = $f->celda("Creador (Usuario):", $f->campos['creador']);
$f->celdas["estado"] = $f->celda("Estado:", $f->campos['estado']);
/** Filas * */
$f->fila["fila0"] = $f->fila("<h2>Detalles Explícitos de la Notificación.</h2>");
$f->fila["fila1"] = $f->fila($f->celdas["notificacion"] . $f->celdas["solicitud"] . $f->celdas["respuesta"].$f->celdas["radicacion"]);
$f->fila["fila2"] = $f->fila($f->celdas["tipo"] . $f->celdas["formato"]);
$f->fila["fila3"] = $f->fila("<h2>Información del Registro & Responsabilidad.</h2>");
$f->fila["fila4"] = $f->fila($f->celdas["fecha"] . $f->celdas["hora"] . $f->celdas["creador"]);
$f->fila["fila5"] = $f->fila($f->celdas["estado"]);
/** Compilando * */
$f->filas("<div id=\"div" . $f->id . "\">");
$f->filas($f->fila['fila0']);
$f->filas($f->fila['fila1']);
$f->filas($f->fila['fila2']);
$f->filas($f->fila['fila3']);
$f->filas($f->fila['fila4']);
$f->filas("</div>");
/** Botones * */
$f->botones($f->campos['ayuda'], "inferior-izquierda");
$f->botones($f->campos['cancelar'], "inferior-derecha");
$f->botones($f->campos['continuar'], "inferior-derecha");
/** JavaScripts * */
$f->JavaScript("function CKupdate(){ckInstance.updateElement();}var ckInstance" . $f->id . "= CKEDITOR.replace( 'ckcontenido" . $f->id . "');");
$f->JavaScript("MUI.titleWindow($('" . ($f->ventana) . "'), \"Redactar Notificación\");");
$f->JavaScript("MUI.resizeWindow($('" . ($f->ventana) . "'), {width: 750, height: 480});");
$f->JavaScript("MUI.centerWindow($('" . $f->ventana . "'));");
$f->eClick("cancelar" . $f->id, "MUI.closeWindow($('" . $f->ventana . "'));");
//$f->eClick("continuar" . $f->id, "envio" . $f->id . "();");
?>
<script>
  function detalles_envio<?php echo($f->id); ?>() {
    var fid = "<?php echo($f->id); ?>";
    var notificacion = $("notificacion<?php echo($f->id); ?>").value;
    var respuesta = $("respuesta").value;
    var fecha = $("fecha").value;
    var tipo = $('tipo').getElement(':selected').value;
    var formato = $('formato').getElement(':selected').value;

    var clase = "required";
    var parametros = {'fid': fid, 'notificacion': notificacion, 'respuesta': respuesta, 'tipo': tipo, 'formato': formato, 'fecha': fecha};
    var datos = JSON.encode(parametros);
    new Request.JSON({
      url: 'modulos/solicitudes/formularios/notificacion/actualizar/detalles/procesador.json.php',
      data: "datos=" + datos,
      requestOptions: {
        spinnerOptions: {
          message: 'Actualizando Causales...'
        }
      },
      onRequest: function() {
        $('div<?php echo($f->id); ?>').setStyle('opacity', 1).get('morph').start({'opacity': 0});
      },
      onComplete: function(djson) {
        var objeto = djson.objeto;
        var dhtml = djson.html;
//        new Element('div', {html: dhtml}).inject('divcausal<?php echo($f->id); ?>', 'top');
        $('div<?php echo($f->id); ?>').setStyle('opacity', 0).get('morph').start({'opacity': 1});

      }
    }).send();
  }
</script>