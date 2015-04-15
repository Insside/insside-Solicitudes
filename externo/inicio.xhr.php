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
 #divInicio{width: 100%; }
 #divInicio h2{color: #000000;font-size: 24px; line-height: 20px;margin-top: 10px;}
 #divInicio h3{font-size: 16px; line-height: 14px;margin-top: 10px;}
 #divInicio p{font-size: 16px; line-height: 16px; margin-bottom: 10px;}
 #divInicio ul{font-size: 16px; line-height: 16px; }
 #divInicio ol{font-size: 16px; line-height: 16px; }
 #divInicio input{font-size: 16px;line-height: 14px;padding: 4px; width: 200px; }
 #divInformacion{ padding: 20px; float: left; }
 #divPQRS{ padding: 20px; float: right; }
 #divInformacion p{font-size: 16px;line-height: 16px;color: #000000; font-weight: normal;}
</style>
<div id="divInicio">
 <table>
  <tr><td width="50%" valign="top">
    <div id="divInformacion">
     <h2>Bienvenid@</h2>
     <p>En Aguas De Buga S.A. E.S.P estamos con usted a sólo un clic. A través de nuestro portal de servicios, de manera
      ágil y oportuna podrá acceder información detallada de sus servicios, realizar una Petición, Queja o Reclamo o
      encontrar en nuestra Guía de preguntas frecuentes los pasos para realizar los diferentes tramites que se realizan ante
      nuestra E.S.P. Próximamente dispondremos de asesores de atención en línea del Chat de Servicio para orientarlo si
      necesita información de la empresa o reportar un daño operativo.</p>


     <h2> Peticiones, Quejas, Reclamos Y Recursos.</h2>
     <p>Todo suscriptor y/o usuario tiene derecho a presentar ante la Empresa peticiones, quejas, reclamos y recursos,
      tal como lo señala el Contrato de Condiciones Uniformes. Esta norma atiende a la especialidad de la materia y se
      soporta en los artículos 152 y 153 de la Ley 142 de 1994 que rezan:</p>
     <p><b><u>Artículo 152. Derecho De Petición Y De Recurso</u></b>. Es de la esencia del contrato de servicios públicos
      que el suscriptor o usuario pueda presentar a la empresa peticiones, quejas y recursos relativos al contrato de
      servicios públicos…</p>
     <p><b><u>Artículo 153. De La Oficina De Peticiones Y Recursos</u></b>. Todas las personas prestadoras de servicios
      públicos domiciliarios constituirán una "Oficina de Peticiones, Quejas y Recursos", la cual tiene la obligación de
      recibir, atender, tramitar y responder las peticiones o reclamos y recursos verbales o escritos que presenten los
      usuarios, los suscriptores o los suscriptores potenciales en relación con el servicio o los servicios que presta dicha
      empresa. Estas "Oficinas" llevarán una detallada relación de las peticiones y recursos presentados y del trámite
      y las respuestas que dieron. Las peticiones y recursos serán tramitados de conformidad con las normas vigentes
      sobre el derecho de petición”.  A su vez, estas normas especiales en materia de servicios públicos sobre peticiones,
      quejas, reclamos y recursos, atienden también a los criterios generales esbozados en el artículo 5º y siguientes
      del Código Contencioso Administrativo, y por supuesto, en lo reseñado por el artículo 23 de la Constitución
      Nacional que disponen:
     <ul>
      <li>“<b><u>Articulo 23</u></b>. Toda persona tiene derecho a presentar peticiones respetuosas a las autoridades
       por motivos de interés general o particular y a obtener pronta resolución. El legislador podrá reglamentar su
       ejercicio ante organizaciones privadas para garantizar los derechos fundamentales”.</li>
      <li>“<b><u>Articulo 50</u></b>. Peticiones Escritas Y Verbales. Toda persona podrá hacer peticiones respetuosas
       a las autoridades, verbalmente o por escrito, a través de cualquier medio.
       Las escritas deberán contener, por lo menos:
       <ol>
        <li>La designación de la autoridad a la que se dirigen.</li>
        <li>Los nombres y apellidos completos del solicitante y de su representante o apoderado, si es el caso, con indicación del documento de identidad y de la dirección.</li>
        <li>El objeto de la petición.</li>
        <li>Las razones en que se apoya.</li>
        <li> La relación de documentos que se acompañan.</li>
        <li> La firma del peticionario, cuando fuere el caso.</li>
       </ol>
       Si quien presenta una petición verbal afirma no saber o no poder escribir y pide constancia de haberla presentado,
       el empleado la expedirá en forma sucinta. Las autoridades podrán exigir, en forma general, que ciertas peticiones
       se presenten por escrito. Para algunos de estos casos podrán elaborar formularios para que los diligencien los
       interesados, en todo lo que les sea aplicable, y añadan las informaciones o aclaraciones pertinentes.
      </li>
     </ul>
     </p>












    </div>
   </td>
   <td width="50%" valign="top">

    <div id="divPQRS">
     <h2>Como usar el Sistema de Atención de Quejas y Reclamos - PQR</h2>
     <p>Aguas De Buga S.A. E.S.P ha puesto a disposición de la comunidad un sistema para radicar en línea peticiones,
      quejas y reclamos; después de radicada una solicitud, el usuario y/o suscriptor puede hacerle seguimiento
      (también en linea) hasta que reciba la correspondiente respuesta. </p>
     <h2>¿Cómo radicar una queja o reclamo?</h2>
     <p><b><u>Paso 1</u></b>: Para poder radicar una queja es necesario que cuente con una cuenta de correo electrónico
      o email en la que pueda recibir respuesta pero para su mayor comodidad el sistema almacena de forma
      permanente las solicitudes que se reciban. Previamente se le aconseja redactar un texto en el que describa
      claramente su caso, y luego diligencie el formulario correspondiente el cual aparece en la sección
      "Suscriptores/Radicar Solicitud" del Menú de Servicios en el sector izquierdo de esta pantalla, proporcione
      Nombre, Email, Teléfono de contacto fijo o movil y describa su caso; si lo requiere puede adjuntar múltiples
      archivos para complementar su queja o reclamo; el sistema le permite enviar archivos en Word, Zip, Excel, PDF o
      fotografías si lo llegase a requerir.</p>
     <p><b><u>Paso 2</u></b>: Después de diligenciar el formulario y haber confirmado cualquier dato que el mismo
      así le indique, podrá dar click en el botón "Enviar solicitud", seguidamente el sistema le confirma la radicación
      de su solicitud generando un número de radicación que resaltado en negrilla. El cual puede imprimir y conservarla
      como prueba de su petición queja o reclamación radicada.</p>



     <h2>¿Cómo consultar el estado de su queja o reclamo?</h2>
     <p>Tenga presente el número de radicación que le entregó el sistema cuando radicó su solicitud, Diríjase a la
      opción "Suscriptores/Consultas" del Menú de Servicios en el sector izquierdo de esta pantalla, tras proporcionar
      su número de suscriptor el sistema le proporcionara el listado de las solicitudes que usted ha radicado. Siendo
      posible acceder a cada solicitud individualmente y observar su contenido y estado.</p>




    </div>
   </td>
  </tr>
 </table>












</div>

















<script>
 $('central').setStyle('background', 'url(imagenes/fondos/pqrs-externo-inicio.jpg)');
 $('central').setStyle('background-repeat', 'no-repeat');
 $('central').setStyle('background-attachment', 'fixed');
 $('central').setStyle('background-position', 'center center');
</script>