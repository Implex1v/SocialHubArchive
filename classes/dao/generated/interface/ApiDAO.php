<?php

interface ApiDAO extends ApiCustomDAO {
	/**
	 * Returns the count of all Api
	 * @return int The count of all Api
	 */
	function getCount();
	
	/**
	 * Creates a new Api into the database
     * @param Api $api The object to create
     * @return Api|null The newly created object or null if inserting failed
     */
	function create(Api $api);
	
	/**
	 * Reads a Api from the database identified by the id
	 * @param int $id The id of the Api to read
	 * @return Api|null The read Api or null if no Api was found
	 */
	function read($id);
	
	/**
	 * Reads all Api objects from the database. Be carefull to use this method if there are a lot of entities because there is no buffering and lazy loading
	 * @return array Array containing all Api objects or empty array if there are none
	 */
	function readAll();
	
	/**
	 * Reads and returns a Api from the database identified by unique attribute name. Null is returned if no object was found
	 * @param String $name The unique attribute to search for
	 * @return Api|null Returns the Api or null if no object was found
	 */
	function readByName($name);
	
	/**
	 * Updates the given Api to the database and returns the updated object
	 * @param Api $api The object to update
	 * @return Api|null The updated object or null, if no id was set
	 */
	function update(Api $api);
	
	/**
	 * Deletes the Api from the database identified by it's id
	 * @param int $id The id of the object to delete
	 * @return boolean True if deletion was successful otherwise false
	 */
	function delete($id);
	
	/**
	 * Deletes a Api by the object itself
	 * @param Api $api The object to delete
	 * @return boolean True if deletion was successful otherwise false
	 */
	function deleteEntity(Api $api);
	
	/**
	 * Deletes all Api objects from the database
	 * @return boolean True if at least one object was deleted
	 */
	function deleteAll();
	
	/**
	 * Returns latest error information of the pdo object. This is a delegator method to $pod->errorInfo().	 
	 * @return array returns an array of error information about the last operation performed by this database handle.
	 */
	function getLatestError();
}
