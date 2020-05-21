<?php

/**
 * Array Repository class.
 * Implements the RepoInterface to handle data stored in a php array.
 */

class ArrayRepo implements RepoInterface {

    // Class properties
    private $dataStore;

    // Constructor requires an array to be passed in
    public function __construct($array) {

        $this->dataStore = $array;

    }

    /**
     * Retrieve all entries from the array (only goes two dimensions deep)
     * @param $value The value to filter the result set on (optional)
     * @param $field The field to match against the value for filtering the result set (optional) 
     */

    public function getAll($value = null, $field = null) {

        if(isset($value)) {        // return elements holding the value chosen
            $array = array();           
            foreach($this->dataStore as $key => $arrayElement) {
                if(isset($field)) {     // query is on a two-dimensional array
                    if($arrayElement[$field] == $value) {
                        $array[] = $this->dataStore[$key];
                    }
                }
                else {      // query is on a one-dimensional array
                    if($arrayElement == $value) {
                        $array[] = $this->dataStore[$key];
                    }
                }
            } 
            return $array;
        }
        else {
            return $this->dataStore;    // no arguments passed- return the entire array
        }
    }

    /**
     * Retrieve a specific result set from the array
     * Returns first matching record value
     * @param $value The data field value to filter your result set on
     * @param $field The data field to filter your result set on 
     */

    public function getRecord($value, $field = null) {
        // the getAll returns an array of elements matching all values (and fields) passed
        // in the context of this game, we only want the first one returned
        // to get a phrase for the game puzzle
        return $this->getAll($value, $field)[0];

    }

}
