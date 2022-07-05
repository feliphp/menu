<?php
include_once('modelo/Menu.php');
class ControladorMenus {

  private $menu;

  public function __construct(){
    $this->menu = new Menu();
  }

  public function index(){
       return $this->menu->listarMenus();
  }

  public function mostrarConPaginador($inicio,$TAMANO_PAGINA,$order,$columorder){
    $this->menu->set('order',$order);
    $this->menu->set('columorder',$columorder);
    $this->menu->set('inicio',$inicio);
    $this->menu->set('tamano_paginador',$TAMANO_PAGINA);

      return $this->menu->mostrarConPaginador();
  }

  public function contarMenus(){
       return $this->menu->contarRegistrosMenus();
  }

  public function contarDependencias(){
    return $this->menu->contarDependenciasMenus();
  }

  public function getNameDependencia($idDependencia){
    $this->menu->set('dependencia_menu',intval($idDependencia));

    return $this->menu->getNameDependenciaStr();
  }

  public function getMenuSecundarios($idMenu){
    $this->menu->set('dependencia_menu',intval($idMenu));

    return $this->menu->contarMenuSecundario();
  }

  public function getMenuDescription($idm){
    $this->menu->set('id',intval($idm));

    return $this->menu->getMenuDesc();
  }

  public function getMenuSecundariosStr($idDependencia){
    $this->menu->set('dependencia_menu',intval($idDependencia));

    return $this->menu->getMenusSecundarios();
  }

  public function getMenuPrincipal(){
    return $this->menu->getMenuPrincipal();
  }

  public function crearMenu($nombre_del_menu,$desc_del_menu,$dependencia_menu){
      $this->menu->set('nombre_del_menu',$nombre_del_menu);
      $this->menu->set('desc_del_menu',$desc_del_menu);
      $this->menu->set('dependencia_menu',$dependencia_menu);

      return $this->menu->crearMenu();
  }

  public function eliminarMenu($id){
    $this->menu->set('id',$id);
    $this->menu->eliminarMenu();
  }


  public function verMenu($id){
    $this->menu->set('id',$id);
    return $this->menu->verMenu();
  }

  public function editarMenu($id,$nombre_del_menu,$desc_del_menu,$dependencia_menu){
    $this->menu->set('id',$id);
    $this->menu->set('nombre_del_menu',$nombre_del_menu);
    $this->menu->set('desc_del_menu',$desc_del_menu);
    $this->menu->set('dependencia_menu',$dependencia_menu);

    return $this->menu->editaMenu();

  }


}
?>
