<?php
/*
error_reporting(E_ALL);
ini_set('display_errors' 1);

*/
//inkluderar
include_once '../controllers/Controller.php';
//instansierar
$controller = new Controller();
//läser av url: en efter index.php?Productid/ABC123
//splitter den till en array så att jag kan kommat åt metod resp arugment
$queryArray = explode('/', $_SERVER['QUERY_STRING']);
//tex $controller->getProductid('ABC123');
//kollar så att metod finns i objektet,
//minskar risk för att någon försöker ändra i url genom att
//skicka in konstiga metodnamn
if  (metod_exist($controller, $queryArray[0])){
        $controller->$queryArray[0]($queryArray[1]);
}   else    {
    // vi har bara surfat in till index1.php eg ingen querystring
    $controller->getProductid('Dator')
}
    
?>

