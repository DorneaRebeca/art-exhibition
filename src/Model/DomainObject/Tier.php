<?php

namespace Art\Model\DomainObject;

class Tier
{

    private $id;
    private $productID;
    private $size;
    private $price;
    private $pathWithWatermark;
    private $pathWithoutWatermark;

    /**
     * Tier constructor.
     * @param $id
     * @param $productID
     * @param $size
     * @param $price
     * @param $pathWithWatermark
     * @param $pathWithoutWatermark
     */
    public function __construct($id = null, $productID, $size, $price, $pathWithWatermark, $pathWithoutWatermark)
    {
        $this->id = $id;
        $this->productID = $productID;
        $this->size = $size;
        $this->price = $price;
        $this->pathWithWatermark = $pathWithWatermark;
        $this->pathWithoutWatermark = $pathWithoutWatermark;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getProductID()
    {
        return $this->productID;
    }

    /**
     * @param mixed $productID
     */
    public function setProductID($productID): void
    {
        $this->productID = $productID;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param mixed $size
     */
    public function setSize($size): void
    {
        $this->size = $size;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getPathWithWatermark()
    {
        return $this->pathWithWatermark;
    }

    /**
     * @param mixed $pathWithWatermark
     */
    public function setPathWithWatermark($pathWithWatermark): void
    {
        $this->pathWithWatermark = $pathWithWatermark;
    }

    /**
     * @return mixed
     */
    public function getPathWithoutWatermark()
    {
        return $this->pathWithoutWatermark;
    }

    /**
     * @param mixed $pathWithoutWatermark
     */
    public function setPathWithoutWatermark($pathWithoutWatermark): void
    {
        $this->pathWithoutWatermark = $pathWithoutWatermark;
    }





}