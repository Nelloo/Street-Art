<?php

class Contient extends Table {
    public $album_id;
    public $photo_id;
    
    public function __construct($a="",$c="",$id=false) {
        parent::__construct();
        $this->album_id = $p;
        $this->photo_id = $c;
    }
    

}