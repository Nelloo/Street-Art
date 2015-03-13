<div id="inscription">
    <form action="<?php echo URL;?>/utilisateur/inscription" method="post">
        <table>
            <tr>
                <td>Login : </td>
                <td><input id="login" type='text' name='login' placeholder='Votre login'/><span id="message"></span></td>
            </tr>
            <tr>
                <td>Mail : </td>
                <td><input type='email' name='mail' placeholder='Votre mail'/></td>
            </tr>
            <tr>
                <td>Mot de passe : &nbsp;</td>
                <td><input type='password' name='mdp' placeholder='Votre mot de passe'/></td>
            </tr>
            <tr><td colspan="2" style="text-align:center;"><br/><input type='submit'/></td></tr>
        </table>
    </form>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$("#login").change(function(){
		var val=$("#login").val();
		executeAjax("http://localhost/photo//utilisateur/ajaxloginexiste/"+val,"#message");
	});
});
</script>