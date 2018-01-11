<?php

/**
 * The PHP class representation of a Api
 */
class Api {
	/**
	 * @var integer $id The id
	 */
	protected $id;
	/**
	 * @var string $token The token
	 */
	protected $token;
	/**
	 * @var string $url The url
	 */
	protected $url;
	/**
	 * @var string $name The name
	 */
	protected $name;
	
	/**
	 * Returns the attribute $id
	 * @return integer|null The attribute's value
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * Returns the attribute $token
	 * @return string|null The attribute's value
	 */
	public function getToken() {
		return $this->token;
	}
	
	/**
	 * Returns the attribute $url
	 * @return string|null The attribute's value
	 */
	public function getUrl() {
		return $this->url;
	}
	
	/**
	 * Returns the attribute $name
	 * @return string|null The attribute's value
	 */
	public function getName() {
		return $this->name;
	}
	
	/**
	 * Sets the attribute $id to the passed value
	 * @param integer $id The new value
	 */
	public function setId($id) {
		$this->id = $id;
	}
	
	/**
	 * Sets the attribute $token to the passed value
	 * @param string $token The new value
	 */
	public function setToken($token) {
		$this->token = $token;
	}
	
	/**
	 * Sets the attribute $url to the passed value
	 * @param string $url The new value
	 */
	public function setUrl($url) {
		$this->url = $url;
	}
	
	/**
	 * Sets the attribute $name to the passed value
	 * @param string $name The new value
	 */
	public function setName($name) {
		$this->name = $name;
	}
	
}
