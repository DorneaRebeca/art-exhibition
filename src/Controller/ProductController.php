<?php


namespace Art\Controller;


use Art\Model\DomainObject\Tier;
use Art\Model\FormMapper\UploadImageFormMapper;
use Art\Model\Http\Request;
use Art\Model\Http\Session;
use Art\Model\Persistence\PersistenceFactory;
use Art\Model\TierProcessor\OriginalImageSaver;
use Art\Model\TierProcessor\TierCreator;
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


    /**
     * @var Session
     */
    private $session;

    /**
     * @var Request
     */
    private $request;

    public function __construct()
    {
        $this->request = Request::createRequest();
    }


    /**
     *
     */
    public function showProducts()
    {
        $this->homePageForm = new HomePageRenderer();

        $products = PersistenceFactory::getFinderInstance(PRODUCT_ENTITY)->findAll();

        $this->homePageForm->displayPage($products);
    }

    public  function uploadProduct()
    {
        require 'src/View/Templates/uploadProductForm.php';

    }


    public function showProduct($productID)
    {

        $product = PersistenceFactory::getFinderInstance(PRODUCT_ENTITY)->findByID($productID);


        $tiers = PersistenceFactory::getFinderInstance(TIER_ENTITY)->findByProductID($productID);

        $this->buyProductForm = new ProductPageRenderer();
        $this->buyProductForm->displayPage($tiers, $product);
    }

    public function buyProduct($tierID)
    {

    }

    /**
     * Creates a new product and three new re-dimensioned tiers
     */
    public function uploadProductPost()
    {
        $this->session = Session::createSession();

        if($this->session->getSpecificSession(LOGGED_USER))
        {
            $userID = $this->session->getSpecificSession(LOGGED_USER);

            $uploadProduct = $this->createProductFromForm( $userID);

            $productID = PersistenceFactory::getMapperInstance(PRODUCT_ENTITY)->insert($uploadProduct);
            $originalImageName = $this->saveOriginalImage();

            $this->saveTiers($productID, $originalImageName);

            }

    }

    private function createProductFromForm($userID)
    {
        $uploadMapper = new  UploadImageFormMapper($this->request);
        $uploadProduct = $uploadMapper->getProductFromUploadForm($userID);
        return $uploadProduct;

    }

    private function saveOriginalImage()
    {
        $imageSaver = new OriginalImageSaver();
        return $imageSaver->saveOriginalImage( $this->request
                                            ->getFileData() );

    }

    private function saveTiers($productID, $imageName)
    {
        $tierCreator = new TierCreator();
        $tierCreator->generateTiers($productID, $this->request->getPostSpecific(IMG_PRICE), $imageName);

    }

}