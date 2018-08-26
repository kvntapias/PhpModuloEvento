<?php
	require "../config/conexion.php";
	Class Evento{
		public function __construct(){}
		//Insertar
		public function insertar(
			$titulo,$categoria,$imagen,$descripcion,$fecha,$horaI,$horaF,$ubicacion,$tipo){
		$sql="INSERT INTO Evento (titulo,categoria,imagen,descripcion,fecha,horaI,horaF,ubicacion,tipo)
				VALUES ('$titulo', '$categoria','$imagen','$descripcion', '$fecha', '$horaI','$horaF', '$ubicacion', '$tipo')";
				return ejecutarConsulta($sql);
		}
		//Actualizar
		public function editar($id,$titulo,$categoria,$imagen,$descripcion,$fecha,$horaI,$horaF,$ubicacion,$tipo){
			$sql="UPDATE Evento SET 
			titulo ='$titulo', 
			categoria='$categoria',
			imagen='$imagen',
			descripcion = '$descripcion',
			fecha = '$fecha',
			horaI = '$horaI',
			horaF = '$horaF',
			ubicacion = '$ubicacion',
			tipo = '$tipo'
			where id = '$id'";
			return ejecutarConsulta($sql);
		}
		//Eliminar
		public function eliminar($id){
			$sql="DELETE FROM Evento where id='$id'";
			return ejecutarConsulta($sql);
		}

		//Mostrar datos de un evento a modificar
		public function mostrar($id){
			$sql="SELECT * FROM Evento WHERE id='$id'";
			return ejecutarConsultaSimplefila($sql);
		}
		//Mostrar todos
		public function listar(){
			$sql = "SELECT * FROM Evento";
			return ejecutarConsulta($sql);
		}

	}
?>