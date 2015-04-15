<?php 
$suscriptor = $suscriptores->consultar($instalacion['suscriptor']);
$campo['suscriptor'] = '<div id="suscriptor">' . @$suscriptor['suscriptor'] . '</div>';
$campo['creado'] = '<div id="creado">' . @$suscriptor['creado'] . '</div>';
$campo['identificacion'] = '<div id="identificacion">' . @$suscriptor['documentos'] . " " . @$suscriptor['identificacion'] . '</div>';
$campo['nacimiento'] = '<div id="nacimiento">' . @$suscriptor['nacimiento'] . '</div>';
$campo['nombre'] = '<div id="nacimiento">' . $cadenas->capitalizar(@$suscriptor['nombres'] . " " . @$suscriptor['apellidos']) . '</div>';
$campo['sexo'] = '<div id="nacimiento">' . @$suscriptor['sexo'] . '</div>';
$campo['telefonos'] = '<div id="telefono">' . @$suscriptor['telefonos'] . '</div>';
$campo['movil'] = '<div id="movil">' . @$suscriptor['movil'] . '</div>';
$campo['correo'] = '<div id="correo">' . @$suscriptor['correo'] . '</div>';
$campo['pais'] = '<div id="pais">' . @$suscriptor['pais'] . '</div>';
$campo['region'] = '<div id="region">' . @$suscriptor['region'] . '</div>';
$campo['ciudad'] = '<div id="ciudad">' . @$suscriptor['ciudad'] . '</div>';
$campo['sector'] = '<div id="sector">' . @$suscriptor['sector'] . '</div>';
$campo['direccion'] = '<div id="direccion">' . @$suscriptor['direccion'] . '</div>';
$campo['referencia'] = '<div id="referencia">' . @$suscriptor['referencia'] . '</div>';
$campo['acueducto'] = '<div id="referencia">' . @$suscriptor['acueducto'] . '</div>';
$campo['alcantarillado'] = '<div id="referencia">' . @$suscriptor['alcantarillado'] . '</div>';
$campo['conexion'] = '<div id="conexion">' . $cadenas->capitalizar(@$suscriptor['conexion']) . '</div>';
$campo['diametro'] = '<div id="diametro">' . @$suscriptor['diametro'] . ' Pulgadas </div>';
?>
<style>
 #divSolicitud{ font-size: 20px; position: relative; border: 1px; border-color: #CCCCCC; width: 620px; }
 #divSolicitud p{ font-size: 16px; line-height: 15px;}
 #divSolicitud .grupo {display:table; width:619px; border:1px solid #cccccc; }
 #divSolicitud .grupo h2{ font-size: 16px; padding-left: 16px;}
 #divSolicitud .titular{ font-size: 14px; font-style: bold; width: 100%; height: 18px; background-color: #EEEEEE; text-align: center;}
 #divSolicitud .row {display:table; width:100%; border-left:1px solid #cccccc; border-bottom:1px solid #cccccc; }
 #divSolicitud .cell {display:table-cell;vertical-align:top; border-right:1px solid #cccccc; padding:2px;font-size: 18;border-collapse: separate; text-align: center; }
 #divSolicitud input[type='button'],input[type='submit']{-moz-border-bottom-colors: none;-moz-border-left-colors: none;-moz-border-right-colors: none;-moz-border-top-colors: none;background: -moz-linear-gradient(center top , #FFFFFF, #E4E4E4) repeat scroll 0 0 #E4E4E4;border-color: #A6A6A6 #A6A6A6 #979797;border-image: none;border-radius: 3px 3px 3px 3px;border-style: solid;border-width: 1px;box-shadow: 0 1px 0 rgba(255, 255, 255, 0.5), 0 0 2px rgba(255, 255, 255, 0.15) inset, 0 1px 0 rgba(255, 255, 255, 0.15) inset;float: left;margin: 0 6px 5px 0;outline: 0 none;padding: 4px 6px;}
 #divHerramientas .herramientas {float: left;}
 #divHerramientas .enunciado {display: none;}
 #divHerramientas .inicio{}
 #divHerramientas .controles {-moz-border-bottom-colors: none;-moz-border-left-colors: none;-moz-border-right-colors: none;-moz-border-top-colors: none;background: -moz-linear-gradient(center top , #FFFFFF, #E4E4E4) repeat scroll 0 0 #E4E4E4;border-color: #A6A6A6 #A6A6A6 #979797;border-image: none;border-radius: 3px 3px 3px 3px;border-style: solid;border-width: 1px;box-shadow: 0 1px 0 rgba(255, 255, 255, 0.5), 0 0 2px rgba(255, 255, 255, 0.15) inset, 0 1px 0 rgba(255, 255, 255, 0.15) inset;float: left;margin: 0 6px 5px 0;}
 #divHerramientas a.boton {border: 0 none;cursor: default;display: inline-block;float: left;height: 18px;outline: 0 none;padding: 4px 6px;}
 #divHerramientas a.boton:hover,a.boton:focus,a.boton:active{opacity:.2;-moz-box-shadow:0 1px 6px rgba(0,0,0,.7) inset,0 1px 0 rgba(0,0,0,.2);-webkit-box-shadow:0 1px 6px rgba(0,0,0,.7) inset,0 1px 0 rgba(0,0,0,.2);box-shadow:0 1px 6px rgba(0,0,0,.7) inset,0 1px 0 rgba(0,0,0,.2)}
 #divHerramientas .icono {background-repeat: no-repeat;cursor: inherit;display: inline-block;float: left;height: 16px;margin-top: 1px;width: 16px;}
 #divHerramientas .etiqueta {color: #474747;cursor: default;display: none;float: left;line-height: 17px;margin-top: 1px;padding-left: 3px;text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);vertical-align: middle;}
 #divHerramientas .final{}
 #divHerramientas #botonAyuda .icono{background-image:url(http://127.0.0.1/agb/scripts/ckeditor/plugins/icons.png?t=D08E); background-position:0 0px;}
</style>
<input name="accion" id="accion" type="hidden" value="confirmar" />
<div id="divSolicitud">
 <div class="grupo">
  <div class="titular"><h2>Datos Del Suscriptor</h2></div>
 </div>
 <div class="row">
  <div class="cell" style=""><div class="titular">Matricula / Suscriptor: </div><?php  echo($campo['suscriptor']); ?></div>
  <div class="cell" style=""><div class="titular">Fecha Radicación:</div><?php  echo($campo['creado']); ?></div>
  <div class="cell" style=""><div class="titular">Identificación: </div><?php  echo($campo['identificacion']); ?></div>
 </div>
 <div class="row">
  <div class="cell" style=""><div class="titular">Nombre Completo (Solicitante): </div><?php  echo($campo['nombre']); ?></div>
  <div class="cell" style=""><div class="titular">Fecha Nacimiento: </div><?php  echo($campo['nacimiento']); ?></div>
  <div class="cell" style=""><div class="titular">Sexo: </div><?php  echo($campo['sexo']); ?></div>
 </div>
 <div class="row">
  <div class="cell" style=""><div class="titular">Telefonos: </div><?php  echo($campo['telefonos']); ?></div>
  <div class="cell" style=""><div class="titular">Correo electrónico: </div><?php  echo($campo['correo']); ?></div>
 </div>
 <div class="row">
  <div class="cell" style=""><div class="titular">Pais: </div><?php  echo($campo['pais']); ?></div>
  <div class="cell" style=""><div class="titular">Región: </div><?php  echo($campo['region']); ?></div>
  <div class="cell" style=""><div class="titular">Ciudad: </div><?php  echo($campo['ciudad']); ?></div>
  <div class="cell" style=""><div class="titular">Sector / Barrio: </div><?php  echo($campo['sector']); ?></div>
 </div>
 <div class="row">
  <div class="cell" style=""><div class="titular">Dirección: </div><?php  echo($campo['direccion']); ?></div>
  <div class="cell" style=""><div class="titular">Referencia: </div><?php  echo($campo['referencia']); ?></div>
 </div>
 <br>
 <div class="grupo">
  <div class="titular"><h2>Servicios Por Instalar</h2></div>
 </div>
 <div class="row">
  <div class="cell" style=""><div class="titular">Acueducto: </div><?php  echo($campo['acueducto']); ?></div>
  <div class="cell" style=""><div class="titular">Alcantarillado: </div><?php  echo($campo['alcantarillado']); ?></div>
  <div class="cell" style=""><div class="titular">Tipo Instalación: </div><?php  echo($campo['conexion']); ?></div>
  <div class="cell" style=""><div class="titular">Diámetro: </div><?php  echo($campo['diametro']); ?></div>
  <div class="cell" style=""><div class="titular">Orden Servicio ( Instalación ): </div><?php  echo($instalacion['orden']); ?></div>
 </div>
 <br>
 <table align="center">
  <tr><td align="center">
    <input name="cancelar"  id="cancelar" type="button" value="Cerrar"/>
    <?php  if (empty($instalacion['orden'])) { ?>
     <input name="enviar"  id="enviar" type="submit" value="Confirmar"/>
    <?php  } ?>
    <span class="herramientas" id="divHerramientas">
     <span class="enunciado" id="divEnunciado">about</span>
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
 if ($('cancelar')) {
  $('cancelar').addEvent('click', function(e) {
   MUI.closeWindow($('<?php  echo($formulario->ventana ); ?>'));
  });
 }
</script>