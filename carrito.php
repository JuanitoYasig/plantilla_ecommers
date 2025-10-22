<?php include 'header.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<br>
<br>
<br>

<div class="page-header py-5 text-center">
    <div class="container">
        <h1 class="display-4 fw-bold animate-fade-in">
            <i class="fas fa-shopping-cart me-2"></i> Mi Carrito
        </h1>
        <p class="lead text-muted">Revisa tus productos antes de finalizar</p>
    </div>
</div>

<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="glass-card p-4 mb-4">
                    <div id="cartItems">
                        <div class="text-center py-5 empty-cart">
                            <i class="fas fa-shopping-cart fa-4x text-muted mb-3"></i>
                            <h4 class="text-muted">Tu carrito está vacío</h4>
                            <p class="text-muted">¡Agrega productos para comenzar tu compra!</p>
                            <a href="categorias.php" class="btn btn-dark mt-3">
                                <i class="fas fa-shopping-bag me-2"></i> Ir a Comprar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="glass-card p-4 position-sticky" style="top: 100px;">
                    <h4 class="fw-bold mb-4">Resumen del Pedido</h4>
                    
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Subtotal:</span>
                            <span id="subtotal" class="fw-bold">$0.00</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Productos:</span>
                            <span id="totalItems" class="fw-bold">0</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <span class="fw-bold fs-5">Total:</span>
                            <span id="total" class="fw-bold fs-5 text-success">$0.00</span>
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2" id="checkoutSection" style="display: none !important;">
                        <button class="btn btn-success btn-lg" id="sendWhatsApp">
                            <i class="fab fa-whatsapp me-2"></i> Enviar Pedido por WhatsApp
                        </button>
                        <button class="btn btn-outline-danger" id="clearCart">
                            <i class="fas fa-trash me-2"></i> Vaciar Carrito
                        </button>
                    </div>
                    
                    <div class="mt-4 pt-4 border-top">
                        <h6 class="fw-bold mb-3">
                            <i class="fas fa-shield-alt me-2 text-success"></i> Compra Segura
                        </h6>
                        <ul class="list-unstyled small text-muted">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Envío a domicilio</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Pago contra entrega</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Atención personalizada</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal de Confirmación -->
<div class="modal fade" id="confirmModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content glass-modal">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">
                    <i class="fas fa-check-circle text-success me-2"></i>
                    Producto Agregado
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <p class="mb-0">El producto se agregó correctamente al carrito</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Seguir Comprando</button>
                <a href="carrito.php" class="btn btn-dark">Ir al Carrito</a>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>