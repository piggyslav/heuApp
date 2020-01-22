<?php


namespace Model;


class Product
{

    private $product;

    /**
     * Product constructor.
     *
     * @param $productId
     */
    public function __construct($productId)
    {
        //cache nebo fetch
        $this->product = (new \ApiFetch("http://heureka-testday.herokuapp.com/product/{$productId}"))->getArrayData();
        $this->getProductInfo();
    }


    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Dotahani dodatecnych informaci o produktu (cache)
     */
    private function getProductInfo(){
        $offers = (new \ApiFetch("http://heureka-testday.herokuapp.com/offers/{$this->product['productId']}/"))->getArrayData();
        $price = [
            'min' => 0,
            'max' => 0
        ];
        foreach ($offers as $offer) {
            $price['max'] = $offer['price'] > $price['max'] ? $offer['price'] : $price['max'];
            $price['min'] = $offer['price'] < $price['min'] || $price['min'] === 0 ? $offer['price'] : $price['min'];
            if ($offer['img_url'] !== null) {
                if ($this->product['imageUrl'] === null){
                    $this->product['imageUrl'] = $offer['img_url'];
                }else{
                    $this->product['gallery'][] = $offer['img_url'];
                }
            }
            if ($offer['description'] !== null && $this->product['description'] === null) {
                $this->product['description'] = $offer['description'];
            }
        }

        $this->product['price'] = $price;

        if (!isset($this->product['imageUrl']) || $this->product['imageUrl'] === null) {
            $this->product['imageUrl'] = '/img/no-img.png';
        }

    }

}
