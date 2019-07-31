<?php


namespace Art\Model\Persistence\Mapper;


use Art\Model\DomainObject\Product;
use Art\Model\Persistence\PersistenceFactory;
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
     * Creates data to link products and tags in database
     * @param $tags
     * @param Product $product
     */
    public function insertTags(Product $product)
    {
        $productID = $product->getId();
        foreach ($product->getTags() as $tag)
        {
            $tagID = PersistenceFactory::getFinderInstance(TAG_ENTITY)->findByTagName($tag);
            /**
             * if tag doesn't exist in db insert it!
             */
            if( ! $tagID )
            {
               $this->insert($tag);
                $tagID = PersistenceFactory::getFinderInstance(TAG_ENTITY)->findByTagName($tag);
            }

            $this->insertProductTag($tagID, $productID);
        }
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