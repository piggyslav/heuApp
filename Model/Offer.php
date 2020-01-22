<?php


namespace Model;


class Offer extends Model
{

    /**
     * Offer constructor.
     *
     * @param $productId
     */
    public function __construct($productId)
    {
        //cache nebo fetch
        $this->items = (new \ApiFetch("http://heureka-testday.herokuapp.com/offers/{$productId}/"))->getArrayData();
    }
}
