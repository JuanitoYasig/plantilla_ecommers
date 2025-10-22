<?php
include 'header.php';

$categoriaSeleccionada = isset($_GET['id']) ? (int)$_GET['id'] : null;
$categorias = getCategorias();

if ($categoriaSeleccionada) {
    $productos = getProductosByCategoria($categoriaSeleccionada);
    $categoriaNombre = getCategoriaNombre($categoriaSeleccionada);
} else {
    $productos = getProductos();
    $categoriaNombre = 'Todos los Productos';
}
?>
<br>
<br>
<br>

<div class="page-header py-5 text-center">
    <div class="container">
        <h1 class="display-4 fw-bold animate-fade-in"><?php echo $categoriaNombre; ?></h1>
        <p class="lead text-muted">Explora nuestra selección de productos</p>
    </div>
</div>

<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Sidebar de Categorías -->
            <div class="col-lg-3 mb-4">
                <div class="glass-card p-4">
                    <h5 class="fw-bold mb-3">Categorías</h5>
                    <div class="list-group list-group-flush">
                        <a href="categorias.php"
                            class="list-group-item list-group-item-action <?php echo !$categoriaSeleccionada ? 'active' : ''; ?>">
                            <i class="fas fa-list me-2"></i> Todas
                        </a>
                        <?php foreach ($categorias as $cat): ?>
                            <a href="categorias.php?id=<?php echo $cat['id_categoria']; ?>"
                                class="list-group-item list-group-item-action <?php echo $categoriaSeleccionada == $cat['id_categoria'] ? 'active' : ''; ?>">
                                <?php echo $cat['nombre']; ?>
                                <span class="badge bg-secondary float-end">
                                    <?php echo count(getProductosByCategoria($cat['id_categoria'])); ?>
                                </span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Productos Grid -->
            <div class="col-lg-9">
                <?php if (empty($productos)): ?>
                    <div class="alert alert-info text-center">
                        <i class="fas fa-info-circle me-2"></i>
                        No hay productos disponibles en esta categoría.
                    </div>
                <?php else: ?>
                    <div class="row g-4">
                        <?php foreach ($productos as $producto): ?>
                            <div class="col-md-6 col-lg-4 product-card-wrapper">
                                <div class="card product-card h-100 glass-card">
                                    <div class="position-relative">
                                        <?php
                                        $mainImg = ltrim($producto['imagen'], '/');
                                        ?>
                                        <img src="<?php echo htmlspecialchars($mainImg); ?>"
                                            alt="<?php echo htmlspecialchars($producto['nombre']); ?>"
                                            class="img-fluid product-image-large-img"
                                            style="max-width:100%; max-height:100%; object-fit:contain; display:block;"
                                            onerror="this.style.display='none'">
                                        <?php if ($producto['descuento'] === 'si'): ?>
                                            <span class="badge bg-danger position-absolute top-0 end-0 m-2">
                                                -<?php echo round((($producto['precio'] - $producto['precio_descuento']) / $producto['precio']) * 100); ?>%
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $producto['nombre']; ?></h5>
                                        <p class="card-text text-muted small"><?php echo substr($producto['descripcion'], 0, 80) . '...'; ?></p>

                                        <div class="mb-2">
                                            <?php foreach ($producto['id_categoria'] as $catId): ?>
                                                <span class="badge bg-secondary small"><?php echo getCategoriaNombre($catId); ?></span>
                                            <?php endforeach; ?>
                                        </div>

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
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>