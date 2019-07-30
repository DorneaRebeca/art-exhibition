<?php

namespace  Art\Model\Persistence\Mapper;

use Art\Model\DomainObject\User;

class UserMapper extends AbstractMapper
{

    public function insert(User $user)
    {
        $row = $this->mapToArray($user);
        $sql = "INSERT into user (name, email, password) VALUES (:name,:email, :password) ";
        $statement = $this->getPdo()->prepare($sql);
        $statement->bindValue('name', $row['name']);
        $statement->bindValue('email', $row['email']);
        $statement->bindValue('password', $row['password']);
        $statement->execute();
    }

    public function update(User $user)
    {
        $row = $this->mapToArray($user);
        $sql = "UPDATE user SET name=?, email=?, password=? where  iduser=?";
        $statement = $this->getPdo()->prepare($sql);

        // ... bind parameters from $row
        $statement->bindValue('name', $row['name']);
        $statement->bindValue('email', $row['email']);
        $statement->bindValue('password', $row['password']);
        $statement->bindValue('iduser', $row['id']);
        $statement->execute();
    }

    /**
     * MAps domain object to array
     * @param $object User
     * @return array
     */
    public function mapToArray($object): array
    {
        $arrayData = [];
        $arrayData['name'] = $object->getName();
        $arrayData['id'] = $object->getId();
        $arrayData['email'] = $object->getEmail();
        $arrayData['password'] = $object->getPassword();

        return $arrayData;

    }
}