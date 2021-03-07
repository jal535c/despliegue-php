<?php  

  /**
   * Crea una constante global para el nombre de la aplicación
   * 
   * @param string $name - El nombre de la constante
   * @param mixed $value - El valor de la constante 
   */
  define('APP', "inventario2");


  /**
   * Controlador Frontal
   * 
   * Recibe los parametros de la ruta introducida por url
   * 
   * @var string $cop - Código de operación
   * @var string $con - Nombre del controlador
   */
  $cop = $_GET["cop"]??"mostrar";
  $con = $_GET["con"]??"Puesto";
  
  /**
   * @var string $nombre - Nombre del controlador que será requerido
   */
  $nombre = "{$con}Controller";   
  require_once "controladores/{$nombre}.php";  

  /**
   * @var $controlador - Instancia del controlador
   */
  $controlador = new $nombre;

  if (!method_exists($controlador, $cop))    
    throw new Exception("la operacion no existe");

  $controlador->$cop();

