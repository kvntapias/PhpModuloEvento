<?php
//Conexion a la BD
require "../config/conexion.php";
Class Usuario
{
    public function __construct()
    {
    }
 	//login
    public function login($user, $pass){
        $sql="SELECT id,nombre,usuario FROM Usuario WHERE usuario='$user' AND contraseña='$pass'";
        return ejecutarConsulta($sql);
    }
}
?>