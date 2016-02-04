<?php

require_once '../lib/Twig/Autoloader.php';
require_once '../models/Model.php';

class Controller {

    public function getAllavaror() {
        $modell = new Model();
        $varorna = $modell->getAllavaror();
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

    public function getAllaDatorer() {
        $modell = new Model();
        $data = $modell->getAllaDatorer();
        Twig_Autoloader::register();
        // i vilken mapp finns templates:erna eg vyerna
        $loader = new Twig_Loader_Filesystem('../templates/undersidor/');
        $twig = new Twig_Environment($loader);
        // laddar vyn som ska visa data om bilar
        $template = $twig->loadTemplate('dator.twig');
        //sätter data till variablen bilar som sedan är åtkomlig i vyn via
        //detta namn
        $template->display(array('Data' => $data));
    }

    public function getTelefon() {
        $modell = new Model();
        $telefon = $modell->getTelefon();
        Twig_Autoloader::register();
        // i vilken mapp finns templates:erna eg vyerna
        $loader = new Twig_Loader_Filesystem('../templates/undersidor/');
        $twig = new Twig_Environment($loader);
        // laddar vyn som ska visa data om bilar
        $template = $twig->loadTemplate('surf.twig');
        //sätter data till variablen bilar som sedan är åtkomlig i vyn via
        //detta namn
        $template->display(array('Telefon' => $telefon));
    }

    public function getTillbehor() {
        $modell = new Model();
        $telefon = $modell->getTillbehor();
        Twig_Autoloader::register();
        // i vilken mapp finns templates:erna eg vyerna
        $loader = new Twig_Loader_Filesystem('../templates/undersidor/');
        $twig = new Twig_Environment($loader);
        // laddar vyn som ska visa data om bilar
        $template = $twig->loadTemplate('tillbehor.twig');
        //sätter data till variablen bilar som sedan är åtkomlig i vyn via
        //detta namn
        $template->display(array('Surf' => $telefon));
    }

    public function getErbjudande() {
        $modell = new Model();
        $erbjudande = $modell->getErbjudande();
        Twig_Autoloader::register();
        // i vilken mapp finns templates:erna eg vyerna
        $loader = new Twig_Loader_Filesystem('../templates/undersidor/');
        $twig = new Twig_Environment($loader);
        // laddar vyn som ska visa data om bilar
        $template = $twig->loadTemplate('erbjudande.twig');
        //sätter data till variablen bilar som sedan är åtkomlig i vyn via
        //detta namn
        $template->display(array('erbjudande' => $erbjudande));
    }

}
