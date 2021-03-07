<?php

  require_once "libs/Database.php";

  class Item
  {

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
     * 
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
     * 
     */
    public function delete()
    {
      $db = Database::getDatabase();
      $db->consulta("DELETE FROM item WHERE idIte= {$this->idIte};");      
    }    

    
    /**
     * 
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
     * 
     */
    public static function findById(int $idi):?Item
    {
      $db = Database::getDatabase();
      $db->consulta("SELECT * FROM item WHERE idIte=$idi;");

      return $db->getObjeto("Item");
    }


    


    /**
     * 
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




