<?php
/**
 * @package     CedAdd2Home
 * @subpackage  com_cedadd2home
 *
 * @copyright   Copyright (C) 2013-2017 galaxiis.com All rights reserved.
 * @license     The author and holder of the copyright of the software is Cédric Walter. The licensor and as such issuer of the license and bearer of the
 *              worldwide exclusive usage rights including the rights to reproduce, distribute and make the software available to the public
 *              in any form is Galaxiis.com
 *              see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.plugin.plugin');
jimport('joomla.environment.browser');

class CedAdd2HomeProvider
{

    var $headLinks = null;
    var $metaData = null;
    var $styleSheet = null;
    var $base = null;
    var $scriptDeclaration = null;
    var $script = null;

    function __construct()
    {
        $this->headLinks = array();
        $this->metaData = array();
        $this->styleSheet = array();
        $this->scriptDeclaration = array();
        $this->script = array();
    }

    public function getHeadLinks()
    {
        return $this->headLinks;
    }

    public function getMetaData()
    {
        return $this->metaData;
    }

    public function getStyleSheet()
    {
        return $this->styleSheet;
    }

    public function getBase()
    {
        return $this->base;
    }

    public function getScriptDeclaration()
    {
        return $this->scriptDeclaration;
    }

    public function getScript()
    {
        return $this->script;
    }

    protected function addHeadLinks($img, $key, $attributes, $rel = 'rel')
    {
        $headLink = new stdClass();

        $headLink->img = JUri::root() . $img;
        $headLink->key = $key;
        $headLink->rel = $rel;
        $headLink->attributes = $attributes;

        $this->headLinks[] = $headLink;
    }

    protected function addMetadata($key, $value)
    {
        if ($value != '') {
            $meta = new stdClass();
            $meta->key = $key;
            $meta->value = $value;

            $this->metaData[] = $meta;
        }
    }

    protected function addStyleSheet($style)
    {
        $this->styleSheet[] = $style;
    }

    protected function addScriptDeclaration($scriptDeclaration)
    {
        $this->scriptDeclaration[] = $scriptDeclaration;
    }

    protected function addScript($script)
    {
        $this->script[] = $script;
    }

}