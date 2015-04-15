<?php

/**
 * Class Lp
 * handles the user's Lp and logout process
 */
class Stats
{
    /**
     * @var object The database connection
     */
    private $db_connection = null;
    /**
     * @var array Collection of error messages
     */
    public $errors = array();
    /**
     * @var array Collection of success / neutral messages
     */
    public $messages = array();
    
    public $result = array();

    public function __construct()
    {
    	$this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    	// change character set to utf8 and check it
    	if (!$this->db_connection->set_charset("utf8")) {
    		$this->errors[] = $this->db_connection->error;
    	}
    }
    /**
     * 
     */
    public function doGetStats($page)
    {
		// if no connection errors (= working database connection)
		if (!$this->db_connection->connect_errno) {
			$sql = "select * from tracker WHERE page LIKE "."'". htmlspecialchars($page)."'";
			$this->result = $this->db_connection->query($sql);
			if ($this->result->num_rows > 1) {
				// show the number
				return $this->result->num_rows;
			}	
		}
		
    }
    
    public function doGetDistinctStats($page)
    {
    	// if no connection errors (= working database connection)
    	if (!$this->db_connection->connect_errno) {
    		$sql = "SELECT DISTINCT ip FROM tracker WHERE page LIKE "."'". htmlspecialchars($page)."'";
    		$this->result = $this->db_connection->query($sql);
    		if ($this->result->num_rows > 0) {
    			// show the number
    			return $this->result->num_rows;
    		}
    	}
    
    }
    

}
