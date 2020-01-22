<?php
namespace Controller;

use Smarty;

class Controller
{
    public $smarty;

    /**
     * Controller constructor.
     * Inituje smarty, dafaultni template folder
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
