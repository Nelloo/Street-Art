<?php
    class UtilisateurSQL extends Query {
        public function nbAbonne($id){
            $pdo = $this->dbAdapter->pdo;
            $s = "SELECT COUNT(*) FROM suit WHERE suivi_id=?";
            $q = $pdo->prepare($s);
            $q->execute(array($id));
            $tab = $q->fetch();
            return $tab[0];

        }

         public function nbAbonnement($id){
            $pdo = $this->dbAdapter->pdo;
            $s = "SELECT COUNT(*) FROM suit WHERE suiveur_id=?";
            $q = $pdo->prepare($s);
            $q->execute(array($id));
            $tab = $q->fetch();
            return $tab[0];

        }


    }
