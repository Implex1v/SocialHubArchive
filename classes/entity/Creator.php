<?php

/**
 * The PHP class representation of a Creator
 */
class Creator {
	/**
	 * @var integer $id The id
	 */
	protected $id;
	/**
	 * @var string $name The name
	 */
	protected $name;
	/**
	 * @var string $twitterId The twitterId
	 */
	protected $twitterId;
	
	/**
	 * Returns the attribute $id
	 * @return integer|null The attribute's value
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * Returns the attribute $name
	 * @return string|null The attribute's value
	 */
	public function getName() {
		return $this->name;
	}
	
	/**
	 * Returns the attribute $twitterId
	 * @return string|null The attribute's value
	 */
	public function getTwitterId() {
		return $this->twitterId;
	}
	
	/**
	 * Sets the attribute $id to the passed value
	 * @param integer $id The new value
	 */
	public function setId($id) {
		$this->id = $id;
	}
	
	/**
	 * Sets the attribute $name to the passed value
	 * @param string $name The new value
	 */
	public function setName($name) {
		$this->name = $name;
	}
	
	/**
	 * Sets the attribute $twitterId to the passed value
	 * @param string $twitterId The new value
	 */
	public function setTwitterId($twitterId) {
		$this->twitterId = $twitterId;
	}
	
}
