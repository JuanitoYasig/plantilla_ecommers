// Cart Management usando localStorage
class ShoppingCart {
    constructor() {
        this.cart = this.loadCart();
        this.updateCartCount();
        // cache map of products loaded from data/productos.json
        this.productsMap = null;
    }

    // Cargar carrito desde localStorage
    loadCart() {
        const cartData = localStorage.getItem('shoppingCart');
        return cartData ? JSON.parse(cartData) : [];
    }

    // Guardar carrito en localStorage
    saveCart() {
        localStorage.setItem('shoppingCart', JSON.stringify(this.cart));
        this.updateCartCount();
    }

    // Agregar producto al carrito
    addItem(id, nombre, precio, imagen = '') {
        const existingItem = this.cart.find(item => item.id === id);
        
        if (existingItem) {
            existingItem.cantidad++;
            // update imagen if provided and not already present
            if (imagen && !existingItem.imagen) existingItem.imagen = imagen.replace(/^\/+/, '');
        } else {
            this.cart.push({
                id: id,
                nombre: nombre,
                precio: parseFloat(precio),
                cantidad: 1,
                imagen: imagen ? imagen.replace(/^\/+/, '') : ''
            });
        }
        
        this.saveCart();
        this.showNotification('Producto agregado al carrito');
    }

    // Load products.json once and cache a map by id -> product
    async ensureProductsLoaded() {
        if (this.productsMap) return;
        try {
            const res = await fetch('data/productos.json', {cache: 'no-cache'});
            if (!res.ok) throw new Error('No se pudo cargar productos.json');
            const products = await res.json();
            this.productsMap = {};
            products.forEach(p => {
                // Ensure id keys are numbers
                this.productsMap[Number(p.id_producto)] = p;
            });
        } catch (err) {
            console.warn('ShoppingCart: no se pudo cargar data/productos.json', err);
            this.productsMap = {};
        }
    }

    // Eliminar producto del carrito
    removeItem(id) {
        this.cart = this.cart.filter(item => item.id !== id);
        this.saveCart();
        this.renderCart();
    }

    // Actualizar cantidad
    updateQuantity(id, cantidad) {
        const item = this.cart.find(item => item.id === id);
        if (item) {
            if (cantidad <= 0) {
                this.removeItem(id);
            } else {
                item.cantidad = parseInt(cantidad);
                this.saveCart();
                this.renderCart();
            }
        }
    }

    // Vaciar carrito
    clearCart() {
        this.cart = [];
        this.saveCart();
        this.renderCart();
    }

    // Obtener total
    getTotal() {
        return this.cart.reduce((total, item) => total + (item.precio * item.cantidad), 0);
    }

    // Obtener cantidad de items
    getItemCount() {
        return this.cart.reduce((count, item) => count + item.cantidad, 0);
    }

    // Actualizar contador del carrito
    updateCartCount() {
        const cartCount = document.getElementById('cartCount');
        if (cartCount) {
            const count = this.getItemCount();
            cartCount.textContent = count;
            cartCount.style.display = count > 0 ? 'flex' : 'none';
        }
    }

    // Renderizar carrito (para página de carrito)
    renderCart() {
        // call async renderer (loads products.json if needed) but don't require caller to await
        this._renderCartAsync();
    }

    // Async renderer helper
    async _renderCartAsync() {
        const cartItemsContainer = document.getElementById('cartItems');
        const subtotalElement = document.getElementById('subtotal');
        const totalElement = document.getElementById('total');
        const totalItemsElement = document.getElementById('totalItems');
        const checkoutSection = document.getElementById('checkoutSection');

        if (!cartItemsContainer) return;

        if (this.cart.length === 0) {
            cartItemsContainer.innerHTML = `
                <div class="text-center py-5 empty-cart">
                    <i class="fas fa-shopping-cart fa-4x text-muted mb-3"></i>
                    <h4 class="text-muted">Tu carrito está vacío</h4>
                    <p class="text-muted">¡Agrega productos para comenzar tu compra!</p>
                    <a href="categorias.php" class="btn btn-dark mt-3">
                        <i class="fas fa-shopping-bag me-2"></i> Ir a Comprar
                    </a>
                </div>
            `;
            if (checkoutSection) checkoutSection.style.display = 'none';
            return;
        }

        if (checkoutSection) checkoutSection.style.display = 'block';

        // Ensure we have products data to resolve image paths
        await this.ensureProductsLoaded();

        let html = '';
        this.cart.forEach(item => {
            // Determine image path: prefer item.imagen (if saved), otherwise look up by id in productsMap
            let imgPath = '';
            if (item.imagen) imgPath = item.imagen;
            else if (this.productsMap && this.productsMap[item.id]) imgPath = this.productsMap[item.id].imagen || '';

            // Trim any leading slashes so relative paths work correctly
            if (imgPath) imgPath = imgPath.replace(/^\/+/, '');

            const imgHtml = imgPath
                ? `<img src="${encodeHTML(imgPath)}" alt="${encodeHTML(item.nombre)}" class="img-fluid" style="max-height:54px; object-fit:cover;" onerror="this.style.display='none'">`
                : `<i class="fas fa-image fa-2x text-muted"></i>`;

            html += `
                <div class="cart-item" data-id="${item.id}">
                    <div class="row align-items-center">
                        <div class="col-md-2">
                            <div class="cart-item-image">
                                ${imgHtml}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h6 class="mb-1 fw-bold">${encodeHTML(item.nombre)}</h6>
                            <p class="text-muted small mb-0">Precio unitario: ${item.precio.toFixed(2)}</p>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group input-group-sm">
                                <button class="btn btn-outline-secondary decrease-qty" data-id="${item.id}">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" class="form-control text-center qty-input" 
                                       value="${item.cantidad}" min="1" data-id="${item.id}">
                                <button class="btn btn-outline-secondary increase-qty" data-id="${item.id}">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-2 text-end">
                            <p class="mb-0 fw-bold">${(item.precio * item.cantidad).toFixed(2)}</p>
                        </div>
                        <div class="col-md-1 text-end">
                            <button class="btn btn-sm btn-outline-danger remove-item" data-id="${item.id}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;
        });

        cartItemsContainer.innerHTML = html;

        // Actualizar totales
        const total = this.getTotal();
        if (subtotalElement) subtotalElement.textContent = `${total.toFixed(2)}`;
        if (totalElement) totalElement.textContent = `${total.toFixed(2)}`;
        if (totalItemsElement) totalItemsElement.textContent = this.getItemCount();

        // Event listeners para botones
        this.attachCartEventListeners();
    }

    // Event listeners para la página del carrito
    attachCartEventListeners() {
        // Eliminar item
        document.querySelectorAll('.remove-item').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const id = parseInt(e.currentTarget.dataset.id);
                if (confirm('¿Eliminar este producto del carrito?')) {
                    this.removeItem(id);
                }
            });
        });

        // Aumentar cantidad
        document.querySelectorAll('.increase-qty').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const id = parseInt(e.currentTarget.dataset.id);
                const item = this.cart.find(item => item.id === id);
                if (item) {
                    this.updateQuantity(id, item.cantidad + 1);
                }
            });
        });

        // Disminuir cantidad
        document.querySelectorAll('.decrease-qty').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const id = parseInt(e.currentTarget.dataset.id);
                const item = this.cart.find(item => item.id === id);
                if (item && item.cantidad > 1) {
                    this.updateQuantity(id, item.cantidad - 1);
                }
            });
        });

        // Input manual de cantidad
        document.querySelectorAll('.qty-input').forEach(input => {
            input.addEventListener('change', (e) => {
                const id = parseInt(e.target.dataset.id);
                const cantidad = parseInt(e.target.value);
                if (cantidad >= 1) {
                    this.updateQuantity(id, cantidad);
                } else {
                    e.target.value = 1;
                }
            });
        });
    }

    // Generar mensaje de WhatsApp
    generateWhatsAppMessage() {
        let message = `¡Hola! Me gustaría hacer el siguiente pedido:\n\n`;
        
        this.cart.forEach((item, index) => {
            message += `${index + 1}. ${item.nombre}\n`;
            message += `   Cantidad: ${item.cantidad}\n`;
            message += `   Precio: ${item.precio.toFixed(2)}\n`;
            message += `   Subtotal: ${(item.precio * item.cantidad).toFixed(2)}\n\n`;
        });
        
        message += `*TOTAL: ${this.getTotal().toFixed(2)}*\n\n`;
        message += `Espero su confirmación. ¡Gracias!`;
        
        return encodeURIComponent(message);
    }

    // Enviar por WhatsApp
    sendToWhatsApp() {
        if (this.cart.length === 0) {
            // alert('El carrito está vacío');
            Swal.fire({
                icon: 'warning',
                title: 'Carrito vacío',
                text: 'No puedes enviar un pedido vacío.',
                confirmButtonText: 'Aceptar'
            });
            return;
        }

        const phoneNumber = '593967212283';
        const message = this.generateWhatsAppMessage();
        const whatsappURL = `https://wa.me/${phoneNumber}?text=${message}`;
        
        window.open(whatsappURL, '_blank');
    }

    // Mostrar notificación
    showNotification(message) {
        // Buscar modal existente o crearlo
        let modal = document.getElementById('confirmModal');
        if (modal) {
            const bsModal = new bootstrap.Modal(modal);
            bsModal.show();
            
            // Auto-cerrar después de 2 segundos
            setTimeout(() => {
                bsModal.hide();
            }, 2000);
        }
    }
}

// Inicializar carrito
const cart = new ShoppingCart();

// Utility: simple HTML encoder for strings inserted into templates
function encodeHTML(str) {
    if (!str && str !== 0) return '';
    return String(str)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#39;');
}

// Event listeners globales
document.addEventListener('DOMContentLoaded', function() {
    // Agregar al carrito desde cualquier página
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const id = parseInt(this.dataset.id);
            const nombre = this.dataset.nombre;
            const precio = parseFloat(this.dataset.precio);
            
            cart.addItem(id, nombre, precio);
            
            // Animación del botón
            this.innerHTML = '<i class="fas fa-check me-1"></i> ¡Agregado!';
            this.classList.add('btn-success');
            this.classList.remove('btn-dark');
            
            setTimeout(() => {
                this.innerHTML = '<i class="fas fa-cart-plus me-1"></i> Agregar al Carrito';
                this.classList.remove('btn-success');
                this.classList.add('btn-dark');
            }, 1500);
        });
    });

    // Renderizar carrito si estamos en la página del carrito
    if (document.getElementById('cartItems')) {
        cart.renderCart();
    }

    // Botón de enviar por WhatsApp
    const sendWhatsAppBtn = document.getElementById('sendWhatsApp');
    if (sendWhatsAppBtn) {
        sendWhatsAppBtn.addEventListener('click', function() {
            cart.sendToWhatsApp();
        });
    }

    // Botón de vaciar carrito (usando SweetAlert2 si está disponible)
    const clearCartBtn = document.getElementById('clearCart');
    if (clearCartBtn) {
        clearCartBtn.addEventListener('click', function() {
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: 'Se vaciará el carrito y no podrás recuperarlo.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, vaciar',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        cart.clearCart();
                        Swal.fire({
                            title: 'Carrito vaciado',
                            text: 'El carrito ha sido vaciado correctamente.',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        });
                    }
                });
            } else {
                // Fallback a confirm() si SweetAlert no está cargado
                if (confirm('¿Estás seguro de que deseas vaciar el carrito?')) {
                    cart.clearCart();
                }
            }
        });
    }
});