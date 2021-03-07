<?php

  require_once "modelos/Puesto.php";
  require_once "modelos/Item.php";
  require_once "controladores/TwigController.php";

    
  /**
   * PuestoController
   * 
   * Clase controlador para gestionar los puestos
   */
  class PuestoController extends TwigController
  {
            
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
      parent::__construct("./vistas");
    }

    
    /**
     * Muestra en pantalla un listado con todos los puestos del mercado. 
     * El metodo render devuelve en texto plano el codigo html, el cual vuelco en pantalla
     *
     */
    public function mostrar()
    {      
      $this->render("mostrarPuestos.php.twig", 
        [
          "titulo" => "Listado de Puestos del Inventario",
          "puestos" => Puesto::findAll(),          
        ]);
    }


    /**
     * Busca y muestra en pantalla la información asociada a un puesto del mercado.
     */
    public function info()
    {      
      $puesto = Puesto::findById($_GET["id"]);
      $items = Item::findAllByPuesto($puesto->getIdPue());

      $this->render("infoPuestos.php.twig", 
        [
          "titulo" => $puesto->getNombre(),
          "puesto" => $puesto,
          "items" => $items,
          "num" => 0 ,
          "app" => APP
        ]);
    }


    /**
     * Busca el puesto, y si existe lo borra
     */
    public function borrar()
    {  
      $puesto = Puesto::findById($_GET["id"]);      
      
      if ($puesto!=null) 
        $puesto->delete();
      
      header('location: /'.APP);
    }


    /**
     * Renderiza el formulario de añadir puesto, o bien
     * lo inserta en la base de datos
     */
    public function aniadir() 
    {
      if (!isset($_GET["nom"])):        
        $this->render("aniadirPuesto.php.twig", 
          [
            "titulo" => "Añadir puesto",
            "app" => APP
          ]);
      else:
        $puesto = new Puesto();

        $puesto->setNombre($_GET["nom"]);
        $puesto->setUbicacion($_GET["ubi"]);
        $puesto->setPlanta($_GET["pla"]);
        $puesto->setNumero($_GET["num"]);

        $puesto->save();
        
        header('location: /'.APP);   
      endif;
    }


    /**
     * Renderiza el formulario de editar puesto, o bien
     * actualiza el puesto en la base de datos
     */
    public function editar()
    {
      $puesto = Puesto::findById($_GET["id"]);
      
      if (!isset($_GET["nom"])):            
        $this->render("editarPuesto.php.twig", 
          [
            "titulo" => "Editar puesto",
            "puesto" => $puesto,
            "app" => APP
          ]);
      else:
        $puesto->setNombre($_GET["nom"]);
        $puesto->setUbicacion($_GET["ubi"]);
        $puesto->setPlanta($_GET["pla"]);
        $puesto->setNumero($_GET["num"]);

        $puesto->save();
        
        header('location: /'.APP);    
      endif; 
    }
  }