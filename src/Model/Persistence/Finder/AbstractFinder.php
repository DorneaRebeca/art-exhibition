<?php

namespace Art\Model\Persistence\Finder;

use PDO;

abstract class AbstractFinder
{
    /**
     * @var PDO
     */
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @return PDO
     */
    protected function getPdo(): PDO
    {
        return $this->pdo;
    }

    /**
    * Maps from rows in a table to domain object
    * @param $row
    */
    public abstract function mapToDomainObject($row);

    /**
     * Retrieves all data in a db table
     * @return array
     */
    public abstract function findAll() : array;







}