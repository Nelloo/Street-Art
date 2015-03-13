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
	<title>Ton petit album photo</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel='stylesheet' type='text/css' href='<?php echo URL;?>/css/bootstrap.css' />
	<link rel='stylesheet' type='text/css' href='<?php echo URL;?>/css/style.css' />
	<script type='text/javascript' src='<?php echo URL;?>/js/jquery-1.9.0.js'></script>
	<script type='text/javascript' src='<?php echo URL;?>/js/bootstrap.js'></script>
	<script type="text/javascript" src="<?php echo URL;?>js/ajax.js"></script>
	
	<script type="text/javascript" src='<?php echo URL;?>js/jquery-ui-1.10.0.custom.min.js'></script>
</head>

<body>

<!-- Ici le header et tout ce que vous voulez -->

<h1>Bienvenue sur mon album photo</h1>
<?php
$URL = URL;
if(isset($_SESSION['id'])) {
	echo "Bonjour ". $_SESSION["login"];
	echo "<a href='$URL/utilisateur/deconnexion'>Deconnexion</a>";
	echo "<a href='$URL/photos/upload'>Uploader</a>";
	echo "<a href='$URL/utilisateur/profil'>Profil</a>";
} else {
	echo "<a href='$URL/utilisateur/inscription'>Inscrivez vous</a>";
	echo "<br /><a href='$URL/utilisateur/connexion'>connectez vous</a>";
}
?>

<?php
if(isset($info)){
	echo "<div class='alert $style'>$info</div>";
}
?>

<?php echo $result; // $result contient le résultat de module->action. ?>



<footer>Le pied de la page</footer>
<!-- Ici le footer et tout ce que vous voulez -->

<div class="modal"><!-- Place at bottom of page --></div>
</body>

</html>
