<?php

require_once '../lib/Twig/Autoloader.php';
require_once '../models/Model.php';
session_start();

class Controller {

    private $cart;
    private $model;
    private $loader;
    private $twig;

    public function __construct() {
        $this->model = new Model();
        Twig_Autoloader::register();
        $this->loader = new Twig_Loader_Filesystem('../templates/');
        $this->twig = new Twig_Environment($this->loader);
    }

    public function getAllavaror() {


        $varorna = $this->model->getAllaVaror();
        // i vilken mapp finns templates:erna eg vyerna
        // laddar vyn som ska visa data om bilar
        $template = $this->twig->loadTemplate('hemsida_ny.twig');
        //sätter data till variablen bilar som sedan är åtkomlig i vyn via
        //detta namn
        $template->display(array('varor' => $varorna));
    }

    public function getKategories() {
        $varorna = $this->model->getKategories();
        // i vilken mapp finns templates:erna eg vyerna
        // laddar vyn som ska visa data om bilar
        $template = $this->twig->loadTemplate('hemsida_ny.twig');
        //sätter data till variablen bilar som sedan är åtkomlig i vyn via
        //detta namn
        $template->display(array('varor' => $varorna));
    }

    public function getinfoByKategori($kategori) {
        $varornaMain = $this->model->getinfoByKategori($kategori);
        $varorna = $this->model->getKategories();

        // i vilken mapp finns templates:erna eg vyerna
        // laddar vyn som ska visa data om bilar
        $template = $this->twig->loadTemplate('hemsida_ny.twig');
        //sätter data till variablen bilar som sedan är åtkomlig i vyn via
        //detta namn
        $template->display(array('varornaMain' => $varornaMain, 'varor' => $varorna));



        return $varornaMain;
    }

    public function getinfo($id) {
        $varornaMain = $this->model->getInfo($id);
        $varorna = $this->model->getKategories();

        // i vilken mapp finns templates:erna eg vyerna
        // laddar vyn som ska visa data om bilar
        $template = $this->twig->loadTemplate('hemsida_ny.twig');
        //sätter data till variablen bilar som sedan är åtkomlig i vyn via
        //detta namn
        $template->display(array('varornaMain' => $varornaMain, 'varor' => $varorna));



        return $varornaMain;
    }
//metod för att lägga till i kundvagn. Använder sig av tillfälliga sessioner.
    public function addtoCart($id) {
        if ($_SESSION['cart']) {
            $this->cart = $_SESSION['cart'];
            $kundvagnArray = $this->getinfo($id);

            if (!array_key_exists($id, $this->cart)) {
                $this->cart[$id] = array($kundvagnArray[0], 1);
                $_SESSION['cart'] = $this->cart;
            } else {
                $this->cart[$id][1] ++;
                $_SESSION['cart'] = $this->cart;
            }
        } else {
            $_SESSION['cart'] = $this->cart;
            $kundvagnArray = $this->getInfo($id);

            $this->cart[$id] = array($kundvagnArray[0], 1);

            $_SESSION['cart'] = $this->cart;
        }
        $this->showCart();
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
        $template = $this->twig->loadTemplate('kundvagn.twig');

        $template->display(array('kundvagnen' => $_SESSION['cart'], 'attBetala' => $this->belopp()));
    }

    public function addVara() {

        $errorArray = $this->validate();
        var_dump($errorArray);
        if (count($errorArray) == 0) {
            $this->model->addVara();
            $this->showAdmin();
        } else {
            $template = $this->twig->loadTemplate('admin.twig');
            $template->display(array('error' => $errorArray));
        }
    }

    public function showError() {
        $this->twig->loadTemplate('error.twig');
    }

    public function showAdmin() {
        $template = $this->twig->loadTemplate('admin.twig');

        $fillAdmin = $this->model->getAllavaror();
        //  $errorArray = $this->validate();


        $template->display(array('varor' => $fillAdmin, /* 'error' => $errorArray) */));
    }

    public function deleteVara() {

        $errorArray = $this->validate();
        var_dump($errorArray);

        if (count($errorArray) == 0) {
            $this->model->deleteVara();
            $this->showAdmin();
        } else {
            $template = $this->twig->loadTemplate('admin.twig');
            $template->display(array('error' => $errorArray));
        }
    }

    public function updateVara() {

        $errorArray = $this->validate();
        var_dump($errorArray);

        if (count($errorArray) == 0) {
            $this->model->updateVara();
            $this->showAdmin();
        } else {
            $template = $this->twig->loadTemplate('admin.twig');
            $template->display(array('error' => $errorArray));
        }
    }

    public function validate() {
        
        $errorArray = array();
        foreach ($_POST as $key => $value) {

            //tomt
            if ($value == '') {
                $errorArray[$key] = 'Inget fält får vara tomt';
                
            } else {
                switch ($key) {
                    case 'id':
                        if (!is_numeric($value)) {
                            $errorArray[$key] = 'ID får bara vara siffror';
                        }
                        break;
                    case 'pris':
                        if (!is_numeric($value)) {
                            
                        $errorArray[$key] = 'PRIS får bara vara siffror';
                        }
                        break;
                    default:
                } //switch
            } //else
        } //loop

        return $errorArray;
    }
    



    public function login() {
        if (strip_tags($_POST['username']) == 'admin' && strip_tags($_POST['password']) == 'admin') {
            $_SESSION['loggedin'] = TRUE;
            $this->showAdmin();
        } else {
            $_SESSION['loggedin'] = FALSE;

            $template = $this->twig->loadTemplate('hemsida_ny.twig');

            $template->display(array('loginerror' => 'Felaktigt användarnamn/Lösenord. Logga in med "admin""admin"'));
        }
    }

}

//class


/*$obj= new Controller();

var_dump($obj->addtoCart(0)); */
