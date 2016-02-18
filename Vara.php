<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Vara
 *
 * @author h14rtand
 */
class Vara {
    private $id;
    private $namn;
    private $kategori;
    private $pris;
    private $bildurl;
    private $infoshort;
    private $infolong;
    
    function __construct($id, $namn, $kategori, $pris, $bildurl, $infoshort, $infolong) {
        $this->id = $id;
        $this->namn = $namn;
        $this->kategori = $kategori;
        $this->pris = $pris;
        $this->bildurl = $bildurl;
        $this->infoshort = $infoshort;
        $this->infolong = $infolong;
    }

    function getId() {
        return $this->id;
    }

    function getNamn() {
        return $this->namn;
    }

    function getKategori() {
        return $this->kategori;
    }

    function getPris() {
        return $this->pris;
    }

    function getBildurl() {
        return $this->bildurl;
    }

    function getInfoshort() {
        return $this->infoshort;
    }

    function getInfolong() {
        return $this->infolong;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNamn($namn) {
        $this->namn = $namn;
    }

    function setKategori($kategori) {
        $this->kategori = $kategori;
    }

    function setPris($pris) {
        $this->pris = $pris;
    }

    function setBildurl($bildurl) {
        $this->bildurl = $bildurl;
    }

    function setInfoshort($infoshort) {
        $this->infoshort = $infoshort;
    }

    function setInfolong($infolong) {
        $this->infolong = $infolong;
    }


    
    
    
    
}


