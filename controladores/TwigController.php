<?php

  require_once "vendor/autoload.php";


  class TwigController
  {

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
     * Encapsula el metodo render de twig
     */
    public function render(string $ruta, array $params=[]) 
    {
      echo $this->twig->render($ruta, $params);
    }
  }