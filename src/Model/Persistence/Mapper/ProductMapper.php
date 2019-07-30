<?php


namespace Art\Model\Persistence\Mapper;


use Art\Model\DomainObject\Product;
use Art\Model\Persistence\PersistenceFactory;
const TAG_ENTITY = 'tag';

class ProductMapper extends AbstractMapper
{

    public function insert(Product $product)
    {
        $row = $this->mapToArray($product);
        $this->insertProductTags($product->getTags(), $product);

        $sql = "INSERT into product (iduser, title, description, cameraSpecs, captureDate, thumbnailPath) 
                    VALUES (:iduser, :title, :description, :cameraSpecs, :captureDate, :thumbnailPath) ";
        $statement = $this->getPdo()->prepare($sql);
        $statement->bindValue('iduser', $row['iduser']);
        $statement->bindValue('title', $row['title']);
        $statement->bindValue('description', $row['description']);
        $statement->bindValue('cameraSpecs', $row['cameraSpecs']);
        $statement->bindValue('captureDate', $row['captureDate']->format('Y-m-d'));
        $statement->bindValue('thumbnailPath', $row['thumbnailPath']);
        $statement->execute();



    }

    /**
     * Maps domain object to array
     * @param $object
     * @return array
     */
    public function mapToArray($object): array
    {
        $arrayData = [];
        $arrayData['title'] = $object->getTitle();
        $arrayData['description'] = $object->getDescription();
        $arrayData['cameraSpecs'] = $object->getCameraSpecs();
        $arrayData['captureDate'] = $object->getCaptureDate();
        $arrayData['thumbnailPath'] = $object->getThumbnailPath();
        $arrayData['iduser'] = $object->getUserID();

        return $arrayData;
    }

    /**
     * Creates data to link products and tags in database
     * @param $tags
     * @param Product $product
     */
    private function insertProductTags($tags, Product $product)
    {
        $productID = PersistenceFactory::getFinderInstance('product')->findByThumbnailPath($product->getThumbnailPath());
        foreach ($tags as $tag)
        {
            $tagID = PersistenceFactory::getFinderInstance(TAG_ENTITY)->findByTagName($tag);
            /**
             * if tag doesn't exist in db insert it!
             */
            if( ! $tagID )
            {
                PersistenceFactory::getMapperInstance(TAG_ENTITY)->insert($tag);
                $tagID = PersistenceFactory::getFinderInstance(TAG_ENTITY)->findByTagName($tag);
            }

            PersistenceFactory::getMapperInstance(TAG_ENTITY)->insertProductTag($tagID, $productID);
        }
    }


}