<?php


namespace Controller;
use Model\Offer;

require_once 'Model/Category.php';
require_once 'Model/Product.php';
require_once 'Model/Offer.php';

class Product extends Controller
{
    /**
     * Zobrazi detail produktu s jeho nabidkami
     * @param $productId
     *
     * @throws \SmartyException
     */
    public function showDetail($productId)
    {
        $categoryModel = new \Model\Category();
        $productModel = new \Model\Product($productId);
        $offerModel = new Offer($productId);
        $product = $productModel->getProduct();
        $this->smarty->assign('categories', $categoryModel->getAllItems());
        $this->smarty->assign('offers', $offerModel->getAllItems());
        $this->smarty->assign('product', $product);
        $this->smarty->assign('productCategory', $categoryModel->getItemByField($product['categoryId'],'categoryId'));

        return $this->smarty->display('Product/detail.tpl');
    }
}
