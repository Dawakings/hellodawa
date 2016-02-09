<?php

require_once '../lib/Twig/Autoloader.php';
require_once '../models/Model.php';
session_start();

class Controller {

    private $cart;

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

    public function getinfoByKategori($kategori) {
        $modell = new Model();
        $varornaMain = $modell->getinfoByKategori($kategori);
        $varorna = $modell->getKategories();

        Twig_Autoloader::register();
        // i vilken mapp finns templates:erna eg vyerna
        $loader = new Twig_Loader_Filesystem('../templates/');
        $twig = new Twig_Environment($loader);
        // laddar vyn som ska visa data om bilar
        $template = $twig->loadTemplate('hemsida_ny.twig');
        //sätter data till variablen bilar som sedan är åtkomlig i vyn via
        //detta namn
        $template->display(array('varornaMain' => $varornaMain, 'varor' => $varorna));



        return $varornaMain;
    }

    public function getinfo($id) {
        $modell = new Model();
        $varornaMain = $modell->getInfo($id);
        $varorna = $modell->getKategories();

        Twig_Autoloader::register();
        // i vilken mapp finns templates:erna eg vyerna
        $loader = new Twig_Loader_Filesystem('../templates/');
        $twig = new Twig_Environment($loader);
        // laddar vyn som ska visa data om bilar
        $template = $twig->loadTemplate('hemsida_ny.twig');
        //sätter data till variablen bilar som sedan är åtkomlig i vyn via
        //detta namn
        $template->display(array('varornaMain' => $varornaMain, 'varor' => $varorna));



        return $varornaMain;
    }

    public function addtoCart($id) {
        if ($_SESSION['cart']) {
            $this->cart =  $_SESSION['cart'];
            $kundvagnArray = $this->getinfo($id);

            if (!array_key_exists($id, $this->cart)) {
                $this->cart[$id] = array($kundvagnArray[0], 1);
                $_SESSION['cart'] = $this->cart;
            } else {
                $this->cart[$id][1] ++;
                $_SESSION['cart'] = $this->cart;
            }
            
        } 
        else {
            $_SESSION['cart'] = $this->cart;
            $kundvagnArray = $this->getInfo($id);

            $this->cart[$id] = array($kundvagnArray[0], 1);

            $_SESSION['cart'] = $this->cart;
        }
        
    }

    public function deletefromCart($id) {
        if ($_SESSION['cart']) {
            $this->cart = $_SESSION['cart'];

            if (array_key_exists($id, $this->cart)) {
                $this->cart[$id][1] --;
            }
            if ($this->cart[$id][1] <= 0) {
                unset($this->cart[$id]);
            }
            $_SESSION['cart'] = $this->cart;
        }
        $this->showCart();
    }

    public function belopp() {
        $belopp = 0;
        foreach ($_SESSION['cart'] as $attBetala) {
            $belopp+=$attBetala[0]['pris'] * $attBetala[1];
        }
        return $belopp;
    }

    public function showCart() {
        Twig_Autoloader::register();
        $loader = new Twig_Loader_Filesystem('../templates/');
        $twig = new Twig_Environment($loader);
        $template = $twig->loadTemplate('kundvagn.twig');

        $template->display(array('kundvagnen' => $_SESSION['cart'], 'attBetala' => $this->belopp()));
    }

}

/*
$obj= new Controller();

var_dump($obj->addtoCart(0)); */
