<form action="<?php echo URL;?>/utilisateur/inscription" method="post">
	login : <input id="login" type='text' name='login' placeholder='Votre login'/><span id="message"></span>
	mail : <input type='email' name='mail' placeholder='Votre mail'/>
	mot de passe : <input type='password' name='mdp' placeholder='Votre mot de passe'/>

	<input type='submit'/>
</form>

<script type="text/javascript">
$(document).ready(function(){
	$("#login").change(function(){
		var val=$("#login").val();
		executeAjax("http://localhost/photo//utilisateur/ajaxloginexiste/"+val,"#message");
	});
});
</script>