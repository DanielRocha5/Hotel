<?php
class controllerBase{
    public function verPaginaDeInicio($pagina){
        include_once $pagina;
    }
 
    public function registerUser($datos){
        unset($_SESSION['errors']);
        unset($_SESSION['old']);
        unset($_SESSION['success']);
 
        $errores = $this->validateData($datos);
        if(count($errores) > 0){
            $_SESSION['errors'] = $errores;
            $_SESSION['old'] = $datos;
            header('location: '.SITE_URL.'index.php?action=getFormRegisterUser');
            exit;
        }
 
        $user = new User();
        $existe = $user->validateUser($datos);
        if($existe > 0){
            $_SESSION['errors'] = ['general' => '* El Usuario ya existe.'];
            $_SESSION['old'] = $datos;
            header('location: '.SITE_URL.'index.php?action=getFormRegisterUser');
            exit;
        }
 
        $password = password_hash($datos['password'], PASSWORD_DEFAULT);
        $datos['password'] = $password;
 
        $resultado = $user->registerUser($datos);
        if($resultado > 0){
            $_SESSION['success'] = "* Usuario Registrado Exitosamente";
            unset($_SESSION['old']);
            header('location: '.SITE_URL.'index.php?action=getFormLoginUser');
            exit;
        } else {
            $_SESSION['errors'] = ['general' => '* Error al registrar el usuario. Intentalo de nuevo.'];
            $_SESSION['old'] = $datos;
            header('location: '.SITE_URL.'index.php?action=getFormRegisterUser');
            exit;
        }
    }
 
    public function loginUser($datos){
        unset($_SESSION['errors']);
        unset($_SESSION['old']);
        unset($_SESSION['success']);
 
        $errores = [];
 
        if(empty(trim($datos['email'] ?? ''))){
            $errores['email'] = '* El email es requerido';
        } elseif(!strpos($datos['email'], '@')){
            $errores['email'] = '* El gmail debe contener @.';
        } elseif(!strpos($datos['email'], '.')){
            $errores['email'] = '* El gmail debe tener un .';
        }
        if(empty($datos['password'] ?? '')){
            $errores['password'] = '* La contraseña es requerida';
        }
 
        if(count($errores) > 0){
            $_SESSION['errors'] = $errores;
            $_SESSION['old'] = $datos;
            header('location: '.SITE_URL.'index.php?action=getFormLoginUser');
            exit;
        }
 
        $user = new User();
        $resultado = $user->loginUser($datos);
 
        if($resultado){
            $_SESSION['user'] = $resultado;
            header('location: '.SITE_URL.'index.php');
            exit;
        } else {
            $_SESSION['errors'] = ['general' => '* Email o contraseña incorrectos.'];
            $_SESSION['old'] = $datos;
            header('location: '.SITE_URL.'index.php?action=getFormLoginUser');
            exit;
        }
    }
 
    public function validateData($datos){
        $errores = [];
 
        if(empty(trim($datos['name'] ?? ''))){
            $errores['name'] = '* El nombre es requerido';
        }
        if(empty(trim($datos['email'] ?? ''))){
            $errores['email'] = '* El email es requerido';
        } elseif(!strpos($datos['email'], '@')){
            $errores['email'] = '* El gmail debe contener @.';
        } elseif(!strpos($datos['email'], '.')){
            $errores['email'] = '* El gmail debe tener un .';
        }

        if(empty($datos['password'] ?? '')){
            $errores['password'] = '* La contraseña es requerida';
        } elseif(strlen($datos['password']) < 6){
            $errores['password'] = '* La contraseña debe contener al menos 6 caracteres';
        }
        return $errores;
    }
}
?>