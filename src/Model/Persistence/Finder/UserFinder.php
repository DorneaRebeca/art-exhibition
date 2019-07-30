<?php


namespace Art\Model\Persistence\Finder;


use Art\Model\DomainObject\User;
use PDO;

class UserFinder extends AbstractFinder
{


    /**
     * Retrieves all data in a db table
     * @return array
     */
    public function findALl() : array
    {
        $sql = "select * from user";
        $statement = $this->getPdo()->prepare($sql);

        $statement->execute();


        $users = [];

        while($row = $statement->fetch(PDO::FETCH_ASSOC) )
        {
            $users[] = $this->mapToDomainObject($row);
        }
        return $users;
    }

    public function mapToDomainObject($row)
    {
        return new User($row['iduser'], $row['name'], $row['email'], $row['password']);

    }

}