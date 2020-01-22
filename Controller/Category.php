<?php
namespace Controller;
require_once "Model/Category.php";
class Category extends Controller
{
    public function showDefault()
    {
        $categoryModel = new \Model\Category();
        $this->smarty->assign('categories', $categoryModel->getAllCategories());
        return $this->smarty->display('Category/list.tpl');
    }

}
