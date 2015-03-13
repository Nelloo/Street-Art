<div id="connexion">
    <h2>Connectez-vous !<br/><span style='font-size:14px;'>Vous n'êtes pas inscrit ? <a href='#'>Je m'inscris !</a></span></h2>
    <form action="<?php echo URL;?>/utilisateur/connexion" method="post">
        <table>
            <tr><td>Login :</td><td><input type='text' name='login' placeholder='Votre login'/></td></tr>
            <tr><td>Mot de passe : &nbsp;</td><td><input type='password' name='mdp' placeholder='Votre mot de passe'/></td></tr>
            <tr><td colspan="2" style="text-align:center;"><br/><input type='submit'/></td></tr>
        </table>
    </form>
</div>