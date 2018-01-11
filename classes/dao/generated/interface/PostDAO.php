<?php

interface PostDAO extends PostCustomDAO {
	/**
	 * Returns the count of all Post
	 * @return int The count of all Post
	 */
	function getCount();
	
	/**
	 * Creates a new Post into the database
     * @param Post $post The object to create
     * @return Post|null The newly created object or null if inserting failed
     */
	function create(Post $post);
	
	/**
	 * Reads a Post from the database identified by the id
	 * @param int $id The id of the Post to read
	 * @return Post|null The read Post or null if no Post was found
	 */
	function read($id);
	
	/**
	 * Reads all Post objects from the database. Be carefull to use this method if there are a lot of entities because there is no buffering and lazy loading
	 * @return array Array containing all Post objects or empty array if there are none
	 */
	function readAll();
	
	/**
	 * Updates the given Post to the database and returns the updated object
	 * @param Post $post The object to update
	 * @return Post|null The updated object or null, if no id was set
	 */
	function update(Post $post);
	
	/**
	 * Deletes the Post from the database identified by it's id
	 * @param int $id The id of the object to delete
	 * @return boolean True if deletion was successful otherwise false
	 */
	function delete($id);
	
	/**
	 * Deletes a Post by the object itself
	 * @param Post $post The object to delete
	 * @return boolean True if deletion was successful otherwise false
	 */
	function deleteEntity(Post $post);
	
	/**
	 * Deletes all Post objects from the database
	 * @return boolean True if at least one object was deleted
	 */
	function deleteAll();
	
	/**
	 * Returns latest error information of the pdo object. This is a delegator method to $pod->errorInfo().	 
	 * @return array returns an array of error information about the last operation performed by this database handle.
	 */
	function getLatestError();
}
