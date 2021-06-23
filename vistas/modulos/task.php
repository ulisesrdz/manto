<?php 
$orden = "0";
$datos = "0";
$idInformacion = "0";
?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Tareas
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Tareas Asignadas</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary btnRegresarOrden" data-toggle="modal" data-target="#modalAgregarInformacion">
          <i class="fa fa-arrow-left"></i>
         Regresar

        </button>

        <?php 
          echo '<button class="btn btn-primary btnAgregarTarea" idInformacion= "'.$_GET["idInforme"].'" data-toggle="modal" data-target="#modalAgregarTarea">
          <i class="fa fa-plus"></i>
          Agregar Tarea

        </button> ';        
        ?>
      </div>      

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
          	<th>Tarea</th>           
            <th>Acciones</th> 
         </tr> 

        </thead>

        <tbody>

        <?php          

        $item="idMtto";
        $valor=$_GET["idInforme"];


          $informacion = ControladorMantenimiento::ctrMostrarTareas($item, $valor);
          //var_dump($informacion);
          foreach ($informacion as $key => $value) {
           

           
             echo ' <tr>

                     <td>'.($key+1).'</td>

                     <td class="text-uppercase">'.$value["tarea"].'</td>
                      
                     <td>

                      <div class="btn-group">
                         
                        <button class="btn btn-danger btnEliminarTarea" idTask="'.$value["id"].'" idInforme="'.$value["idMtto"].'"><i class="fa fa-times"></i></button>

                      </div>  

                    </td>

                  </tr>';
           }
           
          

        ?>

        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
		MODAL AGREGAR TAREA
======================================-->

<div id="modalAgregarTarea" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Tarea</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


            <!--Entrada Serie-->
             <div class="form-group"> 
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="nuevaTarea" name="nuevaTarea" placeholder="Descripcion de la tarea" required>
                <input type="hidden" id="idInformacion" name="idInformacion">
              </div>
            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Tarea</button>

        </div>

        <?php
          
          $crearInformacion = new ControladorMantenimiento();
          $crearInformacion -> ctrIngresarTarea();

        ?>

      </form>

    </div>

  </div>

</div>

 <?php

  $borrarTarea = new ControladorMantenimiento();
  $borrarTarea -> ctrBorrarTarea();

?>