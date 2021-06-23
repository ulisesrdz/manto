
<div class="content-wrapper">
<section class="content-header">
      <h1>
        Configuracion
        <small>Panel de Control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        
        <li class="active">Administrar Usuarios</li>
      </ol>
    </section>

    <section class="content">
    	<div class="box">
    		<div class="box-header with-border">
          
              <button class="btn btn-primary" data-toggle="modal" data-target="#modalModificarEmpresa">
                
                Modificar Configuracion
              
              </button>
          
         
        	</div>
<!-- Body -->
        <div class="box-body">
         
            <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
              
              <thead>
                
                <tr>
                  
                  <th style="width: 10px">#</th>
                  <th>Nombre Empresa</th>
                  <th>Fecha de Inicio</th>
                  <th>Logo</th>
                  <th>RFC</th>                  
                  <th>Acciones</th>

                </tr>

              </thead>
            <tbody>
                

                <?php
                  $item = null;
                  $valor = null;

                  $informacion = ControladorInformacion::ctrMostrarInformacion($item,$valor);
//var_dump($informacion);
                  foreach ($informacion as $key => $value) {
                      echo '<tr>
                  
                      <td>'.($key + 1).'</td>
                      <td>'.$value["nombre"].'</td>
                      <td>'.$value["diaCreacion"].'</td>';

                      if($value["imagenWeb"] != ""){
                        echo '<td><img src="'.$value["imagenWeb"].'" class="img-thumbnail" width="40px"></td>';
                      }
                      else{
                        echo '<td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px"></td>';
                      }

                      
                      echo '<td>'.$value["rfc"].'</td>';
                      
                      echo '<td>
                        
                        <div class="btn-group">

                          <button class="btn btn-warning btnEditarEmpresa" idEmpresa="'.$value["id"].'" btnEditarEmpresa data-toggle="modal" data-target="#modalEditarEmpresa"><i class="fa fa-pencil"></i></button>        
                           
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
                 Ventana Modal
        ======================================-->
<div id="modalModificarEmpresa" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">


        <form role="form" method="post" enctype="multipart/form-data">

      <!--=====================================
                  CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Datos de Empresa</h4>
        </div>

        <!--=====================================
                  CUERPO DEL MODAL
        ======================================-->
        <!-- Entrada Nombre Empresa-->
        <div class="modal-body">
          <div class="box-body">
            <div class="form-group"> 
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-dashboard"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Nombre de la Empresa" required>
              </div>
            </div>

            <!-- Entrada RFC-->
            <div class="form-group"> 
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-dashboard"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoRfc" placeholder="RFC" required>
              </div>
            </div>

            <!-- Entrada Fecha-->

            <div class="form-group"> 
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <datepicker date-format="mediumDate">
                <input type="date" id="start" name="nuevaFecha" 
				      >
             </datepicker>
				       <!-- min="2018-01-01" max="2018-12-31"> -->
              </div>
            </div>
                     
            
            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel">SUBIR FOTO EN FORMATO PNG</div>

              <input type="file" class="nuevaFoto" accept="img/png" name="nuevaFoto">

              <p class="help-block">Peso máximo de la foto 2MB</p>

              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

            </div>

          </div>

        </div>

       <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Cambios</button>

        </div>

       
       <?php

          $crearInformacion = new ControladorInformacion();
          $crearInformacion -> ctrCrearInformacion();
        ?> 

        </form>
    </div>
  </div>
</div>

<!--=====================================
            Editar Informacion
  ======================================-->

<div id="modalEditarEmpresa" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

<!--Formulario-->
<form role="form" method="post" enctype="multipart/form-data">

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
        <!-- Entrada Nombre Empresa-->
        <div class="modal-body">
          <div class="box-body">
            <div class="form-group"> 
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-dashboard"></i></span>
                <input type="text" class="form-control input-lg" id="Nombre" name="Nombre" value="" required>
                <input type="hidden"  name="idEmpresa" id="idEmpresa" required>
              </div>
            </div>

            <!-- Entrada RFC-->
             <div class="form-group"> 
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-dashboard"></i></span>
                <input type="text" class="form-control input-lg" id="editarRfc" name="editarRfc" value="" required>
              </div>
            </div> 

            <!-- Entrada Fecha-->

            <div class="form-group"> 
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                
                <input type="text" id="editarFecha" name="editarFecha" readonly="true" >
             
              </div>
            </div>
            
            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel">SUBIR FOTO</div>

              <input type="file" class="nuevaFoto" accept="img/png" name="editarFoto">

              <p class="help-block">Peso máximo de la foto 2MB</p>

              <img src="vistas/img/empresa/logomaintenance.png" class="img-thumbnail previsualizar" width="100px">
              
              <input type="hidden" name="fotoActual" id="fotoActual">
            
            </div>

          </div>

        </div>

       <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Modificar Informacion</button>

        </div>

            <?php

              $editarInformacion = new ControladorInformacion();
              $editarInformacion -> ctrEditarInformacion();

            ?>

    </form>
    </div>
  </div>
</div>