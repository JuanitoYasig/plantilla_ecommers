<?php
include 'header.php';
$productos = getProductosDestacados();
$productosDestacados = array_slice($productos, 0, 8);
?>

<!-- Carousel -->
<div id="mainCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="2"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="carousel-image" style="background-image: linear-gradient(135deg, rgba(44,62,80,0.65) 0%, rgba(52,73,94,0.35) 100%), url('imagenes/carrusel/imagen1.png'); background-size: cover; background-position: center;">
                <div class="carousel-content">
                    <h1 class="display-3 fw-bold text-white mb-3 animate-fade-in">Nueva Colección</h1>
                    <p class="lead text-white-50 mb-4">Descubre las últimas tendencias en moda</p>
                    <a href="categorias.php" class="btn btn-light btn-lg">Ver Productos</a>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="carousel-image" style="background-image: linear-gradient(135deg, rgba(52,73,94,0.65) 0%, rgba(127,140,141,0.35) 100%), url('imagenes/carrusel/imagen2.png'); background-size: cover; background-position: center;">
                <div class="carousel-content">
                    <h1 class="display-3 fw-bold text-white mb-3 animate-fade-in">Ofertas Especiales</h1>
                    <p class="lead text-white-50 mb-4">Hasta 30% de descuento en productos seleccionados</p>
                    <a href="categorias.php" class="btn btn-light btn-lg">Aprovecha Ahora</a>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="carousel-image" style="background-image: linear-gradient(135deg, rgba(26,37,47,0.65) 0%, rgba(44,62,80,0.35) 100%), url('imagenes/carrusel/imagen3.png'); background-size: cover; background-position: center;">
                <div class="carousel-content">
                    <h1 class="display-3 fw-bold text-white mb-3 animate-fade-in">Estilo para Ti</h1>
                    <p class="lead text-white-50 mb-4">Ropa, zapatos y accesorios de calidad</p>
                    <a href="categorias.php" class="btn btn-light btn-lg">Explorar</a>
                </div>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

<!-- Productos Destacados -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold section-title">Productos Destacados</h2>
            <p class="text-muted">Los más populares de nuestra colección</p>
        </div>
        
        <div class="row g-4">
            <?php foreach ($productosDestacados as $producto): ?>
            <div class="col-md-6 col-lg-3 product-card-wrapper">
                <div class="card product-card h-100 glass-card">
                    <div class="position-relative product-image-wrapper">
                        <?php
                        // Ensure image path doesn't start with a leading slash which could break relative paths
                        $imgPath = ltrim($producto['imagen'], '/');
                        ?>
                        <img src="<?php echo htmlspecialchars($imgPath); ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>" class="img-fluid w-100 product-image" onerror="this.style.display='none'">
                        <?php if ($producto['descuento'] === 'si'): ?>
                        <span class="badge bg-danger position-absolute top-0 end-0 m-2">
                            -<?php echo round((($producto['precio'] - $producto['precio_descuento']) / $producto['precio']) * 100); ?>%
                        </span>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-truncate"><?php echo $producto['nombre']; ?></h5>
                        <p class="card-text text-muted small"><?php echo substr($producto['descripcion'], 0, 60) . '...'; ?></p>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <?php if ($producto['descuento'] === 'si'): ?>
                                    <span class="text-decoration-line-through text-muted small">$<?php echo number_format($producto['precio'], 2); ?></span>
                                    <span class="text-danger fw-bold d-block">$<?php echo number_format($producto['precio_descuento'], 2); ?></span>
                                <?php else: ?>
                                    <span class="fw-bold">$<?php echo number_format($producto['precio'], 2); ?></span>
                                <?php endif; ?>
                            </div>
                            <span class="badge bg-secondary">Stock: <?php echo $producto['stock']; ?></span>
                        </div>
                        <div class="d-grid gap-2">
                            <a href="producto.php?id=<?php echo $producto['id_producto']; ?>" class="btn btn-outline-dark btn-sm">
                                <i class="fas fa-eye me-1"></i> Ver Detalles
                            </a>
                            <button class="btn btn-dark btn-sm add-to-cart" 
                                    data-id="<?php echo $producto['id_producto']; ?>"
                                    data-nombre="<?php echo htmlspecialchars($producto['nombre']); ?>"
                                    data-precio="<?php echo $producto['descuento'] === 'si' ? $producto['precio_descuento'] : $producto['precio']; ?>">
                                <i class="fas fa-cart-plus me-1"></i> Agregar al Carrito
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-5">
            <a href="categorias.php" class="btn btn-dark btn-lg">
                Ver Todos los Productos <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Categorías -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold section-title">Explora por Categoría</h2>
            <p class="text-muted">Encuentra exactamente lo que buscas</p>
        </div>
        
        <div class="row g-4">
            <?php 
            $categorias = getCategorias();
            $iconos = [
                'Hombres' => 'fa-male',
                'Mujeres' => 'fa-female',
                'Unisex' => 'fa-users',
                'Zapatos' => 'fa-shoe-prints',
                'Lentes' => 'fa-glasses',
                'Gorras' => 'fa-hat-cowboy'
            ];
            foreach ($categorias as $categoria): 
            ?>
            <div class="col-md-4 col-lg-2">
                <a href="categorias.php?id=<?php echo $categoria['id_categoria']; ?>" class="text-decoration-none">
                    <div class="card category-card glass-card h-100 text-center">
                        <div class="card-body">
                            <i class="fas <?php echo $iconos[$categoria['nombre']] ?? 'fa-tag'; ?> fa-3x mb-3 text-primary"></i>
                            <h6 class="card-title"><?php echo $categoria['nombre']; ?></h6>
                            <p class="card-text small text-muted"><?php echo $categoria['descripcion']; ?></p>
                        </div>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<script>
// Auto-slide carousel cada 5 segundos
document.addEventListener('DOMContentLoaded', function() {
    var carousel = new bootstrap.Carousel(document.getElementById('mainCarousel'), {
        interval: 5000,
        ride: 'carousel'
    });
});
</script>

<?php include 'footer.php'; ?>