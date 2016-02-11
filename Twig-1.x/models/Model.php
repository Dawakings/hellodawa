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

    public function getInfo($id) {
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

    private function addVara() {
        try {
            $dsn = 'mysql:host=utb-mysql.du.se;dbname=db06';
            $username = 'db06';
            $password = 'Oy9CkDSJ';

            $pdocon = new PDO($dsn, $username, $password);

            $pdoStatement = $pdocon->prepare('INSERT INTO gooddata_h14rtand (namn,
                    , kategori, pris, bildurl, infoshort, infolong) VALUES(:namnet, :kategorin, :priset, :bilden, :shortinfo, :longinfo)');

            $pdoStatement->bindParam(':namnet', filter_var(trim($_POST['namn']), FILTER_SANITIZE_STRING));
            $pdoStatement->bindParam(':kategorin', filter_var(trim($_POST['kategori']), FILTER_SANITIZE_STRING));
            $pdoStatement->bindParam(':priset', filter_var(trim($_POST['pris']), FILTER_SANITIZE_STRING));
            $pdoStatement->bindParam(':bilden', filter_var(trim($_POST['bildurl']), FILTER_SANITIZE_STRING));
            $pdoStatement->bindParam(':shortinfo', filter_var(trim($_POST['infoshort']), FILTER_SANITIZE_STRING));
            $pdoStatement->bindParam(':longinfo', filter_var(trim($_POST['infolong']), FILTER_SANITIZE_STRING));

            $pdoStatement->execute();
           $pdocon = NULL;
            
        } catch (PDOException $pdoexp) {
            $pdocon = NULL;
            throw new Exception('Databasfel');
        }
    }

    public function updateVara() {
        try {
            $dsn = 'mysql:host=utb-mysql.du.se;dbname=db06';
            $username = 'db06';
            $password = 'Oy9CkDSJ';

            $pdocon = new PDO($dsn, $username, $password);

            $pdoStatement = $pdocon->prepare('UPDATE gooddata_h14rtand SET namn=:namnet, 
                     kategori=:kategorin, bild=:bilden, pris=:priset, bild=:bilden, infoshort=:shortinfo, infolong=:longinfo WHERE id=:artikelid');

            $pdoStatement->bindParam(':artikelid', filter_var(trim($_POST['id']), FILTER_SANITIZE_STRING));
            $pdoStatement->bindParam(':namnet', filter_var(trim($_POST['namn']), FILTER_SANITIZE_STRING));
            $pdoStatement->bindParam(':kategorin', filter_var(trim($_POST['kategori']), FILTER_SANITIZE_STRING));
            $pdoStatement->bindParam(':priset', filter_var(trim($_POST['pris']), FILTER_SANITIZE_STRING));
            $pdoStatement->bindParam(':bilden', filter_var(trim($_POST['bildurl']), FILTER_SANITIZE_STRING));
            $pdoStatement->bindParam(':shortinfo', filter_var(trim($_POST['infoshort']), FILTER_SANITIZE_STRING));
            $pdoStatement->bindParam(':longinfo', filter_var(trim($_POST['infolong']), FILTER_SANITIZE_STRING));

            $pdoStatement->execute();
            $pdocon = NULL;
        } catch (PDOException $pdoexp) {
            $pdocon = NULL;
            throw new Exception('Databasfel');
        }
    }
    
    public function deleteVara($id) {
        try {
            $dsn = 'mysql:host=utb-mysql.du.se;dbname=db06';
            $username = 'db06';
            $password = 'Oy9CkDSJ';

            $pdocon = new PDO($dsn, $username, $password);

            $pdoStatement = $pdocon->prepare('DELETE FROM gooddata_h14rtand WHERE id=:artikelid');

            $pdoStatement->bindParam(':artikelid',$id);
            

            $pdoStatement->execute();
           $pdocon = NULL;
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
