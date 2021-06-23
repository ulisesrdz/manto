<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Tablero Principal
      
      <small>Panel de Control</small>
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Tablero</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="row">
      
    <?php

    if($_SESSION["perfil"] =="Administrador"){

      include "usuarios.php";

    }
    if($_SESSION["perfil"] =="Tecnico"){

      include "maquinas.php";

    }
    if($_SESSION["perfil"] =="Operador"){

      include "doctos.php";

    }

    ?>

    </div> 

     

  </section>
 
</div>
