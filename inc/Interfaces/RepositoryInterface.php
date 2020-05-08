<?php

/**
 * Repository Interface for data store.
 * Methods for data source interaction.
 */

interface RepositoryInterface {

    /**
     * Retrieve all entries from your data source (e.g. table, array, json object)
     * @param $entity The entity source of your data 
     */

    public function getAll($dataEntity);

    /**
     * Retrieve a specific result set from your data store
     * @param $entity The entity source of your data
     * @param $id Data field value to filter your result set on
     * @param $field The data field to filter your result set on 
     */

    public function getRecord($dataEntity, $id, $field);

}
