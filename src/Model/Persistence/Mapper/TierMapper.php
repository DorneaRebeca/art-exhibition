<?php
namespace Art\Model\Persistence\Mapper;

use Art\Model\DomainObject\Tier;

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
                        (:price,:pathWithWatermark, :patheWithoutWatermark, :size, :idproduct) ";
        $statement = $this->getPdo()->prepare($sql);

        $statement->bindValue(self::PRICE, $row[self::PRICE]);
        $statement->bindValue(self::PATH_WITH_WATERMARK, $row[self::PATH_WITH_WATERMARK]);
        $statement->bindValue(self::PATH_WITHOUT_WATERMARK, $row[self::PATH_WITHOUT_WATERMARK]);
        $statement->bindValue(self::SIZE, $row[self::SIZE]);
        $statement->bindValue(self::PRODUCT_ID, $row[self::PRODUCT_ID]);
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