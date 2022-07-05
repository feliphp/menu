<?php
$nombre= $_POST['nombre_del_menu'];
$descripcion = $_POST['desc_del_menu'];
$dependencia_menu = $_POST['dependencia_menu'];

if (!isset($_POST['button-aceptar'])) {
    $_POST['button-aceptar']= null;
}

if (!isset($_POST['button-editar-aceptar'])) {
    $_POST['button-editar-aceptar']= null;
}

$buttonaceptar = $_POST['button-aceptar'];
$buttoneditar = $_POST['button-editar-aceptar'];

if($buttonaceptar != null){

                $dir = dirname(dirname(dirname(dirname(__FILE__))));
                require_once($dir.'/controlador/ControladorMenus.php');
                $menu = new ControladorMenus();
                $retMen=$menu->crearMenu($nombre,$descripcion,$dependencia_menu);
                if($retMen == 1){
                  echo "<script language=Javascript> location.href=\"".index.".php\"; </script>";
                  die();
                } else {
                  echo "Ocurrio un Error";
                }

} elseif ($buttoneditar != null) {

                $dir = dirname(dirname(dirname(dirname(__FILE__))));
                $id = $_POST['id'];
                require_once($dir.'/controlador/ControladorMenus.php');
                $menu = new ControladorMenus();
                $retMen = $menu->editarMenu($id,$nombre,$descripcion,$dependencia_menu);

                if($retMen == 1){
                    echo "<script language=Javascript> location.href=\"".index.".php\"; </script>";
                  die();
                } else {
                  echo "Ocurrio un Error al editar";
                }

}

?>
