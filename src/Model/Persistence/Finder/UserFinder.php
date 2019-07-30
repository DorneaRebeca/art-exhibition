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

    public function findByEmail($email)
    {
        $sql = "select * from user where email = ?";
        $statement = $this->getPdo()->prepare($sql);
        $statement->bindParam(1, $email);
        $statement->execute();

        $user = $this->mapToDomainObject( $statement->fetch(PDO::FETCH_ASSOC));

        return $user;

    }

    public function mapToDomainObject($row)
    {
        return new User($row['email'], $row['password'], $row['iduser'], $row['name']);

    }

}