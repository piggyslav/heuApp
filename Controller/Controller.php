<?php
namespace Controller;

use Smarty;

abstract class Controller
{
    public $smarty;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->smarty = new Smarty();
        $this->smarty->_clearTemplateCache();
        $this->smarty->setTemplateDir('Templates');

    }

    /**
     * @return Smarty
     */
    public function getSmarty()
    {
        return $this->smarty;
    }
}
