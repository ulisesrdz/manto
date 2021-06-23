<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar Proveedores
        <small>Panel de Control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        
        <li class="active">Administrar Proveedores</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          
              <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProveedor">
                
                Agregar Proveedor
              
              </button>
          
         
        </div>
        <div class="box-body">
         
            <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
              
              <thead>
                
                <tr>
                  
                  <th style="width: 10px">#</th>
                  <th>Nombre</th>                 
                  <th>RFC</th>                 
                  <th>Documento</th>
                  <th>Email</th>
                  <th>Telefono</th>
                  <th>Direccion</th>
                  <th>Fecha Nacimiento</th>
                  <th>Total Compras</th>
                  <th>Ultima Compra</th>
                  <th>Ingreso al Sistema</th>
                  <th>Acciones</th>

                </tr>

              </thead>
            <tbody>
                
              
                <?php

                    $item = null;
                    $valor = null;

                    $proveedores = ControladorProveedores::ctrMostrarProveedor($item, $valor);

                    foreach ($proveedores as $key => $value) {

                       echo ' <tr>

                          <td>'.($key+1).'</td>

                          <td class="text-uppercase">'.$value["nombre"].'</td>

                          <td> '.$value["RFC"].'</td>

                          <td> '.$value["documento"].'</td>

                          <td> '.$value["email"].'</td>

                          <td> '.$value["telefono"].'</td>

                          <td> '.$value["direccion"].'</td>

                          <td> '.$value["fecha_nacimiento"].'</td>

                          <td> '.$value["compras"].'</td>

                          <td> '.$value["ultima_compra"].'</td>

                          <td> '.$value["fecha"].'</td>

                          <td>

                            <div class="btn-group">
                          
                              <button class="btn btn-warning btnEditarProveedor" data-toggle="modal" data-target="#modalEditarProveedor" idProveedor="'.$value["id"].'"><i class="fa fa-pencil"></i></button>

                              <button class="btn btn-danger btnEliminarProveedor" idProveedor="'.$value["id"].'"><i class="fa fa-times"></i></button>

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
          Agregar Clientes Ventana  Modal
======================================-->
 
<div id="modalAgregarProveedor" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

<!--Formulario-->
<form role="form" method="post" >

      <!--=====================================
                  CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Proveedor</h4>
        </div>

        <!--=====================================
                  CUERPO DEL MODAL
        ======================================-->
        
        <div class="modal-body">
          <div class="box-body">
            
              

              <!-- Entrada Nombre-->
            <div class="form-group"> 
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoProveedor" placeholder="Ingresar Nombre" required>
              </div>
            </div>

             <!-- Entrada RFC-->
            <div class="form-group"> 
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoRFC" id="nuevoRFC" required>
              </div>
            </div>

            <!-- Entrada Documento ID-->

            <div class="form-group"> 
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="number" min="0" class="form-control input-lg" name="nuevoDocumentoId" placeholder="Entrada Docmento" required>
              </div>
            </div>
          <!-- Entrada Email-->

            <div class="form-group"> 
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar Email" required>
              </div>
            </div>

             <!-- Entrada Telefono-->

            <div class="form-group"> 
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar Telefono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>
              </div>
            </div>

             <!-- Entrada Direccion-->

            <div class="form-group"> 
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoDireccion" placeholder="Ingresar Direccion" required>
              </div>
            </div>

             <!-- Entrada Fecha Nacimiento-->

            <div class="form-group"> 
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" class="form-control input-lg" name="nuevaFechaNacimiento" placeholder="Ingresar fecha nacimiento" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>
              </div>
            </div>

          </div>
        </div>

         <!--=====================================
        PIE DEL MODAL
        ======================================-->

          <div class="modal-footer">

            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-primary">Guardar Proveedor</button>

          </div>
       
        
      
    </form>
      <?php

          $crearProveedor = new ControladorProveedores();
          $crearProveedor -> ctrCrearProveedor();
      ?>

    </div>
  </div>
</div>


<!--=====================================
          Editar Clientes Ventana  Modal
======================================-->
 
<div id="modalEditarProveedor" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

<!--Formulario-->
<form role="form" method="post" >

      <!--=====================================
                  CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Proveedor</h4>
        </div>

        <!--=====================================
                  CUERPO DEL MODAL
        ======================================-->
        
        <div class="modal-body">
          <div class="box-body">
            
              

              <!-- Entrada Nombre-->
            <div class="form-group"> 
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="editarProveedor" id="editarProveedor" required>
                 <input type="hidden" id="idProveedor" name="idProveedor">
              </div>
            </div>

             <!-- Entrada RFC-->
            <div class="form-group"> 
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="text" class="form-control input-lg" name="editarRFC" id="editarRFC" required>
              </div>
            </div>

            <!-- Entrada Documento ID-->

            <div class="form-group"> 
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="number" min="0" class="form-control input-lg" name="editarDocumentoId" id="editarDocumentoId" required>
              </div>
            </div>
          <!-- Entrada Email-->

            <div class="form-group"> 
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="email" class="form-control input-lg" name="editarEmail" id="editarEmail" required>
              </div>
            </div>

             <!-- Entrada Telefono-->

            <div class="form-group"> 
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                <input type="text" class="form-control input-lg" name="editarTelefono" id="editarTelefono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>
              </div>
            </div>

             <!-- Entrada Direccion-->

            <div class="form-group"> 
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="text" class="form-control input-lg" name="editarDireccion" id="editarDireccion" required>
              </div>
            </div>

             <!-- Entrada Fecha Nacimiento-->

            <div class="form-group"> 
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" class="form-control input-lg" name="editarFechaNacimiento" id="editarFechaNacimiento" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>

              </div>
            </div>

          </div>
        </div>

         <!--=====================================
        PIE DEL MODAL
        ======================================-->

          <div class="modal-footer">

            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-primary">Guardar Cambios</button>

          </div>
       
        
      
    </form>
      <?php

          $editarProveedor = new ControladorProveedores();
          $editarProveedor -> ctrEditarProveedor();
      ?>

    </div>
  </div>
</div>

 <?php

  $borrarProveedor = new ControladorProveedores();
  $borrarProveedor -> ctrBorrarProveedor();

?>