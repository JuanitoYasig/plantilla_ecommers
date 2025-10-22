<?php
// Configuración general
define('SITE_NAME', 'Juancho\'s Shop');
define('WHATSAPP_NUMBER', '593967212283'); // Formato internacional

// Paleta de colores
$colors = [
    'primary' => '#2C3E50',      // Azul oscuro
    'secondary' => '#34495E',    // Gris azulado
    'accent' => '#7F8C8D',       // Gris medio
    'light' => '#ECF0F1',        // Gris claro
    'dark' => '#1A252F',         // Casi negro
    'white' => '#FFFFFF'
];

// Función para cargar datos JSON
function loadJSON($filename) {
    $file = __DIR__ . '/data/' . $filename;
    if (file_exists($file)) {
        $json = file_get_contents($file);
        return json_decode($json, true);
    }
    return [];
}

// Cargar categorías
function getCategorias() {
    $categorias = loadJSON('categorias.json');
    return array_filter($categorias, function($cat) {
        return $cat['estado'] === 'ACTIVO';
    });
}

// Cargar productos general
function getProductos() {
    $productos = loadJSON('productos.json');
    return array_filter($productos, function($prod) {
        return $prod['estado'] === 'ACTIVO';
    });
}

// Cargar productos Destacados en index
function getProductosDestacados() {
    $productos = loadJSON('productos.json');
    return array_filter($productos, function($prod) {
        return $prod['estado'] === 'ACTIVO' && $prod['destacado'] === 'SI';
    });
}

// Obtener producto por ID
function getProductoById($id) {
    $productos = getProductos();
    foreach ($productos as $producto) {
        if ($producto['id_producto'] == $id) {
            return $producto;
        }
    }
    return null;
}

// Obtener productos por categoría
function getProductosByCategoria($id_categoria) {
    $productos = getProductos();
    return array_filter($productos, function($prod) use ($id_categoria) {
        return in_array($id_categoria, $prod['id_categoria']);
    });
}

// Obtener nombre de categoría
function getCategoriaNombre($id_categoria) {
    $categorias = getCategorias();
    foreach ($categorias as $cat) {
        if ($cat['id_categoria'] == $id_categoria) {
            return $cat['nombre'];
        }
    }
    return '';
}
?>