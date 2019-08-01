<?php


namespace Art\Model\Persistence\Mapper;


use PDO;

class OrderItemMapper extends AbstractMapper
{

    public function insert($userID, $tierID)
    {
        $sql = "INSERT into order_item (created_at, iduser, idtier)  
                VALUES (NOW(),  :iduser, :idtier ) ";
        $statement = $this->getPdo()->prepare($sql);
        $statement->bindValue('iduser', $userID, PDO::PARAM_INT);
        $statement->bindValue('idtier', $tierID, PDO::PARAM_INT);
        $statement->execute();

        return $this->getPdo()->lastInsertId();
    }

    /**
     * MAps domain object to array
     * @param $object
     * @return array
     */
    public function mapToArray($object): array
    {
        // TODO: Implement mapToArray() method.
    }
}

