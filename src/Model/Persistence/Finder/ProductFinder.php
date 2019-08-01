<?php


namespace Art\Model\Persistence\Finder;

use Art\Model\DomainObject\Product;
use PDO;

class ProductFinder extends AbstractFinder
{

    /**
     * Maps from rows in a table to domain object
     * @param $row
     * @return Product
     * @throws \Exception
     */
    public function mapToDomainObject($row)
    {
        $tags = $this->getTags($row['idproduct']);
        $captureDate = new \DateTime($row['captureDate']);
        return new Product(  $row['title'],
            $row['description'], $tags, $row['cameraSpecs'], $captureDate, $row['thumbnailPath'], $row['iduser'], $row['idproduct']);
    }

    /**
     * Retrieves all data in a db table
     * @return array
     * @throws \Exception
     */
    public function findWithLimit($pageNumber): array
    {
        $sql = "select * from product LIMIT ? OFFSET ?";
        $statement = $this->getPdo()->prepare($sql);
        $offset = $pageNumber * NO_PRODUCTS_ON_PAGE;
        $limit = NO_PRODUCTS_ON_PAGE;
        $statement->bindParam(1, $limit, PDO::PARAM_INT);
        $statement->bindParam(2, $offset, PDO::PARAM_INT);
        $statement->execute();

        $resultProducts = [];
        while($row =$statement->fetch(PDO::FETCH_ASSOC) )
        {
            $resultProducts[] = $this->mapToDomainObject($row);
        }
        return $resultProducts;

    }

    public function findByThumbnailPath($thumbnailPath)
    {
        $sql = "select idproduct from product where thumbnailPath=?";

        $statement = $this->getPdo()->prepare($sql);
        $statement->bindParam(1, $thumbnailPath);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return (int)$result['idproduct'];

    }

    private function getTags($productID)
    {
        $sqlQuery = "SELECT tagName from tag where idtag IN ( SELECT idtag FROM product_tag NATURAL JOIN product WHERE idproduct= ? )";
        $statement = $this->getPdo()->prepare($sqlQuery);
        $statement->bindParam(1, $productID, PDO::PARAM_INT);
        $statement->execute();

        $resultTags = [];
        while($row =$statement->fetch(PDO::FETCH_ASSOC) )
        {
            $resultTags[] = $row['tagName'];
        }

        return $resultTags;

    }

    public function findUserProducts($userID)
    {
        $sql = "select * from product natural join user where iduser=?";

        $statement = $this->getPdo()->prepare($sql);
        $statement->bindParam(1, $userID, PDO::PARAM_INT);
        $statement->execute();


        $products = [];

        while($row = $statement->fetch(PDO::FETCH_ASSOC) )
        {
            $products[] = $this->mapToDomainObject($row);
        }

        return $products;
    }


    public function findByID($productID)
    {
        $sql = "select * from product where idproduct=?";

        $statement = $this->getPdo()->prepare($sql);
        $statement->bindParam(1, $productID, PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $this->mapToDomainObject($result);
    }


    /**
     * Retrieves all data in a db table
     * @return array
     */
    public function findAll(): array
    {
        $sql = "select * from product";
        $statement = $this->getPdo()->prepare($sql);

        $statement->execute();

        $resultProducts = [];
        while($row =$statement->fetch(PDO::FETCH_ASSOC) )
        {
            $resultProducts[] = $this->mapToDomainObject($row);
        }
        return $resultProducts;
    }
}