<?php
include 'header.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$producto = getProductoById($id);

if (!$producto) {
    echo '<br><br><br>';
    echo '<div class="container py-5"><div class="alert alert-danger">Producto no encontrado.</div></div>';
    include 'footer.php';
    exit;
}

$precio_final = $producto['descuento'] === 'si' ? $producto['precio_descuento'] : $producto['precio'];
?>

<div class="page-header py-4"></div>

<section class="py-5">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                <li class="breadcrumb-item"><a href="categorias.php">Productos</a></li>
                <li class="breadcrumb-item active"><?php echo $producto['nombre']; ?></li>
            </ol>
        </nav>
        
        <div class="row g-4">
            <!-- Imagen del Producto -->
            <div class="col-lg-6">
                <div class="glass-card p-4">
                    <div class="product-image-large position-relative d-flex align-items-center justify-content-center" style="height: min(60vh,420px); overflow:hidden;">
                        <?php
                        $mainImg = ltrim($producto['imagen'], '/');
                        ?>
                        <img src="<?php echo htmlspecialchars($mainImg); ?>"
                             alt="<?php echo htmlspecialchars($producto['nombre']); ?>"
                             class="img-fluid product-image-large-img"
                             style="max-width:100%; max-height:100%; object-fit:contain; display:block;"
                             onerror="this.style.display='none'">
                        <?php if ($producto['descuento'] === 'si'): ?>
                        <span class="badge bg-danger position-absolute top-0 end-0 m-3 fs-5">
                            -<?php echo round((($producto['precio'] - $producto['precio_descuento']) / $producto['precio']) * 100); ?>% OFF
                        </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <!-- Información del Producto -->
            <div class="col-lg-6">
                <div class="glass-card p-4">
                    <h1 class="display-5 fw-bold mb-3 animate-fade-in"><?php echo $producto['nombre']; ?></h1>
                    
                    <div class="mb-3">
                        <?php foreach ($producto['id_categoria'] as $catId): ?>
                        <a href="categorias.php?id=<?php echo $catId; ?>" class="badge bg-secondary text-decoration-none me-1">
                            <?php echo getCategoriaNombre($catId); ?>
                        </a>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="price-section mb-4">
                        <?php if ($producto['descuento'] === 'si'): ?>
                            <div class="d-flex align-items-center gap-3">
                                <span class="text-decoration-line-through text-muted fs-4">$<?php echo number_format($producto['precio'], 2); ?></span>
                                <span class="text-danger fw-bold fs-2">$<?php echo number_format($producto['precio_descuento'], 2); ?></span>
                            </div>
                            <p class="text-success mb-0">
                                <i class="fas fa-tag me-1"></i>
                                ¡Ahorra $<?php echo number_format($producto['precio'] - $producto['precio_descuento'], 2); ?>!
                            </p>
                        <?php else: ?>
                            <span class="fw-bold fs-2">$<?php echo number_format($producto['precio'], 2); ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="mb-4">
                        <h5 class="fw-bold">Descripción</h5>
                        <p class="text-muted"><?php echo $producto['descripcion']; ?></p>
                    </div>
                    
                    <div class="mb-4">
                        <h6 class="fw-bold">Detalles del Producto</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="fas fa-box text-muted me-2"></i>
                                <strong>Materiales:</strong> <?php echo $producto['materiales']; ?>
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-warehouse text-muted me-2"></i>
                                <strong>Stock disponible:</strong> 
                                <span class="badge bg-<?php echo $producto['stock'] > 10 ? 'success' : ($producto['stock'] > 0 ? 'warning' : 'danger'); ?>">
                                    <?php echo $producto['stock']; ?> unidades
                                </span>
                            </li>
                            <!-- <li class="mb-2">
                                <i class="fas fa-check-circle text-muted me-2"></i>
                                <?php 
                                if ($producto['estado'] === 'ACTIVO'){
                                    $estado_producto = 'Disponible';
                                    echo '<strong>Estado:</strong> <span class="text-success">'.$estado_producto.'</span>';
                                }else{
                                    $estado_producto = 'No disponible';
                                    echo '<strong>Estado:</strong> <span class="text-danger">'.$estado_producto.'</span>';
                                }
                                    
                                ?>
                                
                            </li> -->
                        </ul>
                    </div>
                    
                    <?php if ($producto['stock'] > 0): ?>
                    <div class="d-grid gap-2">
                        <button class="btn btn-dark btn-lg add-to-cart" 
                                data-id="<?php echo $producto['id_producto']; ?>"
                                data-nombre="<?php echo htmlspecialchars($producto['nombre']); ?>"
                                data-precio="<?php echo $precio_final; ?>">
                            <i class="fas fa-cart-plus me-2"></i> Agregar al Carrito
                        </button>
                        <a href="categorias.php" class="btn btn-outline-dark">
                            <i class="fas fa-arrow-left me-2"></i> Seguir Comprando
                        </a>
                    </div>
                    <?php else: ?>
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Producto agotado temporalmente
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <!-- Productos Relacionados -->
        <div class="mt-5">
            <h3 class="fw-bold mb-4">Productos Relacionados</h3>
            <div class="row g-4">
                <?php 
                $productosRelacionados = getProductosByCategoria($producto['id_categoria'][0]);
                $productosRelacionados = array_filter($productosRelacionados, function($p) use ($id) {
                    return $p['id_producto'] != $id;
                });
                $productosRelacionados = array_slice($productosRelacionados, 0, 4);
                
                foreach ($productosRelacionados as $prod): 
                ?>
                <div class="col-md-6 col-lg-3 product-card-wrapper">
                    <div class="card product-card h-100 glass-card">
                        <div class="position-relative">
                            <?php $relImg = ltrim($prod['imagen'], '/'); ?>
                            <img src="<?php echo htmlspecialchars($relImg); ?>" alt="<?php echo htmlspecialchars($prod['nombre']); ?>" class="img-fluid w-100 related-product-image" onerror="this.style.display='none'">
                            <?php if ($prod['descuento'] === 'si'): ?>
                            <span class="badge bg-danger position-absolute top-0 end-0 m-2">
                                -<?php echo round((($prod['precio'] - $prod['precio_descuento']) / $prod['precio']) * 100); ?>%
                            </span>
                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-truncate"><?php echo $prod['nombre']; ?></h5>
                            <p class="card-text text-muted small"><?php echo substr($prod['descripcion'], 0, 60) . '...'; ?></p>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <?php if ($prod['descuento'] === 'si'): ?>
                                        <span class="text-decoration-line-through text-muted small">$<?php echo number_format($prod['precio'], 2); ?></span>
                                        <span class="text-danger fw-bold d-block">$<?php echo number_format($prod['precio_descuento'], 2); ?></span>
                                    <?php else: ?>
                                        <span class="fw-bold">$<?php echo number_format($prod['precio'], 2); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="d-grid">
                                <a href="producto.php?id=<?php echo $prod['id_producto']; ?>" class="btn btn-outline-dark btn-sm">
                                    <i class="fas fa-eye me-1"></i> Ver Detalles
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>