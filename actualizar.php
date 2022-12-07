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
    if(!isset($_GET['id'])){
        header('Location: tabla-producto.php?mensaje=error');
        exit();
    }

    include_once 'conect.php';
    $id = $_GET['id'];

    $sentencia = $bd->prepare("select * from producto where id = ?;");
    $sentencia->execute([$id]);
    $producto = $sentencia->fetch(PDO::FETCH_OBJ);
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
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Categoria
                            </a>
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
			    <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Editar - Producto</h1>
                        <div class="row mt-4">
                            <div class="col-xl-6">
                                <div class="col-md-10">
                                    <div class="card">
                                        <div class="card-header">
                                            Ingresar datos:
                                        </div>
                                        <form class="p-4" method="POST" action="editarProceso.php">
                                        <div class="mb-3">
                                            <label class="form-label">Nombre: </label>
                                            <input type="text" class="form-control" name="nprod" required 
                                            value="<?php echo $producto->nprod; ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Marca: </label>
                                            <input type="text" class="form-control" name="marca" autofocus required
                                            value="<?php echo $producto->marca; ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Medida: </label>
                                            <input type="text" class="form-control" name="medida" autofocus required
                                            value="<?php echo $producto->medida; ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Precio: </label>
                                            <input type="number" class="form-control" name="precio" autofocus required
                                            value="<?php echo $producto->precio; ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Stock: </label>
                                            <input type="number" class="form-control" name="stock" autofocus required
                                            value="<?php echo $producto->stock; ?>">
                                        </div>
                                        <div class="d-grid">
                                            <input type="hidden" name="id" value="<?php echo $producto->id; ?>">
                                            <input type="submit" class="btn btn-primary" value="Editar">
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
							
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Bar Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>