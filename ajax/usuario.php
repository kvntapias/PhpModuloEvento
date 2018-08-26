<?php
session_start();
require_once "../modelos/usuario.php";
	$usuario = new Usuario();
    switch ($_GET["op"]) {
    case 'login':
        //capturar datos del formulario
            $logina=$_POST['logina'];
            $clavea=$_POST['clavea'];
        //enviamos parametros al metodo login
        $rspta=$usuario->login($logina,$clavea);
        $fetch=$rspta->fetch_object();
        //si la respuesta no es vacia
        if (isset($fetch))
        {
            $_SESSION['idusuario']=$fetch->id;
            $_SESSION['nombre']=$fetch->nombre;
            $_SESSION['login']=$fetch->usuario;
        }
        echo json_encode($fetch);
        break;

        //LOGOUT
        case 'salir':
            //Limpiamos variablesd e sesion
            session_unset();
            //destruimos la sesion
            session_destroy();
            //redireccion al index
            header("location: ../index.php");
            break;
        }
?>