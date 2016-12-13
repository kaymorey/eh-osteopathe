<?php

namespace Admin\DAO;

abstract class DAO
{
    /**
     * JSON file
     *
     * @var string
     */
    private $file;

    /**
     * JSON data
     *
     * @var object
     */
    protected $data;

    /**
     * Constructor
     */
    public function __construct() {
        $this->file = '../web/data/data.json';

        $json = file_get_contents($this->file);
        $this->data = json_decode($json);
    }

    /**
     * Grants access to the data object
     *
     * @return The data object
     */
    protected function getData() {
        return $this->data;
    }

    /**
     * Builds a domain object from a JSON row.
     * Must be overridden by child classes.
     */
    protected abstract function buildDomainObject($row);
}
