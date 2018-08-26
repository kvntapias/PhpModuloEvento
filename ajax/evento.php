<?php
	require_once "../modelos/evento.php";
	$evento = new Evento();
	$id=isset($_POST["id"])?limpiarCadena($_POST["id"]):"";
	$titulo=isset($_POST["titulo"])?limpiarCadena($_POST["titulo"]):"";
	$categoria=isset($_POST["categoria"])?limpiarCadena($_POST["categoria"]):"";
	$imagen=isset($_POST["imagen"])?limpiarCadena($_POST["imagen"]):"";
	$descripcion=isset($_POST["descripcion"])?limpiarCadena($_POST["descripcion"]):"";
	$fecha=isset($_POST["fecha"])?limpiarCadena($_POST["fecha"]):"";
	$horaI=isset($_POST["horaI"])?limpiarCadena($_POST["horaI"]):"";
	$horaF=isset($_POST["horaF"])?limpiarCadena($_POST["horaF"]):"";
	$ubicacion=isset($_POST["ubicacion"])?limpiarCadena($_POST["ubicacion"]):"";
	$tipo=isset($_POST["tipo"])?limpiarCadena($_POST["tipo"]):"";

	switch ($_GET["op"]) {
		case 'guardaryeditar':
			if(!file_exists($_FILES['imagen']['tmp_name'])
				|| !is_uploaded_file($_FILES['imagen']['tmp_name']))
			{
				$imagen = $_POST["imagenactual"];
			} else{
				$ext = explode(".", $_FILES["imagen"]["name"]);
				//valida que sea tipo JPG,JPEG o PNG
				if (
				    $_FILES['imagen']['type'] == "image/jpg"||
                    $_FILES['imagen']['type'] == "image/jpeg" ||
                    $_FILES['imagen']['type'] == "image/png")
				{
					$imagen = round(microtime(true)). '.' . end($ext);
					move_uploaded_file($_FILES ["imagen"]['tmp_name'], "../uploads/eventos/".$imagen);
				}
			}
			if (empty($id)) {
				$rspta=$evento->insertar($titulo,$categoria,$imagen,$descripcion,$fecha,$horaI,$horaF,$ubicacion,$tipo);
				echo $rspta ? "Evento registrado" : "Error, no se pudo registrar";
			}
			else{
				$rspta=$evento->editar($id,$titulo,$categoria,$imagen,$descripcion,$fecha,$horaI,$horaF,$ubicacion,$tipo);
				echo $rspta ? "Evento Actualizado" : "Evento no actualizado";
			}
			break;

			case 'eliminar':
			$rspta=$evento->eliminar($id);
				echo $rspta ? "Evento eliminado" : "Evento no eliminado";
			break;

			case 'listar':
				$rspta=$evento->listar();
				//declarar array
				$data = array();
				while ($reg=$rspta->fetch_object()) {
					$data[]=array(
						"0"=>$reg->titulo,
						"1"=>$reg->categoria,
                        "2"=>"<img src='../uploads/eventos/".$reg->imagen."'height='40px' width='70px' >",
                        "3"=>$reg->descripcion,
                        "4"=>$reg->fecha,
                        "5"=>$reg->horaI,
                        "6"=>$reg->horaF,
                        "7"=>$reg->ubicacion,
                        "8"=>$reg->tipo,
                        "9"=>'<button onclick="mostrar('.$reg->id.')" class="btn btn-warning"><i class="fa fa-pencil"></i>Editar</button>'.
                        ' <button onclick="eliminar('.$reg->id.')" class="btn btn-danger"><i class="fa fa-close"></i>Eliminar</button>'
                    );
				}
				$results = array(
					"sEcho"=>1, //info para el datatable
					"iTotalRecords"=>count($data),
					"iTotalDisplayRecords"=>count($data),
					"aaData"=>$data);

				echo json_encode($results);
			break;

			case 'mostrar':
				$rspta=$evento->mostrar($id);
				echo json_encode($rspta);
			break;
	}
?>