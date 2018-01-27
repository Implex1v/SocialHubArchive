<?php

/**
 * DAO implementation class. Use this class to create a DAO object
 */
class ApiDAOImpl extends ApiCustomDAOImpl implements ApiDAO {
	function getCount() {
		$result = $this->pdo->query("SELECT COUNT(*) AS c FROM Api;");
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
	function create(Api $api) {
		$data = array(
			"token" => $api->getToken(),
			"url" => $api->getUrl(),
			"name" => $api->getName(),
			"optional" => $api->getOptional(),
		);
		$statement = $this->pdo->prepare("INSERT INTO Api (token,url,name,optional) VALUES (:token,:url,:name,:optional);");
		$statement->execute($data);
		
		if($statement AND $statement->rowCount() > 0) {
			$id = $this->pdo->lastInsertId();
			$api->setId($id);
			return $api;
		} else {
			return null;
		}
	}
	
	/**
	 * {@inheritdoc}
	 */
	function read($id) {
		$statement = $this->pdo->prepare("SELECT * FROM Api WHERE id = :id;");
		$data = array("id" => $id);
		$statement->execute($data);
		$row = $statement->fetch();
		
		if($row) {
			return $this->buildApi($row);
		} else {
			return null;
		}
	}
	
	/**
	 * {@inheritdoc}
	 */
	function readAll() {
		$statement = $this->pdo->prepare("SELECT * FROM Api;");
		$statement->execute();
		
		$array = array();
		while($row = $statement->fetch()) {
			$object = $this->buildApi($row);
			$array[] = $object;
		}
		
		return $array;
	}
	
	/**
	 * {@inheritdoc}
	 */
	function update(Api $object) {
		if($object->getId()) {
			$statement = $this->pdo->prepare("UPDATE Api SET token = :token, url = :url, name = :name, optional = :optional WHERE id = :id;");
			$data = array(
				"id" => $object->getId(), "token" => $object->getToken(), "url" => $object->getUrl(), "name" => $object->getName(), "optional" => $object->getOptional(),
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
		$statement = $this->pdo->prepare("DELETE FROM Api WHERE id = :id;");
		$data = array("id" => $id);
		$statement->execute($data);
		
		return $statement->rowCount() > 0;
	}
	
	/**
	 * {@inheritdoc}
	 */
	function deleteEntity(Api $api) {
		$statement = $this->pdo->prepare("DELETE FROM Api WHERE id = :id;");
		$data = array("id" => $api->getId());
		$statement->execute($data);
		
		return $statement->rowCount() > 0;
	}
	
	/**
	 * {@inheritdoc}
	 */
	function deleteAll() {
		$statement = $this->pdo->prepare("DELETE FROM Api;");
		$statement->execute();
		
		return $statement->rowCount() > 0;
	}
	
	/**
	 * {@inheritdoc}
	 */
	function readByName($name) {
		$statement = $this->pdo->prepare("SELECT * FROM Api WHERE name = :attribute;");
		$data = array("attribute" => $name);
		$statement->execute($data);
		$row = $statement->fetch();
		
		if($row) {
			return $this->buildApi($row);
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
