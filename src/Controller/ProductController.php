<?php


namespace Art\Controller;


use Art\Model\DomainObject\Product;
use Art\Model\DomainObject\Tier;
use Art\Model\FormMapper\UploadImageFormMapper;
use Art\Model\Http\Request;
use Art\Model\Http\Session;
use Art\Model\Persistence\PersistenceFactory;
use Art\Model\TierProcessor\OriginalImageSaver;
use Art\Model\TierProcessor\ThumbnailCreator;
use Art\Model\TierProcessor\TierCreator;
use Art\View\Renderers\HomePageRenderer;
use Art\View\Renderers\ProductPageRenderer;


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

        $tiers = PersistenceFactory::getFinderInstance(TIER_ENTITY)->findByProductId($productID);

        $this->buyProductForm = new ProductPageRenderer();
        $this->buyProductForm->displayPage($product, $tiers);
    }

    public function buyProduct($tierID)
    {
        echo 'You just brought it!!!!!! >:D< ';

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

            $this->createProductThumbnail($originalImageName, $uploadProduct);

            $this->saveTiers($productID, $originalImageName);

            header('Location:/user/showProfile');

            }

    }

    private function createProductThumbnail($imageName,Product $product)
    {
        $thumbnailCreator = new ThumbnailCreator();
        $thumbnailCreator->saveThumbnail($imageName, $product->getThumbnailPath());

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