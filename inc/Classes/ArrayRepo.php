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
                if(isset($field)) {
                    if($arrayElement[$field] == $value) {
                        $array[] = $this->dataStore[$key];
                    }
                }
                else {
                    if($arrayElement == $value) {
                        $array[] = $this->dataStore[$key];
                    }
                }
            } 
            return $array;
        }
        else {
            return $this->dataStore;
        }
    }

    /**
     * Retrieve a specific result set from the array
     * @param $array The array source of your data
     * @param $id Data field value to filter your result set on
     * @param $field The data field to filter your result set on 
     */

    public function getRecord($dataEntity, $id, $field) {



    }

}
