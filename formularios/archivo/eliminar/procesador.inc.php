<?php
/**
 * Este archivo recibe el nombre del archivo a eliminar y realiza la accion si valoraciones adiciones su
 * proceso implica dos acciones eliminar el registro de la base de datos y eliminar fisicamente el archivo
 * */
$archivos=new Solicitudes_Archivos();
$validaciones=new Validaciones();

$archivo=$archivos->consultar($validaciones->recibir("archivo"));
$archivos->eliminar($archivo['archivo']);
$f->JavaScript("MUI.closeWindow($('" . ($f->ventana) . "'));");
$f->JavaScript("MUI.Solicitudes_Solicitud_Consultar('".$archivo['solicitud']."');");
?>