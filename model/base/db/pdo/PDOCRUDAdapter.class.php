<?php
/**
 * PDO implementation to CRUD
 */
class PDOCRUDAdapter implements CRUDAdapter {

    protected static $pdoCRUDAdapter;

    /**
     * Need a connection to the database
     */
    private $pdodbadapter;

    /**
     * Constructor
     */
    public function __construct() {
        $this->pdodbadapter =PDODBAdapter::getInstance();
    }

    protected function __clone()
    {
    } // Méthode de clonage en privé aussi.

    public static function getInstance()
    {
        if (!isset(self::$pdoCRUDAdapter)) // Si on n'a pas encore instancié notre classe.
        {
            self::$pdoCRUDAdapter = new self; // On s'instancie nous-mêmes. :)
        }

        return self::$pdoCRUDAdapter;
    }



    /**
     * Save inside the DB
     */
    public function save($instance) {
        if($instance->isNew()) {
            $this->insert($instance);
        } else {
            $this->update($instance);
        }
    }
    
    
    /**
     * Insert INTO ....
     */
    private function insert($instance) {
        $tableName = $instance->getTableName();
        
    
        $sql = "INSERT INTO $tableName VALUES(NULL";
        
        $vars = get_class_vars(get_class($instance));
        $nb = count($vars);
        
        for($i = 0;$i<$nb;$i++)
            $sql = $sql.",?";
        $sql = $sql .")";

        $values = array();
        foreach($vars as $k=>$v) {
            $values[] = $instance->$k;
        }
        $this->pdodbadapter->prepare($sql);
        $this->pdodbadapter->execute($values);
        $instance->setId($this->pdodbadapter->lastInsertId());
    }
    
    
    /**
     * UPDATE ...
     */
    public function update($instance) {
        $tableName = $instance->getTableName();
        $sql = "UPDATE $tableName SET ";
        $vars = get_class_vars(get_class($instance));
        
        $values = array();
        $first = true;
        foreach($vars as $k=>$v) {
            $values[] = $instance->$k;
            if($first==false)
                $sql = $sql .",";
            $sql = $sql . "$k = ?";
            $first =false;
        }
        
        $sql = $sql."WHERE id=?";
        $values[] = $instance->getId();
        $this->pdodbadapter->prepare($sql);
        $this->pdodbadapter->execute($values);
        
    }
    
    /**
     * DELETE FROM ....
     */
    public function delete($instance) {
        if($instance->isNew()==true) {
            return;
        }
        
        $tableName = $instance->getTableName();
        
        $sql = "DELETE FROM $tableName WHERE id=?";
        
        $this->pdodbadapter->prepare($sql);
        $this->pdodbadapter->execute(array($instance->getId()));
    }
}


?>