<?php


namespace Art\Controller;


use Art\Model\DomainObject\Product;
use Art\Model\FormMapper\UploadImageFormMapper;
use Art\Model\Http\Request;
use Art\Model\Http\Session;
use Art\Model\Persistence\PersistenceFactory;
use Art\Model\TierProcessor\OriginalImageSaver;
use Art\Model\TierProcessor\ThumbnailCreator;
use Art\Model\TierProcessor\TierCreator;
use Art\Model\TierProcessor\TierDownloader;
use Art\Model\Validations\FormValidations\UploadProductFormValidator;
use Art\View\Renderers\HomePageRenderer;
use Art\View\Renderers\LoginPageRenderer;
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
        $this->session = Session::createSession();
        $this->homePageForm = new HomePageRenderer();
        $this->buyProductForm = new ProductPageRenderer();
    }


    /**
     *Swhos all products or filtered
     */
    public function showProducts($pageNumber)
    {


        $products = PersistenceFactory::getFinderInstance(PRODUCT_ENTITY)->findWithLimit($pageNumber);
        $this->homePageForm->displayPage($products);
    }

    public  function uploadProduct($errorData = null)
    {
        $errors = $errorData;
        require 'src/View/Templates/uploadProductForm.php';

    }

    /**
     * Gets from database sll 3 tiers for the given product
     * @param $productID
     */
    public function showProduct($productID)
    {

        $product = PersistenceFactory::getFinderInstance(PRODUCT_ENTITY)->findByID($productID);

        $tiers = PersistenceFactory::getFinderInstance(TIER_ENTITY)->findByProductId($productID);

        $this->buyProductForm->displayPage($product, $tiers);
    }

    /**
     * creates an order item in database and downloads the original tier
     * @param $tierID
     */
    public function buyProduct($tierID)
    {

        if(!$this->session->getSpecificSession(LOGGED_USER)) {
            $this->goToLogin();
            return;
        }
        $userID =  $this->session->getSpecificSession(LOGGED_USER);

        PersistenceFactory::getMapperInstance(ORDER_ENTITY)->insert($userID, $tierID);

        $image = PersistenceFactory::getFinderInstance(TIER_ENTITY)->findById($tierID);

        $tierDownloader = new TierDownloader();
        $tierDownloader->downloadTier($image->getPathWithoutWatermark());

    }

    /**
     * Creates a new product and three new re-dimensioned tiers if data is valid
     */
    public function uploadProductPost()
    {
        $this->session = Session::createSession();

        if(!$this->session->getSpecificSession(LOGGED_USER)) {
            $this->goToLogin();
            return;
        }

        //validations
        $validator = new UploadProductFormValidator();
        $errors = $validator->validateAll($this->request->getPostVariable(), $this->request->getFileData());

        if($errors) {
            $this->uploadProduct($errors);
            return;
        }

        $userID = $this->session->getSpecificSession(LOGGED_USER);

        $uploadProduct = $this->createProductFromForm( $userID);

        $productID = PersistenceFactory::getMapperInstance(PRODUCT_ENTITY)->insert($uploadProduct);

        $originalImageName = $this->saveOriginalImage();

        $this->createProductThumbnail($originalImageName, $uploadProduct);

        $this->saveTiers($productID, $originalImageName);

        header('Location:/');
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

    /**
     * redirects page to login page
     */
    private function goToLogin()
    {
        $renderer = new LoginPageRenderer();
        $renderer->displayPage();
    }

}