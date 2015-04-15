<?php 
$campo['instalacion'] = $componentes->text('instalacion', time(), '10', 'required', false, false, "[ Requerido ]");
$campo['fecha'] = $componentes->text('fecha', $fechas->hoy(), '10', 'required', false, false, "[ Requerido ]");
$campo['hora'] = $componentes->text('hora', $fechas->ahora(), '8', 'required', false, false, "[ Requerido ]");
$campo['suscriptor'] = $componentes->text('suscriptor', '', '10', 'required', false, false, "[ Requerido ]");
$campo['realizado'] = $componentes->text('realizado', $fechas->hoy(), '10', 'required', false, false, "[ Requerido ]");
$campo['orden'] = $componentes->text('orden', '', '32', 'required', false, false, "[ Requerido ]");
$campo['medidor'] = $componentes->text('medidor', '', '32', 'required', false, false, "[ Requerido ]");
$campo['factura'] = $componentes->text('factura', '', '32', 'required', false, false, "[ Requerido ]");
$campo['tipo'] = $instalaciones->combo_tipo("tipo", "");
$campo['empleado'] = $empleados->combo('empleado', "");
$campo['asistente'] = $empleados->combo('asistente', '');
?>
<style>
 #divFormulario{ font-size: 20px; position: relative; border: 1px; border-color: #CCCCCC; width: 620px; }
 #divFormulario p{ font-size: 16px; line-height: 15px;}
 #divFormulario .grupo {display:table; width:619px; border:1px solid #cccccc; }
 #divFormulario .grupo h2{ font-size: 16px; padding-left: 16px;}
 #divFormulario .titular{ font-size: 14px; font-style: bold; width: 100%; height: 18px; background-color: #EEEEEE; text-align: center;}
 #divFormulario .row {display:table; width:100%;}
 #divFormulario .cell {background-color: #EEEEEE; border: 1px solid #F6F7F8;border-collapse: collapse;border-spacing: 0;display: table-cell;padding: 4px;vertical-align: top; }
 #divFormulario input[type='text']{border: 1px solid #CCCCCC;font-size: 16px;height: 20px !important;padding: 0; width: 100%; }
 #divFormulario input[type='button'],input[type='submit']{-moz-border-bottom-colors: none;-moz-border-left-colors: none;-moz-border-right-colors: none;-moz-border-top-colors: none;background: -moz-linear-gradient(center top , #FFFFFF, #E4E4E4) repeat scroll 0 0 #E4E4E4;border-color: #A6A6A6 #A6A6A6 #979797;border-image: none;border-radius: 3px 3px 3px 3px;border-style: solid;border-width: 1px;box-shadow: 0 1px 0 rgba(255, 255, 255, 0.5), 0 0 2px rgba(255, 255, 255, 0.15) inset, 0 1px 0 rgba(255, 255, 255, 0.15) inset;float: left;margin: 0 6px 5px 0;outline: 0 none;padding: 4px 6px;}
 #divFormulario select {border: 1px solid #CCCCCC;font-size: 16px;height: 22px;padding: 0;width: 100%;}
 #divFormulario .herramientas {float: left;}
 #divFormulario .enunciado {display: none;}
 #divFormulario .inicio{}
 #divFormulario .controles {-moz-border-bottom-colors: none;-moz-border-left-colors: none;-moz-border-right-colors: none;-moz-border-top-colors: none;background: -moz-linear-gradient(center top , #FFFFFF, #E4E4E4) repeat scroll 0 0 #E4E4E4;border-color: #A6A6A6 #A6A6A6 #979797;border-image: none;border-radius: 3px 3px 3px 3px;border-style: solid;border-width: 1px;box-shadow: 0 1px 0 rgba(255, 255, 255, 0.5), 0 0 2px rgba(255, 255, 255, 0.15) inset, 0 1px 0 rgba(255, 255, 255, 0.15) inset;float: left;margin: 0 6px 5px 0;}
 #divFormulario a.boton {border: 0 none;cursor: default;display: inline-block;float: left;height: 18px;outline: 0 none;padding: 4px 6px;}
 #divFormulario a.boton:hover,a.boton:focus,a.boton:active{opacity:.2;-moz-box-shadow:0 1px 6px rgba(0,0,0,.7) inset,0 1px 0 rgba(0,0,0,.2);-webkit-box-shadow:0 1px 6px rgba(0,0,0,.7) inset,0 1px 0 rgba(0,0,0,.2);box-shadow:0 1px 6px rgba(0,0,0,.7) inset,0 1px 0 rgba(0,0,0,.2)}
 #divFormulario .icono {background-repeat: no-repeat;cursor: inherit;display: inline-block;float: left;height: 16px;margin-top: 1px;width: 16px;}
 #divFormulario .etiqueta {color: #474747;cursor: default;display: none;float: left;line-height: 17px;margin-top: 1px;padding-left: 3px;text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);vertical-align: middle;}
 #divFormulario .final{}
 #divFormulario #botonAyuda .icono{background-image:url(http://127.0.0.1/agb/scripts/ckeditor/plugins/icons.png?t=D08E); background-position:0 0px;}
 #divFormulario #asunto {background-color: lightgreen;border-color: #008000;color: #008000;text-align: center;text-transform: capitalize;width: 100px;}
 .validation-passed {background-color: lightgreen !important;}
 .validation-failed {border-color: red;}
 .validation-advice {color: #FFFFFF;font-size: 11px;line-height: 11px;}
 .overTxtLabel {color: #CCCCCC;}
</style>
<input name="accion" id="accion" type="hidden" value="registrar" />
<div id="divFormulario">
 <!--
 <div class="grupo">
  <div class="titular"><h2>Datos Del Suscriptor</h2></div>
 </div>
 -->
 <div class="row">
  <div class="cell" style=""><div class="titular">Instalación: </div><?php  echo($campo['instalacion']); ?></div>
  <div class="cell" style=""><div class="titular">Fecha Recibida:</div><?php  echo($campo['fecha']); ?></div>
  <div class="cell" style=""><div class="titular">Hora: </div><?php  echo($campo['hora']); ?></div>
  <div class="cell" style=""><div class="titular">Fecha Realizado: </div><?php  echo($campo['realizado']); ?></div>
 </div>
 <div class="row">
  <div class="cell" style=""><div class="titular">Suscriptor: </div><?php  echo($campo['suscriptor']); ?></div>
  <div class="cell" style=""><div class="titular">Orden: </div><?php  echo($campo['orden']); ?></div>
  <div class="cell" style=""><div class="titular">Medidor: </div><?php  echo($campo['medidor']); ?></div>
  <div class="cell" style=""><div class="titular">Factura: </div><?php  echo($campo['factura']); ?></div>
 </div>

 <div class="row">
  <div class="cell" style=""><div class="titular">Tipo Instalación: </div><?php  echo($campo['tipo']); ?></div>
  <div class="cell" style=""><div class="titular">Empleado: </div><?php  echo($campo['empleado']); ?></div>
  <div class="cell" style=""><div class="titular">Asistente: </div><?php  echo($campo['asistente']); ?></div>
 </div>

 <table align="center">
  <tr><td align="center">
    <input name="cancelar"  id="cancelar" type="button" value="Cerrar"/>
    <?php  if (empty($instalacion['orden'])) { ?><input name="enviar"  id="enviar" type="submit" value="Confirmar"/><?php  } ?>
    <span class="herramientas" id="divHerramientas">
     <span class="enunciado" id="divEnunciado">Ayuda</span>
     <span class="inicio"></span>
     <span class="controles">
      <a class="boton" id="botonAyuda">
       <span class="icono">&nbsp;</span>
       <span class="etiqueta" id="divEtiqueta">Ayuda</span></a>
     </span>
     <span class="final"></span>
    </span>
   </td>
  </tr>
 </table>
</div>
<script type="text/javascript">
 MUI.resizeWindow($('<?php  echo($formulario->ventana); ?>'), {width: 640, height: 200});
 if ($('cancelar')) {
  $('cancelar').addEvent('click', function(e) {
   MUI.closeWindow($('<?php  echo($formulario->ventana ); ?>'));
  });
 }
</script>