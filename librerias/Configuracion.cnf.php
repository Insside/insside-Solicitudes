<?php

$root = (!isset($root)) ? "../../../" : $root;
require_once($root . "librerias/Configuracion.cnf.php");
if(!class_exists('Validaciones')){require_once($root."librerias/Validaciones.class.php");}
/** Clases del Modulo * */
require_once($root . "modulos/solicitudes/librerias/Asuntos.class.php");
require_once($root . "modulos/solicitudes/librerias/Categorias.class.php");
require_once($root . "modulos/solicitudes/librerias/Causales.class.php");
require_once($root . "modulos/solicitudes/librerias/Filtros.class.php");
require_once($root . "modulos/solicitudes/librerias/Servicios.class.php");
require_once($root . "modulos/solicitudes/librerias/Solicitud.class.php");
require_once($root . "modulos/solicitudes/librerias/Solicitudes.class.php");
require_once($root . "modulos/solicitudes/librerias/Respuestas.class.php");
require_once($root . "modulos/solicitudes/librerias/Notificaciones.class.php");
require_once($root . "modulos/solicitudes/librerias/Traslados.class.php");
require_once($root . "modulos/solicitudes/librerias/Archivos.class.php");
require_once($root . "modulos/solicitudes/librerias/Formatos.class.php");
/** Otros Modulos * */
require_once($root . "modulos/usuarios/librerias/Usuarios.class.php");
require_once($root . "modulos/usuarios/librerias/Usuarios_Equipos.class.php");
require_once($root . "modulos/suscriptores/librerias/Suscriptores.class.php");
require_once($root . "modulos/suscriptores/librerias/Legalizaciones.class.php");

?>