<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Panel Administrativo</title>
        <link href="<?php echo base_url; ?>Assets/css/styles.css" rel="stylesheet" />
        <link href="<?php echo base_url; ?>Assets/css/estilos.css" rel="stylesheet" />
        <link href="<?php echo base_url; ?>Assets/css/select2.min.css" rel="stylesheet" />
        <link href="<?php echo base_url; ?>Assets/DataTables/datatables.min.css" rel="stylesheet"/>
        <script src="<?php echo base_url; ?>Assets/js/all.js"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="<?php echo base_url; ?>Administracion/home">Gestock</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!" data-bs-toggle="modal" data-bs-target="#cambiarPass">Perfil</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="<?php echo base_url; ?>Usuarios/salir">Cerrar Sesión</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <!--SALIDAS-->
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseSalidas" aria-expanded="false" aria-controls="collapseSalidas">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-cart-shopping fa-2x"></i></div>
                                Salidas
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseSalidas" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo base_url; ?>Compras/ventas"><i class="fa-solid fa-cart-shopping m-2"></i>Nueva Venta</a>
                                    <a class="nav-link" href="<?php echo base_url; ?>Compras/historial_ventas"><i class="fa-solid fa-list m-2"></i>Historial</a>
                                </nav>
                            </div>
                            <!--ENTRADAS-->
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseEntradas" aria-expanded="false" aria-controls="collapseEntradas">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-cart-flatbed fa-2x"></i></div>
                                Entradas
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseEntradas" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo base_url; ?>Compras"><i class="fa-solid fa-cart-flatbed m-2"></i>Nueva Compra</a>
                                    <a class="nav-link" href="<?php echo base_url; ?>Compras/historial"><i class="fa-solid fa-list m-2"></i>Historial</a>
                                </nav>
                            </div>
                            <!--ADMINISTRACIÓN-->
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAdministracion" aria-expanded="false" aria-controls="collapseAdministracion">
                                <div class="sb-nav-link-icon"><i class="fas fa-cogs fa-2x"></i></div>
                                Administración
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseAdministracion" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo base_url; ?>Usuarios"><i class="fas fa-user m-2"></i>Usuarios</a>
                                    <a class="nav-link" href="<?php echo base_url; ?>Administracion"><i class="fas fa-cogs m-2"></i>Configuración</a>
                                </nav>
                            </div>
                            <!--PRODUCTOS-->
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProductos" aria-expanded="false" aria-controls="collapseProductos">
                                <div class="sb-nav-link-icon"><i class="fab fa-product-hunt fa-2x"></i></div>
                                Productos
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseProductos" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo base_url; ?>Productos"><i class="fab fa-product-hunt m-2"></i>Productos</a>
                                    <a class="nav-link" href="<?php echo base_url; ?>Medidas"><i class="fas fa-scale-unbalanced m-2"></i>Medidas</a>
                                    <a class="nav-link" href="<?php echo base_url; ?>Categorias"><i class="fas fa-list m-2"></i>Categorías</a>
                                </nav>
                            </div>
                            <!--CAJAS-->
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCajas" aria-expanded="false" aria-controls="collapseCajas">
                                <div class="sb-nav-link-icon"><i class="fas fa-cash-register fa-2x"></i></div>
                                Cajas
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseCajas" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo base_url; ?>Cajas"><i class="fas fa-cash-register m-2"></i>Cajas</a>
                                    <a class="nav-link" href="<?php echo base_url; ?>Cajas/arqueo"><i class="fas fa-cash-register m-2"></i>Apertura/Cierre</a>
                                </nav>
                            </div>
                            <!--CLIENTES-->
                            <a class="nav-link" href="<?php echo base_url; ?>Clientes">
                                <div class="sb-nav-link-icon"><i class="fas fa-users fa-2x"></i></div>
                                Clientes
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4 mt-4">
                               