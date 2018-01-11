<?php

/**
 * Provides a build function to build a Api from a database row.
 */
class ApiBuilder {
	protected $pdo;
	
	function __construct() {
		$this->pdo = DBConnection::getPDO();
	}
	
	/**
	 * Builds an object from the given row of an database query. If an attribute is not set, nothing will be set into the object
	 * @param $row array The object containing the data from <code>$row</code>
	 * @return Api The builded object
	 */
	protected function buildApi(array $row) {
		$object = new Api();
		
		if(isset($row['id'])) {
			$object->setId($row['id']);
		}
		
		if(isset($row['token'])) {
			$object->setToken($row['token']);
		}
		
		if(isset($row['url'])) {
			$object->setUrl($row['url']);
		}
		
		if(isset($row['name'])) {
			$object->setName($row['name']);
		}
		
		return $object;
	}
}
