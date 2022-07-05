<?php
  $id = $_GET['id'];
  $dire = dirname(dirname(dirname(dirname(__FILE__))));
  require_once($dire.'/controlador/ControladorMenus.php');
  $menu = new ControladorMenus();
  $menu->eliminarMenu($id);
  echo "<script language=Javascript> location.href=\"".index.".php\"; </script>";

?>
