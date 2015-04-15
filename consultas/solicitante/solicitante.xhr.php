<?php
$root = (!isset($root)) ? "../../../../" : $root;
require_once($root . "modulos/solicitudes/librerias/Configuracion.cnf.php");

$sesion = new Sesion();
$transaccion = @$_REQUEST['transaccion'];
$accion = @$_REQUEST['accion'];
$trasmision = @$_REQUEST['trasmision'];
$f = new Formularios($transaccion);
echo($f->apertura());
require_once($root . "modulos/solicitudes/consultas/solicitante/solicitante.inc.php");
echo($f->generar());
echo($f->controles());
echo($f->cierre());
?>
<script type="text/javascript">

  if ($('modificar' + fid)) {
    $('modificar' + fid).addEvent('click', function(e) {
      var fid = "<?php echo($f->id); ?>";
      var divcarga = "<?php echo($divcarga); ?>";
      var solicitud = "<?php echo($solicitud['solicitud']); ?>";
      var transaccion = "<?php echo($transaccion); ?>";
      new Request.HTML({
        url: 'modulos/solicitudes/formularios/solicitud/actualizar/solicitante.xhr.php',
        evalScripts: true,
        onRequest: function() {
        },
        onComplete: function(response) {
          $(divcarga).empty().adopt(response);
          $('actualizar' + fid).setStyle('display', '');
          $('modificar' + fid).setStyle('display', 'none');
          $('responder' + fid).setStyle('display', 'none');
        }
      }).send("solicitud=" + solicitud + "&transaccion=" + transaccion);
    });
  }

  if ($('cancelar<?php echo($f->id); ?>')) {
    $('cancelar<?php echo($f->id); ?>').addEvent('click', function(e) {
      MUI.closeWindow($('<?php echo($f->ventana); ?>'));
    });
  }

  if ($('actualizar' + fid)) {
    $('actualizar' + fid).addEvent('click', function(e) {
      var trasmision = "<?php echo(time()); ?>";
      var transaccion = "<?php echo($transaccion); ?>";
      var fid = "<?php echo($f->id); ?>";
      var divcarga = "<?php echo($divcarga); ?>";
      var solicitud = "<?php echo($solicitud['solicitud']); ?>";
      var identificacion = $("identificacion").value;
      var nombres = $("nombres").value;
      var apellidos = $("apellidos").value;
      var sexo = $('sexo').getElement(':selected').value;
      var nacimiento = $("nacimiento").value;
      var telefono = $("telefono").value;
      var movil = $("movil").value;
      var correo = $("correo").value;
      var direccion = $("direccion").value;
      var referencia = $("referencia").value;
      var sector = $('sector').getElement(':selected').value;
      var factura = $("factura").value;
      var envio = new Request.HTML({
        url: 'modulos/solicitudes/formularios/solicitud/actualizar/solicitante.xhr.php',
        evalScripts: true,
        onRequest: function() {
        },
        onComplete: function(response) {
          $(divcarga).empty().adopt(response);
          $('actualizar' + fid).setStyle('display', 'none');
          $('modificar' + fid).setStyle('display', '');
          $('responder' + fid).setStyle('display', '');
        }
      }).send("solicitud=" + solicitud +
              "&transaccion=" + transaccion +
              "&trasmision=" + trasmision +
              "&identificacion=" + identificacion +
              "&nombres=" + nombres +
              "&apellidos=" + apellidos +
              "&sexo=" + sexo +
              "&nacimiento=" + nacimiento +
              "&telefono=" + telefono +
              "&movil=" + movil +
              "&correo=" + correo +
              "&direccion=" + direccion +
              "&referencia=" + referencia +
              "&sector=" + sector +
              "&factura=" + factura
              );
    });
  }
</script>