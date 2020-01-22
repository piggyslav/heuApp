<?php
namespace Controller;
use Model\Product;
require_once 'Model/Category.php';

class Category extends Controller
{
    /**
     * Zobrazi list kategorii / homepage
     * @throws \SmartyException
     */
    public function showDefault()
    {
        $categoryModel = new \Model\Category();
        $this->smarty->assign('categories', $categoryModel->getAllItems());
        return $this->smarty->display('Category/list.tpl');
    }

    /**
     * Zobrazi detail kategorie = vypis produktu kategorie
     * @param $categoryId
     *
     * @throws \SmartyException
     */
    public function showDetail($categoryId)
    {
        $productPerPage = 5;
        $offset = 0;
        $categoryModel = new \Model\Category();
        $productCount = $categoryModel->getCategoryProductsCount($categoryId);
        if (isset($_GET['p']) && is_numeric($_GET['p']) && $_GET['p']>1){
            $offset=($_GET['p']-1)*$productPerPage;
        }

        $this->smarty->assign('categories', $categoryModel->getAllItems());
        $this->smarty->assign('products', $categoryModel->getCategoryProducts($categoryId,$offset,$productPerPage));
        $this->smarty->assign('productsCount', $productCount);
        $this->smarty->assign('productPerPage', $productPerPage);
        $this->smarty->assign('categoryId', $categoryId);

        return $this->smarty->display('Category/detail.tpl');
    }

}
