<?php


namespace Art\Model\Persistence\Finder;


use PDO;

class TagFinder extends AbstractFinder
{
    /**
     * retrieves the tag id from database given the name
     * @param $tagName
     * @return int
     */
    public function findByTagName($tagName)
    {
        $sql = 'SELECT idtag from tag where tagName=?';

        $statement = $this->getPdo()->prepare($sql);
        $statement->bindValue(1,$tagName);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return (int)$result['idtag'];
    }

    /**
     * Maps from rows in a table to domain object
     * @param $row
     */
    public function mapToDomainObject($row)
    {
        // TODO: Implement mapToDomainObject() method.
    }

    /**
     * Retrieves all data in a db table
     * @return array
     */
    public function findALl(): array
    {
        // TODO: Implement findALl() method.
    }
}