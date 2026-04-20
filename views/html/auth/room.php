<?php
require_once 'config/config.php';
require_once 'models/conexion.php';
 
if(!isset($_SESSION['user'])){
    header('location: ' . SITE_URL . 'index.php?action=getFormRegisterUser');
    exit;
}
 
$nombreUsuario = htmlspecialchars($_SESSION['user']['name']);
$apellidoUsuario = htmlspecialchars($_SESSION['user']['last_name']);
 
$conexion = new Conexion();
$conexion->conectar();
$conexion->query("SELECT id, nombre FROM document_types ORDER BY id ASC");
$resultTipos = $conexion->getResult();
$conexion->deconectar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Verde | Habitaciones</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0a2e1c;
            --accent: #c4fb6d;
            --gold: #d4a373;
            --white: #ffffff;
            --bg-dark: #06110a;
        }
 
        * { box-sizing: border-box; margin: 0; padding: 0; }
 
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-dark);
            color: var(--white);
            min-height: 100vh;
        }
 
        .top-nav {
            position: fixed;
            top: 0; width: 100%; z-index: 1000;
            padding: 25px 60px;
            display: flex; justify-content: space-between; align-items: center;
            background: rgba(6,17,10,0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
 
        .nav-brand {
            font-family: 'Playfair Display', serif;
            font-size: 20px; letter-spacing: 5px;
            color: var(--white); text-decoration: none;
        }
 
        .nav-user { display: flex; align-items: center; gap: 25px; }
 
        .btn-logout {
            padding: 9px 22px;
            border: 1px solid #c4fb6d;
            color: #c4fb6d;
            background: transparent;
            text-decoration: none;
            font-size: 9px; font-weight: 700; letter-spacing: 2px;
            transition: 0.3s; text-transform: uppercase;
        }
 
        .btn-logout:hover { background: #c4fb6d; color: #0a2e1c; }
 
        .rooms-hero {
            padding-top: 120px; padding-bottom: 40px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }
 
        .rooms-hero .label {
            font-size: 10px; letter-spacing: 5px; color: #c4fb6d;
            margin-bottom: 15px; display: block;
        }
 
        .rooms-hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(36px, 5vw, 70px);
            font-weight: 400; letter-spacing: 8px; margin-bottom: 10px;
        }
 
        .rooms-hero p { color: rgba(255,255,255,0.5); font-size: 13px; letter-spacing: 2px; }
 
        .bienvenida-user {
            font-size: 26px;
            font-weight: 300;
            letter-spacing: 2px;
            color: rgba(255,255,255,0.7);
            margin-bottom: 50px;
            margin-top: 0;
        }
 
        .bienvenida-user span {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            color: #c4fb6d;
            font-size: 30px;
            font-weight: 400;
        }
 
        .rooms-container { max-width: 1200px; margin: 60px auto; padding: 0 40px; }
 
        .section-title {
            font-size: 15px; letter-spacing: 5px; color: #d4a373;
            text-transform: uppercase; margin-bottom: 40px; display: block;
        }
 
        .reservas-empty {
            text-align: center; padding: 60px;
            border: 1px dashed rgba(255,255,255,0.1); border-radius: 4px;
        }
        .container-a{
            width: 700px;
            height: 400px;
            border: 2px solid white;
        }
 
        @media (max-width: 768px) {
            .top-nav { padding: 20px 25px; }
            .rooms-container { padding: 0 20px; }
            .bienvenida-user { font-size: 20px; }
            .bienvenida-user span { font-size: 24px; }
        }
    </style>
</head>
<body>
 
    <nav class="top-nav">
        <a href="<?php echo SITE_URL; ?>index.php" class="nav-brand">Hotel Verde</a>
        <div class="nav-user">
            <a href="<?php echo SITE_URL; ?>index.php?action=logoutUser" class="btn-logout">Cerrar Sesión</a>
        </div>
    </nav>
 
    <div class="rooms-hero">
        <span class="label">HOTEL VERDE · COLOMBIA</span>
        <h1>HABITACIONES</h1>
        <p>Selecciona tu suite ideal y crea una reserva</p>
    </div>
 
    <div class="rooms-container">
        <p class="bienvenida-user">Bienvenido, <span><?php echo $nombreUsuario . ' ' . $apellidoUsuario; ?></span></p>
 
        <span class="section-title">Tus reservas</span>

        <div class="container-a">
        </div>
    </div>
 
</body>
</html>