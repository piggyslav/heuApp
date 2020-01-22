<?php


namespace Model;


class Model
{
    public $items;


    public function getAllItems()
    {
        return $this->items;
    }

    public function getItemByField($val, $fielc)
    {
        foreach ($this->items as $item){
            if ($item[$fielc] === $val){
                return $item;
            }
        }
        return false;
    }
}
