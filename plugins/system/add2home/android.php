<?php

require_once(dirname(__FILE__) . '/provider.php');
require_once(dirname(__FILE__) . '/helper.php');

class cedAdd2HomeAndroid extends CedAdd2HomeProvider
{

    const ANDROID = "android";

    public function isActive($agent)
    {
        $isAndroid = stripos($agent, self::ANDROID) !== false;

        return $isAndroid;
    }

    public function execute($agent, $params, $base)
    {
    }

}