<?php

/**
 * Provides a build function to build a Creator from a database row.
 */
class CreatorBuilder {
	protected $pdo;
	
	function __construct() {
		$this->pdo = DBConnection::getPDO();
	}
	
	/**
	 * Builds an object from the given row of an database query. If an attribute is not set, nothing will be set into the object
	 * @param $row array The object containing the data from <code>$row</code>
	 * @return Creator The builded object
	 */
	protected function buildCreator(array $row) {
		$object = new Creator();
		
		if(isset($row['id'])) {
			$object->setId($row['id']);
		}
		
		if(isset($row['name'])) {
			$object->setName($row['name']);
		}
		
		if(isset($row['twitterId'])) {
			$object->setTwitterId($row['twitterId']);
		}
		
		if(isset($row['youtubeId'])) {
			$object->setYoutubeId($row['youtubeId']);
		}
		
		if(isset($row['youtubeUpload'])) {
			$object->setYoutubeUpload($row['youtubeUpload']);
		}
		
		if(isset($row['instagramId'])) {
			$object->setInstagramId($row['instagramId']);
		}
		
		if(isset($row['twitchId'])) {
			$object->setTwitchId($row['twitchId']);
		}
		
		return $object;
	}
}
