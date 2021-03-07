<?php

  //define('BASEDIR', __DIR__);

  define('APP', "inventario2");   //nombre de mi aplicacion, la tomo como base, localhost no es necesario

  //Controlador frontal
  
  $cop = $_GET["cop"]??"mostrar";
  $con = $_GET["con"]??"Puesto";

  $nombre = "{$con}Controller";   

  require_once "controladores/{$nombre}.php";  

  $controlador = new $nombre;

  if (!method_exists($controlador, $cop))    
    throw new Exception("la operacion no existe");

  $controlador->$cop();

