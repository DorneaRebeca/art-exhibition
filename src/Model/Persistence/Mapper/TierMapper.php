<?php
namespace Art\Model\Persistence\Mapper;

use Art\Model\DomainObject\Tier;
use PDO;

class TierMapper extends AbstractMapper
{
    private const PRICE = 'price';
    private const PATH_WITH_WATERMARK = 'pathWithWatermark';
    private const PATH_WITHOUT_WATERMARK = 'pathWithoutWatermark';
    private const SIZE = 'size';
    private const PRODUCT_ID = 'idproduct';
    private const TIER_ID = 'idtier';

    
    public function insert(Tier $tier)
    {
        $row = $this->mapToArray($tier);
        
        $sql = "INSERT into tier (price, pathWithWatermark, pathWithoutWatermark, size, idproduct) VALUES
                        (:price,:pathWithWatermark, :pathWithoutWatermark, :size, :idproduct) ";
        $statement = $this->getPdo()->prepare($sql);

        $statement->bindValue(self::PRICE, $tier->getPrice(), PDO::PARAM_INT);
        $statement->bindValue(self::PATH_WITH_WATERMARK, $tier->getPathWithWatermark());
        $statement->bindValue(self::PATH_WITHOUT_WATERMARK, $tier->getPathWithoutWatermark());
        $statement->bindValue(self::SIZE, $tier->getSize());
        $statement->bindValue(self::PRODUCT_ID, $tier->getProductID(), PDO::PARAM_INT);
        $statement->execute();
    }

    /**
     * MAps domain object to array
     * @param $object Tier
     * @return array
     */
    public function mapToArray($object): array
    {
        $arrayData = [];

        $arrayData[self::PRICE] = $object->getPrice();
        $arrayData[self::PATH_WITH_WATERMARK] = $object->getPathWithWatermark();
        $arrayData[self::PATH_WITHOUT_WATERMARK] = $object->getPathWithoutWatermark();
        $arrayData[self::SIZE] = $object->getSize();
        $arrayData[self::PRODUCT_ID] = $object->getProductID();
        $arrayData[self::TIER_ID] = $object->getId();

        return $arrayData;
    }

}