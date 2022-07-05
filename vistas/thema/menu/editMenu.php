<?php require('./vistas/thema/header.php');
session_start();
$id = $_GET['id'];
$dir = dirname(dirname(dirname(dirname(__FILE__))));
require_once($dir.'/controlador/ControladorMenus.php');
$menu = new ControladorMenus();
$dataMen=$menu->verMenu($id);
?>

<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <form id="rendered-form" method="post" action="<?php echo URL_LINKS; ?>index.php?cargar=saveMenu" enctype="multipart/form-data">
          <div class="rendered-form">

            <div class="fb-text form-group field-nombre_del_menu">
              <label for="nombre_del_menu" class="fb-text-label">Nombre<span class="fb-required">*</span></label>
              <input type="text" placeholder="Nombre" value="<?php echo $dataMen['nombre_del_menu']; ?>" class="form-control" name="nombre_del_menu" maxlength="50" id="nombre_del_menu" title="Introduzca el Nombre del Menú" required="required" aria-required="true">
            </div>
            <div class="fb-textarea form-group field-desc_del_menu">
              <label for="desc_del_menu" class="fb-textarea-label">Descripción</label>
              <textarea type="textarea" placeholder="Descripción"  class="form-control" name="desc_del_menu" rows="5" id="desc_del_menu" title="Descripción"><?php echo $dataMen['desc_del_menu']; ?></textarea>
            </div>
            <div class="fb-file form-group field-dependencia_menu">
              <label for="dependencia_menu" class="fb-textarea-label">Dependencia</label>
              <?php $dir = dirname(dirname(dirname(dirname(__FILE__))));
                require_once($dir.'/controlador/ControladorMenus.php');
                $menu = new ControladorMenus();
                $num_total_registros = $menu->contarMenus();
                if($num_total_registros == 0 ) {?>
                  <input type="text" disabled value="<?php echo $dataMen['dependencia_menu']; ?>" placeholder="Dependencia" class="form-control" name="dependencia_menu" maxlength="50" id="dependencia_menu" title="Introduzca dependencia del menú" required="required" aria-required="true">
                <?php } else { 
                $menus = $menu->index();
                if(($dataMen['dependencia_menu'] != '')||($dataMen['dependencia_menu'] != '0')) {
                  if( $dataMen['dependencia_menu'] == 0 ){
                    $nombre_dependencia = 'Sin Dependencia';
                  } else {
                  $nombre_dependencia = $menu->getNameDependencia($dataMen['dependencia_menu']);
                  $nombre_dependencia = $nombre_dependencia["nombre_del_menu"];
                  if( $nombre_dependencia == null){
                    $nombre_dependencia = 'Sin Dependencia';
                  }
                }
                } else {
                  $nombre_dependencia = '';
                }
                ?>
                  <select name="dependencia_menu" id="dependencia_menu">
                  <option value="<?php echo $dataMen['dependencia_menu']; ?>"><?php echo $nombre_dependencia; ?></option>
                  <?php foreach($menus as $menu) { ?>
                    <option value="<?php echo $menu['id']; ?>"><?php echo $menu['nombre_del_menu']; ?></option>
                  <?php } ?>
                  <option value="0">Sin Dependencia</option>
                  </select>
                <?php } ?>
            </div>
            <div class="fb-text form-group field-id">
              <input type="hidden" value="<?php echo $dataMen['id']; ?>" class="form-control" name="id"  id="id">
            </div>
            <div class="fb-button form-group field-button-aceptar">
              <button type="submit" class="btn btn-primary" name="button-editar-aceptar" value="Guardar Menu" style="warning" id="button-aceptar">Guardar Menú</button>
            </div>
          </div>
        </form>

    </section>
</section>
<!--main content end-->
<?php require('./vistas/thema/foother.php'); ?>
