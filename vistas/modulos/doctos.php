<div class="content-wrapper">

	<section class="content-header">
    
    <h1>
      	
      	Visualizar Documentos
		    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Visualizar Documentos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <!--<button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarInformacion">-->
          
        <!--  Agregar Informacion-->

        <!--</button>-->

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Folio</th>
           <th>Num Maquina</th>
           <th>Frecuencia</th>
           <th>Tipo Mtto</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php          

          $informacion = ControladorMantenimiento::ctrMostrarDoctos();
          
          foreach ($informacion as $key => $value) {
           $tipoDocto = '';
           if($value["tipoDocumento"] == 'P'){
           		$tipoDocto = 'Preventivo';
           }elseif ($value["tipoDocumento"] == 'C') {
           	   	$tipoDocto = 'Correctivo';
           }elseif ($value["tipoDocumento"] == 'T') {
           		$tipoDocto = 'Troubleshooting';
           }
			

            echo ' <tr>

                    <td>'.($key+1).'</td>

                    <td class="text-uppercase">'.$value["nomenclatura"].'</td>
                    <td class="text-uppercase">'.$value["numMaquina"].'</td>
                    <td class="text-uppercase">'.$value["descripcion"].'</td>
                    <td class="text-uppercase">'.$tipoDocto.'</td>
                    
                    <td>

                      <div class="btn-group">
                          <button class="btn btn-info btnImpimirDocto" id="'.$value["id"].'" nomenclatura="'.$value["nomenclatura"].'" tipoDocto="'.$value["tipoDocumento"].'" data-toggle="modal" data-target="#modalAgregarTarea"><i class="fa fa-print"></i></button>
                         
                          
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