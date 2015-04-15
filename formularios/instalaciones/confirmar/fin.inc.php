<?php 
$instalacion = $instalaciones->consultar(@$_REQUEST['instalacion'], "alcantarillado");

$instalaciones->actualizar($instalacion['instalacion'], 'realizado', $fechas->hoy(), "alcantarillado");
$instalaciones->actualizar($instalacion['instalacion'], 'orden', $_REQUEST['orden'], "alcantarillado");
$instalaciones->actualizar($instalacion['instalacion'], 'empleado', $_REQUEST['empleado'], "alcantarillado");
$instalaciones->actualizar($instalacion['instalacion'], 'asistente', $_REQUEST['asistente'], "alcantarillado");
$instalaciones->actualizar($instalacion['instalacion'], 'factura', $_REQUEST['factura'], "alcantarillado");
?>
<pre><?php  print_r($_REQUEST); ?></pre>
<script type="text/javascript">
 MUI.closeWindow($('<?php  echo($formulario->ventana ); ?>'));
 MUI.Alcantarillado_Instalaciones();
</script>