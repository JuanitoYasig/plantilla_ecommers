<?php include 'header.php'; ?>

<br>
<br>
<br>

<div class="page-header py-5 text-center">
    <div class="container">
        <h1 class="display-4 fw-bold animate-fade-in">Contáctanos</h1>
        <p class="lead text-muted">Estamos aquí para ayudarte</p>
    </div>
</div>

<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Información de Contacto -->
            <div class="col-lg-4">
                <div class="glass-card p-4 h-100">
                    <h4 class="fw-bold mb-4">Información de Contacto</h4>

                    <div class="contact-info">
                        <div class="mb-4">
                            <div class="d-flex align-items-start">
                                <div class="icon-box me-3">
                                    <i class="fas fa-map-marker-alt fa-lg"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold">Dirección</h6>
                                    <p class="text-muted mb-0">Santo Domingo de los Tsachilas<br>Ecuador</p>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="d-flex align-items-start">
                                <div class="icon-box me-3">
                                    <i class="fab fa-whatsapp fa-lg"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold">WhatsApp</h6>
                                    <a href="https://wa.me/<?php echo WHATSAPP_NUMBER; ?>" class="text-decoration-none text-muted">
                                        +593 96 721 2283
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="d-flex align-items-start">
                                <div class="icon-box me-3">
                                    <i class="fas fa-envelope fa-lg"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold">Email</h6>
                                    <a href="mailto:info@styleshop.com" class="text-decoration-none text-muted">
                                        info@styleshop.com
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="d-flex align-items-start">
                                <div class="icon-box me-3">
                                    <i class="fas fa-clock fa-lg"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold">Horario</h6>
                                    <p class="text-muted mb-0">
                                        Lun - Vie: 9:00 AM - 6:00 PM<br>
                                        Sáb: 9:00 AM - 2:00 PM<br>
                                        Dom: Cerrado
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-top">
                        <h6 class="fw-bold mb-3">Síguenos en Redes Sociales</h6>
                        <div class="d-flex gap-3">
                            <a href="#" class="social-icon">
                                <i class="fab fa-facebook fa-2x"></i>
                            </a>
                            <a href="#" class="social-icon">
                                <i class="fab fa-instagram fa-2x"></i>
                            </a>
                            <a href="#" class="social-icon">
                                <i class="fab fa-twitter fa-2x"></i>
                            </a>
                            <a href="https://wa.me/<?php echo WHATSAPP_NUMBER; ?>" class="social-icon">
                                <i class="fab fa-whatsapp fa-2x"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulario de Contacto -->
            <div class="col-lg-8">
                <div class="glass-card p-4">
                    <h4 class="fw-bold mb-4">Envíanos un Mensaje</h4>

                    <form id="contactForm">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Nombre Completo</label>
                                <input id="contactName" name="name" type="text" class="form-control" required placeholder="Tu nombre">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Email</label>
                                <input id="contactEmail" name="email" type="email" class="form-control" required placeholder="tu@email.com">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Teléfono</label>
                                <input id="contactPhone" name="phone" type="tel" class="form-control" placeholder="09XXXXXXXXX">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Asunto</label>
                                <select id="contactSubject" name="subject" class="form-select">
                                    <option selected>Consulta General</option>
                                    <option>Estado de Pedido</option>
                                    <option>Devoluciones</option>
                                    <option>Sugerencias</option>
                                    <option>Reclamos</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold">Mensaje</label>
                                <textarea id="contactMessage" name="message" class="form-control" rows="6" required placeholder="Escribe tu mensaje aquí..."></textarea>
                            </div>
                            <div class="col-12">
                                <button id="contactSubmit" type="submit" class="btn btn-dark btn-lg px-5">
                                    <i class="fas fa-paper-plane me-2"></i> Enviar Mensaje
                                </button>
                            </div>
                        </div>
                    </form>

                    <div id="formMessage" class="alert alert-success mt-3" style="display: none;">
                        <i class="fas fa-check-circle me-2"></i>
                        ¡Mensaje enviado correctamente! Te contactaremos pronto.
                    </div>
                </div>


                <!-- Preguntas Frecuentes -->
                <div class="glass-card p-4 mt-4">
                    <h4 class="fw-bold mb-4">Preguntas Frecuentes</h4>

                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item bg-transparent border">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    ¿Cómo realizo un pedido?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Simplemente agrega los productos que deseas al carrito y envía tu pedido por WhatsApp. Nuestro equipo te contactará para confirmar los detalles.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item bg-transparent border mt-2">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    ¿Cuáles son los métodos de pago?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Aceptamos transferencias bancarias, tarjetas de crédito/débito y pago contra entrega en Quito.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item bg-transparent border mt-2">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    ¿Hacen envíos a nivel nacional?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Sí, realizamos envíos a todo Ecuador. Los costos varían según la ubicación.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item bg-transparent border mt-2">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                    ¿Cuál es el tiempo de entrega?
                                </button>
                            </h2>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    En Quito: 1-2 días hábiles. Resto del país: 3-5 días hábiles.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- Sucursales: Mapas -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="p-3 rounded-3 shadow glass-card " style="background: rgba(255,255,255,0.85);">
                    <h5 class="fw-bold mb-3"><i class="fas fa-map-marker-alt me-2"></i> Sucursal Principal</h5>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d3106.298446462409!2d-79.18352915131966!3d-0.26045075999035533!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses-419!2sec!4v1761110453342!5m2!1ses-419!2sec" width="100%" height="320" style="border:0; border-radius:12px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <p class="mt-3 text-muted small">Av. Central 123, Local 4, Quito</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-3 rounded-3 shadow glass-card " style="background: rgba(255,255,255,0.85);">
                    <h5 class="fw-bold mb-3"><i class="fas fa-map-marker-alt me-2"></i> Sucursal Secundaria</h5>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1484.9170072078384!2d-79.16777468398865!3d-0.25409627407662555!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses-419!2sec!4v1761110645337!5m2!1ses-419!2sec" width="100%" height="320" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <p class="mt-3 text-muted small">Calle Secundaria 45, Centro Comercial Norte, Quito</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.getElementById('contactForm').addEventListener('submit', function(e) {
        e.preventDefault();
        document.getElementById('formMessage').style.display = 'block';
        this.reset();
        setTimeout(() => {
            document.getElementById('formMessage').style.display = 'none';
        }, 5000);
    });

    (function() {
        // Listener en fase de captura para bloquear el handler existente y abrir WhatsApp
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            e.stopPropagation(); // evita que otros handlers añadidos después se ejecuten

            var name = document.getElementById('contactName').value.trim();
            var email = document.getElementById('contactEmail').value.trim();
            var phone = document.getElementById('contactPhone').value.trim();
            var subject = document.getElementById('contactSubject').value;
            var message = document.getElementById('contactMessage').value.trim();

            var lines = [];
            if (name) lines.push("Nombre: " + name);
            if (email) lines.push("Email: " + email);
            if (phone) lines.push("Teléfono: " + phone);
            lines.push("Asunto: " + subject);
            lines.push("Mensaje: " + message);

            var fullMessage = lines.join("\n");

            // Número de WhatsApp definido en PHP en el resto del fichero
            var waNumber = "<?php echo WHATSAPP_NUMBER; ?>";
            var waUrl = "https://wa.me/" + encodeURIComponent(waNumber) + "?text=" + encodeURIComponent(fullMessage);

            // Abrir WhatsApp en nueva ventana/pestaña
            window.open(waUrl, '_blank');

            // Mostrar feedback local y resetear formulario
            var alertEl = document.getElementById('formMessage');
            alertEl.style.display = 'block';
            this.reset();

            setTimeout(function() {
                alertEl.style.display = 'none';
            }, 5000);
        }, true); // true -> Capturing phase to run before other submit handlers
    })();
</script>

<?php include 'footer.php'; ?>