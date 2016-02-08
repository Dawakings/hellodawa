<?php

require_once '../lib/Twig/Autoloader.php';
require_once '../models/Model.php';

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
    
    public function getinfoByKategori($kategori){
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
       $template->display(array('varornaMain' => $varornaMain, 'varor' => $varorna ));
       
  
       
        return $varornaMain;
    }
    
    
    function __construct() {
        if($_SESSION['cart']){
        $this->cart=array();
        }
        else{
           $this->cart=$_SESSION['cart'];
        }
    }

    public function addToCart($id) {
        //lägg till i kundvagn och visa kundvagn sidan
        $vagn[0]=0;
        //om produktid inte finns lägg till produkt och sätt dess antal till 1
        if(!array_key_exists($id, $this->cart)){
            $this->cart[$id]=array($vagn[0],1);
        }
        //annars öka dess antal med 1
        else{
            $this->cart[$id][1]++;
        }
        $_SESSION['cart']=$this->cart;
        
    }
    public function removeFromCart($id) {
        //ta bort från kundvagn och visa kundvagns sidan
        if(array_key_exists($id, $this->cart)){
            //minskar antal med 1
            //$this->cart[$id][1]--;
            //tar bort på id
            unset($this->cart[$id]);
        }
         $_SESSION['cart']=$this->cart;
        
    }
    public function showCart(){        
        
        
    }
    
    
    

  


}
/*$obj= new Controller();

var_dump($obj->getinfoByKategori('Datorer')); */
