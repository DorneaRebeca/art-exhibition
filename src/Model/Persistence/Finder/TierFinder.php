<?php


namespace Art\Model\Persistence\Finder;


use Art\Model\DomainObject\Tier;
use PDO;

class TierFinder extends AbstractFinder
{
    private const PRICE = 'price';
    private const PATH_WITH_WATERMARK = 'pathWithWatermark';
    private const PATH_WITHOUT_WATERMARK = 'pathWithoutWatermark';
    private const SIZE = 'size';
    private const PRODUCT_ID = 'idproduct';
    private const TIER_ID = 'idtier';

    /**
     * Retrieves all data in a db table
     * @return array
     */
    public function findALl(): array
    {

    }


    /**
     * Maps from rows in a table to domain object
     * @param $row
     * @return Tier
     */
    public function mapToDomainObject($row)
    {

        return new Tier( $row[self::PRODUCT_ID], $row[self::SIZE], $row[self::PRICE],
                        $row[self::PATH_WITH_WATERMARK], $row[self::PATH_WITHOUT_WATERMARK], $row[self::TIER_ID]);
    }

    /**
     * finds all tiers belonging to a product
     * @param $productID
     * @return array
     */
    public function findByProductId($productID)
    {
        $sql = "SELECT * FROM tier WHERE idproduct=?";
        $statement = $this->getPdo()->prepare($sql);
        $statement->bindParam(1, $productID, PDO::PARAM_INT);
        $statement->execute();

        $result = [];

        while($row = $statement->fetch(PDO::FETCH_ASSOC))
        {
            $result[] = $this->mapToDomainObject($row);
        }

        return $result;

    }


    /**
     * finds all tiers belonging to a product
     * @param $tierID
     * @return Tier
     */
    public function findById($tierID)
    {
        $sql = "SELECT * FROM tier WHERE idtier=?";
        $statement = $this->getPdo()->prepare($sql);
        $statement->bindParam(1, $tierID, PDO::PARAM_INT);
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        return $this->mapToDomainObject($row);

    }


    public function findByOrders($userID)
    {
        $sql = 'select * from tier where idtier in (select idtier from order_item 
                    natural join user where iduser=?)';
        $statement = $this->getPdo()->prepare($sql);
        $statement->bindParam(1, $userID, PDO::PARAM_INT);
        $statement->execute();

        $result = [];

        while($row = $statement->fetch(PDO::FETCH_ASSOC))
        {
            $result[] = $this->mapToDomainObject($row);
        }

        return $result;
    }



}