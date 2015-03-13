<?php
/**
 * Adapter to the Database
 */
interface DBAdapter {
    
    /**
     * Prepare the query
     */
    function prepare($query);
    
    /**
     * Execute the query
     */
    function execute($params=false);
    
    /**
     * Fetch a record
     * @param : the class name of the instance created
     */
    function fetch($className);
    
    /**
     * Fetch all records
     * @param : the class name of the instances created
     */
    function fetchAll($className);
    
    
    /**
     * Return the last inserted id
     */
    function lastInsertId();
    
    
}
?>