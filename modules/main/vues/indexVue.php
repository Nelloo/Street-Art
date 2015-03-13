<?php
if(isset($_SESSION['id'])){
    echo "<div class='col-md-2 stat'>
        <span id='album'>Albums</span>
        <span id='nbalbum'>?</span>
    </div>
    <div class='col-md-2 stat'>
        <span id='photos'>Photos</span>
        <span id='nbphotos'>?</span>
    </div>
    <div class='col-md-2 stat'>
        <span id='followers'>Followers</span>
        <span id='nbfollowers'>$this->nbSuiveur</span>
    </div>
    <div class='col-md-2 stat'>
        <span id='abonnement'>Abonnements</span>
        <span id='nbabonnement'>$this->nbSuivi</span>
    </div>";
}
?>