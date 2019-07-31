<?php


namespace Art\Controller;


use Art\Controller\Model\FormMapper\UploadImageFormMapper;
use Art\Model\DomainObject\Product;
use Art\Model\Http\Request;
use Art\Model\Http\Session;
use Art\Model\Persistence\PersistenceFactory;
use Art\Model\TierProcessor\OriginalTierSaver;
use Art\View\Renderers\ProductPageRenderer;
use Art\View\Renderers\HomePageRenderer;

require 'src/constants.php';

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

    /**
     * @var Session
     */
    private $session;


    public function showProducts()
    {
        $this->homePageForm = new HomePageRenderer();

        $products = PersistenceFactory::getFinderInstance(PRODUCT_ENTITY)->findALl();

        $this->homePageForm->displayPage($products);
    }

    public  function uploadProduct()
    {
        require 'src/View/Templates/uploadProductForm.php';

    }


    public function showProduct()
    {
        $this->buyProductForm = new ProductPageRenderer();
        $p = new Product(null,4,'Ho-ho-ho4', 'asdf', ['ptoj','dgfhf','dds'],'camera specs','2000-04-06','https://source.unsplash.com/M185_qYH8vg/400x300');

        $this->buyProductForm->displayPage($p);
    }

    public function buyProduct()
    {

    }

    public function uploadProductPost()
    {
        $uploadRequest = Request::createRequest();
        $this->session = Session::createSession();

        if( $this->session->getSpecificSession(LOGGED_USER))
        {
            $userID = $this->session->getSpecificSession(LOGGED_USER);

            $uploadMapper = new  UploadImageFormMapper($uploadRequest);
            $uploadProduct = $uploadMapper->getProductFromUploadForm($userID);

            PersistenceFactory::getMapperInstance(PRODUCT_ENTITY)->insert($uploadProduct);



        }

    }

}