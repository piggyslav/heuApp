<?php


class ApiFetch
{
    private $url;
    private $apiData = null;

    /**
     * apiFetch constructor.
     * Jednoducha trida pro tahani dat z api
     * V tomto pripade bych tahani dat resil v modelu, jestli je vubec potreba volat ApiFetch
     *
     * @param string $url
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

    /**
     * Zde by se popripade dalo resit cachovani (pred jakou dobou jsme tahali tohle URL?)
     */
    public function loadData()
    {
        $this->apiData =  file_get_contents($this->url);
    }

    /**
     * @param string $url
     *
     * @return ApiFetch
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }


}