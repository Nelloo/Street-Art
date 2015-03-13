<?php
class utilisateurActions extends baseActions {

public function executeAjaxloginexiste($login){
	$sql = new UtilisateurSQL();
	$result = $sql->findBylogin($login)->execute();
if(count($result)==0){
	$this->message = "Ce login est disponible";
}else{
	$this->message = "Ce login n'est pas disponible";
}}

    public function executeInscription() {
		if(isset($_POST['login'])){
			$sql = new UtilisateurSQL();
			$existe = $sql->findBylogin($_POST['login'])->execute();
			if(count($existe)==0){
				$u = new utilisateur($_POST['login'],$_POST['mail'],$_POST['mdp'],"");
				$u->save();
				$_SESSION['id'] = $u->getId();
				$_SESSION['login'] = $u->login;
				header("location:".URL);
			}
		}
    }
	
    /** 
    * Fonction de connexion, on reçoit dans le Post le login et le mot de passe
    */
    public function executeconnexion() {
		if(isset($_POST['login'])){
			$sql = new UtilisateurSQL();
			$existe = $sql->findBylogin($_POST['login'])->execute();
			if(count($existe)==1){
				$u = $existe[0];
				if($u->mdp==$_POST['mdp']){
				$_SESSION['id'] = $u->getId();
				$_SESSION['login'] = $u->login;
				header("location:".URL);
			}
		}
    }
   }

    /** 
    * Fonction de changement de profil
    */

  public function executeprofil() {
		$sql = new UtilisateurSQL();
		$this->utilisateur = $sql->findById($_SESSION['id']);
		if($this->utilisateur==false) header("Location".URL);

	}

 /** 
  *Fonction de déconnexion
 */
  public function executedeconnexion() {
	    session_destroy();
	    header("location:".URL);
  }

  
}

//photo que de cette album

/* public function executeAlbum($ida){
	$sql = new PhotoSQL();
	$this->photos = $sql->findWithCondition("id IN(SELECT photo_id FROM contient WHERE album_id=?", array($ida))orderBy("nom")->execute();*/
//}




