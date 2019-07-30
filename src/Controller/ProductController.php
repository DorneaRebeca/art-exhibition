<?php


namespace Art\Controller;


use Art\Model\DomainObject\Product;
use Art\Model\Persistence\PersistenceFactory;
use Art\View\Renderers\ProductPageRenderer;
use Art\View\Renderers\HomePageRenderer;

class ProductController
{
    /**
     * @var HomePageRenderer
     */
    private $homePageForm;

    /**
     * @var ProductPageRenderer
     */
    private $buyProductForm;


    public function showProducts()
    {
        $this->homePageForm = new HomePageRenderer();

        $products = PersistenceFactory::getFinderInstance('product')->findALl();

        $this->homePageForm->displayPage($products);
    }

    public  function uploadProduct()
    {
        require 'src/uploadArtwork/index.php';

    }


    public function showProduct()
    {
        $this->buyProductForm = new ProductPageRenderer();
        $p = new Product(null,4,'Ho-ho-ho4', 'asdf', ['ptoj','dgfhf','dds'],'camera specs','2000-04-06','https://source.unsplash.com/M185_qYH8vg/400x300');

        $this->buyProductForm->displayPage($p);
    }

    public function buyProduct()
    {
        $products = [];
        $products [] = new Product(null,1,'Ho-ho-ho1', 'asdf', ['ptoj','dgfhf','dds'],'camera specs',new \DateTime('2019-04-06'),'https://source.unsplash.com/pWkk7iiCoDM/400x300');
        $products [] = new Product(null,2,'Ho-ho-ho2', 'asdf', ['ptoj','dgfhf','dds'],'camera specs',new \DateTime('2018-06-12'),'https://source.unsplash.com/aob0ukAYfuI/400x300');
        $products [] = new Product(null,3,'Ho-ho-ho3', 'asdf', ['ptoj','dgfhf','dds'],'camera specs',new \DateTime('2019-04-05'),'https://source.unsplash.com/EUfxH-pze7s/400x300');
        $products [] = new Product(null,4,'Ho-ho-ho4', 'asdf', ['ptoj','dgfhf','dds'],'camera specs',new \DateTime('2018-07-07'),'https://source.unsplash.com/M185_qYH8vg/400x300');

        foreach ($products as $product)
        {
            PersistenceFactory::getMapperInstance('product')->insert($product);
        }
        PersistenceFactory::getFinderInstance('product')->findALl();

    }

    public  function uploadProductPost()
    {

    }

}