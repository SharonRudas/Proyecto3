<?php
	
	session_start();
	require 'conexion.php';
	require 'funcs.php';
	
	if(!isset($_SESSION['id'])){
		header("Location: index.php");
	}
	$nombre = $_SESSION['nombre'];
	$tipo_usuario = $_SESSION['tipo_usuario'];
	
	$id = $_SESSION['id'];
	$tipo_usuario = $_SESSION['tipo_usuario'];
	
	if($tipo_usuario == 1){
		$where = "";
		} else if($tipo_usuario == 2){
		$where = "WHERE id=$id";
	}
	$sql = "SELECT * FROM producto $where";
	$resultado = $mysqli->query($sql);
	
	
?>
<?php
    include_once "conect.php";
    $sentencia = $bd -> query("CALL SP_DATOS()");
    $persona = $sentencia->fetchAll(PDO::FETCH_OBJ);
    //print_r($persona);
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="principal.php">Start Bootstrap</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

            <ul class="navbar-nav ms-auto me-0 me-md-3 my-2 my-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" 
                    data-bs-toggle="dropdown" aria-expanded="false"><?php echo $nombre; ?> <i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Configuracion</a></li>
                        <!--<li><a class="dropdown-item" href="#!">Activity Log</a></li>-->
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="logout.php">Salir</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="principal.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
							<?php if($tipo_usuario == 1) { ?>
                            <div class="sb-sidenav-menu-heading">Administrador</div>
							<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Productos
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="insertar-producto.php">Insertar</a>
                                    <a class="nav-link" href="tabla-producto.php">Ver Lista</a>
                                </nav>
                            </div>
							<a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Realizar Venta
                            </a>
							<?php } ?>
                            <div class="sb-sidenav-menu-heading">Cliente</div>
                            
                            <a class="nav-link" href="tabla.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Usuarios Registrados
                            </a>
							<?php if($tipo_usuario == 2) { ?>
                            <div class="sb-sidenav-menu-heading">Menu</div>
							<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Productos
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="insertar-producto.php">Insertar</a>
                                    <a class="nav-link" href="tabla-producto.php">Ver Lista</a>
                                </nav>
                            </div>
							<a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Inventario
                            </a>
							<?php } ?>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
			<?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'falta'){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Rellena todos los campos.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?>


            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'registrado'){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Registrado!</strong> Se agregaron los datos.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?>   
            
            

            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'error'){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Vuelve a intentar.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?>   



            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'editado'){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Cambiado!</strong> Los datos fueron actualizados.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?> 


            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'eliminado'){
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Eliminado!</strong> Los datos fueron borrados.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?> 
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Insertar - Producto</h1>
                        <div class="row mt-4">
                            <div class="col-xl-4">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            Ingresar datos:
                                        </div>
                                        <form class="p-4" method="POST" action="registro1.php">
                                            <div class="mb-3">
                                                <label class="form-label">Nombre de Producto: </label>
                                                <input type="text" class="form-control" name="nprod" autofocus required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Marca: </label>
                                                <input type="text" class="form-control" name="marca" autofocus required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Medida: </label>
                                                <input type="text" class="form-control" name="medida" autofocus required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Precio: </label>
                                                <input type="number" class="form-control" name="precio" autofocus required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Stock: </label>
                                                <input type="number" class="form-control" name="stock" autofocus required>
                                            </div>
                                            <div class="d-grid">
                                                <input type="hidden" name="oculto" value="1">
                                                <input type="submit" class="btn btn-primary" value="Registrar">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
							
                            <div class="col-xl-8">
                            <div class="card mb-4 mt-4">
							
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Lista de Productos Registrados
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Marca</th>
                                            <th>Medida</th>
                                            <th>Precio</th>
											<th>Stock</th>
                                            <th></th>
											<th></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Marca</th>
                                            <th>Medida</th>
                                            <th>Precio</th>
											<th>Stock</th>
                                            <th></th>
											<th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php while($row = $resultado->fetch_assoc()) { ?>
												<tr>
													<td><?php echo $row['nprod']; ?></td>
													<td><?php echo $row['marca']; ?></td>
													<td><?php echo $row['medida']; ?></td>
													<td><?php echo $row['precio']; ?></td>
													<td><?php echo $row['stock']; ?></td>
													<td><a href="actualizar.php?id=<?php echo $row['id'] ?>" class="btn btn-info"> Editar</a></td>
													<td><a href="eliminar.php?id=<?php echo $row['id'] ?>" class="btn btn-info"> Eliminar</a></td>
													
												</tr>
										<?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                            </div>
                        </div>
                        
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
		<?php
			if(isset($_GET['mensaje'])and $_GET['mensaje']=='falta'){
				?>
					<div>
						<strong>Error!</strong>Rellena todos los campos.
		<?php
											}
		?>
										</div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>