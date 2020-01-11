<?php
/**
 * @package     CedAdd2Home
 * @subpackage  com_cedadd2home
 *
 * @copyright   Copyright (C) 2013-2019 galaxiis.com All rights reserved.
 * @license     The author and holder of the copyright of the software is Cédric Walter. The licensor and as such issuer of the license and bearer of the
 *              worldwide exclusive usage rights including the rights to reproduce, distribute and make the software available to the public
 *              in any form is Galaxiis.com
 *              see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.plugin.plugin');
jimport('joomla.environment.browser');
require_once 'scaler.php';
require_once(dirname(__FILE__) . '/provider.php');

class cedAdd2HomeWindows8 extends CedAdd2HomeProvider
{
    const WINDOWS = "Windows";

    public function isActive($agent)
    {
        $isWindows = stripos($agent, self::WINDOWS) !== false;

        return $isWindows;
    }

    public function execute($agent, $params, $base)
    {
    }

}