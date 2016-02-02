<?php

require_once '../lib/Twig/Autoloader.php';
require_once '../models/Model.php';

class Controller {
    public function getAllCars() {
        $modell = new Model();
        $bilarna = $modell->getAllCars();
        Twig_Autoloader::register();
        // i vilken mapp finns templates:erna eg vyerna
        $loader = new Twig_Loader_Filesystem('../templates/');
        $twig = new Twig_Environment($loader);
        // laddar vyn som ska visa data om bilar
        $template = $twig->loadTemplate('Vyn.twig');
        //sätter data till variablen bilar som sedan är åtkomlig i vyn via
        //detta namn
        $template->display(array('bilar'=>$bilarna));
    }
}
