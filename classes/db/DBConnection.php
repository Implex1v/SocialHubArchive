<?php

/**
 *class for connection to the database
 */
class DBConnection {
	
	/**
	 * Returns a connection to the database via PDO
	 */
	public static function getPDO() {
		$dbConfig = array(
			"host" => "localhost",
			"username" => "socialhub",
			"password" => "2DQQVhCE8cKpJqOlZ",
			"database" => "socialhub"
		);
		
		return new \PDO('mysql:host='.$dbConfig['host'].';dbname='.$dbConfig['database'], $dbConfig['username'], $dbConfig['password']);
	}
}
