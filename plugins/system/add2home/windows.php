<?php
/**
 * @package     CedAdd2Home
 * @subpackage  com_cedadd2home
 *
 * @copyright   Copyright (C) 2013-2016 galaxiis.com All rights reserved.
 * @license     The author and holder of the copyright of the software is Cédric Walter. The licensor and as such issuer of the license and bearer of the
 *              worldwide exclusive usage rights including the rights to reproduce, distribute and make the software available to the public
 *              in any form is Galaxiis.com
 *              see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.plugin.plugin');
jimport('joomla.environment.browser');

require_once(dirname(__FILE__) . '/provider.php');
require_once(dirname(__FILE__) . '/scaler.php');

class cedAdd2HomeWindows extends CedAdd2HomeProvider
{

    public function isActive($agent)
    {
        // can not use JBrowser::getInstance() as IE 11 is hiding behind "mozilla" browser
        preg_match('/MSIE (.*?);/', $agent, $matches);
        if (count($matches) < 2) {
            preg_match('/Trident\/\d{1,2}.\d{1,2}; rv:([0-9]*)/', $agent, $matches);
        }

        if (count($matches) > 1) {
            $version = $matches[1];
            return $version >= 9;
        }

        return false;
    }

    public function execute($agent, $params, $base)
    {
        //http://www.buildmypinnedsite.com/windows7/en
    }

    // to be call in afterRender

    public function addDynamicalJumpList($params)
    {
    }

    public function addDiscoverIt($params)
    {
    }

    public function generateMenu($params)
    {
    }

    /**
     * @param $useMenuIcon
     * @param $items
     * @param $row
     * @return string
     */
    private function getMenuIcon($useMenuIcon, $items, $row)
    {
        $ico = ';icon-uri=';
        if ($useMenuIcon) {
            $menuParams = $items->getParams($row->id);
            $icon = $menuParams->get('menu_image', '');
            if ($icon) {
                $ico .= "/images/stories/" . $icon;
                return $ico;
            }
            return $ico;
        }
        return $ico;
    }

    private function getTargetWindowsProperty($browserNav)
    {
        switch ($browserNav) {
            case 1: // new window with navigator
                $target = 'window'; // a new Pinned Site window
                break;
            case 2: // new window without navigator
                $target = 'tab'; // a new tab in the current window
                break;
            default:
                $target = 'self'; // the current tab
        }
        return ';window-type=' . $target;
    }

    public function addDiscoverItBody($params)
    {
        if ($params->get('discover-it', true)) {

            $meta = '<div id="cedadd2home-discover"></div>';

            $body = JFactory::getApplication()->getBody();

            $matches = preg_split('/(<body.*?>)/i', $body, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
            $injectedHTML = $matches[0] . $matches[1] . $meta . $matches[2];

            JFactory::getApplication()->setBody($injectedHTML);
        }
    }

}