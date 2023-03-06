<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Panel de Administración</title>
        <link href="<?php echo base_url; ?>Assets/css/style.css" rel="stylesheet" />
        <link href="<?php echo base_url; ?>Assets/DataTables/datatables.min.css" rel="stylesheet" />
        <link href="<?php echo base_url; ?>Assets/css/select2.min.css" rel="stylesheet" />
        <link href="<?php echo base_url; ?>Assets/css/styles.css" rel="stylesheet" />
        <script src="<?php echo base_url; ?>Assets/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="<?php echo base_url; ?>Administracion/home">Gestock</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!" data-toggle="modal" data-target="#cambiarPass">Perfil</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="<?php echo base_url; ?>/Usuarios/salir">Cerrar Sesión</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseVentas" aria-expanded="false" aria-controls="collapseVentas">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-cart-shopping fa-2x"></i></div>
                                Salidas
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseVentas" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo base_url; ?>Compras/ventas"><i class="fa-solid fa-cart-shopping fa-2x m-1"></i>Nueva Venta</a>
                                    <a class="nav-link" href="<?php echo base_url; ?>Compras/historial_ventas"><i class="fas fa-list m-1 fa-2x"></i>Historial Ventas</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCompras" aria-expanded="false" aria-controls="collapseCompras">
                                <div class="sb-nav-link-icon"><i class="fas fa-cart-flatbed fa-2x"></i></div>
                                Entradas
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseCompras" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo base_url; ?>Compras"><i class="fas fa-cart-flatbed fa-2x m-1"></i>Nueva Compra</a>
                                    <a class="nav-link" href="<?php echo base_url; ?>Compras/historial"><i class="fas fa-list m-1 fa-2x"></i>Historial Compras</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-tools fa-2x"></i></div>
                                Administración
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo base_url; ?>Usuarios"><i class="fas fa-user m-1 fa-2x"></i>Usuarios</a>
                                    <a class="nav-link" href="<?php echo base_url; ?>Cajas"><i class="fa-solid fa-cash-register m-1 fa-2x"></i>Cajas</a>
                                    <a class="nav-link" href="<?php echo base_url; ?>Administracion"><i class="fas fa-tools m-1 fa-2x"></i>Configuración</a>
                                </nav>
                            </div>

                            <a class="nav-link" href="<?php echo base_url; ?>Clientes">
                                <div class="sb-nav-link-icon"><i class="fas fa-users fa-2x"></i></div>
                                Clientes
                            </a>

                            <a class="nav-link" href="<?php echo base_url; ?>Medidas">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-scale-unbalanced fa-2x"></i></div>
                                Medidas
                            </a>

                            <a class="nav-link" href="<?php echo base_url; ?>Categorias">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-list fa-2x"></i></div>
                                Categorías
                            </a>

                            <a class="nav-link" href="<?php echo base_url; ?>Productos">
                                <div class="sb-nav-link-icon"><i class="fab fa-product-hunt fa-2x"></i></div>
                                Productos
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid mt-2">
                        
                    
