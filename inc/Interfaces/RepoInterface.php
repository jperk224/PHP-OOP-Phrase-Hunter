<?php

/**
 * Repository Interface for data store.
 * Methods for data source interaction.
 */

interface RepoInterface {

    /**
     * Retrieve all entries from your data source (e.g. table, array, json object)
     * No parameters to make it easy to dump all records if desired in the implementing class.
     */

    public function getAll();

    /**
     * Retrieve a specific result set from your data store
     * @param $value Data field value to filter your result set on
     * @param $field Data field to filter your result set on (optional)
     */

    public function getRecord($value, $field = null);

}
