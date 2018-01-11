<?php

/**
 * The PHP class representation of a Post
 */
class Post {
	/**
	 * @var integer $id The id
	 */
	protected $id;
	/**
	 * @var string $link The link
	 */
	protected $link;
	/**
	 * @var object $released The released
	 */
	protected $released;
	/**
	 * @var string $channel The channel
	 */
	protected $channel;
	/**
	 * @var string $content The content
	 */
	protected $content;
	/**
	 * @var string $comment The comment
	 */
	protected $comment;
	
	/**
	 * Returns the attribute $id
	 * @return integer|null The attribute's value
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * Returns the attribute $link
	 * @return string|null The attribute's value
	 */
	public function getLink() {
		return $this->link;
	}
	
	/**
	 * Returns the attribute $released
	 * @return object|null The attribute's value
	 */
	public function getReleased() {
		return $this->released;
	}
	
	/**
	 * Returns the attribute $channel
	 * @return string|null The attribute's value
	 */
	public function getChannel() {
		return $this->channel;
	}
	
	/**
	 * Returns the attribute $content
	 * @return string|null The attribute's value
	 */
	public function getContent() {
		return $this->content;
	}
	
	/**
	 * Returns the attribute $comment
	 * @return string|null The attribute's value
	 */
	public function getComment() {
		return $this->comment;
	}
	
	/**
	 * Sets the attribute $id to the passed value
	 * @param integer $id The new value
	 */
	public function setId($id) {
		$this->id = $id;
	}
	
	/**
	 * Sets the attribute $link to the passed value
	 * @param string $link The new value
	 */
	public function setLink($link) {
		$this->link = $link;
	}
	
	/**
	 * Sets the attribute $released to the passed value
	 * @param object $released The new value
	 */
	public function setReleased($released) {
		$this->released = $released;
	}
	
	/**
	 * Sets the attribute $channel to the passed value
	 * @param string $channel The new value
	 */
	public function setChannel($channel) {
		$this->channel = $channel;
	}
	
	/**
	 * Sets the attribute $content to the passed value
	 * @param string $content The new value
	 */
	public function setContent($content) {
		$this->content = $content;
	}
	
	/**
	 * Sets the attribute $comment to the passed value
	 * @param string $comment The new value
	 */
	public function setComment($comment) {
		$this->comment = $comment;
	}
	
}
