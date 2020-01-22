<?php


namespace Model;
require_once "Service/ApiFetch.php";

class Category
{
    private $categories;
    /**
     * Category constructor.
     */
    public function __construct()
    {
        //cache nebo fetch
        $this->categories = (new \ApiFetch('http://heureka-testday.herokuapp.com/categories/'))->getArrayData();
        $this->loadCategoriesInfo();

    }

    public function getAllCategories()
    {
        return $this->categories;
    }

    public function getCategoryById($id)
    {
        foreach ($this->categories as $category){
            if ($category['categoryId'] === $id){
                return $category;
            }
        }
        return false;
    }

    private function loadCategoriesInfo(){
        foreach ($this->categories as &$category){
            $prod = (new \ApiFetch("http://heureka-testday.herokuapp.com/products/{$category['categoryId']}/0/1/"))->getArrayData()[0];
            $offer = (new \ApiFetch("http://heureka-testday.herokuapp.com/offers/{$prod['productId']}/0/1/"))->getArrayData()[0];
            $category['imageUrl'] = $offer['imgUrl'];
        }
    }
}
