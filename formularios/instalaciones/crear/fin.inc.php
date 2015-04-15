<?php 
$suscriptor = @$_REQUEST['suscriptor'];
$instalaciones =new Instalaciones();
$instalacion = $instalaciones->crear($suscriptor);
$instalaciones->actualizar($instalacion, "fecha", @$_REQUEST['fecha']);
$instalaciones->actualizar($instalacion, "hora", @$_REQUEST['hora']);
$instalaciones->actualizar($instalacion, "realizado", @$_REQUEST['realizado']);
$instalaciones->actualizar($instalacion, "orden", @$_REQUEST['orden']);
$instalaciones->actualizar($instalacion, "medidor", @$_REQUEST['medidor']);
$instalaciones->actualizar($instalacion, "factura", @$_REQUEST['factura']);
$instalaciones->actualizar($instalacion, "tipo", @$_REQUEST['tipo']);
$instalaciones->actualizar($instalacion, "empleado", @$_REQUEST['empleado']);
$instalaciones->actualizar($instalacion, "asistente", @$_REQUEST['asistente']);
?>
<script type="text/javascript">
 MUI.closeWindow($('<?php  echo($formulario->ventana); ?>'));
</script>