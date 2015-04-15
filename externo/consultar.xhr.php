<?php 
$root = (!isset($root)) ? "../../../" : $root;
require_once($root . "modulos/solicitudes/librerias/Configuracion.cnf.php");
//\\//\\//\\//\\ Variables Generadas //\\//\\//\\//\\
$sesion =new Sesion();
$usuarios =new Usuarios();

$transaccion = @$_REQUEST['transaccion'];
$accion = @$_REQUEST['accion'];
$suscriptor = @$_REQUEST['suscriptor_consultado'];

$formulario['id'] = "f" . $transaccion;
$formulario['ventana'] = "v" . $transaccion;
$formulario['contenedor'] = "c" . $transaccion;
$formulario['interno'] = "i" . $transaccion;

if (!empty($suscriptor)) {
 $suscriptor = $suscriptores->consultar($suscriptor);
}




if (empty($accion)) {
 echo('<div id="' . $formulario['contenedor'] . '" class="formulario">');
 echo('<form name="' . $formulario['id'] . '" id="' . $formulario['id'] . '" action="modulos/solicitudes/externo/consultar.xhr.php?&transaccion=' . $transaccion . '" method="post">');
 echo('<div id="' . $formulario['interno'] . '">');
}
?>
<?php  if (empty($accion) || $accion == "cancelar") { ?>
 <input type="hidden" name="accion" id="accion" value="verificar">
 <div class="franja"></div>
 <div style="width: 100%; height: 230px;top:-5px;left:0px;display:block; position: relative; ">
  <table><tr><td>
     <div class="mensaje">
      <div id="i100x100_seguro" style="float: left;"></div>
      <p>
       Por favor proporcione el código del suscriptor para continuar, este dato es necesario para radicar o consultar el
       estado de sus solicitudes, y demás información administrada por este sistema. Consultado el código verifique si
       el nombre de suscriptor y/o dirección domiciliaria corresponden antes de realizar cualquier transacción.
      </p>
     </div>
    </td></tr>
   <tr><td align="center">
     <div class="contenido">
      <table align="center">
       <tr><td colspan="2"><b>Código Del Suscriptor</b>:</td></tr>
       <tr>
        <td><input type="text" name="suscriptor_consultado" id="suscriptor_consultado" class="required validate-numeric" data-validators="required validate-integer" title="Numero De Matricula..."></td>
        <td><input type="submit" value="" id="consultar_suscriptor" name="consultar_suscriptor"></td>
       </tr>
       </tbody></table>
     </div>
    </td></tr>
  </table>
 </div>
 <div class="franja"></div>
<?php  } else { ?>
 <input type="hidden" name="accion" id="accion" value="continuar">
 <div class="franja"></div>
 <div style="width: 100%; height: 230px;top:-5px;left:0px;display:block; position: relative; ">
  <table><tr><td>
     <div class="mensaje">
      <div id="i100x100_seguro" style="float: left;"></div>
      <p>
       Confirme si los datos visualizados corresponden al suscriptor o dirección del bien inmueble del que desea
       consultar o radicar su solicitud, una vez confirmados los datos presione continuar o cancelar para
       intentarlo nuevamente:<br><br><br><br>
      </p>
      <?php  if (!empty($suscriptor['suscriptor'])) { ?>
       <table width="100%">
        <tr><td align="center">       Suscriptor: <b><?php  echo($cadenas->capitalizar(@$suscriptor['nombres'] . " " . @$suscriptor['apellidos'])); ?></b><br>
          Dirección: <b><?php  echo($cadenas->capitalizar(@$suscriptor['direccion'])); ?></b></td></tr>
        <tr><td><br></td></tr>
        <tr><td align="center">
          <input type="submit" value="Cancelar" id="cancelar" name="cancelar" onclick="$('accion').value = 'cancelar';">
          <?php  $n = $solicitudes->conteo_suscriptor($suscriptor['suscriptor']); ?>
          <?php  if ($n > 0) { ?>
           <input type ="submit" value="Continuar" id="continuar" name="continuar">
          <?php  } else { ?>
           <input type ="submit" value="Continuar" id="sinsolicitudes" name="sinsolicitudes">
          <?php  } ?>
         </td></tr></table>
      <?php  } else { ?>
       <table width="100%">
        <tr><td align="center">
          <p>El código del suscriptor ingresado no corresponde con ninguno existente en la base de datos, por favor inténtelo nuevamente.</p>
         </td></tr>
        <tr><td><br></td></tr>
        <tr><td align="center">
          <input type="submit" value="Continuar" id="cancelar" name="cancelar" onclick="$('accion').value = 'cancelar';">
         </td></tr></table>
      <?php  } ?>

     </div>
    </td></tr>
  </table>
 </div>
 <div class="franja"></div>
 <script type="text/javascript">
           if ($('continuar')) {
            $('continuar').addEvent('click', function(e) {
             e.stop();
             $('central').setStyle('background', '');
             $('central').setStyle('background-repeat', 'no-repeat');
             MUI.closeWindow($('<?php  echo($formulario['ventana'] ); ?>'));
             MUI.PQRS_SE_Solicitudes('<?php  echo($suscriptor['suscriptor']); ?>');
            });
           }

           if ($('sinsolicitudes')) {
            $('sinsolicitudes').addEvent('click', function(e) {
             e.stop();
             $('central').setStyle('background', '');
             $('central').setStyle('background-repeat', 'no-repeat');
             MUI.closeWindow($('<?php  echo($formulario['ventana'] ); ?>'));
             MUI.SinSolicitudes();
            });
           }
 </script>
<?php  } ?>
<?php 
if (empty($accion)) {
 echo('</div>');
 echo('</form>');
 echo('</div>');
}
?>
<?php  if (empty($accion)) { ?>
 <script type="text/javascript">
  new OverText('suscriptor_consultado', {positionOptions: {offset: {x: 0, y: 50}}});
  var fv =new Form.Validator.Inline($('<?php  echo($formulario['id'] ); ?>'));
  new Form.Request($('<?php  echo($formulario['id'] ); ?>'), $('<?php  echo($formulario['interno'] ); ?>'), {
   requestOptions: {
    spinnerOptions: {
     message: 'Trasmitiendo datos...'
    }
   },
   onSend: function() {

   },
   onSuccess: function() {

    if ($('<?php  echo($formulario['interno'] ); ?>') && MUI.options.standardEffects == true) {
     $('<?php  echo($formulario['interno'] ); ?>').setStyle('opacity', 0).get('morph').start({'opacity': 1});
    }

   }
  });
 </script>
 <?php 
}?>