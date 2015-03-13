<?php
class photosActions extends baseActions {
    public function executesupprimer($photo_id){
    if(!isset($_SESSION['id'])){
        header("location:index.php");}
        $sql = new PhotoSQL();
        $c = $sql->findById($photo_id);
        if($c==false || $c->utilisateur_id!=$_SESSION['id'])
            header("location:".URL."error404.php");
        
        unlink($c->fichier);
        $c->delete();
        $_SESSION['info']='Votre photo à bien été supprimée';
        header("Location:".$_SERVER['HTTP_REFERER']);
    }
    public function executeupload(){
        if(!isset($_SESSION['id'])){
            header("location:".URL);
        }
        if(isset($_FILES['photo'])){
            $error = false;
            $extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
            $extension_upload = strtolower(  
                substr(  strrchr($_FILES['photo']['name'], '.')  ,1)  );
        
            if ( !in_array($extension_upload,$extensions_valides) ) 
                $error="Extension non valide";
            if($error==false && $_FILES['photo']['error']==0 && $_FILES['photo']['size']<3000000){
                $fichier="./uploads/".uniqid().".$extension_upload";

                if(move_uploaded_file($_FILES['photo']['tmp_name'],$fichier)) {
                   $c = new Photo($_POST['nom'],$fichier,date("Y-m-d h:i:s"),$_POST['style'],$_SESSION['id']);
                                   $c->save();
                                   header("Location:".URL);
                }
        }
      
    }
    }
}
