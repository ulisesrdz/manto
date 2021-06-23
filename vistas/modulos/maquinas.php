<div class="content-wrapper">

  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar Maquinas
        <small>Panel de Control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        
        <li class="active">Administrar Maquinas</li>
      </ol>
    </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarMaquinas">
          
          Agregar Maquina

        </button>

      </div>
 
       <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Num Maquina</th>
           <th>Descripcion Grupo</th>
           <th>Modelo</th>
           <th>Serie</th>
           <th>Fecha de Crea.</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $maquinas = ControladorMaquinas::ctrMostrarMaquinas($item, $valor);

          foreach ($maquinas as $key => $value) {
           
            echo ' <tr>

                    <td>'.($key+1).'</td>

                    <td class="text-uppercase">'.$value["numMaquina"].'</td>
                    <td class="text-uppercase">'.$value["descripcion"].'</td>
                    <td class="text-uppercase">'.$value["modelo"].'</td>
                    <td class="text-uppercase">'.$value["serie"].'</td>
                    <td class="text-uppercase">'.$value["df"].'</td>
                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning btnEditarMaquina" idMaquina="'.$value["idMaquina"].'" data-toggle="modal" data-target="#modalEditarMaquinas"><i class="fa fa-pencil"></i></button>

                        <button class="btn btn-danger btnEliminarMaquina" idMaquina="'.$value["idMaquina"].'"><i class="fa fa-times"></i></button>

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

<div id="modalAgregarMaquinas" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Maquina</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaNumMaquina" placeholder="Ingresar #Maquina" required>

              </div>

            </div>

             <div class="form-group"> 
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="nuevaWB" placeholder="Ingresar #WB" required>
              </div>
            </div>

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

            <div class="form-group"> 
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="nuevaModelo" placeholder="Ingresar Modelo" required>
              </div>
            </div>

            <div class="form-group"> 
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="nuevaMarca" placeholder="Ingresar Marca" required>
              </div>
            </div>

            <div class="form-group"> 
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="nuevaArea" placeholder="Ingresar Area" required>
              </div>
            </div>


            <div class="form-group"> 
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="nuevaVS" placeholder="Ingresar VS" required>
              </div>
            </div>

            <div class="form-group"> 
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="nuevaSerie" placeholder="Ingresar Serie" required>
              </div>
            </div>

            <div class="form-group"> 
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="nuevaVoltaje" placeholder="Ingresar Voltaje" required>
              </div>
            </div>

            <div class="form-group"> 
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="nuevaFase" placeholder="Ingresar Fase" required>
              </div>
            </div>

            <div class="form-group"> 
              <div class="input-group">
                 <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <datepicker date-format="mediumDate">
                <input type="date" id="start" name="nuevaDF">
             </datepicker>
              </div>
            </div>

           </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Maquina</button>

        </div>

        <?php

          $crearMaquina = new ControladorMaquinas();
          $crearMaquina -> ctrCrearMaquina();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR MAQUINA
======================================-->

 <div id="modalEditarMaquinas" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">


        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Maquinas</h4>

        </div>

       

        <div class="modal-body">

          <div class="box-body">           
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="editarNumMaquina" id="editarNumMaquina" required>

                 <input type="hidden" id="idMaquina" name="idMaquina">

              </div>

            </div>
  

            <div class="form-group"> 
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="editarWB" id="editarWB" placeholder="Ingresar #WB" required>
              </div>
            </div>

          
            
             <div class="form-group">
              
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg" id="editarIdGrupo"  name="editarIdGrupo" required>                 

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
  
            <div class="form-group"> 
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" id="editarModelo" name="editarModelo" placeholder="Ingresar Modelo" required>
              </div>
            </div>

            <div class="form-group"> 
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" id="editarMarca" name="editarMarca" placeholder="Ingresar Marca" required>
              </div>
            </div>

            <div class="form-group"> 
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" id="editarArea" name="editarArea" placeholder="Ingresar Area" required>
              </div>
            </div>


            <div class="form-group"> 
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" id="editarVS" name="editarVS" placeholder="Ingresar VS" required>
              </div>
            </div>

            <div class="form-group"> 
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" id="editarSerie" name="editarSerie" required>
              </div>
            </div>

            <div class="form-group"> 
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="editarVoltaje" id="editarVoltaje" placeholder="Ingresar Voltaje" required>
              </div>
            </div>

            <div class="form-group"> 
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="editarFase" id="editarFase" placeholder="Ingresar Fase" required>
              </div>
            </div>

            <div class="form-group"> 
             <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </span>
                <input type="text" data-plugin-datepicker class="form-control" id="editarDF" readonly="true">
              </div>
            </div>
          </div>

        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>

      <?php

          $editarMaquina = new ControladorMaquinas();
          $editarMaquina -> ctrEditarMaquinas();

        ?> 

      </form> 

    </div>

  </div> 

</div>

<?php

  $borrarMaquina = new ControladorMaquinas();
  $borrarMaquina -> ctrBorrarMaquinas();

?> 


