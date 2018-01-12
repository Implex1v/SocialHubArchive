<?php

/**
 * DAO implementation class. Use this class to create a DAO object
 */
class CreatorDAOImpl extends CreatorCustomDAOImpl implements CreatorDAO {
	function getCount() {
		$result = $this->pdo->query("SELECT COUNT(*) AS c FROM Creator;");
		if($result) {
			$row = $result->fetch();
			return $row['c'];
		} else {
			return 0;
		}
	}
	
	/**
	 * {@inheritdoc}
	 */
	function create(Creator $creator) {
		$data = array(
			"name" => $creator->getName(),
			"twitterId" => $creator->getTwitterId(),
			"youtubeId" => $creator->getYoutubeId(),
			"youtubeUpload" => $creator->getYoutubeUpload(),
			"instagramId" => $creator->getInstagramId(),
			"twitchId" => $creator->getTwitchId(),
		);
		$statement = $this->pdo->prepare("INSERT INTO Creator (name,twitterId,youtubeId,youtubeUpload,instagramId,twitchId) VALUES (:name,:twitterId,:youtubeId,:youtubeUpload,:instagramId,:twitchId);");
		$statement->execute($data);
		
		if($statement AND $statement->rowCount() > 0) {
			$id = $this->pdo->lastInsertId();
			$creator->setId($id);
			return $creator;
		} else {
			return null;
		}
	}
	
	/**
	 * {@inheritdoc}
	 */
	function read($id) {
		$statement = $this->pdo->prepare("SELECT * FROM Creator WHERE id = :id;");
		$data = array("id" => $id);
		$statement->execute($data);
		$row = $statement->fetch();
		
		if($row) {
			return $this->buildCreator($row);
		} else {
			return null;
		}
	}
	
	/**
	 * {@inheritdoc}
	 */
	function readAll() {
		$statement = $this->pdo->prepare("SELECT * FROM Creator;");
		$statement->execute();
		
		$array = array();
		while($row = $statement->fetch()) {
			$object = $this->buildCreator($row);
			$array[] = $object;
		}
		
		return $array;
	}
	
	/**
	 * {@inheritdoc}
	 */
	function update(Creator $object) {
		if($object->getId()) {
			$statement = $this->pdo->prepare("UPDATE Creator SET name = :name, twitterId = :twitterId, youtubeId = :youtubeId, youtubeUpload = :youtubeUpload, instagramId = :instagramId, twitchId = :twitchId WHERE id = :id;");
			$data = array(
				"id" => $object->getId(), "name" => $object->getName(), "twitterId" => $object->getTwitterId(), "youtubeId" => $object->getYoutubeId(), "youtubeUpload" => $object->getYoutubeUpload(), "instagramId" => $object->getInstagramId(), "twitchId" => $object->getTwitchId(),
			);
			$statement->execute($data);
			
			if($statement->rowCount() > 0) {
				return $this->read($object->getId());
			} else {
				return null;
			}
		} else {
			return null;
		}
	}
	
	/**
	 * {@inheritdoc}
	 */
	function delete($id) {
		$statement = $this->pdo->prepare("DELETE FROM Creator WHERE id = :id;");
		$data = array("id" => $id);
		$statement->execute($data);
		
		return $statement->rowCount() > 0;
	}
	
	/**
	 * {@inheritdoc}
	 */
	function deleteEntity(Creator $creator) {
		$statement = $this->pdo->prepare("DELETE FROM Creator WHERE id = :id;");
		$data = array("id" => $creator->getId());
		$statement->execute($data);
		
		return $statement->rowCount() > 0;
	}
	
	/**
	 * {@inheritdoc}
	 */
	function deleteAll() {
		$statement = $this->pdo->prepare("DELETE FROM Creator;");
		$statement->execute();
		
		return $statement->rowCount() > 0;
	}
	
	/**
	 * {@inheritdoc}
	 */
	function readByName($name) {
		$statement = $this->pdo->prepare("SELECT * FROM Creator WHERE name = :attribute;");
		$data = array("attribute" => $name);
		$statement->execute($data);
		$row = $statement->fetch();
		
		if($row) {
			return $this->buildCreator($row);
		} else {
			return null;
		}
	}
	
	
	/**
	 * {@inheritdoc}
	 */
	function getLatestError() {
		return $this->pdo->errorInfo();
	}
}
