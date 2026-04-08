<?php
class User{
    public function validateUser($data){
        $conexion = new Conexion();
        $conexion->conectar();
        $sql = "SELECT * FROM users WHERE email = '$data[email]'";
        $conexion->query($sql);
        $result = $conexion->getResult();
        $conexion->deconectar();
        if($result->num_rows > 0){
            return 1;
        }
        return 0;
    }
 
    public function registerUser($data){
        $conexion = new Conexion();
        $conexion->conectar();
        $sql = "INSERT INTO users (name, email, password)
        VALUES ('$data[name]', '$data[email]', '$data[password]')";
        $conexion->query($sql);
        $filas = $conexion->getFilasAfectadas();
        $conexion->deconectar();
        return $filas;
    }
 
    public function loginUser($data){
        $conexion = new Conexion();
        $conexion->conectar();
        $sql = "SELECT * FROM users WHERE email = '$data[email]'";
        $conexion->query($sql);
        $result = $conexion->getResult();
        $conexion->deconectar();
        if($result->num_rows > 0){
            $user = $result->fetch_assoc();
            if(password_verify($data['password'], $user['password'])){
                return $user;
            }
        }
        return false;
    }
}
?>