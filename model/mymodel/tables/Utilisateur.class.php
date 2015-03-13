<?php

class Utilisateur extends Table {
    public $login;
    public $mail;
    public $mdp;
    public $avatar;
    
    public function __construct($l="",$m="",$p="",$a="",$id=false) {
        parent::__construct();
        $this->login=$l;
        $this->mail = $m;
        $this->mdp = $p;
        $this->avatar = $a;
        $this->id = $id;
    }
    
    public function suivre($suivi_id) {
        if($this->id==false)
            return;
        $s = new Suit($this->id,$suivi_id);
        $s->save();
    }
}
