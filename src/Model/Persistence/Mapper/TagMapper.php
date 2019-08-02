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

        return $this->getPdo()->lastInsertId();
    }

    public function insertProductTag($tagID, $productID)
    {
        $sql = "INSERT into product_tag (idproduct, idtag)  VALUES (:idproduct, :idtag) ";
        $statement = $this->getPdo()->prepare($sql);
        $statement->bindValue('idproduct', $productID, PDO::PARAM_INT);
        $statement->bindValue('idtag', $tagID, PDO::PARAM_INT );
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
               $tagID = $this->insert($tag);
            }

            echo 'Tag id : '.$tagID.PHP_EOL;
            echo 'Product id : '.$productID.PHP_EOL;
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
    }
}