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
              <div class="row">
				<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-list-alt"></i> Menus</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.php?cargar=inicio">Home</a> / Ver menu</li>
					</ol>
				</div>
			</div>
      <div class="row">
          <div class="col-lg-12">
              <!--notification start-->
              <section class="panel">
                  <header class="panel-heading">
                    Ver Menu
                  </header>
                  <div class="panel-body">

                    <table class="table table-striped table-advance table-hover">
                        <thead>
                        <tr>
                            <td><strong>#</strong></td><td><?php echo $dataMen['id']; ?></td>
                        </tr><tr>
                            <td><strong>Nombre</strong></td><td><?php echo $dataMen['nombre_del_menu']; ?></td>
                        </tr><tr>
                            <td><strong>Descripción</strong></td><td><?php echo $dataMen['desc_del_menu']; ?></td>
                        </tr><tr>
                            <td><strong>Dependencia</strong></td><td><?php 
                            if($dataMen['dependencia_menu'] <> '') {
                                $nombre_dependencia = $menu->getNameDependencia($dataMen['dependencia_menu']);
                                $nombre_dependencia = $nombre_dependencia["nombre_del_menu"];
                            } else {
                                $nombre_dependencia = '';
							}		 
                            echo $nombre_dependencia ; 
                            ?></td>
                        </tr>
                      </thead>
                    </tr>
                    </table>

                    <a class="btn btn-primary" href="<?php echo URL_LINKS; ?>index.php" title="Bootstrap 3 themes generator"><span class="icon_ol"></span> Regresar</a>
                </div>
            </section>
            <!--notification end-->



        </div>

    </div>
</section>
</section>
<!--main content end-->
<?php require('./vistas/thema/foother.php'); ?>
