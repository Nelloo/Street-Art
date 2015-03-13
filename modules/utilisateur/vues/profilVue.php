<?php
include("modules/photos/vues/_photosVue.php"); 

echo "<h2>Profil de ". $_SESSION["login"]."</h2>";
?>
<div id = 'info'>
	<?php

		$profil = $this->utilisateur;

		if(!empty($profil->avatar)) echo ">img alt='".$profil->login."' src='".$profil->avatar."'/>";
		else echo "<img alt='".$profil->login."' src='".URL."/img/avatars/anonyme.png'/>";
		//<p><a href='index.php?page=update_avatar'>Changer votre photo de profil</a></p>
	?>

</div>