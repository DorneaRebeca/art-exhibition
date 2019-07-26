<?php

namespace Art\Model\DomainObject;

class OrderItem
{
    private $userID;
    private $tierID;
    private $createdAt;

    /**
     * OrderItem constructor.
     * @param $userID
     * @param $tierID
     * @param $createdAt
     */
    public function __construct($userID, $tierID, $createdAt)
    {
        $this->userID = $userID;
        $this->tierID = $tierID;
        $this->createdAt = $createdAt;
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
    public function getTierID()
    {
        return $this->tierID;
    }

    /**
     * @param mixed $tierID
     */
    public function setTierID($tierID): void
    {
        $this->tierID = $tierID;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }




}