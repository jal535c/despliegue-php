<?php

  require_once "vendor/autoload.php";

  
  /**
   * TwigController
   * 
   * Clase para gestionar del motor de platillas Twig
   */
  class TwigController
  {
    
    /**
     * twig
     *
     * @var mixed $twig - Instancia del motor de plantillas Twig
     */
    private  $twig;    


    /**
     * Clase común para futuros controladores, los cuales heredaran de esta
     * Configura el motor de plantillas twig
     * @param string $ruta - Ruta de la carpeta que contiene las vistas (inyección de dependencia)
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
     * @param  mixed $ruta - Ruta de la carpeta que contiene las vistas para el motor
     * @param  mixed $params - Parametros en forma de array asociativo que se pasan a las vistas
     * @return void
     */
    public function render(string $ruta, array $params=[]) 
    {
      echo $this->twig->render($ruta, $params);
    }
  }