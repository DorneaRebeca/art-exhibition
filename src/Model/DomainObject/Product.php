<?php

namespace Art\Model\DomainObject;

class Product
{
    private $id;
    private $userID;
    private $title;
    private $description;
    private $tags;
    private $cameraSpecs;
    private $captureDate;
    private $thumbnailPath;

    /**
     * Product constructor.
     * @param $id
     * @param $userID
     * @param $title
     * @param $description
     * @param $tags
     * @param $cameraSpecs
     * @param $captureDate
     * @param $thumbnailPath
     */
    public function __construct( $id = null, $userID, $title, $description, $tags, $cameraSpecs, $captureDate, $thumbnailPath)
    {
        $this->id = $id;
        $this->userID = $userID;
        $this->title = $title;
        $this->description = $description;
        $this->tags = $tags;
        $this->cameraSpecs = $cameraSpecs;
        $this->captureDate = $captureDate;
        $this->thumbnailPath = $thumbnailPath;
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
    public function getUserID()
    {
        return $this->userID;
    }

    /**
     * @param mixed $userID
     */
    public function setUserID($userID): void
    {
        $this->userID = $userID;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param mixed $tags
     */
    public function setTags($tags): void
    {
        $this->tags = $tags;
    }

    /**
     * @return mixed
     */
    public function getCameraSpecs()
    {
        return $this->cameraSpecs;
    }

    /**
     * @param mixed $cameraSpecs
     */
    public function setCameraSpecs($cameraSpecs): void
    {
        $this->cameraSpecs = $cameraSpecs;
    }

    /**
     * @return mixed
     */
    public function getCaptureDate()
    {
        return $this->captureDate;
    }

    /**
     * @param mixed $captureDate
     */
    public function setCaptureDate($captureDate): void
    {
        $this->captureDate = $captureDate;
    }

    /**
     * @return mixed
     */
    public function getThumbnailPath()
    {
        return $this->thumbnailPath;
    }

    /**
     * @param mixed $thumbnailPath
     */
    public function setThumbnailPath($thumbnailPath): void
    {
        $this->thumbnailPath = $thumbnailPath;
    }




}