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
$cadenas = new Cadenas();
$categorias = new Categorias();
$componentes = new Componentes();
$suscriptores = new Suscriptores();
$servicios = new Servicios();

$solicitud = $solicitudes->consultar(@$_REQUEST['solicitud']);
$categoria = $categorias->consultar($solicitud['categoria']);
$causal = $causales->consultar($solicitud['servicio'], $solicitud['causal']);
$asunto = $asuntos->consultar($solicitud['asunto']);
/** Valores * */
$valores = $solicitud;
$valores['factura'] = (empty($valores['factura'])) ? "N" : $valores['factura'];
/** Campos * */
$f->oculto("modificar", "solicitud");
$f->campos['solicitud'] = $f->text("solicitud", $valores['solicitud'], "10", "required codigo", true);
$f->campos['dane'] = $f->text("dane", $valores['dane'], "10", "", true, true);
$f->campos['servicio'] = $servicios->combo("servicio" . $f->id, $valores['servicio'], false, "changeServicio" . $f->id . "();");
$f->campos['radicado'] = $f->text("radicado", $valores['radicado'], "20", "required", false);
$f->campos['radicacion'] = $f->calendario("radicacion".$f->id, $valores['radicacion'], "-1","1","",false);
$f->campos['categoria'] = $categorias->combo("categoria" . $f->id, $valores['categoria'], false, "changeCategoria" . $f->id . "();");
$f->campos['causal'] = $causales->combo("causal" . $f->id, $valores['causal'], $valores['servicio'], $valores['categoria'], "required", "changeCausal" . $f->id . "();");
$f->campos['asunto'] = $asuntos->combo("asunto" . $f->id, $valores['asunto'], $valores['servicio'], $valores['categoria'], $valores['causal']);
$f->campos['detalle'] = $f->textarea("detalle", $valores['detalle'], "h150 p10", "1000", "", false);
$f->campos['suscriptor'] = $f->text("suscriptor", $valores['suscriptor'], "10", "", false, false);
$f->campos['factura'] = $f->text("factura", $valores['factura'], "10", "", false);
$f->campos['respuesta'] = $f->text("respuesta", $valores['respuesta'], "1", "", false);
$f->campos['contestacion'] = $f->text("contestacion", $valores['contestacion'], "10", "", false);
$f->campos['radicada'] = $f->text("radicada", $valores['radicada'], "14", "", false);
$f->campos['notificado'] = $f->text("notificado", $valores['notificado'], "10", "", false);
$f->campos['notificacion'] = $f->text("notificacion", $valores['notificacion'], "1", "", false);
$f->campos['sspd'] = $f->text("sspd", $valores['sspd'], "10", "", false);
$f->campos['ejecucion'] = $f->text("ejecucion", $valores['ejecucion'], "10", "", false);
$f->campos['orden'] = $f->text("orden", $valores['orden'], "16", "", false);
$f->campos['fecha'] = $f->text("fecha", $valores['fecha'], "10", "", false);
$f->campos['documentos'] = $f->text("documentos", $valores['documentos'], "128", "", false);
$f->campos['identificacion'] = $f->text("identificacion", $valores['identificacion'], "128", "", false);
$f->campos['nombres'] = $f->text("nombres", $valores['nombres'], "128", "", false);
$f->campos['apellidos'] = $f->text("apellidos", $valores['apellidos'], "128", "", false);
$f->campos['sexo'] = $f->text("sexo", $valores['sexo'], "128", "", false);
$f->campos['nacimiento'] = $f->text("nacimiento", $valores['nacimiento'], "128", "", false);
$f->campos['telefono'] = $f->text("telefono", $valores['telefono'], "128", "", false);
$f->campos['movil'] = $f->text("movil", $valores['movil'], "128", "", false);
$f->campos['correo'] = $f->text("correo", $valores['correo'], "128", "", false);
$f->campos['pais'] = $f->text("pais", $valores['pais'], "128", "", false);
$f->campos['region'] = $f->text("region", $valores['region'], "128", "", false);
$f->campos['ciudad'] = $f->text("ciudad", $valores['ciudad'], "128", "", false);
$f->campos['sector'] = $f->text("sector", $valores['sector'], "128", "", false);
$f->campos['direccion'] = $f->text("direccion", $valores['direccion'], "128", "", false);
$f->campos['referencia'] = $f->text("referencia", $valores['referencia'], "128", "", false);
$f->campos['expiracion'] = $f->text("expiracion", $valores['expiracion'], "10", "", false);
$f->campos['instalacion'] = $f->text("instalacion", $valores['instalacion'], "128", "", false);
//$f->campos['instalacionsector'] = $f->text("instalacionsector", $valores['instalacionsector'], "3", "", false);
$f->campos['estrato'] = $f->text("estrato", $valores['estrato'], "2", "", false);
$f->campos['diametro'] = $f->text("diametro", $valores['diametro'], "3,2", "", false);
$f->campos['legalizado'] = $f->text("legalizado", $valores['legalizado'], "2", "", false);
$f->campos['matricula'] = $f->text("matricula", $valores['matricula'], "10", "", false);
$f->campos['tipoderespuesta'] = $f->text("tipoderespuesta", $valores['tipoderespuesta'], "2", "", false);
$f->campos['ordenservicio'] = $f->text("ordenservicio", $valores['ordenservicio'], "10", "", false);
$f->campos['ordencobro'] = $f->text("ordencobro", $valores['ordencobro'], "10", "", false);
$f->campos['creador'] = $f->text("creador", $valores['creador'], "10", "", false);
$f->campos['responsable'] = $f->text("responsable", $valores['responsable'], "10", "", false);
$f->campos['origen'] = $f->text("origen", $valores['origen'], "128", "", false);
$f->campos['equipo'] = $f->text("equipo", $valores['equipo'], "10", "", false);
$f->campos['cancelar'] = $f->button("cancelar" . $f->id, "button", "Cerrar");
$f->campos['actualizar'] = $f->button("actualizar" . $f->id, "submit", "Actualizar");
/** Celdas * */
$f->celdas["solicitud"] = $f->celda("Código Solicitud: [ <a href=\"#\" onClick=\"MUI.Solicitudes_Ayuda('codigosolicitud');\">?</a> ]", $f->campos['solicitud'], "", "w150");
$f->celdas["dane"] = $f->celda("Código Dane: [ <a href=\"#\" onClick=\"MUI.Solicitudes_Ayuda('codigodane');\">?</a> ]", $f->campos['dane'], "", "w100");
$f->celdas["servicio"] = $f->celda("Servicio Relacionado: [ <a href=\"#\" onClick=\"MUI.Solicitudes_Ayuda('servicio');\">?</a> ]", $f->campos['servicio']);
$f->celdas["radicado"] = $f->celda("Radicado Recibido: [ <a href=\"#\" onClick=\"MUI.Solicitudes_Ayuda('radicadorecibido');\">?</a> ]", $f->campos['radicado']);
$f->celdas["radicacion"] = $f->celda("Fecha de Radicación: [ <a href=\"#\" onClick=\"MUI.Solicitudes_Ayuda('fecharadicacion');\">?</a> ]", $f->campos['radicacion'], "", "w150");
$f->celdas["categoria"] = $f->celda("Categoría / Tipo de Trámite: [ <a href=\"#\" onClick=\"MUI.Solicitudes_Ayuda('categoriasolicitud');\">?</a> ]", $f->campos['categoria']);
$f->celdas["causal"] = $f->celda("Detalle de la Causal: [ <a href=\"#\" onClick=\"MUI.Solicitudes_Ayuda('causal');\">?</a> ]", $f->campos['causal']);
$f->celdas["asunto"] = $f->celda("Asunto:", "<div id=\"divasunto" . $f->id . "\">" . $f->campos['asunto'] . "</div>");
$f->celdas["detalle"] = $f->celda("Detalle:", $f->campos['detalle']);
$f->celdas["suscriptor"] = $f->celda("Número de Cuenta / Suscriptor: [ <a href=\"#\" onClick=\"MUI.Solicitudes_Ayuda('suscriptor');\">?</a> ]", $f->campos['suscriptor'], "", "w200");
$f->celdas["factura"] = $f->celda("Factura en Reclamación: [ <a href=\"#\" onClick=\"MUI.Solicitudes_Ayuda('factura');\">?</a> ]", $f->campos['factura'], "", "w200");
$f->celdas["respuesta"] = $f->celda("Respuesta:", $f->campos['respuesta']);
$f->celdas["contestacion"] = $f->celda("Contestacion:", $f->campos['contestacion']);
$f->celdas["radicada"] = $f->celda("Radicada:", $f->campos['radicada']);
$f->celdas["notificado"] = $f->celda("Notificado:", $f->campos['notificado']);
$f->celdas["notificacion"] = $f->celda("Notificacion:", $f->campos['notificacion']);
$f->celdas["sspd"] = $f->celda("Sspd:", $f->campos['sspd']);
$f->celdas["ejecucion"] = $f->celda("Ejecucion:", $f->campos['ejecucion']);
$f->celdas["orden"] = $f->celda("Orden:", $f->campos['orden']);
$f->celdas["fecha"] = $f->celda("Fecha:", $f->campos['fecha']);
$f->celdas["documentos"] = $f->celda("Documentos:", $f->campos['documentos']);
$f->celdas["identificacion"] = $f->celda("Identificacion:", $f->campos['identificacion']);
$f->celdas["nombres"] = $f->celda("Nombres:", $f->campos['nombres']);
$f->celdas["apellidos"] = $f->celda("Apellidos:", $f->campos['apellidos']);
$f->celdas["sexo"] = $f->celda("Sexo:", $f->campos['sexo']);
$f->celdas["nacimiento"] = $f->celda("Nacimiento:", $f->campos['nacimiento']);
$f->celdas["telefono"] = $f->celda("Telefono:", $f->campos['telefono']);
$f->celdas["movil"] = $f->celda("movil:", $f->campos['movil']);
$f->celdas["correo"] = $f->celda("Correo:", $f->campos['correo']);
$f->celdas["pais"] = $f->celda("Pais:", $f->campos['pais']);
$f->celdas["region"] = $f->celda("Region:", $f->campos['region']);
$f->celdas["ciudad"] = $f->celda("Ciudad:", $f->campos['ciudad']);
$f->celdas["sector"] = $f->celda("Sector:", $f->campos['sector']);
$f->celdas["direccion"] = $f->celda("Direccion:", $f->campos['direccion']);
$f->celdas["referencia"] = $f->celda("Referencia:", $f->campos['referencia']);
$f->celdas["expiracion"] = $f->celda("Expiracion:", $f->campos['expiracion']);
$f->celdas["instalacion"] = $f->celda("Instalacion:", $f->campos['instalacion']);
//$f->celdas["instalacionsector"] = $f->celda("Instalacionsector:", $f->campos['instalacionsector']);
$f->celdas["estrato"] = $f->celda("Estrato:", $f->campos['estrato']);
$f->celdas["diametro"] = $f->celda("Diametro:", $f->campos['diametro']);
$f->celdas["legalizado"] = $f->celda("Legalizado:", $f->campos['legalizado']);
$f->celdas["matricula"] = $f->celda("Matricula:", $f->campos['matricula']);
$f->celdas["tipoderespuesta"] = $f->celda("Tipoderespuesta:", $f->campos['tipoderespuesta']);
$f->celdas["ordenservicio"] = $f->celda("Ordenservicio:", $f->campos['ordenservicio']);
$f->celdas["ordencobro"] = $f->celda("Ordencobro:", $f->campos['ordencobro']);
$f->celdas["creador"] = $f->celda("Creador:", $f->campos['creador']);
$f->celdas["responsable"] = $f->celda("Responsable:", $f->campos['responsable']);
$f->celdas["origen"] = $f->celda("Origen:", $f->campos['origen']);
$f->celdas["equipo"] = $f->celda("Equipo:", $f->campos['equipo']);
/** Filas * */
$f->fila["solicitud1"] = $f->fila($f->celdas["solicitud"] . $f->celdas["dane"] . $f->celdas["radicado"] . $f->celdas["radicacion"]);
$f->fila["solicitud2"] = $f->fila($f->celdas["suscriptor"] . $f->celdas["factura"] . $f->celdas["servicio"]);
$f->fila["solicitud3"] = $f->fila($f->celdas["categoria"] . $f->celdas["causal"]);
$f->fila["solicitud4"] = $f->fila($f->celdas["asunto"]);
$f->fila["solicitud5"] = $f->fila($f->celdas["detalle"]);
/** Compilando * */
$f->filas("<div id=\"solicitud" . $transaccion . "\">");
$f->filas($f->titulo("Datos de la solicitud."));
$f->filas($f->fila['solicitud1']);
$f->filas($f->fila['solicitud2']);
$f->filas($f->fila['solicitud3']);
$f->filas($f->fila['solicitud4']);
$f->filas($f->fila['solicitud5']);
$f->filas("</div>");
$f->botones($f->campos['cancelar'], "inferior-derecha");
$f->botones($f->campos['actualizar'], "inferior-derecha");
/** JavaScripts * */
$f->JavaScript("MUI.titleWindow($('" . ($f->ventana) . "'), \"Modificar Solicitud \");");
$f->JavaScript("MUI.resizeWindow($('" . ($f->ventana) . "'), {width: 680, height: 420});");
$f->JavaScript("MUI.centerWindow($('" . $f->ventana . "'));");
$f->eClick("cancelar" . $f->id, "MUI.closeWindow($('" . $f->ventana . "'));");
?>
<script type="text/javascript">
  function changeServicio<?php echo($f->id); ?>() {
    changeCategoria<?php echo($f->id); ?>();
  }
  function changeCategoria<?php echo($f->id); ?>() {
    changeCausal<?php echo($f->id); ?>();
  }
  function changeCausal<?php echo($f->id); ?>() {
    /**
     * ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------
     * Cambio De Causal
     * ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------
     * Esta funcion gestiona el cambio del contenido del select causales generando una peticion ajax que modifica
     * esencial mente el contenido de un area que alberga el campo cusal, la solicitud lleva por paramentros
     * todos aquellos datos que permitan regerar el campo causal acorde con los valores existentes en tiempo real.
     * Generada la estructura html del elemento regenerado se produce una llamada la funcion que actualiza los
     * asuntos disponibles para la nueva causal, a manera de una actualizacion en cadena sincronizada, donde
     * actualizar la categoria, activa actualizar la causal, y actualizar la causal consecuentemente actualiza los
     * asuntos.
     * Nota 1: Se intenta enviar el elemento seleccionado en la lista causal pero si este esta vacio o nulo esto genera
     * un error, por lo tanto se debe evaluar el estado del elemento antes de tratar de tomar su valor.
     */
    var fid = "<?php echo($f->id); ?>";
    var servicio = new String();
    var categoria = new String();
    var causal = new String();
    if ($('causal' + fid).getElement(':selected')) {causal = $('causal' + fid).getElement(':selected').value;} else {console.error('No se pudo obtener el valor del elemento seleccionado en el combo causal.');}
    if ($('servicio' + fid).getElement(':selected')) {servicio= $('servicio' + fid).getElement(':selected').value;} else{console.error('No se pudo obtener el valor del elemento seleccionado en el combo servicio.');}
    if ($('categoria' + fid).getElement(':selected')) {categoria = $('categoria' + fid).getElement(':selected').value;} else{console.error('No se pudo obtener el valor del elemento seleccionado en el combo categoria.');}
    var clase = "required";
    var change = "changeCausal" + fid + "();";
    var parametros = {'fid': fid, 'servicio': servicio, 'categoria': categoria,'causal': causal, 'clase': clase, 'change': change};
    var datos = JSON.encode(parametros);
    new Request.JSON({
      url: 'modulos/solicitudes/consultas/jsons/causales.json.php',
      data: "datos=" + datos,
      requestOptions: {
        spinnerOptions: {
          message: 'Actualizando Causales...'
        }
      },
      onRequest: function() {
        $('divcausal<?php echo($f->id); ?>').empty();
      },
      onComplete: function(djson) {
        var objeto = djson.objeto;
        var dhtml = djson.html;
        new Element('div', {html: dhtml}).inject('divcausal<?php echo($f->id); ?>', 'top');
        changeAsunto<?php echo($f->id); ?>();
      }
    }).send();
  }
  
  
  
  
  function changeAsunto<?php echo($f->id); ?>() {   
/** 
     * ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------
     * Cambio De Asunto
     * ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------
     * Esta funcion gestiona el cambio del contenido del select asuntos generando una peticion ajax que modifica
     * esencial mente el contenido de un area que alberga el campo asuntos, la solicitud lleva por paramentros
     * todos aquellos datos que permitan regerar el campo asuntos acorde con los valores existentes en tiempo real.
     * Actualizar la causal consecuentemente actualiza los asuntos siendo esta una instancia final que no genera
     * acciones adicionales..
     * Nota 1: Se intenta enviar el elemento seleccionado en la lista asuntos pero si este esta vacio o nulo esto genera
     * un error, por lo tanto se debe evaluar el estado del elemento antes de tratar de tomar su valor.
     * Nota 2: Se intenta enviar el elemento seleccionado en la lista causal pero si este esta vacio o nulo esto genera
     * un error, por lo tanto se debe evaluar el estado del elemento antes de tratar de tomar su valor.
     */
    var fid = "<?php echo($f->id); ?>";
    var selected = "";
    var servicio = $('servicio' + fid).getElement(':selected').value;
    var categoria = $('categoria' + fid).getElement(':selected').value;
    var causal = "";
    if ($('causal' + fid).getElement(':selected')) {/** Nota 2**/
      causal = $('causal' + fid).getElement(':selected').value;
    }
    var clase = "required";
    var change ="";// "changeAsunto" + fid + "();"; Causaba error refrescando el asunto con solo cambiarlo y no dejaba seleccionar
    var parametros = {'fid': fid, 'selected': selected, 'servicio': servicio, 'categoria': categoria, 'causal': causal, 'clase': clase, 'change': change};

    var datos = JSON.encode(parametros);
    new Request.JSON({
      url: 'modulos/solicitudes/consultas/jsons/asuntos.json.php',
      data: "datos=" + datos,
      requestOptions: {
        spinnerOptions: {
          message: 'Actualizando Causales...'
        }
      },
      onRequest: function() {
        $('divasunto<?php echo($f->id); ?>').empty();
      },
      onComplete: function(djson) {
        var objeto = djson.objeto;
        var dhtml = djson.html;
        new Element('div', {html: dhtml}).inject('divasunto<?php echo($f->id); ?>', 'top');
      }
    }).send();

  }
</script>
