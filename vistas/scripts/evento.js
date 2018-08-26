var tabla;

var titulo = $('#titulo');
var descripcion = $('#descripcion');
var imagen = $('#imagen');
var categoria = $('#categoria');
var fecha = $('#fecha');
var horaI = $('#horaI');
var horaF = $('#horaF');
var ubicacion = $('#ubicacion');
var tipo = $('#tipo');


function init() {
    listar();
    mostrarform(false);
    $("#formulario").on("submit",function(e){
        guardaryeditar(e);})
    $("#imagenmuestra").hide();
    //Validar imagen
    $("#imagen").change(function () {
        var val = $(this).val();
        switch (val.substring(val.lastIndexOf('.') + 1).toLowerCase()) {
            //Permitidos
            case 'jpg':
            case 'png':
            case 'jpeg':
                break;
            default:
                $(this).val('');
                alert("Error: Seleccione un archivo JPG o PNG");
                break;
        }
    });
}

//funcion para guardar y editar
function guardaryeditar(e){
    e.preventDefault();
    $('#btnGuardar').prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);
    $.ajax({
        url: "../ajax/evento.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos){
            bootbox.alert(datos);
            mostrarform(false),
                tabla.ajax.reload();
        }
    });
    limpiar();
}

function mostrarform(flag){
    limpiar();
    if (flag) {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled", false);
        $("#btnagregar").hide();
    }
    else
    {
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
        $("#btnagregar").show();
    }
}

function cancelarform(){
    limpiar();
    mostrarform(false);
}

function limpiar(){
    $("#id").val("");
    $("#titulo").val("");
    $("#descripcion").val("");
    $("#fecha").val("");
    $("#horaI").attr("src", "");
    $("#horaF").val("");
    $("#ubicacion").val("");
    $("#tipo").val("");
}


function listar(){    
    tabla=$('#tbllistado').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons:[
        ],
        "ajax":{
            url: "../ajax/evento.php?op=listar",
            type: "get",
            dataType: "json",
            error: function(e){
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLenght": 5, //paginacion por pagina
        "order":[[0,"desc"]]
    }).DataTable();
}

//Desactivar articulo
function eliminar(id){
    //Caja de confirmacion tipo bootbox
    bootbox.confirm("¿Esta seguro de eliminar el evento", function(result){
        if(result){
            $.post("../ajax/evento.php?op=eliminar", {id : id}, function(e){
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    })
}

function mostrar(id) {
    $.post("../ajax/evento.php?op=mostrar",{id : id}, function(data,status)
    {
        data = JSON.parse(data);
        mostrarform(true);
        $("#id").val(data.id);
        $("#titulo").val(data.titulo);
        $("#descripcion").val(data.descripcion);
        $("#categoria").val(data.categoria);
        $("#fecha").val(data.fecha);
        $("#horaI").val(data.horaI);
        $("#horaF").val(data.horaF);
        $("#ubicacion").val(data.ubicacion);
        $("#tipo").val(data.tipo);
        $("#imagenactual").val(data.imagen);
        $("#imagenactual").show();
        $("#imagenmuestra").attr("src", "../uploads/eventos/"+data.imagen);
        $("#btnGuardar").html('Actualizar');
    })
}   

init();