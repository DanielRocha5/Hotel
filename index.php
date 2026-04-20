<?php
// ✅ ANTES de session_start()
ini_set('session.cookie_lifetime', 0);
session_set_cookie_params(0);
 
session_start();
 
require_once 'config/config.php';
require_once 'controllers/controllerBase.php';
require_once 'models/conexion.php';
require_once 'models/user.php';
 
$controllerBase = new ControllerBase();
 
if(isset($_GET['action'])){
    if($_GET['action'] == 'getFormRegisterUser'){
        if(!isset($_SESSION['errors']) && !isset($_SESSION['old'])){
            unset($_SESSION['old']);
            unset($_SESSION['errors']);
        }
        $controllerBase->verPaginaDeInicio('views/html/auth/register.php');
    }
    if($_GET['action'] == 'registerUser'){
        $controllerBase->registerUser($_POST);
    }
    if($_GET['action'] == 'getFormLoginUser'){
        $controllerBase->verPaginaDeInicio('views/html/auth/login.php');
    }
    if($_GET['action'] == 'loginUser'){
        $controllerBase->loginUser($_POST);
    }
    if($_GET['action'] == 'logoutUser'){
        $controllerBase->logoutUser();
    }
    if($_GET['action'] == 'verHabitaciones'){
        $controllerBase->verPaginaDeInicio('views/html/auth/room.php');
    }
} else {
    $controllerBase->verPaginaDeInicio('views/html/home.php');
}
?>