<?php
// La classe de base. Ne touchez pas.


abstract class baseActions {
  protected $pdo;
  public function __construct() {
	global $pdo;
	$this->pdo = $pdo;
  }
  
  public function getModule() {
    $name = get_class($this);
    return substr($name,0,strlen($name)-7);
  }

  public function execute($action,$parameters=array()) {
    $todo = "execute".$action;
    if(!method_exists($this,$todo))
      throw new Exception("M&eacute;thode introuvable");
    if(count($parameters)==0)
	$this->$todo();
    else 
	call_user_func_array(array($this,$todo),$parameters);
    $m = $this->getModule();
    $v = $action."Vue";
    ob_start();
    include "modules/$m/vues/$v.php";
    $result = ob_get_contents();
    ob_end_clean();
    return $result;
  }
  
}
?>