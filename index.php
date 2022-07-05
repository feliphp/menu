<?php
/**
 * Felipe Herrera 4 Jul 2022
 */
//error_reporting(0);
require_once('config/Enrutador.php');
$enrutador = new Enrutador();
if (!isset($_GET['cargar'])) {
    $_GET['cargar']= '';
}

if($enrutador->validarGet($_GET['cargar'])) {
	$enrutador->cargarVista($_GET['cargar']);
}
?>
