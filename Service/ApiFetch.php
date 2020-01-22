<?php


class ApiFetch
{
    private $url;
    private $apiData = null;

    /**
     * apiFetch constructor.
     *
     * @param string $url
     * @param null   $apiData
     */
    public function __construct($url)
    {
        $this->url = $url;
        $this->loadData();
    }


    public function getJsonData()
    {
        return $this->apiData;
    }

    public function getArrayData()
    {
        return json_decode($this->apiData,true);
    }

    private function loadData()
    {
        $this->apiData =  file_get_contents($this->url);
    }


}