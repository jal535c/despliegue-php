<?php

  require_once "libs/Database.php";
  
  /**
   * Puesto
   * 
   * Clase modelo para la gestion de los puestos
   */
  class Puesto
  {

    /**
     * @var null|int $idPue - Identificador del puesto
     * @var string $nombre - Nombre del puesto
     * @var string $ubicacion - Ubicación del puesto
     * @var int $planta - Planta del puesto
     * @var int $numero - Número del puesto
     */
    private ?int $idPue = null;    
    private string $nombre;
    private string $ubicacion;
    private int $planta;
    private int $numero; 


    /**
     * @return mixed
     */
    public function getIdPue()   
    {
      return $this->idPue;
    }
    
    /**
     * @return mixed
     */
    public function getNombre()
    {
      return $this->nombre;
    }

    /**
     * @param mixed $nombre
     *
     * @return self
     */
    public function setNombre($nombre)
    {
      $this->nombre = $nombre;

      return $this;     
    }

    /**
     * @return mixed
     */
    public function getUbicacion()
    {
      return $this->ubicacion;
    }

    /**
     * @param mixed $ubicacion
     *
     * @return self
     */
    public function setUbicacion($ubicacion)
    {
      $this->ubicacion = $ubicacion;

      return $this;
    }

    /**
     * @return mixed
     */
    public function getPlanta()
    {
      return $this->planta;
    }

    /**
     * @param mixed $planta
     *
     * @return self
     */
    public function setPlanta($planta)
    {
      $this->planta = ($planta) ? $planta : 0;

      return $this;
    }

    /**
     * @return mixed
     */
    public function getNumero()
    {
      return $this->numero;
    }

    /**
     * @param mixed $numero
     *
     * @return self
     */
    public function setNumero($numero)
    {
      $this->numero = ($numero) ? $numero : 0;

      return $this;
    }


    /**
     * Inserta en la base de datos, o bien,
     * hace un update,
     * depende de si existe idPue
     */
    public function save()      
    {
      $db = Database::getDatabase();

      if ($this->idPue==null) {        
        $sql = "INSERT INTO puesto (nombre, ubicacion, planta, numero)
          VALUES ('{$this->nombre}', '{$this->ubicacion}', {$this->planta}, {$this->numero});";

        if ($db->consulta($sql)) {
          $this->idPue = $db->getUltimoId();
        }
      } else {
        $sql="UPDATE puesto
          SET nombre='{$this->nombre}', ubicacion='{$this->ubicacion}', planta={$this->planta}, numero={$this->numero}
          WHERE idPue={$this->idPue};";

        $db->consulta($sql);
      }
      
      return $this;
    }


    /**
     * Borra el objeto que lo invoca
     */
    public function delete()
    {
      $db = Database::getDatabase();
      $db->consulta("DELETE FROM puesto WHERE idPue = {$this->idPue};");
    }


    /**
     * Devuelve un array con todos los puestos
     * @return
     */
    public static function findAll():array 
    {
      $db = Database::getDatabase();
      $db->consulta("SELECT * FROM puesto;");

      $datos=[];
      while ($puesto = $db->getObjeto("Puesto")) {
        array_push($datos, $puesto);           
      }

      return $datos;
    }


    /**
     * Devuelve el puesto indicado, si se encuentra
     * @param int $idp - Identificador del puesto
     * @return 
     */
    public static function findById(int $idp):?Puesto 
    {
      $db = Database::getDatabase();
      $db->consulta("SELECT * FROM puesto WHERE idPue=$idp;");

      return $db->getObjeto("Puesto");
    }
    
  }




