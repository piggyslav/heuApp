<?php


namespace Model;
require_once "Service/ApiFetch.php";
require_once "Model.php";

class Category extends Model
{
    /**
     * Category constructor.
     */
    public function __construct()
    {
        //cache nebo fetch
        $this->items = (new \ApiFetch('http://heureka-testday.herokuapp.com/categories/'))->getArrayData();
        $this->loadCategoriesImages();

    }

    private function loadCategoriesImages()
    {
        foreach ($this->items as &$category) {
            $products = (new \ApiFetch("http://heureka-testday.herokuapp.com/products/{$category['categoryId']}/0/1/"))->getArrayData();
            foreach ($products as $prod) {
                $offers = (new \ApiFetch("http://heureka-testday.herokuapp.com/offers/{$prod['productId']}/"))->getArrayData();
                foreach ($offers as $offer) {
                    if ($offer['img_url'] !== null) {
                        $category['imageUrl'] = $offer['img_url'];
                        continue;
                    }
                }
                if (isset($category['imageUrl'])) {
                    continue;
                }
            }
            if (!isset($category['imageUrl']) || $category['imageUrl'] === null) {
                $category['imageUrl'] = '/img/no-img.png';
            }
        }
    }

    public function getCategoryProductsCount($categoryId)
    {
       return (new \ApiFetch("http://heureka-testday.herokuapp.com/products/{$categoryId}/count"))->getArrayData()['count'];
    }

    public function getCategoryProducts($categoryId, $offset = 0, $limit = 5)
    {
        $products = (new \ApiFetch("http://heureka-testday.herokuapp.com/products/{$categoryId}/{$offset}/{$limit}"))->getArrayData();
        foreach ($products as &$item) {
            $offers = (new \ApiFetch("http://heureka-testday.herokuapp.com/offers/{$item['productId']}/"))->getArrayData();
            $price = [
                'min' => 0,
                'max' => 0
            ];

            foreach ($offers as $offer) {
                $price['max'] = $offer['price'] > $price['max'] ? $offer['price'] : $price['max'];
                $price['min'] = $offer['price'] < $price['min'] || $price['min'] === 0 ? $offer['price'] : $price['min'];
                if ($offer['img_url'] !== null && $item['imageUrl'] === null) {
                    $item['imageUrl'] = $offer['img_url'];
                }

                if ($offer['description'] !== null && $item['description'] === null) {
                    $item['description'] = substr($offer['description'], 0, 240). ' ...';
                }
            }

            $item['price'] = $price;

            if (!isset($item['imageUrl']) || $item['imageUrl'] === null) {
                $item['imageUrl'] = '/img/no-img.png';
            }

        }
        return $products;
    }
}
