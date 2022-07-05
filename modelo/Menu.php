<?php
include_once('Conexion.php');
class Menu{
  private $id;
  private $nombre_del_menu;
  private $desc_del_menu;
  private $dependencia_menu;

  private $conn;

  public function __construct(){
    $this->conn = new Conexion();
  }

  public function set($atributo, $contenido){
    $this->$atributo = $contenido;
  }

  public function get($atributo){
    return $this->$atributo;
  }

  public function contarRegistrosMenu(){
    $sql = "SELECT * FROM menu_table";
    $arrayRes =  $this->conn->consultaRetorno($sql);
    return mysqli_num_rows($arrayRes);
  }

  public function listarMenus(){
    $sql = "SELECT * FROM menu_table";
    return $this->conn->consultaRetorno($sql);
  }

  public function getMenuPrincipal(){
    $sql = "SELECT id,nombre_del_menu FROM menu_table WHERE `dependencia_menu` is null OR `dependencia_menu` = '0'";
    return $this->conn->consultaRetorno($sql);
  }

  public function getMenusSecundarios(){
    $sql = "SELECT id,nombre_del_menu FROM menu_table WHERE dependencia_menu = '{$this->dependencia_menu}' ";
    return $this->conn->consultaRetorno($sql);
  }

  public function verMenu(){
      $sql = "SELECT * FROM menu_table WHERE id = {$this->id} LIMIT 1";
      $ret = $this->conn->consultaRetorno($sql);
      $row = mysqli_fetch_assoc($ret);

      $this->id = $row['id'];
      $this->nombre_del_menu = $row['nombre_del_menu'];
      $this->desc_del_menu = $row['desc_del_menu'];
      $this->dependencia_menu = $row['dependencia_menu'];


      return $row;
  }
  public function contarRegistrosMenus(){
    $sql = "SELECT * FROM menu_table";
    $arrayRes =  $this->conn->consultaRetorno($sql);
    return mysqli_num_rows($arrayRes);
  }

  public function contarDependenciasMenus(){
    $sql = "SELECT * FROM menu_table WHERE dependencia_menu <> '' ";
    $arrayRes =  $this->conn->consultaRetorno($sql);
    return mysqli_num_rows($arrayRes);
  }

  public function contarMenuSecundario(){
    $sql = "SELECT * FROM menu_table WHERE dependencia_menu = '{$this->dependencia_menu}' ";
    $arrayRes =  $this->conn->consultaRetorno($sql);
    return mysqli_num_rows($arrayRes);
  }


  public function mostrarConPaginador(){
    $sql = "SELECT * FROM menu_table ORDER BY {$this->columorder} {$this->order} LIMIT {$this->inicio}, {$this->tamano_paginador}";
    return $this->conn->consultaRetorno($sql);
  }

  public function crearMenu(){

      $consulta = "INSERT INTO menu_table(nombre_del_menu, desc_del_menu, dependencia_menu) VALUES('{$this->nombre_del_menu}', '{$this->desc_del_menu}', '{$this->dependencia_menu}')";
      $this->conn->consultaSimple($consulta);
      return true;
    
  }
  public function editaMenu(){
    $consulta = "UPDATE menu_table SET nombre_del_menu = '{$this->nombre_del_menu}',desc_del_menu = '{$this->desc_del_menu}',dependencia_menu = '{$this->dependencia_menu}' WHERE id = {$this->id}";
    $this->conn->consultaSimple($consulta);
    return true;
  }

  public function eliminarMenu(){
    $sql = "DELETE FROM menu_table WHERE id = '{$this->id}'";
    $this->conn->consultaSimple($sql);
  }

  public function getNameDependenciaStr(){
    $sql = "SELECT nombre_del_menu FROM menu_table WHERE id = '{$this->dependencia_menu}'";
    $arrayRes =  $this->conn->consultaRetorno($sql);
    return $arrayRes->fetch_assoc();
  }

  public function getMenuDesc(){
    $sql = "SELECT desc_del_menu FROM menu_table WHERE id = '{$this->id}'";
    $arrayRes =  $this->conn->consultaRetorno($sql);
    return $arrayRes->fetch_assoc();
  }
}
?>