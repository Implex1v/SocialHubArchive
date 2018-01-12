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
	 * @var string $youtubeId The youtubeId
	 */
	protected $youtubeId;
	/**
	 * @var string $youtubeUpload The youtubeUpload
	 */
	protected $youtubeUpload;
	/**
	 * @var string $instagramId The instagramId
	 */
	protected $instagramId;
	/**
	 * @var string $twitchId The twitchId
	 */
	protected $twitchId;
	
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
	 * Returns the attribute $youtubeId
	 * @return string|null The attribute's value
	 */
	public function getYoutubeId() {
		return $this->youtubeId;
	}
	
	/**
	 * Returns the attribute $youtubeUpload
	 * @return string|null The attribute's value
	 */
	public function getYoutubeUpload() {
		return $this->youtubeUpload;
	}
	
	/**
	 * Returns the attribute $instagramId
	 * @return string|null The attribute's value
	 */
	public function getInstagramId() {
		return $this->instagramId;
	}
	
	/**
	 * Returns the attribute $twitchId
	 * @return string|null The attribute's value
	 */
	public function getTwitchId() {
		return $this->twitchId;
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
	
	/**
	 * Sets the attribute $youtubeId to the passed value
	 * @param string $youtubeId The new value
	 */
	public function setYoutubeId($youtubeId) {
		$this->youtubeId = $youtubeId;
	}
	
	/**
	 * Sets the attribute $youtubeUpload to the passed value
	 * @param string $youtubeUpload The new value
	 */
	public function setYoutubeUpload($youtubeUpload) {
		$this->youtubeUpload = $youtubeUpload;
	}
	
	/**
	 * Sets the attribute $instagramId to the passed value
	 * @param string $instagramId The new value
	 */
	public function setInstagramId($instagramId) {
		$this->instagramId = $instagramId;
	}
	
	/**
	 * Sets the attribute $twitchId to the passed value
	 * @param string $twitchId The new value
	 */
	public function setTwitchId($twitchId) {
		$this->twitchId = $twitchId;
	}
	
}
