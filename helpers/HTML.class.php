<?php
class HTML {


  public function displaySong($song) {
	$titre = $song['nom'];
	
	$fichier = $song['fichier'];
	$div = "song".$song['id'];
	$id = $song['id'];
	$result =  "<div class='song'>";
	
	$result = $result. "<a href='#' onclick='changeMP3(\"$fichier\");'><img width='32px' src='./img/play.png' /></a>&nbsp;&nbsp;<span id='$div' song='$id'>$titre</span>&nbsp;&nbsp;";
	

	foreach($song['tags'] as $t) {
		$result.="<span class='label label-info'>$t</span>";
	}

	$result.= "</div>";
	return $result;
  }

  private function options($options) {
    $ret = "";
    foreach($options as $att=>$val) 
      $ret = $ret."$att='$val' ";
    return $ret;
  }
  
  public function a($link,$aff,$options=array()) {
    $o = $this->options($options);
    return "<a href='$link' $o>$aff</a>";
  }	
  

  public function table($tab,$ent) {
    $res = "<table><tr>";
    foreach($ent as $e) {
      $res.="<th>$e</th>";
    }
    $res .="</tr>\n";
    
    foreach($tab as $ligne) {
      $res = $res."<tr>";
      foreach($ligne as $cellule) {
	$res = $res."<td>$cellule</td>";	
      }
      
      $res = $res."</tr>\n";
      
    }
    
    $res=$res."</table>";
    return $res;	
  }
  
  public function input($type,$name,$options=array()) {
    $o = $this->options($options);
    return "<input type='$type' name='$name' $o />";
  }


  public function select($name,$select,$options=array()) {
    $o = $this->options($options);
    $ret = "<select name='$name' $o>";
    foreach($select as $k=>$aff) {
      $ret = $ret."<option value='$k'>$aff</option>";
    }
    return $ret."</select>";
  }


  public function date($vj,$vm,$va) {
    $jours = array();
    for($j=1;$j<=31;$j++) $jours[$j]= $j;
  
    $ret = $this->select($vj,$jours);
    $mois=array(1=>'janvier',2=>'f&eacute;vrier',3=>'mars',4=>'avril',5=>'mai',6=>'juin',7=>'juillet',8=>'aout',9=>'sepetembre',10=>'octobre',11=>'novembre',12=>'decembre');
    $ret = $ret.$this->select($vm,$mois);
    
    $ans=array();
    for($a=1950;$a<=2050;$a++)
      $ans[$a]=$a;
    return $ret.$this->select($va,$ans);
    
  }

}




?>