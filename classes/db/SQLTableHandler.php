<?php 

class SQLTableHandler {
	protected $pdo;
	
	function __construct() {
		$this->pdo = DBConnection::getPDO();
	}
	
	function createTables() {
		$this->pdo->query("DROP TABLE IF EXISTS Post;
		CREATE TABLE Post(
		id INT  AUTO_INCREMENT NOT NULL
		,
		link TEXT  ,
		released DATETIME  ,
		channel VARCHAR(64)  ,
		content TEXT  ,
		comment TEXT  ,
		originalId VARCHAR(64)  ,
		creatorId VARCHAR(64)  ,
		PRIMARY KEY (id)
		) DEFAULT CHARSET utf8;
		");
		$this->pdo->query("DROP TABLE IF EXISTS Api;
		CREATE TABLE Api(
		id INT  AUTO_INCREMENT NOT NULL
		,
		token TEXT  ,
		url VARCHAR(64)  ,
		name VARCHAR(64) UNIQUE ,
		PRIMARY KEY (id)
		) DEFAULT CHARSET utf8;
		");
		$this->pdo->query("DROP TABLE IF EXISTS Creator;
		CREATE TABLE Creator(
		id INT  AUTO_INCREMENT NOT NULL
		,
		name VARCHAR(64) UNIQUE ,
		twitterId VARCHAR(64)  ,
		PRIMARY KEY (id)
		) DEFAULT CHARSET utf8;
		");
	}
	
	function deleteTables() {
		$this->pdo->query("DROP TABLE IF EXISTS Post;");
		$this->pdo->query("DROP TABLE IF EXISTS Api;");
		$this->pdo->query("DROP TABLE IF EXISTS Creator;");
	}
}
