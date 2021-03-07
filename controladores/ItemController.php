<?php

  require_once "modelos/Item.php";
  require_once "modelos/Puesto.php";
  require_once "controladores/TwigController.php";

    
  /**
   * ItemController
   * 
   * Clase controlador para gestionar los items
   */
  class ItemController extends TwigController
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
     * aniadir
     *
     * Método para añadir un item a la base de datos
     * @return void
     */
    public function aniadir() 
    {
      $puesto = Puesto::findById($_GET["idp"]);

      if (!isset($_GET["nom"])):        
        $this->render("aniadirItem.php.twig", 
          [
            "titulo" => "Añadir item",
            "puesto" => $puesto,
            "app" => APP
          ]);
      else:
        $item = new Item();

        $item->setIdPue($_GET["idp"]);

        $item->setItem($_GET["nom"]);
        $item->setStock($_GET["sto"]);
        $item->setAlta(date("Y-m-d", strtotime($_GET["fec"])));
        
        $item->save();
        
        header("location: /".APP."/puestos/info/{$_GET["idp"]}");
      endif;
    }

        
    /**
     * editar
     *
     * Metodo para editar un item
     * @return void
     */
    public function editar()
    {
      $puesto = Puesto::findById($_GET["idp"]);
      $item = Item::findById($_GET["idi"]);
      
      if (!isset($_GET["nom"])):            
        $this->render("editarItem.php.twig", 
          [
            "titulo" => "Editar item",
            "puesto" => $puesto,
            "item" => $item,
            "app" => APP
          ]);
      else:
        $item->setItem($_GET["nom"]);
        $item->setStock($_GET["sto"]);
        
        $item->update();
        
        header("location: /".APP."/puestos/info/{$puesto->getIdPue()}");
      endif; 
    }
    
         
    /**
     * borrar
     *
     * Busca el item, y si existe lo borra
     * 
     * @return void
     */
    public function borrar()
    {  
      $item = Item::findById($_GET["idi"]);      
      
      if (!is_null($item)) 
        $item->delete();
      
      header("location: /".APP."/puestos/info/{$item->getIdPue()}");
    }
  }