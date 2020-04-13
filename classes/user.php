<?php

include 'classes/config.php';

class User {

    protected $_config;

    // Database Connection
    public $dbc;

    /* function __construct
     * Opens the database connection
     * @param $config is an array of database connection parameters
     */
    public function __construct( array $config ) {
        $this->_config = $config;
        $this->getPDOConnection();
    }

    /* Function __destruct
     * Closes the database connection
     */
    public function __destruct() {
		$this->dbc = NULL;
	}

    /* Function getPDOConnection
     * Get a connection to the database using PDO.
     */
    private function getPDOConnection() {
        // Check if the connection is already established
        if ($this->dbc == NULL) {
            // Create the connection
            $dsn = "" .
                $this->_config['driver'] .
                ":host=" . $this->_config['host'] .
                ";dbname=" . $this->_config['dbname'];

            try {
                $this->dbc = new PDO( $dsn, $this->_config[ 'username' ], $this->_config[ 'password' ] );
            } catch( PDOException $e ) {
                echo __LINE__.$e->getMessage();
            }
        }
    }

    /* Function runQuery
     * Runs a insert, update or delete query
     * @param string sql insert update or delete statement
     * @return int count of records affected by running the sql statement.
     */
    public function runQuery( $sql ) {
        try {
        	$count = $this->dbc->exec($sql) or print_r($this->dbc->errorInfo());
        } catch(PDOException $e) {
        	echo __LINE__.$e->getMessage();
        }
        return $count;
    }

    /* Function getQuery
     * Runs a select query
     * @param string sql insert update or delete statement
     * @returns associative array
     */
	public function getQuery( $sql ) {
		$stmt = $this->dbc->query( $sql );
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

		return $stmt;
	}
}