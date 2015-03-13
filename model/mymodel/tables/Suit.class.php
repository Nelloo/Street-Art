<?php

class Suit extends Table {
    public $suiveur_id;
    public $suivi_id;
    
    public function __construct($suiveur="",$suivi="",$id=false) {
        parent::__construct();
        $this->suiveur_id = $suiveur;
        $this->suivi_id = $suivi;
    }
    

}