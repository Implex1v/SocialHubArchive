<?php

interface CreatorDAO extends CreatorCustomDAO {
	/**
	 * Returns the count of all Creator
	 * @return int The count of all Creator
	 */
	function getCount();
	
	/**
	 * Creates a new Creator into the database
     * @param Creator $creator The object to create
     * @return Creator|null The newly created object or null if inserting failed
     */
	function create(Creator $creator);
	
	/**
	 * Reads a Creator from the database identified by the id
	 * @param int $id The id of the Creator to read
	 * @return Creator|null The read Creator or null if no Creator was found
	 */
	function read($id);
	
	/**
	 * Reads all Creator objects from the database. Be carefull to use this method if there are a lot of entities because there is no buffering and lazy loading
	 * @return array Array containing all Creator objects or empty array if there are none
	 */
	function readAll();
	
	/**
	 * Reads and returns a Creator from the database identified by unique attribute name. Null is returned if no object was found
	 * @param String $name The unique attribute to search for
	 * @return Creator|null Returns the Creator or null if no object was found
	 */
	function readByName($name);
	
	/**
	 * Updates the given Creator to the database and returns the updated object
	 * @param Creator $creator The object to update
	 * @return Creator|null The updated object or null, if no id was set
	 */
	function update(Creator $creator);
	
	/**
	 * Deletes the Creator from the database identified by it's id
	 * @param int $id The id of the object to delete
	 * @return boolean True if deletion was successful otherwise false
	 */
	function delete($id);
	
	/**
	 * Deletes a Creator by the object itself
	 * @param Creator $creator The object to delete
	 * @return boolean True if deletion was successful otherwise false
	 */
	function deleteEntity(Creator $creator);
	
	/**
	 * Deletes all Creator objects from the database
	 * @return boolean True if at least one object was deleted
	 */
	function deleteAll();
	
	/**
	 * Returns latest error information of the pdo object. This is a delegator method to $pod->errorInfo().	 
	 * @return array returns an array of error information about the last operation performed by this database handle.
	 */
	function getLatestError();
}
