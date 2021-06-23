<?php


require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/categorias.controlador.php";
require_once "controladores/productos.controlador.php";
require_once "controladores/ventas.controlador.php";
require_once "controladores/compras.controlador.php";
require_once "controladores/clientes.controlador.php";
require_once "controladores/maquinas.controlador.php";
require_once "controladores/mantenimiento.controlador.php";
require_once "controladores/informacion.controlador.php";
require_once "controladores/grupos.controlador.php";


require_once "modelos/usuarios.modelo.php";
require_once "modelos/categorias.modelo.php";
require_once "modelos/productos.modelo.php";
require_once "modelos/ventas.modelo.php";
require_once "modelos/compras.modelo.php";
require_once "modelos/clientes.modelo.php";
require_once "modelos/maquinas.modelo.php";
require_once "modelos/mantenimiento.modelo.php";
require_once "modelos/informacion.modelo.php";
require_once "modelos/grupos.modelo.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();
