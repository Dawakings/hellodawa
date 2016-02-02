<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        error_reporting(E_ALL);
        ini_set('display_errors',1);
        //inkluderar
        include_once '../controllers/Controller.php';
        //surfar till denna sida med länken index2.php?getAllCars
        //delar upp querystringen till en array med /som avskiljare
        //arrayens innehåll:
        //$queryArray[0]=getAllCars
        $queryArray = explode('/', $_SERVER['QUERY_STRING']);
        //instansierar ett nytt controller objekt
        $cont = new Controller();
        //anropar metod på controllerobjekt
        //blir tex $cont->getAllCars();
        $cont->$queryArray[0]();
        ?>
    </body>
</html>
