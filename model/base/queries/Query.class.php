<?php
abstract class Query {
    
    /**
     *The DB Adpater
     */
    protected $dbAdapter;

    /**
     * We need the table associated to this object
     */    
    protected $tableName;
    
    
    /**
     * The query under construction
     */
    protected $sql;
    
    
    /**
     * Params needed for the current querry (array)
     */
    
    protected $params;
    
    
    public function __construct() {
        $this->tableName  = strtolower(substr(get_class($this),0,strlen(get_class($this))-3));
        $this->dbAdapter = PDODBAdapter::getInstance();
    }
    /**
     * Find a record wrt its id
     * @return the record if it exists, false otherwise
     */
     
    public function findById($id) {
        $this->dbAdapter->prepare("SELECT * FROM $this->tableName WHERE id=?");
        $this->dbAdapter->execute(array($id));
        return $this->dbAdapter->fetch(ucfirst($this->tableName));    
    }

    /**
     * Execute the query under construction
     */
    public function execute() {
        $this->dbAdapter->prepare($this->sql);
        $this->dbAdapter->execute($this->params);
        return $this->dbAdapter->fetchAll(ucfirst($this->tableName));
    }

    
    /** 
     * General Query
     * This is a preparation.
     * The query is execute only when the function execute is called
     * @param $cond : something after the where.....
     * @param $params the array necessary for the execution
     * return $this
     */
    function findWithCondition($cond,$params=false) {
        $this->sql = "SELECT * FROM $this->tableName WHERE $cond";
        $this->params = $params;
        return $this;
    }
    


    /**
     * Find all records
     * @return $this
     */
    public function findAll() {
        $this->sql = "SELECT * FROM $this->tableName";
        return $this;
    }
    
    /**
     * Add a limit in query
     * @param $start
     * @param $nb
     * @return $this
     */
    public function limit($start,$nb) {
        $this->sql  .= " LIMIT $start,$nb";
        return $this;
    }
    
    /**
     * Sort results 
     */
    
    public function orderBy($order) {
        $this->sql .= " ORDER BY $order";
        return $this;
    }
    
    
    /**
     * Automate  function findByXXX where XXX is a field of the given table
     */
    public function __call($name,$arguments) {
        if(strpos($name,"findBy")!==0) {
            throw new Exception("function $name unknow in class ".get_class($this) );
        }
        if(!is_array($arguments) || count($arguments)!=1){
            throw new Exception("Need only one argument in ".get_class($this)."->$name");
        }
        
        $field = strtolower(substr($name,6));

        return $this->findWithCondition("$field=?",$arguments);        
    }
    
}

?>
