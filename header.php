<?php
require_once 'config.php';
$currentPage = basename($_SERVER['PHP_SELF'], '.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?> - Tu tienda de moda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top glass-effect">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <div class="logo-placeholder me-2">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <span class="fw-bold"><?php echo SITE_NAME; ?></span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link <?php echo $currentPage == 'index' ? 'active' : ''; ?>" href="index.php">
                            <i class="fas fa-home me-1"></i> INICIO
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $currentPage == 'categorias' ? 'active' : ''; ?>" href="categorias.php">
                            <i class="fas fa-th-large me-1"></i> CATEGORÍAS
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $currentPage == 'contacto' ? 'active' : ''; ?>" href="contacto.php">
                            <i class="fas fa-envelope me-1"></i> CONTACTO
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $currentPage == 'equipo' ? 'active' : ''; ?>" href="equipo.php">
                            <i class="fas fa-users me-1"></i> EQUIPO
                        </a>
                    </li>
                    <li class="nav-item ms-3">
                        <a class="nav-link cart-link position-relative" href="carrito.php">
                            <i class="fas fa-shopping-cart fa-lg"></i>
                            <span class="cart-badge position-absolute translate-middle badge rounded-pill bg-danger" id="cartCount">
                                0
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- <div class="content-wrapper"></div> -->