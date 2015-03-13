<?php

include("config/constants.php");
include("helpers/autoload.php");	


// Question 1 : Créez un utilisateur et sauvez le. Affichez ensuite son id (on le notera idu)
$u = new Utilisateur("moi","moi@moi","moi","");
$u->save();
echo "$u->login : ".$u->getId();

// Mettez en commentaire quand vous avez fini
// Question 2 : Créez une chanson pour l'utilisateur précédent et sauvez la

$p = new photo("toto","","",date("Y-m-d"),"paysage","1");
$p->save();
echo $p->getId();
echo "</br>";
echo 

// Mettez en commentaire quand vous avez fini
// Question 3 : Récupérez L'utilisateur ayant l'id idu. Affichez son mail



// Question 4 : Récupérez toutes les chansons de cet utilisateur et affichez leur nom

$sql = new photoSQL();
$tous = $sql->findByutilisateur_id(1)->orderBy("titre")->execute();
foreach($tous as $p){
	echo $p->titre."</br>";
}
// Question 5 : faites la même chose en ordonnant par la date de création (post_date)


?>
