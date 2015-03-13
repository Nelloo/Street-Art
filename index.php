<?php
	session_start();
	

	include "helpers/HTML.class.php";
	include "helpers/routing.php";
	require "config/constants.php";
	include "helpers/divers.php";
	include("modules/baseActions.class.php");
	include("helpers/autoload.php");	

	// Gestion des flashs	
	if(isset($_SESSION['warning'])) {$info = "<strong>Attention</strong> : ".$_SESSION['warning'];$style="alert-error";unset($_SESSION['warning']);}
	if(isset($_SESSION['info'])) {$info = $_SESSION['info'];$style="alert-success";unset($_SESSION['info']);}
	// Gestion de l'URL rewriting
	$path = isset($_GET['url']) ? $_GET['url'] : "";
	$path = ltrim($path, '/');
	$parameters = explode('/',$path);


	if($path == "")  {                     // No path elements means home
		$module = 'main';
		$action = 'index';
		$parameters=array();
	} else {
		$module = array_shift($parameters);
		$action = array_shift($parameters);
	}
	
	try {
		if(!file_exists("modules/$module/actions/".$module."Actions.class.php"))
			throw new Exception("Module introuvable");
		include "modules/$module/actions/".$module."Actions.class.php";
		$class=$module."Actions";
		$m = new $class();
		$result = $m->execute($action,$parameters);
		if(isAjax()) {
			
			echo $result;
			die(1);
		}
	} catch(Exception $e) {
		if(ENV=="PROD") {
			header('HTTP/1.1 404 Not Found');
			include("error404.php");
			die(1);
		} else {
			echo "<h1>Probl&egrave;me</h1>";
			echo "<b>Path : </b>$path<br />";
			echo "<b>Module : </b>$module<br />";
			echo "<b>action : </b>$action<br />";
			echo "<b>Parameters : </b>";print_r($parameters);
			echo "<br /><br /><br /><br />Probleme : ".$e->getMessage();
			die(1);	
		}
	
	}
	
	

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset='UTF-8'>
	<title>Street'art</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel='stylesheet' type='text/css' href='<?php echo URL;?>/css/bootstrap.css' />
	<link rel='stylesheet' type='text/css' href='<?php echo URL;?>/css/stylesite.css' />
	<script type='text/javascript' src='<?php echo URL;?>/js/jquery-1.9.0.js'></script>
	<script type='text/javascript' src='<?php echo URL;?>/js/bootstrap.js'></script>
	<script type="text/javascript" src="<?php echo URL;?>js/ajax.js"></script>
	
	<script type="text/javascript" src='<?php echo URL;?>js/jquery-ui-1.10.0.custom.min.js'></script>
</head>

<body>

<!-- Ici le header et tout ce que vous voulez -->

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container"> 
        <div id="navbar" class="navbar-collapse collapse">
            <div class="container-fluid">
                <div class="row">
                    <div  class='col-md-4'><span id="titre">Street Art</span></div>
                    <div class='col-md-3'>
                        <form class="formulaire">
                           <input id="recherche" class="champ" type="text" placeholder="Recherche">
                           <input id="rech_valide" type="submit" value="OK" />
                       </form>
                    </div>
                    <div class='col-md-4'>
                        <?php
                            $URL = URL;
                            echo "<ul class='nav navbar-nav'>";
                            if(isset($_SESSION['id'])) {
//                                echo "<li><a href='#'>Accueil</a></li>
//                                    <li><a href='#ar'>Artistes</a></li>
//                                    <li><a href='#alb'>Oeuvres</a></li>";
                                echo "<li><a href='$URL/utilisateur/profil'>Profil</a></li>";
                                echo "<li><a href='$URL/photos/upload'>Uploader</a></li>";
                                echo "<li><a href='$URL/utilisateur/deconnexion'>Déconnexion</a></li>";
                            } else {
                                echo "<li><a href='$URL/utilisateur/inscription'>Inscription</a></li>";
                                echo "<li><a href='$URL/utilisateur/connexion'>Connexion</a></li>";
                            }
                            echo "</ul>";
                        ?>
                    </div>
                    <div class='col-md-1'></div>
                </div>
            </div>
        </div>
    </div><!--/.nav-collapse -->
</nav>

<div class='container-fluid'>
    <div class='row'>

        <div class='col-md-12' id='entete'>
            <h1 id='Bienvenue'>
            <?php
                if(isset($_SESSION['id'])) {
                    echo "Bienvenue, ".$_SESSION['login']." !";
                }
                else {
                    echo "Bienvenue sur Street'Art !"; 
                }
            ?>
            </h1>
        </div>

    </div>
</div>

<div id="profil">
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-md-3' ></div>
            <div class='col-md-6'>
                <?php
                    if(isset($_SESSION['id'])) {
                        echo "<img id='silhouette' src='img/silhouette.png' alt='silhouette' onmousedown='return false'></img>";
                    }
                ?>
            </div>
            <div class='col-md-3'></div>
        </div>
    </div>

   <?php
    if(isset($_SESSION['id'])) {
        echo "<div class='container-fluid'>
            <div class='row'>
                <div class='col-md-2'></div>";
        echo $result; // $result contient le résultat de module->action.  
        echo "  <div class='col-md-2'></div>
            </div>
        </div>";
    }
    ?>
</div>

<?php
if(isset($info)){
	echo "<div class='alert $style'>$info</div>";
}
?>

<?php if(!isset($_SESSION['id'])) {echo $result;} ?>

<footer></footer>

<div class="modal"><!-- Place at bottom of page --></div>
</body>

</html>
