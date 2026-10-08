<?php
// Conexión única a la base de datos (la usan tanto la tienda como el CRUD).
// Configurable con variables de entorno (útil con Docker); por defecto, XAMPP.
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conexion = new mysqli(
        getenv('DB_HOST') ?: 'localhost',
        getenv('DB_USER') ?: 'root',
        getenv('DB_PASS') !== false ? getenv('DB_PASS') : '',
        getenv('DB_NAME') ?: 'tiendasceleste1'
    );
    $conexion->set_charset('utf8mb4');
} catch (mysqli_sql_exception $e) {
    http_response_code(500);
    error_log('Error de conexión: ' . $e->getMessage()); // el detalle va al log, no al navegador
    exit('No se pudo conectar con la base de datos. Revisa la configuración.');
}
