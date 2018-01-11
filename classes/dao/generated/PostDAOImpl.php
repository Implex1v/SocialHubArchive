<?php

/**
 * DAO implementation class. Use this class to create a DAO object
 */
class PostDAOImpl extends PostCustomDAOImpl implements PostDAO {
	function getCount() {
		$result = $this->pdo->query("SELECT COUNT(*) AS c FROM Post;");
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
	function create(Post $post) {
		$data = array(
			"link" => $post->getLink(),
			"released" => $post->getReleased(),
			"channel" => $post->getChannel(),
			"content" => $post->getContent(),
			"comment" => $post->getComment(),
			"originalId" => $post->getOriginalId(),
		);
		$statement = $this->pdo->prepare("INSERT INTO Post (link,released,channel,content,comment,originalId) VALUES (:link,:released,:channel,:content,:comment,:originalId);");
		$statement->execute($data);
		
		if($statement AND $statement->rowCount() > 0) {
			$id = $this->pdo->lastInsertId();
			$post->setId($id);
			return $post;
		} else {
			return null;
		}
	}
	
	/**
	 * {@inheritdoc}
	 */
	function read($id) {
		$statement = $this->pdo->prepare("SELECT * FROM Post WHERE id = :id;");
		$data = array("id" => $id);
		$statement->execute($data);
		$row = $statement->fetch();
		
		if($row) {
			return $this->buildPost($row);
		} else {
			return null;
		}
	}
	
	/**
	 * {@inheritdoc}
	 */
	function readAll() {
		$statement = $this->pdo->prepare("SELECT * FROM Post;");
		$statement->execute();
		
		$array = array();
		while($row = $statement->fetch()) {
			$object = $this->buildPost($row);
			$array[] = $object;
		}
		
		return $array;
	}
	
	/**
	 * {@inheritdoc}
	 */
	function update(Post $object) {
		if($object->getId()) {
			$statement = $this->pdo->prepare("UPDATE Post SET link = :link, released = :released, channel = :channel, content = :content, comment = :comment, originalId = :originalId WHERE id = :id;");
			$data = array(
				"id" => $object->getId(), "link" => $object->getLink(), "released" => $object->getReleased(), "channel" => $object->getChannel(), "content" => $object->getContent(), "comment" => $object->getComment(), "originalId" => $object->getOriginalId(),
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
		$statement = $this->pdo->prepare("DELETE FROM Post WHERE id = :id;");
		$data = array("id" => $id);
		$statement->execute($data);
		
		return $statement->rowCount() > 0;
	}
	
	/**
	 * {@inheritdoc}
	 */
	function deleteEntity(Post $post) {
		$statement = $this->pdo->prepare("DELETE FROM Post WHERE id = :id;");
		$data = array("id" => $post->getId());
		$statement->execute($data);
		
		return $statement->rowCount() > 0;
	}
	
	/**
	 * {@inheritdoc}
	 */
	function deleteAll() {
		$statement = $this->pdo->prepare("DELETE FROM Post;");
		$statement->execute();
		
		return $statement->rowCount() > 0;
	}
	
	
	/**
	 * {@inheritdoc}
	 */
	function getLatestError() {
		return $this->pdo->errorInfo();
	}
}
