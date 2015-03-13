<?php
class mainActions extends baseActions {

  public function executeindex() {
      if(isset($_SESSION['id'])){
      	$sql = new PhotoSQL();
      	$this->photo=$sql->findByutilisateur_id($_SESSION['id'])
      		->orderBy("post_date DESC")
      		->execute();
      }
      $sqlU = new UtilisateurSQL();
      $this->nbSuiveur = $sqlU->nbAbonne($_SESSION['id']);
       $sqlu = new UtilisateurSQL();
      $this->nbSuivi = $sqlu->nbAbonnement($_SESSION['id']);
}
}
?>
