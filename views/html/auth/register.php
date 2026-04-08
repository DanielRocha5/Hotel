<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Verde | Registrarse</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="views/html/auth/style.css">
</head>
<body>
    <div class="Contenedor">
        <h1>Crear Cuenta</h1>

        <?php if(isset($_SESSION['errors']['general'])){ ?>
            <span class="error-msg"><?php echo $_SESSION['errors']['general']; ?></span>
        <?php } ?>

        <form action="<?php echo SITE_URL; ?>index.php?action=registerUser" method="post">
            <label>Tipo de Documento</label>
                <select class = "input-warp" name="document_type_id">
                    <option class="xd" value="">Seleccionar.....</option>
                    <option class="xd" value="1">Cedula de Ciudadania</option>
                    <option class="xd" value="2">Tarjeta de Identidad</option>
                    <option class="xd" value="3">Cedula de Extranjeria</option>
                </select>

            <label>Numero de Documento</label>
            <input class="input_doc" type="text" name="document_number" value="" 
            placeholder = "Ej: 1110501182">

            <label>Nombre de Usuario</label>
            <input type="text" name="name" value="<?php echo isset($_SESSION['old']['name']) ? $_SESSION['old']['name'] : ''; ?>" placeholder="Tu nombre">
            <?php if(isset($_SESSION['errors']['name'])){ ?>
                <span><?php echo $_SESSION['errors']['name']; ?></span>
            <?php } ?>


            <label>Apellido</label>
            <input type="text" name="last_name" value=""
            placeholder = "Tu apellido Torres">

            <label>Correo Electrónico</label>
            <input type="text" name="email" value="<?php echo isset($_SESSION['old']['email']) ? $_SESSION['old']['email'] : ''; ?>" placeholder="correo@ejemplo.com">
            <?php if(isset($_SESSION['errors']['email'])){ ?>
                <span><?php echo $_SESSION['errors']['email']; ?></span>
            <?php } ?>

            <label>Contraseña</label>
            <input type="password" name="password" placeholder="••••••••">
            <?php if(isset($_SESSION['errors']['password'])){ ?>
                <span><?php echo $_SESSION['errors']['password']; ?></span>
            <?php } ?>

            <label>Verificar Contraseña</label>
            <input type="password" name="password_verify" placeholder="••••••••">

            <button type="submit" name="submit">Registrar</button>
        </form>

        <p class="auth-footer">
            ¿Ya tienes cuenta? 
            <a href="<?php echo SITE_URL; ?>index.php?action=getFormLoginUser">Inicia Sesión</a>
        </p>
    </div>
</body>
</html>