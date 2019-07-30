<?php


namespace Art\Model\Persistence\Mapper;


use PDO;

class TagMapper extends AbstractMapper
{

    public function insert($tagName)
    {

        $sql = "INSERT into tag (tagName)  VALUES (:tagName) ";
        $statement = $this->getPdo()->prepare($sql);
        $statement->bindValue('tagName', $tagName);
        $statement->execute();
    }

    public function insertProductTag($tagID, $productID)
    {
        $sql = "INSERT into product_tag (idproduct, idtag)  VALUES (?, ?) ";
        $statement = $this->getPdo()->prepare($sql);
        $statement->bindValue(1, $tagID, PDO::PARAM_INT );
        $statement->bindValue(2, $productID, PDO::PARAM_INT);
        $statement->execute();
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
     * MAps domain object to array
     * @param $object
     * @return array
     */
    public function mapToArray($object): array
    {
        // TODO: Implement mapToArray() method.
    }
}