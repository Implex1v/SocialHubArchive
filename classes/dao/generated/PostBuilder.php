<?php

/**
 * Provides a build function to build a Post from a database row.
 */
class PostBuilder {
	protected $pdo;
	
	function __construct() {
		$this->pdo = DBConnection::getPDO();
	}
	
	/**
	 * Builds an object from the given row of an database query. If an attribute is not set, nothing will be set into the object
	 * @param $row array The object containing the data from <code>$row</code>
	 * @return Post The builded object
	 */
	protected function buildPost(array $row) {
		$object = new Post();
		
		if(isset($row['id'])) {
			$object->setId($row['id']);
		}
		
		if(isset($row['link'])) {
			$object->setLink($row['link']);
		}
		
		if(isset($row['released'])) {
			$object->setReleased($row['released']);
		}
		
		if(isset($row['channel'])) {
			$object->setChannel($row['channel']);
		}
		
		if(isset($row['content'])) {
			$object->setContent($row['content']);
		}
		
		if(isset($row['comment'])) {
			$object->setComment($row['comment']);
		}
		
		return $object;
	}
}
