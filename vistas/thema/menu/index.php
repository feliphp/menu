<?php 
/**
 * Felipe Herrera 4 Jul 2022
 */
require('./vistas/thema/header.php');
if (!isset($_GET['order'])) {
    $_GET['order']= '';
}
if (!isset($_GET['idm'])) {
    $_GET['idm']= '';
}
if (!isset($_GET['columorder'])) {
    $_GET['columorder']= '';
}
if (!isset($_GET['pagina'])) {
    $_GET['pagina']= '';
}
?>
<section id="main-content">
	<section class="wrapper">
		<div class="row">
		  <div class="col-lg-12">
			  <h3 class="page-header"><i class="fa fa-list-alt"></i> Menus</h3>
		  </div>
	  </div>
		<div class="row">
			<div class="col-lg-12">
				<section class="panel">
					<header class="panel-heading">
					  Tabla de Menus
					</header>
					<div class="panel-body">
					  <!-- ordenamiento-->
					  <?php $order = $_GET["order"];
					  $columorder = $_GET["columorder"];
					  if($columorder == ''){
						$columorder = 'id';
					  }
					  if (($order == '')||($order == 'ASC')){
						  $orderif = 'DESC';
					  } else {
						  $orderif = 'ASC';
					  }
					  if($order == ''){
						$order = 'ASC';
					  }
					   ?>
					   <!-- fin ordenamiento -->
					  <table class="table table-striped table-advance table-hover">
						<thead>
						  <tr>
							  <th><a href="<?php echo URL_LINKS; ?>index.php?cargar=menu&order=<?php echo $orderif; ?>&columorder=id">#</a></th>
							  <th><a href="<?php echo URL_LINKS; ?>index.php?cargar=menu&order=<?php echo $orderif; ?>&columorder=nombre">Nombre</a></th>
							  <th>Descripción</th>
							  <th>Dependencia de Menú</th>
							  <th>Acciones</th>
						  </tr>
						</thead>
					  <?php
					   $dir = dirname(dirname(dirname(dirname(__FILE__))));
					   require_once($dir.'/controlador/ControladorMenus.php');
					   $menus = new ControladorMenus();
						 $num_total_registros = $menus->contarMenus();

					   $TAMANO_PAGINA = TAMANO_PAGINADOR;
					   $pagina = $_GET["pagina"];
					   if (!$pagina) {
						 $inicio = 0;
						 $pagina = 1;
					   } else {
						 $inicio = ($pagina - 1) * $TAMANO_PAGINA;
					   }
					   //calculo el total de páginas
					   $total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);
					   $resultados = $menus->mostrarConPaginador($inicio,$TAMANO_PAGINA,$order,$columorder);

					   while ($row = mysqli_fetch_array($resultados)) :
					   ?>
						<tr>
							<td><?php echo $row['id']; ?></td>
							<td><?php echo $row['nombre_del_menu']; ?></td>
							<td><?php echo $row['desc_del_menu']; ?></td>
							<?php 
							if($row['dependencia_menu'] != '') {
                                if( $row['dependencia_menu'] != '0' ) {
								  $nombre_dependencia = $menus->getNameDependencia($row['dependencia_menu']);
                  				  $nombre_dependencia = $nombre_dependencia["nombre_del_menu"];
                                } else {
                                    $nombre_dependencia = '';
                                }
							} else {
								$nombre_dependencia = '';
							}		  
								  ?>
							<td><?php echo $nombre_dependencia; ?></td>

							<td><div class="btn-group">
								<a class="btn btn-primary" href="<?php echo URL_LINKS; ?>index.php?cargar=editMenu&id=<?php echo $row['id']; ?>"><i class="fa fa-pencil"></i></a>
								<a class="btn btn-success" href="<?php echo URL_LINKS; ?>index.php?cargar=verMenu&id=<?php echo $row['id']; ?>"><i class="fa fa-file-text"></i></a>
								<a class="btn btn-danger" href="<?php echo URL_LINKS; ?>index.php?cargar=deleteMenu&id=<?php echo $row['id']; ?>" onclick="if(confirm('Esta seguro que desea eliminar este registro?') == false){return false;}"><i class="fa fa-eraser"></i></a>
							</div></td>
						</tr>
					  <?php endwhile; ?>
						</table>
			<!--pagination -->
				  <section class="panel">
					<div class="panel-body">
						<div>
						  <ul class="pagination pagination-lg">
					  <?php
						  if ($total_paginas > 1) {
						   if ($pagina != 1)
							  echo '<a href="'.URL_LINKS.'index.php?cargar=menu&pagina='.($pagina-1).'">«</a> &nbsp; ';
							  for ($i=1;$i<=$total_paginas;$i++) {
								 if ($pagina == $i)
									echo '<a href="" onclick="return false;">'.$pagina.'</a> &nbsp;| ';
								 else
									echo '<a href="'.URL_LINKS.'index.php?cargar=menu&pagina='.$i.'">'.$i.'</a> &nbsp;| ';
							  }
							  if ($pagina != $total_paginas)
								 echo '<a href="'.URL_LINKS.'index.php?cargar=menu&pagina='.($pagina+1).'">»</a> &nbsp;';
						  }
					  ?>
					</ul>
					</div>
				  </div>
			  </section>
			  <!--pagination end-->

						<a class="btn btn-primary" href="<?php echo URL_LINKS; ?>index.php?cargar=addMenu" title="Bootstrap 3 themes generator"><span class="icon_ol"></span> Agregar Menú</a>
					</div>
				</section>

			</div>

		</div>
		MENU
		<?php
		//elementos principales
		$principales = $menus->getMenuPrincipal();
		echo '<nav>';
		echo '<ul>';
		foreach ($principales as $item_principal) {
			echo '<li><a href="?idm='.$item_principal["id"].'">'.$item_principal["nombre_del_menu"].'</a></li>';
			$num_secundarios = $menus->getMenuSecundarios($item_principal["id"]);
			if( $num_secundarios == 0 ) {
				
			} else {
				echo '<ul>';
				$secundarios = $menus->getMenuSecundariosStr($item_principal["id"]);
				foreach ($secundarios as $secundario) {
					echo '<li><a href="?idm='.$secundario["id"].'">'.$secundario["nombre_del_menu"].'</a></li>';
				}
				echo '</ul>';
			}
		}
		echo '</ul>';
		echo '</nav>';
		?>
		<br>
		<?php 
		if ($_GET['idm'] != '') { 
		echo 'DESCRIPCION<br>';
		$desc = $menus->getMenuDescription($_GET['idm']);
		echo $desc["desc_del_menu"];
		 } else {
			echo 'Selecciona un Menù';
		} ?>
	</section>
</section>



<?php require('./vistas/thema/foother.php'); ?>
