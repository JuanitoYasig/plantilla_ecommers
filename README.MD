# StyleShop - E-commerce

Sistema de e-commerce desarrollado con PHP, HTML, Bootstrap 5 y JavaScript, con base de datos JSON y funcionalidad de carrito de compras con integración a WhatsApp.

## 🎨 Paleta de Colores

- **Primary**: #2C3E50 (Azul oscuro)
- **Secondary**: #34495E (Gris azulado)
- **Accent**: #7F8C8D (Gris medio)
- **Light**: #ECF0F1 (Gris claro)
- **Dark**: #1A252F (Casi negro)
- **White**: #FFFFFF

## 📁 Estructura de Archivos

```
proyecto/
│
├── index.php           # Página principal con carousel y productos destacados
├── categorias.php      # Listado de productos por categoría
├── producto.php        # Detalle de producto individual
├── carrito.php         # Página del carrito de compras
├── contacto.php        # Formulario de contacto y preguntas frecuentes
├── equipo.php          # Página del equipo de trabajo
├── config.php          # Configuración y funciones PHP
├── header.php          # Encabezado común
├── footer.php          # Pie de página común
│
├── data/
│   ├── categorias.json # Base de datos de categorías
│   └── productos.json  # Base de datos de productos
│
├── css/
│   └── style.css       # Estilos personalizados
│
├── js/
│   ├── cart.js         # Gestión del carrito de compras
│   └── main.js         # JavaScript principal
│
└── images/             # Carpeta para imágenes de productos (crear)
```

## 🚀 Instalación

### Requisitos
- PHP 7.4 o superior
- Servidor web (Apache, Nginx, o PHP built-in server)
- Navegador web moderno

### Pasos de Instalación

1. **Descargar o clonar el proyecto**
   ```bash
   git clone [tu-repositorio]
   cd proyecto
   ```

2. **Crear la estructura de carpetas**
   ```bash
   mkdir -p data css js images
   ```

3. **Colocar los archivos en sus respectivas carpetas**
   - Archivos PHP en la raíz
   - `categorias.json` y `productos.json` en la carpeta `data/`
   - `style.css` en la carpeta `css/`
   - `cart.js` y `main.js` en la carpeta `js/`

4. **Configurar el número de WhatsApp**
   - Editar `config.php`
   - Cambiar la constante `WHATSAPP_NUMBER` si es necesario:
   ```php
   define('WHATSAPP_NUMBER', '593967212283');
   ```

5. **Iniciar el servidor**
   
   **Opción A - Servidor PHP integrado:**
   ```bash
   php -S localhost:8000
   ```
   
   **Opción B - XAMPP/WAMP:**
   - Colocar el proyecto en `htdocs/` o `www/`
   - Acceder a `http://localhost/nombre-proyecto/`
   
   **Opción C - Apache/Nginx:**
   - Configurar virtual host apuntando a la carpeta del proyecto
   - Reiniciar el servidor web

6. **Acceder a la aplicación**
   - Abrir navegador
   - Ir a `http://localhost:8000` (o la URL configurada)

## 📋 Características

### ✨ Funcionalidades Principales

- **Carrusel Automático**: Cambia cada 5 segundos con controles manuales
- **Catálogo de Productos**: Organizado por categorías con filtros
- **Carrito de Compras**: Funciona con localStorage del navegador
- **Integración WhatsApp**: Envío de pedidos directamente por WhatsApp
- **Diseño Responsivo**: Adaptado a dispositivos móviles, tablets y desktop
- **Efectos Visuales**: Transparencias, animaciones suaves y transiciones
- **Base de Datos JSON**: Sistema ligero sin necesidad de MySQL

### 🛒 Funciones del Carrito

- Agregar productos
- Modificar cantidades
- Eliminar productos
- Calcular totales automáticamente
- Persistencia de datos (se mantiene al cerrar el navegador)
- Envío de pedido completo por WhatsApp

### 📱 Páginas Disponibles

1. **INICIO** - Carousel, productos destacados y categorías
2. **CATEGORÍAS** - Filtro por categorías y listado completo
3. **CONTACTO** - Formulario, información de contacto y FAQ
4. **EQUIPO DE TRABAJO** - Presentación del equipo y valores
5. **PRODUCTO** - Detalles completos con productos relacionados
6. **CARRITO** - Gestión del carrito y envío por WhatsApp

## 🎯 Uso del Sistema

### Agregar Productos

Los productos se gestionan desde `data/productos.json`:

```json
{
  "id_producto": 1,
  "nombre": "Nombre del Producto",
  "descripcion": "Descripción detallada",
  "precio": 45.99,
  "precio_descuento": 35.99,
  "descuento": "si",
  "id_categoria": [1, 3],
  "stock": 25,
  "materiales": "Material del producto",
  "estado": "ACTIVO",
  "imagen": "images/producto.jpg"
}
```

### Agregar Categorías

Las categorías se gestionan desde `data/categorias.json`:

```json
{
  "id_categoria": 1,
  "nombre": "Categoría",
  "descripcion": "Descripción de la categoría",
  "estado": "ACTIVO"
}
```

## 🎨 Personalización

### Cambiar Colores

Editar las variables CSS en `css/style.css`:

```css
:root {
    --primary: #2C3E50;
    --secondary: #34495E;
    --accent: #7F8C8D;
    --light: #ECF0F1;
    --dark: #1A252F;
    --white: #FFFFFF;
}
```

### Modificar Tiempo del Carousel

Editar en `index.php`:

```javascript
var carousel = new bootstrap.Carousel(document.getElementById('mainCarousel'), {
    interval: 5000, // Cambiar a los milisegundos deseados
    ride: 'carousel'
});
```

### Cambiar Nombre de la Tienda

Editar en `config.php`:

```php
define('SITE_NAME', 'Tu Nombre Aquí');
```

## 📱 Formato del Mensaje de WhatsApp

El sistema genera automáticamente un mensaje estructurado:

```
¡Hola! Me gustaría hacer el siguiente pedido:

1. Producto 1
   Cantidad: 2
   Precio: $45.99
   Subtotal: $91.98

2. Producto 2
   Cantidad: 1
   Precio: $35.50
   Subtotal: $35.50

*TOTAL: $127.48*

Espero su confirmación. ¡Gracias!
```

## 🔧 Solución de Problemas

### El carrito no guarda productos
- Verificar que JavaScript esté habilitado
- Verificar que localStorage esté permitido en el navegador
- Limpiar caché del navegador

### Los productos no se muestran
- Verificar que los archivos JSON estén en la carpeta `data/`
- Verificar permisos de lectura de archivos
- Revisar la consola del navegador para errores

### No funciona el envío por WhatsApp
- Verificar el formato del número en `config.php`
- Debe incluir código de país sin el signo +
- Ejemplo: `593967212283` para Ecuador

## 🌟 Mejoras Futuras Sugeridas

- [ ] Sistema de búsqueda de productos
- [ ] Galería de imágenes para cada producto
- [ ] Sistema de valoraciones y reseñas
- [ ] Wishlist o lista de deseos
- [ ] Comparador de productos
- [ ] Filtros avanzados (precio, material, etc.)
- [ ] Panel de administración
- [ ] Integración con pasarelas de pago

## 📞 Soporte

Para consultas o soporte:
- WhatsApp: +593 96 721 2283
- Email: info@styleshop.com

## 📄 Licencia

Este proyecto es de código abierto para uso educativo y comercial.

---

**Desarrollado con ❤️ para StyleShop**