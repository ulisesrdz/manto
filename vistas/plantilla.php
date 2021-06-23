<?php
session_start();
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Maintenance APP</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="icon"  href="vistas/img/plantilla/icono-negro.png">
<!--==========================================
  Pluggin de CCS
  ===========================================-->
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="vistas/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="vistas/dist/css/skins/_all-skins.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

   <!-- DataTables -->
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
 <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">
  
<!-- iCheck -->
  <link rel="stylesheet" href="vistas/plugins/iCheck/all.css">


<link rel="stylesheet" href="vistas/bower_components/bootstrap-daterangepicker/daterangepicker.css">

<!-- Morris chart -->
<link rel="stylesheet" href="vistas/bower_components/morris.js/morris.css">

<!--==========================================
  Pluggin de JAVASCRIPT
  ===========================================-->
<!-- jQuery 3 -->
<script src="vistas/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="vistas/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="vistas/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="vistas/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="vistas/dist/js/adminlte.min.js"></script>

  <script src="vistas/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/datatables.responsive.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>


  <!-- SweetArlert2-->
  
  <script src="vistas/plugins/sweetAlert2/sweetalert2.all.js"></script>

   <!-- iCheck -->
  <script src="vistas/plugins/iCheck/icheck.min.js"></script>

<!-- InputMask-->
  <script src="vistas/plugins/input-mask/jquery.inputmask.js"></script>
  <script src="vistas/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="vistas/plugins/input-mask/jquery.inputmask.extensions.js"></script>
  
  <!-- JQueryNumber-->
  <script src="vistas/plugins/JQueryNumber/jquerynumber.min.js"></script>
  
    <!-- dateRangePicker-->
  <script src="vistas/bower_components/moment/min/moment.min.js"></script>
  <script src="vistas/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    

    <!-- Morris.js charts-->
    <script src="vistas/bower_components/raphael/raphael.min.js"></script>
    <script src="vistas/bower_components/morris.js/morris.min.js"></script>

    <!-- Chart.js charts-->
    <script src="vistas/bower_components/chart.js/Chart.js"></script>

</head>

<!--==========================================
  Cuerpo Documento
  ===========================================-->

<body class="hold-transition skin-blue sidebar-collapse sidebar-mini login-page">
<!-- Site wrapper -->


  

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  

  <!-- =============================================== -->
<?php
if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"]="ok"){
    echo '<div class="wrapper">';

    /*================================
    =            Cabezote            =
    ================================*/

    include "modulos/cabezote.php";

    /*============================
    =            Menu            =
    ============================*/
    include "modulos/menu.php";
    /*=================================
    =            Contenido            =
    =================================*/

    if (isset($_GET["ruta"])) {
        
      if (
          $_GET["ruta"] == "usuarios" ||
          $_GET["ruta"] == "categorias" ||         
          $_GET["ruta"] == "generarCodigoQR" ||
          $_GET["ruta"] == "maquinas" ||          
          $_GET["ruta"] == "mantenimiento" || 
          $_GET["ruta"] == "task" || 
          $_GET["ruta"] == "settings" || 
          $_GET["ruta"] == "doctos" ||
          $_GET["ruta"] == "descargar-archivo" || 
          $_GET["ruta"] == "grupos" || 
          $_GET["ruta"] == "salir" ) {
        include "modulos/".$_GET["ruta"].".php";
      }
      else{
        include "modulos/404.php";
      }
    }
    else{
      include "modulos/usuarios.php";
    }



    /*=================================
    =            Footer            =
    =================================*/

    include "modulos/footer.php";

    echo '</div>';
}else{
  include "modulos/login.php";
}
?>  

  <!-- Control Sidebar -->
<!-- ./wrapper -->

<script src="vistas/js/plantilla.js"> </script>
<script src="vistas/js/usuarios.js"></script>
<script src="vistas/js/categorias.js"></script>
<script src="vistas/js/productos.js"></script>
<script src="vistas/js/clientes.js"></script>
<script src="vistas/js/proveedores.js"></script>
<script src="vistas/js/ventas.js"></script>
<script src="vistas/js/compras.js"></script>
<script src="vistas/js/codigoQR.js"></script>
<script src="vistas/js/maquinas.js"></script>
<script src="vistas/js/tareas.js"></script>
<script src="vistas/js/reportes.js"></script>
<script src="vistas/js/informacion.js"></script>
<script src="vistas/js/grupos.js"></script>
</body>
</html>
