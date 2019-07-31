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

        $product->setId($this->getPdo()->lastInsertId());

        PersistenceFactory::getMapperInstance(TAG_ENTITY)->insertTags($product);

        return $product->getId();
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




}