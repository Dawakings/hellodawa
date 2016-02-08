<?php

require_once '../lib/Twig/Autoloader.php';
require_once '../models/Model.php';

class Controller {

    public function getAllavaror() {
        $modell = new Model();
        $varorna = $modell->getAllaVaror();
        Twig_Autoloader::register();
        // i vilken mapp finns templates:erna eg vyerna
        $loader = new Twig_Loader_Filesystem('../templates/');
        $twig = new Twig_Environment($loader);
        // laddar vyn som ska visa data om bilar
        $template = $twig->loadTemplate('Vyn.twig');
        //sätter data till variablen bilar som sedan är åtkomlig i vyn via
        //detta namn
        $template->display(array('varor' => $varorna));
    }
    
    public function getKategories() {
        $modell = new Model();
        $varorna = $modell->getKategories();
        Twig_Autoloader::register();
        // i vilken mapp finns templates:erna eg vyerna
        $loader = new Twig_Loader_Filesystem('../templates/');
        $twig = new Twig_Environment($loader);
        // laddar vyn som ska visa data om bilar
        $template = $twig->loadTemplate('hemsida_ny.twig');
        //sätter data till variablen bilar som sedan är åtkomlig i vyn via
        //detta namn
        $template->display(array('varor' => $varorna));
    }
    
    public function getinfoByKategori($kategori){
        $modell = new Model();
        $varornaMain = $modell->getinfoByKategori($kategori);
        Twig_Autoloader::register();
        // i vilken mapp finns templates:erna eg vyerna
        $loader = new Twig_Loader_Filesystem('../templates/');
        $twig = new Twig_Environment($loader);
        // laddar vyn som ska visa data om bilar
        $template = $twig->loadTemplate('hemsida_ny.twig');
        //sätter data till variablen bilar som sedan är åtkomlig i vyn via
        //detta namn
        $template->display(array('varornaMain' => $varornaMain));
    }
    

  


}
