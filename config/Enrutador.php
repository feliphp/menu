<?php
/**
 * Felipe Herrera 4 Jul 2022
 * Clase para manejar el enrutado
 */
class Enrutador{

	public function __Construct(){
				include_once('config/Configuraciones.php');
				include_once('config/Ayudante.php');
	}

	public function cargarVista($vista){
		include_once('config/Configuraciones.php');
		switch($vista){
			case "inicio":
				include_once('vistas/thema/'.$vista.'/'.$vista.'.php');
				break;
			case "menu":
				include_once('vistas/thema/'.$vista.'/index.php');
				break;
			case "addMenu":
				include_once('vistas/thema/menu/'.$vista.'.php');
				break;
			case "editMenu":
				include_once('vistas/thema/menu/'.$vista.'.php');
				break;
			case "deleteMenu":
				include_once('vistas/thema/menu/'.$vista.'.php');
				break;
			case "saveMenu":
				include_once('vistas/thema/menu/'.$vista.'.php');
				break;
			case "verMenu":
				include_once('vistas/thema/menu/'.$vista.'.php');
				break;
			default:
				include_once('vistas/error.php');
		}
	}

	public function validarGet($variable){
		include_once('config/Configuraciones.php');
		if(empty($variable)){
			include_once('vistas/thema/inicio/inicio.php');
		} else {
			return true;
		}
	}
}
