<?php

  require_once "vendor/autoload.php";

  
  /**
   * TwigController
   */
  class TwigController
  {
    
    /**
     * twig
     *
     * @var mixed
     */
    private  $twig;    //para k no sea protegida, encapsulo y uso el metodo render de aqui


    /**
     * Padre comun para todos los controladores
     * Configura el motor de plantillas twig
     * @param $ruta: inyeccion de dependencia, le paso la ruta de las vistas y ya no tengo que tocar esta clase
     */
    public function __construct(string $ruta)
    {      
      $config = new \Twig\Loader\FilesystemLoader($ruta);
      $this->twig = new \Twig\Environment($config);
    }


        
    /**
     * render
     * Encapsula el metodo render de la clase Twig
     *
     * @param  mixed $ruta
     * @param  mixed $params
     * @return void
     */
    public function render(string $ruta, array $params=[]) 
    {
      echo $this->twig->render($ruta, $params);
    }
  }