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
            $template = $this->twig->loadTemplate('ErrorPage.twig');
            $template->display(array('error' =>$pdoexp->getMessage()));
            
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

    public function addVara() {
        try {
            
            
            $dsn = 'mysql:host=utb-mysql.du.se;dbname=db06';
            $username = 'db06';
            $password = 'Oy9CkDSJ';

            $pdocon = new PDO($dsn, $username, $password);
            
           /* $query = "INSERT INTO gooddata_h14rtand (namn,
                     , kategori, pris, bildurl, infoshort, infolong) VALUES(:namnet, :kategorin, :priset, :bilden, :shortinfo, );"; */

          $pdoStatement = $pdocon->prepare('INSERT INTO gooddata_h14rtand (namn,
                      kategori, pris, bildurl, infoshort, infolong) VALUES(:namnet, :kategorin, :priset, :bilden, :shortinfo, :longinfo)');

            // https://gist.github.com/eleisoncruz/d3a251767a49e24ca11e
            
            $pdoStatement->bindParam(':namnet', filter_var($_POST['namn']), FILTER_SANITIZE_STRING);
            $pdoStatement->bindParam(':kategorin', filter_var($_POST['kategori']), FILTER_SANITIZE_STRING);
            $pdoStatement->bindParam(':priset', filter_var($_POST['pris']), FILTER_SANITIZE_STRING);
            $pdoStatement->bindParam(':bilden', filter_var($_POST['bildurl']), FILTER_SANITIZE_STRING);
            $pdoStatement->bindParam(':shortinfo', filter_var($_POST['infoshort']), FILTER_SANITIZE_STRING);
            $pdoStatement->bindParam(':longinfo', filter_var($_POST['infolong']), FILTER_SANITIZE_STRING);
            
            
           //  $stmt = $pdocon->prepare($query);
             
            /* $stmt->bindParam(1, $_POST['namn']);
             $stmt->bindParam(2, $_POST['kategori']);
             $stmt->bindParam(3, $_POST['pris']);
             $stmt->bindParam(4, $_POST['bildurl']);
             $stmt->bindParam(5, $_POST['infoshort']);
             $stmt->bindParam(6, $_POST['infolong']);
             */
             

            $pdoStatement->execute();
          //   $stmt->execute();
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

            $pdoStatement = $pdocon->prepare('UPDATE gooddata_h14rtand SET namn=:namnet,kategori=:kategorin, pris=:priset, bildurl=:bilden, infoshort=:shortinfo, infolong=:longinfo WHERE id=:artikelid');

            $pdoStatement->bindParam(':artikelid',$_POST['id']);
            $pdoStatement->bindParam(':namnet', $_POST['namn']);
            $pdoStatement->bindParam(':kategorin',$_POST['kategori']);
            $pdoStatement->bindParam(':priset', $_POST['pris']);
            $pdoStatement->bindParam(':bilden',$_POST['bildurl']);
            $pdoStatement->bindParam(':shortinfo', $_POST['infoshort']);
            $pdoStatement->bindParam(':longinfo', $_POST['infolong']);
    
            $pdoStatement->execute();
            $pdocon = NULL;
        } catch (PDOException $pdoexp) {
            $pdocon = NULL;
            throw new Exception('Databasfel');
            
        }
    }
    
    public function deleteVara() {
        try {
            $dsn = 'mysql:host=utb-mysql.du.se;dbname=db06';
            $username = 'db06';
            $password = 'Oy9CkDSJ';

            $pdocon = new PDO($dsn, $username, $password);

            $pdoStatement = $pdocon->prepare('DELETE FROM gooddata_h14rtand WHERE id=:artikelid;');

            $pdoStatement->bindParam(':artikelid',filter_var(trim($_POST['id']), FILTER_SANITIZE_STRING));
            

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
