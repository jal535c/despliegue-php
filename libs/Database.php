<?php 

  class Database 
  {
    const HOST = "localhost";
    const USER = "root";
    const PASS = "";
    const DBNAME = "inventariomvc";

    private static ?Database $instancia = null;
    private $sqli;    
    private $res;     


    private function __clone() {   

    }


    private function __construct()    
    {
      $this->sqli = new mysqli(self::HOST, self::USER, self::PASS, self::DBNAME);
      
      if ($this->sqli->connect_errno)
        die("error de conexion");
    }


    public static function getDatabase():Database
    {
      if (self::$instancia==null)       
        self::$instancia = new Database();

      return self::$instancia;        
    }
    

    /**
     *  Usa la conexion para realizar una consulta a la base de datos
     *  @param string $sql
     *  @return bool 
     */
    public function consulta(string $sql):bool   
    {
      $this->res = $this->sqli->query($sql);      

      if (is_object($this->res)) {
        return ($this->res->num_rows > 0);
      } else {
        return (($this->res) && ($this->sqli->affected_rows > 0));
      }       
    }


    /**
     * Extrae del resultset una fila en forma de objeto
      @param string $class
      @return Object
    */
    public function getObjeto(string $class="StdClass"):?Object  
    {
      return $this->res->fetch_object($class);
    }


    /**
     * Devuelve el id (auto_increment) del ultimo insertado
     */
    public function getUltimoId():int 
    {
      return $this->sqli->insert_id;    
    }


    /**
     * Cierra la conexion con la base de datos
     */
    public function __destruct()
    {
      $this->sqli->close();
    }

  }