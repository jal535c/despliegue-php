<?php 
  
  /**
   * Database
   * 
   * Clase que gestiona la conexion a la base de datos
   */
  class Database 
  {
    
    /**
     * @var string HOST - Servidor de la base de datos
     * @var string USER - Nombre de usuario
     * @var string PASS - Clave de usario 
     * @var string DBNAME - Nombre de la base de datos
     */
    const HOST = "localhost";
    const USER = "root";
    const PASS = "";
    const DBNAME = "inventariomvc";

    /**
     * @var null|\Database $instancia - Instancia de esta clase
     * @var \mysqli $sqli - Instancia de la libreria mysqli para realizar la conexion
     * @var mixed $res - Guarda el resultado de una consulta
     */
    private static ?Database $instancia = null;
    private $sqli;    
    private $res;     

    
    /**
     * __clone
     *
     * Metodo vacio para evitar el clonado de esta clase
     * @return void
     */
    private function __clone() {   

    }

    
    /**
     * __construct
     *
     * Constructor privado para evitar que se llame desde fuera (patron singleton)
     * @return void
     */
    private function __construct()    
    {
      $this->sqli = new mysqli(self::HOST, self::USER, self::PASS, self::DBNAME);
      
      if ($this->sqli->connect_errno)
        die("error de conexion");
    }

    
    /**
     * getDatabase
     * 
     * Implementa el patron singlenton para tener siempre una unica instancia de esta clase
     *
     * @return Database
     */
    public static function getDatabase():Database
    {
      if (self::$instancia==null)       
        self::$instancia = new Database();

      return self::$instancia;        
    }
    

    /**
     *  Usa la conexion para realizar una consulta a la base de datos
     *  @param string $sql - Sentencia sql
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
     * Extrae del resultado obtenido (resultset) una fila en forma de objeto
     * @param string $class - Tipo de la Clase que quiero obtener
     * @return Object
     */
    public function getObjeto(string $class="StdClass"):?Object  
    {
      return $this->res->fetch_object($class);
    }

         
    /**
     * getUltimoId
     *
     * @return int - Devuelve el id (auto_increment) del ultimo insertado
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