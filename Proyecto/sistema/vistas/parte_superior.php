<?php

session_start();

if (!isset($_SESSION['id'])) {
	header("Location: index.php");
}

$nombre = $_SESSION['nombre'];
$tipo_usuario = $_SESSION['tipo_usuario'];


?>


<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<title>Sistema Web</title>
	<link href="css/styles.css" rel="stylesheet" />
	<link rel="shortcut icon" href="../../img/logo.ico" type="image/x-icon">
	<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
	<!-- Bootstrap CSS v5.0.2 -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<!-- cdn icnonos-->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body class="sb-nav-fixed">
	<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
		<a class="navbar-brand" href="../index.php">Sistema Web</a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button><!-- Navbar Search-->
		<!--<form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
				<input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
				<div class="input-group-append">
				<button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
				</div>
                </div>
			</form>-->
		<!-- Navbar-->
		<ul class="navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $nombre; ?><i class="fas fa-user fa-fw"></i></a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
					<a class="dropdown-item" href="#">Configuración</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="logout.php">Salir</a>
				</div>
			</li>
		</ul>
	</nav>
	<div id="layoutSidenav">
		<div id="layoutSidenav_nav">
			<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
				<div class="sb-sidenav-menu">
					<div class="nav">
						<a class="nav-link" href="../../sistema/principal.php">
							<div class="sb-nav-link-icon"><i class="bi bi-code-square"></i></i></div>
							Dashboard
						</a>

						<?php if ($tipo_usuario == 1) { ?>

							<div class="sb-sidenav-menu-heading">Interface</div>
							<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
								<div class="sb-nav-link-icon"><i class="bi bi-person-badge"></i></div>
								Empleado
								<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
							</a>
							<div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
								<nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="empleado.php">Ajustes</a></nav>
							</div>
							
							<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
								<div class="sb-nav-link-icon"><i class="bi bi-person-bounding-box"></i></i></div>
								clientes
								<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
							</a>
							<div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
								<nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
									
								<nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="cliente.php">Ajustes</a></nav>
							</div>

							
							<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapProve" aria-expanded="false" aria-controls="collapProve">
								<div class="sb-nav-link-icon"><i class="bi bi-people-fill"></i></div>
								Proveedores
								<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
							</a>
							<div class="collapse" id="collapProve" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
								<nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
									
								<nav class="sb-sidenav-menu-nested nav"><a class="nav-link" href="proveedor.php">registrar</a></nav>
								
							</div>

							

						<?php } ?>

						<div class="sb-sidenav-menu-heading">Addons</div>
						<a class="nav-link" href="citas.php">
							<div class="sb-nav-link-icon"><i class="bi bi-calendar2-event-fill"></i></div>
							Citas
						</a>
						<a class="nav-link" href="evento.php">
							<div class="sb-nav-link-icon"><i class="bi bi-calendar-plus-fill"></i></div>
							Evento
						</a>
						<a class="nav-link" href="servicios.php">
							<div class="sb-nav-link-icon"><i class="bi bi-ui-checks"></i></div>
							Servicios
						</a> 
						<a class="nav-link" href="encuesta.php">
							<div class="sb-nav-link-icon"><i class="bi bi-bar-chart-fill"></i></div>
							Encuesta
						</a>
						<a class="nav-link" href="galeria.php">
							<div class="sb-nav-link-icon"><i class="bi bi-image"></i></div>
							Galeria
						</a>
						<a class="nav-link" href="contrato.php">
							<div class="sb-nav-link-icon"><i class="bi bi-file-earmark"></i></div>
							Contrato
						</a>
					</div>
				</div>

			</nav>
		</div>
		<div id="layoutSidenav_content">
			<main>

			<a href="../../sistema/index.php"></a>