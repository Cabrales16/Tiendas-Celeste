<?php
// Utilidades de sesión, permisos, CSRF y escape de salida.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

const ROL_EMPLEADO = 1;
const ROL_CLIENTE = 2;

// Escapa texto antes de imprimirlo en HTML (evita XSS).
function e($valor): string
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

// Muestra un aviso y redirige (mismo estilo que la versión original, pero con el texto escapado).
function aviso_y_redirigir(string $mensaje, string $destino): void
{
    echo '<script>alert(' . json_encode($mensaje, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) . ');'
        . 'window.location = ' . json_encode($destino) . ';</script>';
    exit;
}

function usuario_actual(): ?array
{
    if (!isset($_SESSION['codigo'])) {
        return null;
    }
    return ['codigo' => (int) $_SESSION['codigo'], 'rol' => (int) ($_SESSION['rol'] ?? 0)];
}

// Exige sesión iniciada. $loginUrl es relativo a la página que llama.
function requerir_login(string $loginUrl = 'login.php'): void
{
    if (!usuario_actual()) {
        aviso_y_redirigir('Por favor debes iniciar sesión', $loginUrl);
    }
}

// Exige rol Empleado: el CRUD ya no queda abierto a cualquiera.
function requerir_empleado(string $loginUrl = '../login.php', string $inicioUrl = '../index.php'): void
{
    $u = usuario_actual();
    if (!$u) {
        aviso_y_redirigir('Por favor debes iniciar sesión', $loginUrl);
    }
    if ($u['rol'] !== ROL_EMPLEADO) {
        aviso_y_redirigir('Esta sección es solo para empleados', $inicioUrl);
    }
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

function csrf_field(): string
{
    return '<input type="hidden" name="csrf" value="' . e(csrf_token()) . '">';
}

// Corta la petición si no es POST o el token CSRF no coincide.
function requerir_post_csrf(): void
{
    $ok = $_SERVER['REQUEST_METHOD'] === 'POST'
        && isset($_POST['csrf'], $_SESSION['csrf'])
        && hash_equals($_SESSION['csrf'], (string) $_POST['csrf']);
    if (!$ok) {
        http_response_code(400);
        exit('Petición no válida.');
    }
}
