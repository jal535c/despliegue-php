<?php

  require_once "libs/Database.php";

  class Item
  {

    /**
     * @var int $idIte - Identificador del item
     * @var int $idPue - Identificador del puesto
     * @var string $item - Nombre del item
     * @var int $stock - Cantidad en stock
     * @var string $alta - Fecha de alta
     */
    private int $idIte;
    private int $idPue;
    private string $item;
    private int $stock;
    private string $alta;

  
    /**
     * @return mixed
     */
    public function getIdIte()
    {
      return $this->idIte;
    }

    /**
     * @param mixed $idIte
     *
     * @return self
     */
    public function setIdIte($idIte)    
    {
      $this->idIte = $idIte;

      return $this;
    }

    /**
     * @return mixed
     */
    public function getIdPue()
    {
      return $this->idPue;
    }

    /**
     * @param mixed $idPue
     *
     * @return self
     */
    public function setIdPue($idPue)
    {
      $this->idPue = $idPue;

      return $this;
    }

    /**
     * @return mixed
     */
    public function getItem()
    {
      return $this->item;
    }

    /**
     * @param mixed $item
     *
     * @return self
     */
    public function setItem($item)
    {
      $this->item = $item;

      return $this;
    }

    /**
     * @return mixed
     */
    public function getStock()
    {
      return $this->stock;
    }

    /**
     * @param mixed $stock
     *
     * @return self
     */
    public function setStock($stock)
    {
      $this->stock = $stock;

      return $this;
    }

    /**
     * @return mixed
     */
    public function getAlta()
    {
      return $this->alta;
    }

    /**
     * @param mixed $alta
     *
     * @return self
     */
    public function setAlta($alta)
    {
      $this->alta = $alta;

      return $this;
    }

        
    /**
     * update
     *
     * Actualiza de la base de datos un item
     * @return void
     */
    public function update()
    {
      $db = Database::getDatabase();
      $sql = "UPDATE item 
        SET item='{$this->item}', stock={$this->stock} 
        WHERE idIte={$this->idIte};";
      
      $db->consulta($sql);
    }

        
    /**
     * delete
     *
     * Borra de la base de datos un item
     * @return void
     */
    public function delete()
    {
      $db = Database::getDatabase();
      $db->consulta("DELETE FROM item WHERE idIte= {$this->idIte};");      
    }    
    
       
    /**
     * save
     *
     * Inserta en la base de datos un item
     * @return void
     */
    public function save()
    {
      $db = Database::getDatabase();
      $sql = "INSERT INTO item (idPue, item, stock, alta)
        VALUES ({$this->idPue}, '{$this->item}', {$this->stock}, '{$this->alta}');";
      
      if ($db->consulta($sql)) {
        $this->idIte = $db->getUltimoId();
      } else {
        die("error: $sql");
      }
    }
 
        
    /**
     * findById
     *
     * Busca en la base de datos un item
     * @param  int $idi - identificador del item
     * @return null|Item - Devuelve el Item, o null si no lo encuentra
     */
    public static function findById(int $idi):?Item
    {
      $db = Database::getDatabase();
      $db->consulta("SELECT * FROM item WHERE idIte=$idi;");

      return $db->getObjeto("Item");
    }
  
        
    /**
     * findAllByPuesto
     *
     * Busca en la base de datos todos los items de un determinado puesto
     * @param  mixed $idp - Identificador del puesto
     * @return array - Array con todos los items
     */
    public static function findAllByPuesto(int $idp):array 
    {
      $db = Database::getDatabase();
      $db->consulta("SELECT *, DATE_FORMAT(alta, '%d/%m/%Y') as alta FROM item WHERE idPue=$idp ;");

      $datos=[];
      while ($item = $db->getObjeto("Item")) {
        array_push($datos, $item);
      }

      return $datos;
    }    

  }




