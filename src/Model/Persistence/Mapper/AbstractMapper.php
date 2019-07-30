<?php

namespace  Art\Model\Persistence\Mapper;

use PDO;

abstract class AbstractMapper
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
     * MAps domain object to array
     * @param $object
     * @return array
     */
    public abstract function mapToArray($object) : array;


}