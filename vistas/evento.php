<?php
//almacenamiento en buffer
ob_start();
//iniciamos las sesiones
session_start();
//Si no existe la session
if (!isset($_SESSION["nombre"])) {
  //Lo enviamos al login
    header("location: login.html");
  }else

{
require 'header.php';
?>
<!--Contenido-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">

                        <h1 class="box-title">Evento
                            <button id="btnagregar" class="btn btn-success" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                            <thead>
                            <!--celdas-->
                            <th>Titulo</th>
                            <th>Categoria</th>
                            <th>Imagen</th>
                            <th>Descripcion</th>
                            <th>Fecha</th>
                            <th>Inicio</th>
                            <th>Fin</th>
                            <th>Ubicacion</th>
                            <th>Tipo</th>
                            <th>Opciones</th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <!--FORM PUBLICAR-->
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label> Titulo(*):</label>
                                <input type="hidden" name="id" id="id">
                                <input type="text" class="form-control" name="titulo" id="titulo" maxlength="100" placeholder="Titulo" required>
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label> Categoria(*):</label>
                                <select id="categoria" name="categoria"  required>
                                    <option value="Deportes">Deportes</option>
                                    <option value="Entretenimiento">Entretenimiento</option>
                                    <option value="Festival">Festival</option>
                                    <option value="Concierto">Concierto</option>
                                    <option value="Teatro">Teatro</option>
                                    <option value="Tecnologia">Tecnologia</option>
                                </select>
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Imagen</label>

                                <input type="file" class="form-control" name="imagen" id="imagen">
                                <input type="hidden" name="imagenactual" id="imagenactual">
                                <img src="" width="150px" height="120px" id="imagenmuestra">
                                
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Descripcion</label>
                                <input type="text" class="form-control" name="descripcion" id="descripcion" maxlength="256" placeholder="Descripcion">
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label> Fecha(*):</label>
                                <input type="date" class="form-control" name="fecha" id="fecha" required>
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label> Hora Inicio(*):</label>
                                <input type="time" class="form-control" name="horaI" id="horaI" required>
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label> Hora fin(*):</label>
                                <input type="time" class="form-control" name="horaF" id="horaF" required>
                            </div>
                            
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label> Ubicacion(*):</label>
                                <input type="text" class="form-control" name="ubicacion" id="ubicacion" maxlength="100" placeholder="Ubicación" required>
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label> Tipo(*):</label>
                                <select id="tipo" name="tipo"  required>
                                    <option value="Gratuito">Gratuito</option>
                                    <option value="Pago">Pago</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>Publicar</button>
                                <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arroww-circle-left"></i> Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<?php

require 'footer.php';
?>
<!--libreria para generar codigos de barras-->
<script  src="../public/js/JsBarcode.all.min.js" type="text/javascript"></script>
<script src="../public/js/jquery.PrintArea.js" type="text/javascript"></script>
<script src="scripts/evento.js" type="text/javascript"></script>
<?php 
  }
  //liberamos el buffer
  ob_end_flush();
?>
