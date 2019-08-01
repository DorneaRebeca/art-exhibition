<?php


namespace Art\View\Renderers;


use Art\Model\DomainObject\Tier;
use Art\Model\Http\Session;

class OrdersPageRenderer
{
    private const IMAGE_PATH = '../../../src/assets/savedData/';


    public static function createRenderer()
    {
        return new self();
    }

    public function getHeader()
    {
        if(Session::createSession()->getSpecificSession(LOGGED_USER) )
        {
            return require 'src/View/Templates/loggedUserHeader.php';
        }
        return require 'src/View/Templates/defaultHeader.php';
    }


    public function displayPage($orders)
    {
        $this->getHeader();
        $userOrders = $this->createOrdersData($orders);
        require 'src/View/Templates/ordersForm.php';
    }



    /**
     * @param $displayProducts Tier[]
     * @return array
     */
    public function createOrdersData($displayProducts) : array
    {
        $displayData = [];
        foreach ($displayProducts as $tier)
        {
            $data[IMG_PRICE] = $tier->getPrice();
            $data[IMG_SIZE] = $tier->getSize();
            $data[IMG_SOURCE] = self::IMAGE_PATH.$tier->getPathWithWatermark();
            $displayData[] = $data;
        }
        return $displayData;
    }

}