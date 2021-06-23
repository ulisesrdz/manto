<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar  Mantenimiento Preventivo
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Mantenimiento Preventivo</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarInformacion">
          
          Agregar Informacion

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Tipo Mtto</th>
           <th>Descripcion</th>
           <th>Frecuencia</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php          

          $informacion = ControladorMantenimiento::ctrMostrarInformacion();
          
          foreach ($informacion as $key => $value) {
           
            echo ' <tr>

                    <td>'.($key+1).'</td>

                    <td class="text-uppercase">Preventivo</td>
                    <td class="text-uppercase">'.$value["descripcionG"].'</td>
                    <td class="text-uppercase">'.$value["descripcion"].'</td>

                    <td>

                      <div class="btn-group">
                       
                           <button class="btn btn-warning btnMostrarTarea" idInforme="'.$value["id"].'" ><i class="fa fa-plus"></i></button>                      
                        
                          <button class="btn btn-danger btnEliminarInforme" idInforme="'.$value["id"].'"><i class="fa fa-times"></i></button>
                          
                          

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
MODAL AGREGAR MAQUINA
======================================-->

<div id="modalAgregarInformacion" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Informacion</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

           <!--Entrada TipoMtto-->
             <!--  <div class="form-group">
              
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" id="nuevaCategoria"  name="nuevaCategoria" required>
                  
                 

                  <option value="">Seleccione Tipo de Mtto</option>

                  <?php
                     $item = null;
                     $valor = null;
                     $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
                     foreach ($categorias as $key => $value) {
                       echo '<option value="'.$value["id"].'">'.$value["categoria"].'</option>';
                     }

                  ?>

                  
                </select>

              </div> 

            </div> -->
             <!--Entrada Periodo-->
              <div class="form-group">
              
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" id="nuevoPeriodo"  name="nuevoPeriodo" required>
                  
                 

                  <option value="">Seleccione el Periodo de Frecuencia</option>

                  <?php
                     
                     $periodo = ControladorMantenimiento::ctrMostrarPeriodo();
                     foreach ($periodo as $key => $value) {
                       echo '<option value="'.$value["id"].'">'.$value["descripcion"].'</option>';
                     }

                  ?>

                  
                </select>

              </div>

            </div>

             <!--Entrada Maquina-->
            <div class="form-group">
              
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" id="idGrupo"  name="idGrupo" required>
                  
                 

                  <option value="">Asignar Grupo</option>

                  <?php
                     $item = null;
                     $valor = null;
                     $grupos = ControladorGrupos::ctrMostrarGrupos($item, $valor);
                     foreach ($grupos as $key => $value) {
                       echo '<option value="'.$value["idGrupo"].'">'.$value["descripcion"].'</option>';
                     }

                  ?>

                  
                </select>

              </div>

            </div>

             

            <!--Entrada Serie-->
             
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Informacion</button>

        </div>

        <?php

          $crearInformacion = new ControladorMantenimiento();
          $crearInformacion -> ctrIngresarInformacion();

        ?>

      </form>

    </div>

  </div>

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
                <input type="text" class="form-control input-lg" name="nuevaTarea" placeholder="Descripcion de la tarea" required>
                <input type="hidden" id="idInform" name="idInform">
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
          //var_dump($_POST["idInformacion"]);
          $crearInformacion = new ControladorMantenimiento();
          $crearInformacion -> ctrIngresarTarea();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL MOSTRAR TAREAS
======================================-->

<div id="modalMostrarTarea" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Tarea4</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="box-body">


           <!--Entrada Serie-->
             <div class="form-group"> 
              <div class="input-group">                
                
                   <input type="text" id="idInformacionTarea" name="idInformacionTarea"> 

                
              </div>
            </div>
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Tarea</th>
           <th>Estado</th>           

         </tr> 

        </thead>

        <tbody>

        <?php          

          $item = "idMtto";
          $val  = $_SESSION["nombre"];
         

        ?> 

        </tbody>

       </table>

      </div>

      </form>

    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR INFORME
======================================-->
<div id="modalEditarInformacion" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Informacion</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

           <!--Entrada TipoMtto-->
              <div class="form-group">
              
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="hidden" id="editarIdInformacion" name="editarIdInformacion"> 
                <select class="form-control input-lg" id="editarCategoria"  name="editarCategoria" required>                 

                  <option value="">Seleccione Tipo de Mtto</option>

                  <?php
                     $item = null;
                     $valor = null;
                     $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
                     foreach ($categorias as $key => $value) {
                       echo '<option value="'.$value["id"].'">'.$value["categoria"].'</option>';
                     }

                     

                  ?>
                  
                </select>

              </div>

            </div>
             <!--Entrada Periodo-->
              <div class="form-group">
              
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" id="editarPeriodo"  name="editarPeriodo" required>
                  
                 

                  <option value="">Seleccione el Periodo de Frecuencia</option>

                  <?php
                     
                     $periodo = ControladorMantenimiento::ctrMostrarPeriodo();
                     foreach ($periodo as $key => $value) {
                       echo '<option value="'.$value["id"].'">'.$value["descripcion"].'</option>';
                     }

                  ?>

                  
                </select>

              </div>

            </div>

             <!--Entrada Maquina-->
              <div class="form-group">
              
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" id="editarNumMaq"  name="editarNumMaq" required>
                  
                 

                  <option value="">Seleccione Maquina</option>

                  <?php
                     $item = null;
                     $valor = null;
                     $maquinas = ControladorMaquinas::ctrMostrarMaquinas($item, $valor);
                     foreach ($maquinas as $key => $value) {
                       echo '<option value="'.$value["idMaquina"].'">'.$value["numMaquina"].'</option>';
                     }


                  ?>

                  
                </select>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Informacion</button>

        </div>

        <?php

          $editarInformacion = new ControladorMantenimiento();
          $editarInformacion -> ctrEditarInforme();

        ?>

      </form>

    </div>

  </div>

</div>


<?php

      $borrarInforme = new ControladorMantenimiento();
      $borrarInforme -> ctrBorrarInforme();

?>
