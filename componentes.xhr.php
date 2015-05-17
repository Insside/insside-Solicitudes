<?php
$root = (!isset($root)) ? "../../" : $root;
require_once($root . "modulos/comercial/librerias/Configuracion.cnf.php");
Sesion::init();
$usuario=Sesion::usuario();

$menus = new Aplicacion_Menus();
echo($menus->menu("3000000",$usuario['usuario']));

?>