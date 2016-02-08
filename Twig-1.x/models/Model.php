<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Model
 *
 * @author h14sshak
 */
class Model {

   
 

    public function getAllavaror() {
        try {
            $dsn = 'mysql:host=utb-mysql.du.se;dbname=db06';
            $username = 'db06';
            $password = 'Oy9CkDSJ';

            $pdocon = new PDO($dsn, $username, $password);

            $pdoStatement = $pdocon->prepare('CALL h14rtand_getallvaror()');

            $pdoStatement->execute();
            $vara = $pdoStatement->fetchAll();
            return $vara;
        } catch (PDOException $pdoexp) {
            $pdocon = NULL;
            throw new Exception('Databasfel');
        }
    }



    public function getKategories() {
        try {
            $dsn = 'mysql:host=utb-mysql.du.se;dbname=db06';
            $username = 'db06';
            $password = 'Oy9CkDSJ';

            $pdocon = new PDO($dsn, $username, $password);

            $pdoStatement = $pdocon->prepare('CALL h14rtand_getcategory()');

            $pdoStatement->execute();
            $vara = $pdoStatement->fetchAll();
            return $vara;
        } catch (PDOException $pdoexp) {
            $pdocon = NULL;
            throw new Exception('Databasfel');
        }
    }
    
  



    public function getInfo() {
        try {
            $dsn = 'mysql:host=utb-mysql.du.se;dbname=db06';
            $username = 'db06';
            $password = 'Oy9CkDSJ';

            $pdocon = new PDO($dsn, $username, $password);

            $pdoStatement = $pdocon->prepare("CALL h14rtand_getinfo ('{$id}')");

            $pdoStatement->execute();
            $vara = $pdoStatement->fetchAll();
            return $vara;
        } catch (PDOException $pdoexp) {
            $pdocon = NULL;
            throw new Exception('Databasfel');
        }
    }

//function

    public function getinfoByKategori($kategori) {
        try {
            $dsn = 'mysql:host=utb-mysql.du.se;dbname=db06';
            $username = 'db06';
            $password = 'Oy9CkDSJ';

            $pdocon = new PDO($dsn, $username, $password);

            $pdoStatement = $pdocon->prepare("CALL h14rtand_getinfobycategory ('{$kategori}')");

            $pdoStatement->execute();
            $vara = $pdoStatement->fetchAll();
            return $vara;
        } catch (PDOException $pdoexp) {
            $pdocon = NULL;
            throw new Exception('Databasfel');
        }
    }

//function

    public function getPast() {
        try {
            $dsn = 'mysql:host=utb-mysql.du.se;dbname=db06';
            $username = 'db06';
            $password = 'Oy9CkDSJ';

            $pdocon = new PDO($dsn, $username, $password);

            $pdoStatement = $pdocon->prepare("");

            $pdoStatement->execute();
            $vara = $pdoStatement->fetchAll();
            return $vara;
        } catch (PDOException $pdoexp) {
            $pdocon = NULL;
            throw new Exception('Databasfel');
        }
    }



   

   

    

}
/*
$objmodel = new Model();

var_dump($objmodel->getinfoByKategori('Datorer'));
 
 */
