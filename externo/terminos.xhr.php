<?php 
$root = (!isset($root)) ? "../../../" : $root;
require_once($root . "librerias/Sesion.class.php");
require_once($root . "librerias/MySQL.class.php");
//\\//\\//\\//\\ Variables Generadas //\\//\\//\\//\\
$sesion =new Sesion();
$transaccion = @$_REQUEST['transaccion'];
$formulario['id'] = "f" . $transaccion;
$formulario['ventana'] = "v" . $transaccion;
$formulario['contenedor'] = "c" . $transaccion;
$formulario['interno'] = "i" . $transaccion;
?>



<style>
 #cTerminos{font-size: 14px; line-height: 12px; overflow: scroll; width: 60%; height: 390px; float: right; }
 #cTerminos h2{font-size: 20px; line-height: 18px;margin-top: 10px;}
 #cTerminos h3{font-size: 16px; line-height: 14px;margin-top: 10px;}
 #cTerminos p{font-size: 14px; line-height: 13px; margin-top: 10px;}
 #cControles{width: 60%;float: right;}
 #cControles p{font-size: 14px; line-height: 12px; margin:0px; padding:0px;}
 #cControles input{font-size: 16px;line-height: 14px;padding: 4px; width: 200px; }
 #<?php  echo($formulario['ventana']); ?>_title {font-size: 16px;}
 #<?php  echo($formulario['ventana']); ?>_contentWrapper {background: url(imagenes/fondos/fondo-terminos.jpg) no-repeat;overflow: auto; }
</style>
<div id="cTerminos">
 <h2>POLITICA DE PRIVACIDAD Y CONDICIONES GENERALES DE USO DE LOS SERVICIOS Y LA INFORMACIÓN
  CONTENIDA EN EL PORTAL WWW.AGUASDEBUGA.NET DE LA EMPRESA DE ACUEDUCTO Y ALCANTARILLADO
  AGUAS DE BUGA S.A. E.S.P.</h2>

 <h3>1. OBJETO</h3>
 <p>El objeto de las presentes Condiciones Generales es reglamentar: El ingreso y uso de los servicios y la información
  contenida en el portal WWW.AGUASDEBUGA.NET de la Empresa de Acueducto y Alcantarillado Aguas De Buga S.A. E.S.P.</p>

 <h3>2. CARACTERÍSTICAS DE LOS SERVICIOS</h3>
 <p><u><b>ACCESO Y UTILIZACIÓN DEL PORTAL DE SERVICIOS</b></u>: El acceso y uso por parte del USUARIO y/o SUSCRIPTOR a las aplicaciones
 e información de propiedad de AGUAS DE BUGA S.A. E.S.P. del Portal WWW.AGUASDEBUGA.NET le permitirá al USUARIO y/o
 SUSCRIPTOR consultar y conocer información específica y general sobre los servicios y contenidos que presta AGUAS DE
 BUGA S.A. E.S.P.</p>

<p><u><b>SUSCRIPCIÓN AL PORTAL DE SERVICIOS DE AGUAS DE BUGA S.A. E.S.P.</b></u> La suscripción a los servicios presentados al
USUARIO mediante el Portal WWW.AGUASDEBUGA.NET es de carácter voluntario. No tiene ningún costo para el
suscriptor al tratarse de un servicio que Aguas De Buga S.A. E.S.P. ofrece gratuitamente.</p>

<p>RESPONSABILIDAD DE LA INFORMACIÓN DEL USUARIO: En todo caso, será responsabilidad del USUARIO del servicio
 comunicar al Aguas De Buga S.A. E.S.P. cualquier cambio en los datos personales y/o de contacto registrados.
 La no recepción por parte del SUSCRIPTOR de una comunicación respecto a los servicios y contenidos, a los que se
 halla inscrito, por error en los datos personales y/o de contacto informados o por cualquier otro motivo, no implicará
 que estos dejen de proporcionarse ya que estos se adquieren al momento de realizarse la legalización de la matrícula
 y convertirse en suscriptor del servicio.</p>

<p><u><b>ACEPTACIÓN DEL CONTRATO DE USO DEL PORTAL</b></u>: Se entenderá que el SUSCRIPTOR presta su
consentimiento para ser dado de alta en los servicios que proporciona Aguas De Buga S.A. E.S.P, desde el momento en
que realiza la legalización de su matrícula en los términos formales y legales correspondientes. Desde ese momento,
el SUSCRIPTOR acepta y se adhiere de manera completa a cada una de las Condiciones Generales que se detallan en
el presente texto. </p>
</div>
<div id="cControles">
 <p align="center"><br><b>Al presionar Acepto confirmo haber leído los términos y condiciones de uso y estoy de acuerdo con lo descrito.</b></p>
 <p align="center"><input type="button" name="acepto" id="acepto" value="Acepto"></p>
</div>
<script type="text/javascript">
 if ($('acepto')) {
  $('acepto').addEvent('click', function(e) {
   MUI.closeWindow($('<?php  echo($formulario['ventana'] ); ?>'));
   MUI.AcercaDe();
  });
 }
</script>